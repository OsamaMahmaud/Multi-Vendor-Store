<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

      if ($request->has('notification_id')) {
            $notificationId = $request->input('notification_id');
            $user = Auth::user();

            if ($user) {
                $notification = $user->notifications()->find($notificationId);

                if ($notification) {
                    $notification->markAsRead();
                }
            }
        }

        return $next($request);
    }
}

