<?php

namespace App\Http\Middleware;

use App\Models\Notification;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class GlobalNotificationsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return $next($request);
        }

        // Obtener el usuario autenticado
        $user = $request->user();

        // Obtener las notificaciones filtradas
        $notifications = Notification::where('enabled', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->get()
            ->filter(function (Notification $notification) use ($request, $user)
            {
                // Verificar que la cookie no existe si se define un cookie_name
                $isCookieAbsent = ! $notification->cookie_name || ! $request->cookies->has($notification->cookie_name);

                // Filtrar basado en el target_audience
                $isTargetAudienceValid = match (true) {
                    is_null($notification->target_audience) => true, // Sin audiencia objetivo, mostrar a todos
                    isset($notification->target_audience['roles']) &&
                    in_array($user->role->id, $notification->target_audience['roles']) => true, // Rol permitido
                    default => false // Cualquier otro caso
                };

                // Retornar true si la cookie está ausente y el usuario es parte de la audiencia objetivo
                return $isCookieAbsent && $isTargetAudienceValid;
            });

        // Compartir las notificaciones filtradas con la vista de manera global
        View::share('globalNotifications', $notifications);

        return $next($request);
    }
}
