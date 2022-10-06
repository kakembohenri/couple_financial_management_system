<!DOCTYPE html>
<html lang="en">
@extends('layout.header')
<body>
    @if(!empty(session('status')))
    <div class='popup' id='popup'>
        <div class='popup-container'>
            <p>{{ session('status') }}</p>
        </div>
    </div>
    @endif
    <div class='form-main-container '>
        <img class='form-bgimg' src="{{ asset('bg3.jpg') }}" />
        <div class='form-container'>
            <div>
                <h3>Login</h3>
            </div>
            <form class='form form-login' action="{{ route('login') }}" method='post'>
                @csrf
                <div class='input-container'>
                    <input type="text" name='username' placeholder="Username">
                    @error('username')
                    <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class='input-container'>
                    <input type="password" name='password' placeholder="Password">
                    @error('password')
                    <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class='checkbox'>
                    <input type="checkbox">
                    <p>Remember me</p>
                </div>
                <button type='submit' class='btn btn-login'>Login</button>
                <a href="{{ route('forgot-password') }}">Forgot your password</a>
                <a href="{{ route('register') }}">Dont have an account?</a>
            </form>
        </div>
    </div>
    <script>
        let submit = document.querySelector("button[type='submit']")
        let popup = document.querySelector('#popup')

        submit.addEventListener('click', prevent)

        function prevent(e){
            e.preventDeafault()
        }

        if(popup !== null){

            setTimeout(() => {
             popup.className = 'popup-close'
            }, 9000);
        }
    </script>
</body>
</html>