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
            <h3>Dashboard</h3>
            <div class='dashboard-card-container'>
                <div class='dashboard-card'>
                    <div class='stat-box'>
                        <span>{{ $users }}</span>
                        <h4>Users</h4>
                    </div>
                    <div class='img-box'>
                        <img src="{{ asset('user.jpg') }}" alt="user pic">
                    </div>
                </div>
                <div class='dashboard-card'>
                    <div class='stat-box'>
                        <span>{{ $females }}</span>
                        <h4>Females</h4>
                    </div>
                    <div class='img-box'>
                        <img src="{{ asset('female.jpg') }}" alt="females">
                    </div>
                </div>
                <div class='dashboard-card'>
                    <div class='stat-box'>
                        <span>{{ $males }}</span>
                        <h4>Males</h4>
                    </div>
                    <div class='img-box'>
                        <img src="{{ asset('male.jpg') }}" alt="males">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let pop = document.querySelector('#popup')

        if(pop !== null){

        setTimeout(() => {
        pop.className = 'popup-close'
        }, 9000);
    </script>
</body>
</html>