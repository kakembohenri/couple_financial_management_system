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
            <h2>Bills</h2>
        </div>
        <div style='display: flex; align-items: center'>
            <h3 class='bill-name'>Add new invoice for bill:</h3>
            <i>{{ $name }}</i>
            @if($bill !== null)
            <div class='bill-update'>
                <div>
                    <h4>Amount due:</h4>
                    <span>{{ $bill->amount_due }}</span>
                </div>
                <div>
                    <h4>Amount paid:</h4>
                    <span>{{ $bill->amount_paid }}</span>
                </div>
            </div>
            @endif
        </div>
        <div class='profile-container'>
            <form class='form form-profile_update' action='{{ route('add.invoice', ['name' => $name]) }}' method='post'>
                @csrf
                <div class='form-profile'>
                    <div class='profile-item'>
                        <label for="amount_due">Amount due:</label>
                        @if($bill !== null)
                            @if($bill->amount_due !== $bill->amount_paid)
                                <input type='number' name='amount_due' value='{{ $bill->amount_due }}' readonly />
                                <small>* You have to first complete this <b>{{ $name }}</b> bill before adding a new one</small>
                            @else
                                <input type='number' name='amount_due' />
                                <small>* You can now set an initial amount to pay for <b>{{ $name }}</b> bill</small>
                            @endif
                        @else
                            <input type='number' name='amount_due' />
                            <small>* You can now set an initial amount to pay for <b>{{ $name }}</b> bill</small>
                        @endif
                        @error('amount_due')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    @if($bill !== null)
                        @if($bill->amount_due === $bill->amount_paid)
                            
                            <div class='profile-item'>
                                <label for="date">Date due:</label>
                                <input type="date" name='date_due' />
                                @error('date_due')
                                <small>{{ $message }}</small>
                                @enderror
                            </div>
                        @else
                            <div class='profile-item'>
                                <label for="date">Date due:</label>
                                <input type="date" name='date_due' value='{{ $bill->date_due }}' readonly />
                                @error('date_due')
                                <small>{{ $message }}</small>
                                @enderror
                            </div>
                        @endif
                    @else
                        <div class='profile-item'>
                            <label for="date">Date due:</label>
                            <input type="date" name='date_due'  />
                            @error('date_due')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                    @endif
                    
                    <div class='profile-item'>
                        <label for="paid">Amount Paid:</label>
                        <input type='number' name='amount_paid' />
                        @error('amount_paid')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    @if($bill !== null)
                        @if($bill->amount_due === $bill->amount_paid)
                            <div class='profile-item'>
                                <label for="bill_type">Select Bill Type</label>
                                <select name='bill_type'>
                                    <option value="" selected>--Select Bill Type--</option>
                                    <option value='joint'>Joint bill</option>
                                    <option value='individual'>Individual bill</option>
                                </select>
                                @error('bill_type')
                                <small>{{ $message }}</small>
                                @enderror
                            </div>
                        @else
                           
                            <label for="bill_type">Select Bill Type</label>

                            <select name='bill_type'>
                                @if($bill->couple_id !== null)
                                <option value='joint' selected>Joint bill</option>
                                @else
                                <option value='individual' selected>Individual bill</option>
                                @endif
                            </select>
                        @endif
                    @else
                        <div class='profile-item'>
                            <label for="bill_type">Select Bill Type</label>
                            <select name='bill_type'>
                                <option value="" selected>--Select Bill Type--</option>
                                <option value='joint'>Joint bill</option>
                                <option value='individual'>Individual bill</option>
                            </select>
                            @error('bill_type')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                    @endif
                </div>
                <button type="submit" class='btn'>Create Invoice</button>
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