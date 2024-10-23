<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Check if the user has too many failed login attempts.
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            RateLimiter::clear($this->throttleKey($request)); // Clear on successful login
            return $this->sendLoginResponse($request);
        }

        // Increment the number of failed attempts for the user
        RateLimiter::hit($this->throttleKey($request));

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Send the lockout response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        return redirect()->back()
        ->withErrors(['message' => 'Too many login attempts. Please try again in ' . $seconds . ' seconds.'])
        ->withInput($request->only($this->username(), 'remember'));
    }

    /**
     * Generate the throttle key for the login attempt.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input($this->username())) . '|' . $request->ip();
    }
}
