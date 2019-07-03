<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    use ThrottlesLogins;
    
     /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Return login view
     */
    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if(Auth::attempt(['username' => $username, 'password'=> $password, 'is_active' => '1'])){
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withInput()
            ->withErrorMessage('Invalid Username or Password !!');
    }

    /**
     * Return dashboard view
     */
    // public function onSuccess()
    // {
    //     $user = auth()->user();
    //     return view('dashboard')
    //         ->with('user', $user);
    // }

    /**
     * Logout user from application
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
