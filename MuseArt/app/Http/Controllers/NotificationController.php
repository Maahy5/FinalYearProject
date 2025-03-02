<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\User;
use App\Notifications\SubscribedUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $notifications = $user->notifications;


        return view('notification', compact('notifications'));  // Return the view with artists data
    }

    public function destroy() {}





    /* 
    //For sending notification to users
    public function sendNotifications(Request $request, $artist_id)
    {
        $this->validate($request, [
            'message' => 'required|string',
        ]);

        $artists = Artist::findOrFail($artist_id);


        //Get the message
        $message = $request->input('message');

        //fetching subscribed users
        $subscribedUsers = User::where('is_subscribed', true)->get();

        //Sending the notification to all subscribed users
        Notification::send($subscribedUsers, new SubscribedUserNotification($message));

        return back()->with('success', 'Notification sent successfully to all subscribed users.');
    } */
}
