<?php

namespace Datakrama\Lapiuth\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Reset password token
     *
     * @var string
     */
    protected $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('Reset Password Notification'))
                    ->markdown('lapiuth::email.user.password.reset')
                    ->with([
                        'url' => env('CLIENT_URL', env('APP_URL')),
                        'token' => $this->token,
                        'count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')
                    ]);
    }
}
