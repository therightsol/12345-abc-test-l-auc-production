<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewRegisterNotification extends Notification
{
    use Queueable;
    
    protected $subject;
	
	/**
	 * Create a new notification instance.
	 *
	 * @param string $subject
	 */
    public function __construct( $subject = "Welcome!")
    {
        //
		$this->subject = $subject;
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
			->subject($this->subject)
			->greeting("Thank You for registration")
			->line('This is confirmation email that you have successfully registered with Pak Auction.')
			->line('We hope you will enjoy great features. Write us anytime for suggestions or for feedback.')
			->line('Thank you for using PakAuction!');
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
