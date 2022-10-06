<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href="{{ asset('/css/app.css') }}" />
    <title>Document</title>
</head>
<body>
    @if(!empty(session('success')))
    <div class='popup' id='popup'>
        <div class='popup-container'>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif
    
    <div class='form-main-container'>
        <img class='form-bgimg' src="{{ asset('bg3.jpg') }}" />

        <div class='form-container'>
            <div>
                <h3>Create an Account</h3>
            </div>
            <form class='form form-login' action="{{ route('register') }}" method="post">
                @csrf
                <div class='input-container'>
                    <input type="text" name='email' placeholder="E-mail address">
                    @error('email')
                    <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class='input-container'>
                    <input type="password" name='password' placeholder="Password">
                    @error('password')
                    <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class='input-container'>
                    <input type="password" name='password_confirmation' placeholder="Confirm password">
                   
                </div>
                <button type='submit' class='btn'>Join</button>
                <a href="{{ route('login') }}">Already have an account?</a>
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