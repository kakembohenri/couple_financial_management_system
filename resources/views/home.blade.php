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
  <div>
    <div>
        <h3 class='home-header'>Couple Financial Management System</h3>
    </div>
    <div class='home-page'>
        <div class='backdrop-image'>
            <div class='backdrop backdrop-home'></div>
            <img src="{{ asset('bg.jpg') }}" alt='bg-pic' />
        </div>
        <div class='home-body'>
            <h2>Lorem ipsum dolor sit amet.</h2>
            <p style='width:50%;color:white;margin:1rem 0rem;'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti totam, temporibus eius ducimus neque soluta!</p>
            <div class='home-actions'>
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}" class='home-signin'>Create account</a>
            </div>

        </div>
    </div>
  </div>
</body>
</html>