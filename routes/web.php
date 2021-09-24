<?php

use App\Events\Test;
use App\Events\UserSignedUp;
use App\Http\Controllers\NotificationsController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


// Notifications Routes below

Route::group(
    [
        'prefix' => 'db-notifications',
        'as' => 'notification.',
        'middleware' => 'auth'
    ],
    function () {
        Route::get('/send-notification', [NotificationsController::class, 'SendTestMail'])->name('send');
        Route::get('/get-notifications', [NotificationsController::class, 'GetUserNotifications'])->name('get');
        Route::get('/mark-all-as-read', [NotificationsController::class, 'MarkAllAsRead'])->name('mark-all-as-read');
    }
);

Route::group(
    [
        'prefix' => 'web-sockets',
        'as' => 'web-sockets.',
        'middleware' => 'auth'
    ],
    function () {

        // to send a test event
        Route::get('/broadcast', function () {
            broadcast(new Test());
            dd('Event Sent, please make sure you have received an alert on your previous tab ! You can refresh this tab again and again for testing');
        })->name('test');

        // to send a test event
        Route::get('/broadcast-new-registration', function () {
            broadcast(new UserSignedUp('testingeventmail@test.com'));
            dd('Please refer to the previous page before the notification disappears ! timeout = 10s');
        })->name('new-user');
    }
);
