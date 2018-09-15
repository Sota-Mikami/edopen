<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmailInformPayment extends Mailable
{
    use Queueable, SerializesModels;

    protected $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {

         $this->user = Auth::user();
        $this->content = $content;
        // dd($this->content);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('【EDOPEN】注文内容の確認')
                    ->view('content.email.inform')
                    ->with([
                        'content_title'=>$this->content->title,
                        'user_name' => $this->user->name,
                    ]);
    }
}
