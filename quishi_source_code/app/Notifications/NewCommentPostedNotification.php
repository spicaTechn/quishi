<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewCommentPostedNotification extends Notification
{
    use Queueable;
    protected $message, $user_image, $link;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message,$user_image,$link)
    {
        //
        $this->message    = $message;
        $this->user_image = $user_image;
        $this->link       = $link;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
            'message'    => $this->message,
            'user_image' => $this->user_image,
            'url'        => $this->link
        ];
    }
}
