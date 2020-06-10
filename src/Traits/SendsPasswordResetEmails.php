<?php

namespace Datakrama\Lapiuth\Traits;

use Datakrama\Lapires\Traits\ApiResponser;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails as DefaultSendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

trait SendsPasswordResetEmails
{
    use ApiResponser, DefaultSendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Send password reset email
     *
     * @param Request $request
     * @return void
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );
        return $response == Password::RESET_LINK_SENT
            ? $this->successResponse(null, trans('passwords.sent'), 201)
            : $this->errorResponse(401, trans('passwords.user'));
    }
}