<?php

namespace App\Notifications;

use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Stringable;

class JadwalNotif2 extends Notification
{
    use Queueable;
    protected $start_time;
    protected $keterangan;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($keterangan)
    {
        // $this->start_time = $start_time;
        $this->keterangan = $keterangan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    // public function toBroadcast($notifiable)
    // {
    //     return [
    //         'data' => [
    //             'keterangan' => $this->keterangan,
    //             'waktu' => $this->start_time->format('Y-m-d H:i:s'),
    //         ],
    //     ];
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $acara = new Stringable($this->keterangan);
        return "Acara " . $acara . " akan segera dimulai kurang dari 1 jam lagi.";
    }
}
