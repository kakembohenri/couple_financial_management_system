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
    @if(!empty(session('verified')))
    <div class='popup' id='popup'>
        <div class='popup-container'>
            <p>{{ session('verified') }}</p>
        </div>
    </div>
    @endif
    <div class='form-main-container'>
        <img class='form-bgimg' src="{{ asset('bg3.jpg') }}" />

        <div class='form-container'>
            <div>
                <h3>Create your profile</h3>
            </div>
            <form class='form form-create_profile' action="{{ route('create-profile') }}" method='post' enctype="multipart/form-data">
                @csrf
                <div class='profile-names'>
                    <div class='input-container'>
                        <input type="text" name='f_name' placeholder="First name">
                        @error('l_name')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class='input-container'>

                    <input type="text" name='l_name' placeholder="Last name">
                    @error('l_name')
                    <small>{{ $message }}</small>
                    @enderror
                    </div>
                </div>
                <div class='input-container'>
                    <input type="text" name='username' placeholder="Username">
                    @error('username')
                    <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class='input-container'>
                    <input type="text" name='tel_no' placeholder="Enter your phone number">
                    @error('tel_no')
                    <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class='input-container'>
                    <select name='gender'>
                        <option selected>--Select your Gender--</option>
                        <option value='male'>Male</option>
                        <option value='female'>Female</option>
                    </select>
                    @error('gender')
                    <small>{{ $message }}</small>
                    @enderror
                <div>
                    <p style='font-size: 0.8rem;'>Your national id document<p>
                    <input type="file" name='national_id'>

                </div>
                <div>
                    <p style='font-size: 0.8rem;'>Your passport document</p>
                    <input type="file" name='passport'>
                </div>
                <button type='submit' class='btn'>Create profile</button>
                
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