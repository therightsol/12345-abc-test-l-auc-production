<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\GeneralSettings\Entities\GeneralSetting;

class InspectionCompleted extends Notification
{
    use Queueable;
    /**
     * @var
     */
    private $inspection;
    private $inspection_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($inspection)
    {
        //
        $this->inspection = $inspection;
        $inspection_unique_id = GeneralSetting::where('key', 'inspection_unique_id')->first();
        if ($inspection_unique_id) {
            $this->inspection_id = $inspection_unique_id->value ?: $inspection->id;

        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->line('Your car inspection has been completed.')
                    ->line('Your Inspection id is ('.$this->inspection_id.$this->inspection->id.')')
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
