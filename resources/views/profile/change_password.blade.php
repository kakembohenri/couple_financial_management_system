<!DOCTYPE html>
<html lang="en">
    @extends('layout.header_nav')
    <body>
        <div class='dashboard-main-container'>
            @extends('layout.navbar')
            <div class='profile-header'>
                <h2>Change password</h2>
            </div>
            @if(!empty(session('status')))
                <div class='popup' id='popup'>
                    <div class='popup-container'>
                        <p>{{ session('status') }}</p>
                    </div>
                </div>
            @endif
            <div class='profile-container'>
                <form class='form form-change_password' action='{{ route('change-password') }}' method="post">
                    @csrf
                    <div class='form-profile'>
                        <div class='profile-item'>
                            <label for="password">New password:</label>
                            <input type='password' name='password' />
                            @error('password')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class='profile-item'>
                            <label for="confirm_password">Confirm password:</label>
                            <input type='password' name='password_confirmation' />
                        </div>
                    </div>
                    <button type='submit' class='btn'>Change password</button>
                </form>
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