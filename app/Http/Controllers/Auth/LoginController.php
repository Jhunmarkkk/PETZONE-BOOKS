<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email', // Ensure email is required and valid
            'password' => 'required|string|min:6', // Ensure password is required and at least 6 characters
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'status' => true,
                'redirect' => route('shop.products.index'), // Redirect URL after successful login
            ]);
        }

        return response()->json([
            'status' => false,
            'errors' => ['email' => 'Invalid Email or Password. Please try again.']
        ], 422);
    }

    protected function authenticated(Request $request, $user)
    {
        return response()->json([
            'status' => true,
            'redirect' => route('shop.products.index'),
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
            'status' => false,
            'errors' => ['email' => 'Invalid Email or Password. Please try again.']
        ], 422);
    }
}