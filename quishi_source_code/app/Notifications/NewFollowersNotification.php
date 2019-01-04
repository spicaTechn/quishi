<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use URL;
use App\User, App\Model\UserProfile;

class NewFollowersNotification extends Notification
{
    use Queueable;

    protected $follower;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($follower)
    {
        //

        $this->follower = $follower;
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

        //find the targeted user image
        $user_profile_image = User::findOrFail($this->follower->id)->user_profile->image_path;
        return [
            'message'       => $this->follower->name .' has started to following you',
            'url'           => URL::to('/career-advisor/'.$this->follower->id.'/'.str_slug($this->follower->user_profile->first_name)),
            'user_image'    => ($user_profile_image != "") ? asset('/front/images/profile/') .'/' . $user_profile_image : asset('/front/images/blog1.jpg'),
        ];


    }
}
