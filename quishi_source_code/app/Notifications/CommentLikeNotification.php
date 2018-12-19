<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommentLikeNotification extends Notification
{
    use Queueable;

    protected $message,$link,$image_url;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message,$link,$image_url)
    {
        //
        $this->message    = $message;
        $this->link       = $link;
        $this->image_url  = $image_url;
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
            'user_image' => $this->image_url,
            'url'        => $this->link
        ];
    }
}
