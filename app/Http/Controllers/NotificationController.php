<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\customNotification;
use App\Http\Requests\SendNotificationRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    use ApiResponseTrait;
    //to send notification
    public function send(SendNotificationRequest $request){
        if (!Auth::check()) {
            return $this->errorResponse('User not authenticated', 401);
        }
        // Find the user by ID
        $user = User::find(Auth::user()->id);

        if (!$user) {
            return $this->errorResponse('User not found', 404);
        }

        // Send the notification
        $user->notify(new CustomNotification($request->input('title'), $request->input('message')));

        return $this->successResponse(null,'Notification sent successfully');
    }

    //to get all notification
    public function index(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if (!$user) {
            return $this->errorResponse('User not found',404);
        }

        //This line fetches all notifications that have been sent to the user
        $notifications=$user->notifications()->latest()->paginate(10);

        //Check whether there are notifications or not
        if ($notifications->isEmpty()) {
            return $this->successResponse([],'No notifications available');
        }
        return $this->successResponse([
            'data' => $notifications->items(),
            'pagination' => [
                'total' => $notifications->total(),
                'per_page' => $notifications->perPage(),
                'current_page' => $notifications->currentPage(),
                'last_page' => $notifications->lastPage(),
                'next_page_url' => $notifications->nextPageUrl(),
                'prev_page_url' => $notifications->previousPageUrl(),
            ]
            ]);
    }

    //mark as read
    public function markAsRead(Request $request){
        if (!Auth::check()) {
            return $this->errorResponse('User not authenticated', 401);
        }
        $user = User::find(Auth::user()->id);
        if (!$user) {
            return $this->errorResponse('User not found', 404);
        }
        //Check if there are any unread notifications
        if($user->unreadNotifications->count()===0){
            return $this->successResponse([],'No unread notification to mark as read');
        }
        //to put a mark as read
        $user->unreadNotifications->markAsRead();
        $this->successResponse(null, 'Notifications marked as read');    }

}
