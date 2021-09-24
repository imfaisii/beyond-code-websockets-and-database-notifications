<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationsController extends Controller
{

    public function SendTestMail()
    {
        $user = User::find(Auth::user()->id);

        $data = [
            'subject' => 'Some Subject',
            'greetings' => 'Some greetings',
            'description' => 'Some Description',
            'login-details' => 'Some login details',
            'website' => url('/'),
            'footer' => 'Some footer details',
            'store_info' => 'A test email was sent to your email address !'
        ];

        Notification::send($user, new EmailNotification($data));

        dd('A test email was sent to the email address ' . Auth::user()->email . '. Go back and click on view notifications to make sure that the notification is stored !');
    }

    public function GetUserNotifications()
    {
        $user = User::find(Auth::user()->id);
        $notificationsData = array();
        foreach ($user->notifications as $notification) {
            array_push($notificationsData,$notification->data);
        }
        $details = array(
            'Your Total Notifications : ' =>  $user->notifications->count(),
            'Your total unread notifications : ' => $user->unreadNotifications->count(),
            'Your total read notifications : ' => $user->notifications->count() - $user->unreadNotifications->count(),
            'Data stored in each notification : ' => $notificationsData
        );
        dd($details);
        
        // dd($user->notifications);

        // some common data fetching
        foreach ($user->unreadNotifications as $notification) {
            echo $notification->type . '<br>';
        }
        foreach ($user->notifications as $notification) {
            echo $notification->type . '<br>';
        }
        return;
    }

    public function MarkAllAsRead()
    {
        $user = User::find(Auth::user()->id);
        $user->unreadNotifications->markAsRead();
        dd('All of your notifications are now marked as read ! Please revisit the previous url to confirm !');
    }
    
}
