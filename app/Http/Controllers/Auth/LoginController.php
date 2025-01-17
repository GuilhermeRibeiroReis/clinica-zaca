<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers; // Important!

class LoginController extends Controller
{
    use AuthenticatesUsers;  // Make sure you are using this trait

    public function __construct()
    {
        // Apply 'guest' middleware
        $this->middleware('guest')->except('logout');
    }

    protected $redirectTo = '/home';
}
