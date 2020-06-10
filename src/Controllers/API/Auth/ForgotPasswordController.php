<?php

namespace Datakrama\Lapiuth\Controllers\API\Auth;

use Datakrama\Lapiuth\Controllers\Controller;
use Datakrama\Lapiuth\Traits\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
}
