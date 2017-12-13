<?php

namespace App\Mail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class registration extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $next;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $next)
    {
        $this->user = $user;
        $this->next = $next;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        // return $this->view('email.registration');
        return $this->view('email.registration')->with(['activation_link' => '/auth/user/activation/' . $this->user->verification_code . '?next=' . $this->next]);
    }
}
