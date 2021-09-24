<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <h1 class="text-blue-700 text-3xl"><strong>Below are some necessary routes to test the working of the
                            project
                            !</strong></h1>
                    <small>Only the first user ( ID = 1 ) will get the push notifications of any new user who signs
                        up!</small>
                    <small>Notification has an interval of 10 secs</small>
                </div>
                <x-new-user-signed-up />
                <br>
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2>1. To send a test event <a class="hover:text-blue-500 hover:underline" target="__blank"
                            href="{{ route('web-sockets.test') }}">Click
                            here</a></h2>
                    <small>Note : This is the testing of retrieval of web-socket message !</small>
                    <hr>
                    <h2>2. To test the new sign up notification <a class="hover:text-blue-500 hover:underline"
                            target="__blank" href="{{ route('web-sockets.new-user') }}">Click
                            here</a></h2>
                    <small>Note : This will send a new sign up event , system will return the email of the newly
                        signed up user ! </small>
                    <br>
                    <small class="text-red-500"><strong>Only the first signed up user will get this notification as it
                            is on private channel and only user with id 1 can listen</strong></small>
                    <hr>
                    <h2>3. To send a mail to the logged in user's email address and every time a notification is created
                        the an email was sent to your mail ! <a class="hover:text-blue-500 hover:underline"
                            target="__blank" href="{{ route('notification.send') }}">Click
                            here</a></h2>
                    <small>Note : This is to test that the email is received and a notification is stored in database
                        !</small>
                    <hr>
                    <h2>4. To view the number of notifications along with their statuses ! <a
                            class="hover:text-blue-500 hover:underline" target="__blank"
                            href="{{ route('notification.get') }}">Click
                            here</a></h2>
                    <small>Note this is the testing of retrieval of web-socket message !</small>
                    <h2>5. Mark all notifications as read <a class="hover:text-blue-500 hover:underline"
                            target="__blank" href="{{ route('notification.mark-all-as-read') }}">Click
                            here</a></h2>
                    <small>Note : This will make all of you notifications as read !</small>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <h1 class="text-red-700 text-3xl"><strong>----------- End ------------</strong></h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script src="{{ asset('js/pusher/echo.js') }}"></script>
<script src="{{ asset('js/pusher/echo.iife.js') }}"></script>

<script>
    let PUSHER_KEY = '{{ env('MIX_PUSHER_APP_KEY') }}';
    let PUSHER_CLUSTER = '{{ env('PUSHER_APP_CLUSTER') }}';
    let SOME_ID = '{{ Auth::user()->id }}';
</script>

<script src="{{ asset('js/pusher/main.js') }}"></script>
