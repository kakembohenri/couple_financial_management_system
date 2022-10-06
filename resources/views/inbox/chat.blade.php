<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel='stylesheet' href="{{ asset('/css/app.css') }}" />
        <link rel="stylesheet" href="{{ asset('/css/nav.css') }}" />
       <link rel='stylesheet' href="{{ asset('/css/messages.css') }}" />
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
        @extends('layout.navbar')
        <div>
            <div class='dashboard-image_box' style="position:fixed; ">
                <div class='backdrop'></div>
                <img src='{{ asset('bg2.jpg') }}' alt='bg-pic' />
            </div>
            <h2>Inbox</h2>
            <h3 style='margin: 1rem 0rem; color:white; position:absolute;'>You are chatting with {{ $username }}</h3>
            <div class='main-inbox-container' style="margin-top:3rem;">
                <div class='main-messages-container'>
                    @forelse($messages as $message)
                    <div class='messages-container'>
                        
                        <div class='sender-container'>
                            @if($message->reciever_id === auth()->user()->id)
                            <div class='sender'>
                                <p>{{ $message->body }}</p>

                                <span>{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                            @endif
                        </div>
                        <div class='reciever-container'>
                            @if($message->sender_id === auth()->user()->id)
                            <div class='reciever'>
                                <p>{{ $message->body }}</p>
                                <span>{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                   
                    @empty
                    <p style='margin: 1rem; text-align: center;'>Start chatting with your spouse</p>
                    @endforelse
                </div>
                <form class='form-send' action="{{ route('inbox') }}" method='post'>
                    @csrf
                    <input type="text" name='body' placeholder="Type message here"/>
                    <button type='submit' style='background:#454545;' class='btn'>Send</button>
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
