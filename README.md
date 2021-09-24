Steps for Laravel Websockets Working on live/localserver

1. Create Project
 -> composer create-project laravel/laravel NotificationsWorking
 -> cd NotificationsWorking

2. Install breeze and other required packages with the commands below
 -> composer require laravel/breeze
 -> php artisan breeze:install
 -> npm install
 -> npm run dev
 -> composer require beyondcode/laravel-websockets -w
 -> php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"
 -> php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"
 -> php artisan notifications:table
 -> composer require pusher/pusher-php-server "~3.0"
 -> php artisan migrate
 -> php artisan make:notification EmailNotification

// update the file as

private $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->data['subject'])
            ->greeting($this->data['greetings'])
            ->line($this->data['description'])
            ->action($this->data['login-details'], $this->data['website'])
            ->line($this->data['footer']);
    }

public function toArray($notifiable)
    {
        return [
            'user_id' => $this->data['user']
        ];
    }

3. Create a notification controller and write the send notification function
 -> php artisan make:controller NotificationsController

4. Create a route to store this notification via your browser
  -> Route::get('/send-notification', [NotificationsController::class, 'SendTestMail']);

5. Below is the function to send a test email

$user = User::find(Auth::user()->id);

        $data = [
            'subject' => 'Some Subject',
            'greetings' => 'Some greetings',
            'description' => 'Some Description',
            'login-details' => 'Some login details',
            'website' => url('/'),
            'footer' => 'Some footer details',
            'user_id' => Auth::user()->id
        ];

        Notification::send($user, new EmailNotification($data));

        dd('Task completed!');

// make sure to add these lines in your .env

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=grapefamilytracker@gmail.com
MAIL_PASSWORD=bilalasd123
MAIL_ENCRYPTION=tls
MAIL_FROM_NAME="${APP_NAME}"

6. Fetching the user notifications are easier, make a route

 -> Route::get('/get-notifications', [NotificationsController::class, 'GetUserNotifications']);

Note : GetUserNotification function is as below

	$user = User::find(Auth::user()->id);
        dd($user->notifications);

        // some common data fetching
        foreach ($user->unreadNotifications as $notification) {
            echo $notification->type;
        }
        foreach ($user->notifications as $notification) {
            echo $notification->type;
        }
	foreach ($user->unreadNotifications as $notification) {
    		$notification->markAsRead();
	}

	$user->unreadNotifications()->update(['read_at' => now()]);

// Laravel websockets begin here

1. set BROADCAST_DRIVER=pusher in env

2. Head over to config/app.php and make sure App\Providers\BroadcastServiceProvider::class

3. Add this in broadcasting.php

'pusher' => [
    'driver' => 'pusher',
    'key' => env('PUSHER_APP_KEY'),
    'secret' => env('PUSHER_APP_SECRET'),
    'app_id' => env('PUSHER_APP_ID'),
    'options' => [
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'encrypted' => true,
        'host' => '127.0.0.1',
        'port' => 6001,
        'scheme' => 'http'
    ],
],

4. Add these as pusher default settings in env

PUSHER_APP_ID=local
PUSHER_APP_KEY=local
PUSHER_APP_SECRET=local
PUSHER_APP_CLUSTER=mt1

5. After this type php artisan websockets:serve on cli and goto http://127.0.0.1:8000/laravel-websockets and connect
and make sure it is connected and you can see the events log on dashbaord + cli

6. Now make a Test event to listen it on the browser for testing purpose

 -> php artisan make:event Test

7. Register event in channels.php

Broadcast::channel('test', function ($user) {
    return true;
});

8. Make a route to test the sending of event

Route::get('/broadcast', function () {
    broadcast(new Test());
    dd('Event Sent');
});

// Now to listen this event on front end use echo

9. Following configuration works fine for laravel blade template

<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script src="{{ asset('js/pusher/echo.js') }}"></script>
<script src="{{ asset('js/pusher/echo.iife.js') }}"></script>

<script>
    let PUSHER_KEY = '{{ env('MIX_PUSHER_APP_KEY') }}';
    let PUSHER_CLUSTER = '{{ env('PUSHER_APP_CLUSTER') }}';
</script>

<script src="{{ asset('js/pusher/main.js') }}"></script>

// Please make sure echo.js is included