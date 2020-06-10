<?php

namespace Datakrama\Lapiuth\Controllers\API\Auth;

use Datakrama\Lapiuth\Controllers\Controller;
use Datakrama\Lapiuth\Traits\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
}
