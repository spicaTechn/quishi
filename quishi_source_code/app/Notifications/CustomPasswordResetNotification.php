<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomPasswordResetNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $token,$link;

    public function __construct($token)
    {
        //
        $this->token    = $token;
        $this->link     = url( "/password/reset/?token=" . $this->token ); 
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
                    ->view('quishi_login.passwordReset',['link' => $this->link])
                    ->subject('Password Reset')
                    ->line("You're receiving this email because we received a password reset request for your account.")
                    ->action('Reset Password',$this->link)
                    ->line('If you did not request a password reset, Please ignore this email or Contact Us at 
                      <a href="mailto:support@quishi.com">support@quishi.com</a>');

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
