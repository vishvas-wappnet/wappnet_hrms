<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $user;


    /**
     * Create a new job instance.
     *
     * @return void
     * 
     * pub
     */
    
    //  public function __construct( $user)
    //  {
    //     $this->user=$user['name'];
    //      $this->user = $user['token'];
    //  }


     public function __construct()
     {
        
     }
    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        // $email=new ResetPassword($this->user);
        // Mail::to($this->user['email'])->send($email);
        
       // Mail::to('joejemes40@gmail.com')->send(new  SendMailable());
        Mail::to('joejemes40@gmail.com')->send(new WelcomeEmail);
        

    //    // Mail::to($request->email)->queue(new ResetPassword($this->name, $this->token));
    //     Mail::to('joejemes40@gmail.com')->queue(new  ResetPassword());
    }
}
