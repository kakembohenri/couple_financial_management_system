<!DOCTYPE html>
<html lang="en">
@extends('layout.header_nav_admin')
<body>
    @if(!empty(session('status')))
    <div class='popup' id='popup'>
        <div class='popup-container'>
            <p>{{ session('status') }}</p>
        </div>
    </div>
    @endif
    <div class='admin-main-container'>
        @extends('layout.navbar_admin')
        <div class='admin-dashboard'>
            <h3>Profile</h3>
            <div class='profile-container'>
                <form class='form form-profile_update' action='{{ route('admin.profile', ['name' => auth()->user()->username]) }}' method="POST">
                    @csrf
                    <div class='form-profile'>
                        <div class='profile-item'>
                            <label for="f_name">First name:</label>
                            <input type='text' name='f_name' value={{ auth()->user()->f_name }} />
                            @error('f_name')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class='profile-item'>
                            <label for="l_name">Last name:</label>
                            <input type='text' name='l_name' value={{ auth()->user()->l_name }} />
                            @error('l_name')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class='profile-item'>
                            <label for="username">Username:</label>
                            <input type='text' name='username' value={{ auth()->user()->username }} />
                            @error('username')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class='profile-item'>
                            <label for="email">Email:</label>
                            <input type='text' name='email' value={{ auth()->user()->email }} />
                            @error('email')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class='profile-item item-gender'>
                            <label for="gender">Gender:</label>
                            <p>{{ auth()->user()->gender }}</p>
                        </div>
                        <div class='profile-item'>
                            <label for="phone_number">Phone Number:</label>
                            <input name='phone_number' type="text" value={{ auth()->user()->tel_no }} />
                            @error('phone_number')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <button type='submit' class='btn'>Save</button>
                </form>
            </div>  
        </div>
    </div>
</body>
</html>