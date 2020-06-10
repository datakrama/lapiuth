<?php

namespace Datakrama\Lapiuth\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Reset password token
     *
     * @var string
     */
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('Verify Email Address'))
                    ->markdown('lapiuth::email.verify')
                    ->with([
                        'url' => $this->url
                    ]);
    }
}
