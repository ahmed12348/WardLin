<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Cache\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request, RateLimiter $limiter)
    {
        // Throttle login attempts
        if ($limiter->tooManyAttempts($this->throttleKey($request), 5, 1)) {
            // Return an error response after too many attempts
            throw ValidationException::withMessages([
                'email' => 'Too many login attempts. Please try again later.',
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->device_token !== $request->device_token) {
                // Deactivate previous device/token
                $user->device_token = $request->device_token;
                $user->save();
            }

            $limiter->clear($this->throttleKey($request)); // Clear attempts on successful login

            // Generate and return API token (use your token generation logic here)
            // Example: If using Sanctum
            $token = $user->createToken('MyApp')->plainTextToken;

            return response()->json(['token' => $token], 200);
        } else {
            $limiter->hit($this->throttleKey($request)); // Increment login attempts
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials.',
            ]);
        }
    }

    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }
}
