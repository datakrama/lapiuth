<?php

namespace Datakrama\Lapiuth\Traits;

use Carbon\Carbon;
use Datakrama\Lapires\Traits\ApiResponser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers as DefaultRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

trait RegistersUsers
{
    use ApiResponser, DefaultRegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $user->assignRole('user');
        $userToken = $user->createToken('Portpoliwo Personal Access Token');
        $data = [
            'user' => $user,
            'token' => $userToken->accessToken,
            'type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $userToken->token->expires_at
            )->toDateTimeString()
        ];

        return $this->registered($request, $user)
                        ?: $this->successResponse($data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return DB::table($this->getDefaultAuthTable())->insert(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }

    /**
     * Get default auth table
     *
     * @return void
     */
    public function getDefaultAuthTable()
    {
        $provider = config('auth.guards.api.provider');
        $table = config('auth.providers.' . $provider . '.table');
        if (config('auth.providers.' . $provider . '.driver') == 'eloquent') {
            $model = config('auth.providers.' . $provider . '.model');
            $table = new $model;
            $table = $table->getTable();
        }
        return $table;
    }
}