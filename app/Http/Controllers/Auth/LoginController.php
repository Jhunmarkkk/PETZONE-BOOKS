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
        \Log::info('Attempting login for: ', $request->only('email', 'password'));
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'status' => true,
                'redirect' => route('shop.products.index'), // Redirect URL after successful login
            ]);
        }

        return response()->json([
            'status' => false,
            'errors' => ['email' => 'These credentials do not match our records.']
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
            'errors' => ['email' => 'These credentials do not match our records.']
        ], 422);
    }
}