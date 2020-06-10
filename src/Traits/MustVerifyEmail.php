<?php

namespace Datakrama\Lapiuth\Traits;

use Datakrama\Lapiuth\Notifications\VerifyEmailRequest;
use Illuminate\Auth\MustVerifyEmail as DefaultMustVerifyEmail;

trait MustVerifyEmail
{
    use DefaultMustVerifyEmail;

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailRequest);
    }
}