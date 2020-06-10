<?php

namespace Datakrama\Lapiuth\Controllers\API\Auth;

use Datakrama\Lapiuth\Controllers\Controller;
use Datakrama\Lapiuth\Traits\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;
}
