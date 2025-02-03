<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\customNotification;

class NotificationController extends Controller
{
    //to send notification
    public function sendNotification(Request $request){
        $user=User::find($request->input('user_id'));
        if(!$user){
            return response()->json(['error'=>'User not found']);
        }
         //to send new notification to user
         $user->notify(new customNotification($request->input('title'), $request->input('message')));
        return response()->json(['success'=>'Notification sent successsfully']);
    }

    //to get all notification
    public function getNotifications(Request $request)
    {
        $user = User::find($request->input('user_id'));
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        //This line fetches all notifications that have been sent to the user
        $notifications=$user->notifications()->latest()->get();
        return response()->json($notifications);
    }

    //mark as read
    public function markAsRead(Request $request){
        $user = User::find($request->input('user_id'));
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        //to put a mark as read
        $user->unreadNotifications->markAsRead();
        return response()->json(['success' => 'Notifications marked as read']);
    }

}
