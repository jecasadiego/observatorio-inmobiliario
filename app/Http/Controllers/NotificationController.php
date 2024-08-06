<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = auth()->user()->unreadNotifications->find($id);
        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['status' => 'success', 'message' => 'Notification marked as read', 'data' => $notification], 200);
    }
}
