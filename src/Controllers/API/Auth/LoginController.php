<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Datakrama\Lapiuth\Traits\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
}
