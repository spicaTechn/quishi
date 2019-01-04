<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth, URL;
class BlogLikeNotification extends Notification
{
    use Queueable;

    protected $blog;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($blog)
    {
        //
        $this->blog   = $blog;
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

            'message'  => (Auth::check())  ? Auth::user()->name .' likes your blog "' . $this->blog->title .'"'  : 'anonymous likes your blog "'.$this->blog->title .'"',
            'user_image' => (Auth::check()) ? (Auth::user()->user_profile->image_path != "") ? asset('/front/images/profile/') .'/' . Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg') : asset('/front/images/blog1.jpg'),
            'url'       => URL::to('/blog/'.$this->blog->id.'/'.$this->blog->slug)
        ];
    }
}
