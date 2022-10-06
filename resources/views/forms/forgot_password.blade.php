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
    @if(!empty(session('status')))
    <div class='popup' id='popup'>
        <div class='popup-container'>
            <p>{{ session('status') }}</p>
        </div>
    </div>
    @endif
    <div class='form-main-container'>
        <div class='form-container'>
            <div>
                <h3>Forgot password</h3>
            </div>
            <form class='form form-forgot_password' action="{{ route('forgot-password') }}" method='post'>
                @csrf
                <small>* Enter the email address you used to create your account</small>
                <input type="email" name='email' placeholder="Enter your email address">
                <button type='submit' class='btn btn-login'>Send Reset Token</button>
                <a href="{{ route('login') }}">Back</a>
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