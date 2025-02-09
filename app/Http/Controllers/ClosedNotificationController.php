<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class ClosedNotificationController extends Controller
{
    public function __invoke(Notification $notification)
    {
        if ($notification->cookie_name)
        {
            $cookieName = $notification->cookie_name;
            $cookieLifetime = $notification->cookie_lifetime_in_days * 24 * 60;

            // signature queue: make($name, $value, $minutes = 0, $path = null, $domain = null, $secure = null, $httpOnly = true, $raw = false, $sameSite = null)
            cookie()->queue($cookieName, true, $cookieLifetime);
        }

        return response()->noContent();
    }
}
