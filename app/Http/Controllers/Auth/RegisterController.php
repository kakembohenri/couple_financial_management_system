<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendToken;
use App\Models\EmailVerify;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    // public function __construct(){
    //     $this->middleware(['guest']);
    // }

    // Create an account
    public function index()
    {
        return view('forms.create_account');
    }

    // Create profiles
    public function create_profile()
    {
        return view('forms.create_profile');
    }

    public function create_account(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $token = Str::random(64);

        // $user_id = User::select('id')->where('email', $request->email)->get();

        Mail::to($request->email)->send(new SendToken($token, $request->email));

        EmailVerify::create([
            'email' => $request->email,
            'token' => $token
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        session(['password' => $request->password]);

        return back()->with('success', 'A verification code has been sent to your email address');
    }

    // Verify token and email
    public function verify(Request $request)
    {

        $isPresent = EmailVerify::where('email', $request->email)->where('token', $request->token)->get();

        if (count($isPresent) > 0) {

            echo 'Verifying email address...';
            // Verify user account
            User::where('email', $request->email)->update(['email_verified_at' => true]);

            session(['email' => $request->email]);

            EmailVerify::where('email', $request->email)->delete();
            return redirect()->route('create-profile')->with('verified', 'Your email address has been verified. Proceed with creating your account');
        } else {
            $user = User::where('email', $request->email)->where('email_verified_at', true)->get();

            if (count($user) > 0) {
                session(['email' => $request->email]);

                return redirect()->route('create-profile')->with('verified', 'Please complete your profile');
            } else {
                echo 'Access Forbidden!';
            }
        }
    }

    // Fill your profile
    public function fill_profile(Request $request)
    {

        $this->validate($request, [
            'f_name' => 'required',
            'l_name' => 'required',
            'username' => 'required',
            'tel_no' => 'required',
            'gender' => 'required',

        ]);

        // Update users table

        User::where('email', session('email'))->update([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'username' => $request->username,
            'tel_no' => $request->tel_no,
            'gender' => $request->gender,
        ]);

        auth()->attempt(['email' => session('email'), 'password' => session('password')]);

        // Check if email address is in invitation table
        $user = DB::table('invitations')->where([
            'reciever' => session('email'),
            'status' => 'ok'
        ])->first();

        if ($user !== null) {
            // Delete any record with email address in the session
            DB::table('invitations')->where('reciever', session('email'))->delete();

            // Get user sender
            $reciever = User::where('email', session('email'))->first();

            $sender = User::where('email', $user->sender)->first();

            if ($request->gender == 'female') {
                DB::table('couple')->insert([
                    'wife' => $reciever->id,
                    'husband' => $sender->id,
                ]);
            } else {
                DB::table('couple')->insert([
                    'wife' => $sender->id,
                    'husband' => $reciever->id,
                ]);
            }
            return redirect()->route('dashboard')->with('status', 'Thanks for creating an account with us');
        }
        return redirect()->route('dashboard')->with('status', 'Thanks for creating an account with us');
    }
}
