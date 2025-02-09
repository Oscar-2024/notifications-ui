<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class DisplayedNotificationController extends Controller
{
    public function __invoke(Request $request, Notification $notification)
    {
        if ($user = $request->user()) {
            $user->uiNotifications()->attach($notification->id, [
                'displayed_at' => now(),
            ]);
        }

        return response()->noContent();
    }
}
