<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::get()->count();
        $females = User::where('gender', 'female')->get()->count();
        $males = User::where('gender', 'male')->get()->count();

        return view('admin.dashboard')->with('users', $users)->with('females', $females)->with('males', $males);
    }

    // Get admin profile
    public function get_profile()
    {
        return view('admin.profile');
    }

    // Update my profile
    public function store(Request $request)
    {

        $this->validate($request, [
            'f_name' => 'required',
            'l_name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone_number' => 'required'
        ]);

        if (auth()->user()->email !== $request->email) {
            $this->validate($request, [
                'email' => 'email|unique:users'
            ]);
        }

        User::where('id', auth()->user()->id)->update([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'username' => $request->username,
            'email' => $request->email,
            'tel_no' => $request->phone_number
        ]);

        return back()->with('status', 'Profile successfully updated');
    }

    // Get users to manage

    public function manage()
    {
        $users = User::get();
        return view('admin.manage')->with('users', $users);
    }

    // Delete user
    public function del_user(Request $request)
    {
        $id = $request->id;
        // Get couple id
        $couple = DB::table('couple')->where('wife', $id)->orWhere('husband', $id)->first();

        // if couple id is present
        if ($couple !== null) {

            $couple_id = $couple->id;
            // Remove user from couples table
            DB::table('couple')->where('id', $couple_id)->delete();

            // Remove couple from bills table
            Bills::where('couple_id', $couple_id)->delete();

            // Remove couple from accounts
            DB::table('accounts')->where('couple_id', $couple_id)->delete();
        }

        // Remove user from user table
        User::where('id', $id)->delete();

        // Remove user from messages
        Messages::where('sender_id', $id)->orWhere('reciever_id', $id)->delete();


        // Remove user from Bills table
        Bills::where('user_id', $id)->delete();


        // Remove user from accounts
        DB::table('accounts')->where('user_id', $id)->delete();



        return back()->with('status', 'User successfully deleted');
    }

    // Get create profile admin
    public function get_create()
    {
        return view('admin.create');
    }

    // Create profile
    public function create_profile(Request $request)
    {
        $this->validate($request, [
            'f_name' => 'required',
            'l_name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required',
            'gender' => 'required',
            'role' => 'required',
            'phone_number' => 'required',
            'password' => 'required|confirmed'
        ]);

        // Create a new user
        User::create([
            'username' => $request->username,
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'tel_no' => $request->phone_number,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Get user id
        $user_id = User::select('id')->where('email', $request->email)->first();

        // Update user
        User::where('email', $request->email)->update(['email_verified_at' => true]);

        // Create new record in admin table if role is 'admin'
        if ($request->role === 'admin') {

            DB::table('admin')->insert([
                'user_id' => $user_id->id
            ]);
        }

        return redirect()->route('admin.dashboard')->with('status', 'Successfully created a new user');
    }
}
