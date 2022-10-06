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
            <h3>Create Profile</h3>
            <div class='profile-container'>
                <form class='form form-profile_admin' action='' method="POST">
                    @csrf
                    <div class='form-profile'>
                        <div class='profile-item'>
                            <label for="f_name">First name:</label>
                            <input type='text' name='f_name' />
                            @error('f_name')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class='profile-item'>
                            <label for="l_name">Last name:</label>
                            <input type='text' name='l_name' />
                            @error('l_name')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class='profile-item'>
                            <label for="username">Username:</label>
                            <input type='text' name='username' />
                            @error('username')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class='profile-item'>
                            <label for="email">Email:</label>
                            <input type='text' name='email' />
                            @error('email')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class='profile-item item-select'>
                            <label for="gender">Gender:</label>
                            <select name='gender'>
                                <option selected value="">--Select Gender--</option>
                                <option value='male'>Male</option>
                                <option value='female'>Female</option>
                            </select>
                            @error('gender')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class='profile-item item-select'>
                            <label for="gender">Priviledges:</label>
                            <select name='role'>
                                <option selected value="">--Select Priviledge--</option>
                                <option value='admin'>Admin</option>
                                <option value='normal'>Normal</option>
                            </select>
                            @error('role')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class='profile-item'>
                            <label for="phone_number">Phone Number:</label>
                            <input name='phone_number' type="text" />
                            @error('phone_number')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class='profile-item'>
                            <label for="password">Password:</label>
                            <input name='password' type="password" />
                            @error('password')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class='profile-item'>
                            <label for="password">Confirm Password:</label>
                            <input name='password_confirmation' type="password" />
                           
                        </div>
                    </div>
                    <button type='submit' class='btn'>Create</button>
                </form>
            </div>  
        </div>
    </div>
    <script>
        let submit = document.querySelector("button[type='submit']")
 
         let pop = document.querySelector('#popup')
 
         submit.addEventListener('click', prevent)
 
             function prevent(e){
                 e.preventDeafault()
             }
 
         if(pop !== null){
 
             setTimeout(() => {
              pop.className = 'popup-close'
             }, 9000);
         }
     </script>
</body>
</html>