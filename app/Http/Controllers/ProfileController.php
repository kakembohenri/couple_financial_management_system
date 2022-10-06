<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Get user profile

    public function index()
    {
        return view('profile.profile');
    }

    // Get Change password 
    public function change_password()
    {
        return view('profile.change_password');
    }

    // Update profile
    public function update(Request $request)
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
        // dd(auth()->user()->id);
    }

    public function update_password(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);


        User::where('id', auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('status', 'Password successfully changed');
    }
}
