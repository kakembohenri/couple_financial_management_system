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
        <h4>Add savings to {{ $account->name }} account</h4>
        <div style='display: flex;
        justify-content: center;
        margin: 1rem 0rem;'>
            <div style='margin:0rem 1rem;'>
                <h4>Target</h4>
                <span>{{ $account->target }} shs</span>
            </div>
            <div>
                <h4>Amount deposited</h4>
                <span>{{ $account->deposit }} shs</span>
            </div>
        </div>
        <div class='profile-container' >
            <form class='form form-profile_update' style='height:15rem;' action='{{ route('add.saving', ['id' => $account->id]) }}' method="POST">
                @csrf
                <div class='form-profile'>
                    
                    <div class='profile-item'>
                        <label for="name">Deposit saving:</label>
                        <input type='number' name='account_deposit' />
                        @error('account_deposit')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    
                </div>
                <button type='submit' class='btn'>Edit account</button>
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