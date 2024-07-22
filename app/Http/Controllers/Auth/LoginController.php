<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin) {
            session()->flash('message', 'Login berhasil! Selamat datang Admin!');
            session()->flash('alert-type', 'success');
            return redirect()->route('home');
        } else {
            session()->flash('message', 'Login berhasil! Selamat datang ' . $user->name . '!');
            session()->flash('alert-type', 'success');
            return redirect()->route('homepage');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Override the logout method
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session()->flash('message', 'Logout berhasil!');
        session()->flash('alert-type', 'success');

        return $this->loggedOut($request) ?: redirect('/');
    }
}
