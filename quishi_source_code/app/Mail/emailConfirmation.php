<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class emailConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user,$token,$callback_url;

    public function __construct(User $user, $email_token, $callback_url)
    {
        //
        $this->user          = $user;
        $this->token         = $email_token;
        $this->callback_url  = $callback_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('quishi_login.emailConfirmation')
                    ->with([
                        'name'           => $this->user->name,
                        'email'          => $this->user->email,
                        'token'          => $this->token,
                        'callback_url'   => $this->callback_url
                    ]);
    }
}
