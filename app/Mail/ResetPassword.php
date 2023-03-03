<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class ResetPassword extends Mailable
{
    use   Dispatchable, InteractsWithQueue, Queueable, SerializesModels ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $token;

    // public function __construct($name, $token)
    // {
    //     $this->name = $name;
    //     $this->token = $token;
    // }

    public function __construct()
    {
       
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user['name'] = $this->name;
        $user['token'] = $this->token;

        return $this->from("yoursenderemail@mail.com", "Sender Name")
        ->subject('Password Reset Link')
        ->view('template.reset-password', ['user' => $user]);
    }
}
