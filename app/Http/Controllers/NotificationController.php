<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
      public function markAsRead(Notification $notification)
    {
        $notification->markAsRead();
        return back()->with('success', 'done');
    }
     public function delete(Notification $notification)
    {
        $notification->delete();
        return back()->with('success', '✅ تم');
    }
     public function markAllAsRead()
    {
        auth()->user()->notifications->markAsRead();
        return back()->with('success', '✅ تم');
    }
   

}
