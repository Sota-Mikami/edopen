<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdatePassword extends Mailable {

    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function build()
    {
        return $this
            ->subject('パスワード変更のお知らせ')
            ->view('user.email.updatePassword');
    }


}
