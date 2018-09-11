<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        // dd($user);
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $test =$this
            ->subject('【EDOPEN】仮登録が完了しました')
            ->view('user.email.pre_register')
            ->with(['token'=>$this->user->email_verify_token,]);

            // dd($test);

        return $test;

        // return $this->view('view.name');
    }
}
