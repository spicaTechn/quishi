<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth, URL;

class ProfileAnswerLikeNotification extends Notification
{
    use Queueable;

    protected $liked_answer;
    protected $liked_question;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($answer,$question)
    {
        //
        $this->liked_answer   = $answer;
        $this->liked_question = $question; 
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
            'message'       => (Auth::check()) ? Auth::user()->name . ' likes your question "' . $this->liked_question->title .'" answer' : 'Anonymous likes your question "' . $this->liked_question->title . '" answer',
            'user_image'    => (Auth::check()) ? (Auth::user()->user_profile->image_path != "") ? asset('/front/images/profile/') .'/' . Auth::user()->user_profile->image_path : asset('/front/images/blog1.jpg') : asset('/front/images/blog1.jpg'),
            'url'           => asset('/career-advisor/'.$this->liked_answer->user_id .'/'.str_slug($this->liked_answer->user->user_profile->first_name).'#profile-answer'.$this->liked_question->id)
        ];
    }
}
