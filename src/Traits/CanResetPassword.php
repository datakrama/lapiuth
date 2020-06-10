<?php

namespace Datakrama\Lapiuth\Traits;

use Datakrama\Lapiuth\Notifications\PasswordResetRequest;
use Illuminate\Auth\Passwords\CanResetPassword as DefaultCanResetPassword;

trait CanResetPassword
{
    use DefaultCanResetPassword;

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetRequest($token));
    }
}