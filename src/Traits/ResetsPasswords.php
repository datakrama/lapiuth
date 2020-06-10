<?php

namespace Datakrama\Lapiuth\Traits;

use Carbon\Carbon;
use Datakrama\Lapires\Traits\ApiResponser;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords as DefaultResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

trait ResetsPasswords
{
    use ApiResponser, DefaultResetsPasswords;

    protected $user;

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
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('api');
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        $data = [];
        if ( ! empty($this->user)) {
            $user = $this->user;
            $userToken = $user->createToken(env('APP_NAME') . ' Personal Access Token');
            $data = [
                'user' => $user,
                'token' => $userToken->accessToken,
                'type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $userToken->token->expires_at
                )->toDateTimeString()
            ];
        }

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
            ? $this->successResponse($data, null, 201)
            : $this->errorResponse(401, trans('passwords.token'));
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);
        $user->save();
        $this->user = $user;
        event(new PasswordReset($user));
    }

}