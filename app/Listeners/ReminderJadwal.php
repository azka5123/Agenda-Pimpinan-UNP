<?php

namespace App\Listeners;

use App\Events\EventJadwal;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class ReminderJadwal implements ShouldQueue
{
    protected $pusher;

    // public function __construct(Pusher $pusher)
    // {
    //     $this->pusher = $pusher;
    // }

    public function handle(EventJadwal $event)
    {
        $notification = $event->notif;
        $notificationCount = auth()->user()->unreadNotifications->count();

        $data = [
            'notification' => $notification,
            'notification_count' => $notificationCount,
        ];

        $response = [
            'data' => $data,
            'message' => 'New notification received.',
        ];

        return response()->json($response);
    }
}
