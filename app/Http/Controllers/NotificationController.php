<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\customNotification;

class NotificationController extends Controller
{
    //to send notification
    public function sendNotification(Request $request){
        //Validate the incoming request data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Find the user by ID
        $user = User::find($request->input('user_id'));

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Send the notification
        $user->notify(new CustomNotification($request->input('title'), $request->input('message')));

        return response()->json(['success' => 'Notification sent successfully'], 200);
    }

    //to get all notification
    public function getNotifications(Request $request)
    {
        $user = User::find($request->input('user_id'));
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        //This line fetches all notifications that have been sent to the user
        $notifications=$user->notifications()->latest()->paginate(10);

        //Check whether there are notifications or not
        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No notifications available'], 200);
        }
        return response()->json($notifications);
    }

    //mark as read
    public function markAsRead(Request $request){
        $user = User::find($request->input('user_id'));
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        //Check if there are any unread notifications
        if($user->unreadNotifications->count()===0){
            return response()->json(['message'=>'No unread notification to mark as read'],200);
        }
        //to put a mark as read
        $user->unreadNotifications->markAsRead();
        return response()->json(['success' => 'Notifications marked as read']);
    }

}
