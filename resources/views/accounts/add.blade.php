<!DOCTYPE html>
<html lang="en">
@extends('layout.header_nav')
<body>
    @if(!empty(session('status')))
    <div class='popup' id='popup'>
        <div class='popup-container'>
            <p>{{ session('status') }}</p>
        </div>
    </div>
    @endif
    <div class='dashboard-main-container'>
        @extends('layout.navbar')
        <div class='profile-header'>
            <h2>Accounts</h2>
        </div>
        <h4>Add {{ $name }} account</h4>
        
        <div class='profile-container'>
            <form class='form form-profile_update' action='{{ route('accounts.add', ['name' => $name]) }}' method="POST">
                @csrf
                <div class='form-profile'>
                    <div class='profile-item'>
                        <label for="name">Account name:</label>
                        <input type='text' name='account_name' />
                        @error('account_name')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    @if($name == 'Joint savings' || $name == 'My savings')
                    <div class='profile-item'>
                        <label for="name">Account saving target:</label>
                        <input type='number' name='account_saving' />
                        @error('account_saving')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    @endif
                    <div class='profile-item'>
                        <label for="name">Account deposit:</label>
                        <input type='number' name='account_deposit' />
                        @error('account_deposit')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class='profile-item'>
                        <label for="details">Details:</label>
                        <textarea type='text' name='details' placeholder="Account details"></textarea>
                        @error('details')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    
                    
                </div>
                <button type='submit' class='btn'>Add Account</button>
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