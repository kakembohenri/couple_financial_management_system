<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

    // public function __construct(){
    //     $this->middleware(['guest']);
    // }

    // Logout
    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }

    // Login view
    public function index()
    {
        return view('forms.login');
    }

    // Forgot password view
    public function forgot_password()
    {
        return view('forms.forgot_password');
    }

    // Reset password view
    public function reset_password()
    {
        return view('forms.reset_password');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('username', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid Credentials');
        }

        // Check if user id is in the admin table
        $admin = DB::table('admin')->where('user_id', auth()->user()->id)->first();

        if ($admin === null) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    // Forgot password
    public function send_token(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        // Check if email address is in the users table
        $user = User::where('email', $request->email)->first();

        if ($user !== null) {

            // Create record in passwords table
            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token
            ]);

            Mail::to($request->email)->send(new ForgotPassword($token, $request->email));

            return back()->with('status', 'Password reset token has been sent to your email address');
        } else {
            return back()->with('status', 'This email address doesnt exist in our system!');
        }
    }

    // Check password reset credentials
    public function check_credentials(Request $request)
    {

        $user = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if ($user !== null) {
            // Create an email session and token session
            session(['email' => $request->email]);

            session(['token' => $request->token]);

            return redirect()->route('reset-password')->with('status', 'Reset your password');
        } else {
            echo 'Unrecognised credentials';
        }
    }

    public function new_password(Request $request)
    {

        $this->validate($request, [
            'password' => 'required|confirmed'
        ]);

        // Check if password belongs to user
        // $user = User::where('email', session('email'))->where('password', Hash::make($request->password))->get();
        $user = DB::table('password_resets')->where([
            'email' => session('email'),
            'token' => session('token')
        ])->first();

        if ($user !== null) {
            // Update user table
            User::where('email', session('email'))->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('login')->with('status', 'Password has been changed successfully');
        } else {
            return back()->with('status', 'Illegal attempt has been noticed');
        }
    }
}
