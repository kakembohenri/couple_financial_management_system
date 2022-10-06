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
    <div class='backdrop'></div>
        <form class='form form-invite' id='form-invite' action="{{ route('dashboard') }}" method='post'>
            @csrf
            <h4>Invite your spouse</h4>
            <input type="email" name='email' placeholder="Spouse email address">
            <button type='submit' class='btn btn-invite'>Invite</button>
        </form>
    <div class='dashboard-main-container dashboard-home'>
        @extends('layout.navbar')
        <div class='notification-container'>
            @if($expense !== null)
            <div class='notification'>
                <p>Expense {{ $expense->name }} is due on {{ $expense->date_due }}</p>
                <a class='btn' href="{{ route('upcoming') }}">View more</a>
            </div>
            @endif
            @if($married === false)
            <button type="button" class='btn btn-invite' id='btn-invite'>Invite Spouse</button>
            @endif
        </div>
        <div class='notification-container latest-payment'>
            @if($latest !== null)
            <div class='notification'>
                <p>{{ $latest->text }} at </p><span>{{ $latest->created_at }}</span>
            </div>
            @endif
           
        </div>
        @if($overdue !== null)
        <div class='notification-container latest-payment' style='display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 12rem;'>
            @foreach($overdue as $item)
            <div class='notification' style='margin:0.5rem 0rem;'>
                <p>Bill {{ $item->name }} was supposed to be cleared on </p><span>{{ $item->created_at }}</span>
            </div>
            
            @endforeach
        </div>
        @endif
        <div class='dashboard-container'>
            <div class='dashboard-image_box'>
                <div class='backdrop'></div>
                <img src='{{ asset('bg.jpg') }}' alt='bg-pic' />
            </div>
            {{-- <div class='dashboard-bills'>
                <h3>Bills</h3>
                <div class="table-container">
                    @if(count($bills) > 0)
                    <div class="table-row table-head">
                        <div class="table-cell">
                            <p>Name</p>
                        </div>
                        <div class="table-cell">
                            <p>Joint Bill</p>
                        </div>
                        <div class="table-cell">
                            <p>Amount due</p>
                        </div>
                        <div class="table-cell">
                            <p>Date due</p>
                        </div>
                        <div class="table-cell">
                            <p>Paid</p>
                        </div>
                        <div class="table-cell">
                            <p>Balance</p>
                        </div>
                    </div>
                    @endif
                    @forelse($bills as $bill)
                    <div class="table-row">
                        <div class="table-cell">
                            <p>{{ $bill->name }}</p>
                        </div>
                        <div class="table-cell">
                            @if($bill->couple_id === null)
                            <p>No</p>
                            @else
                            <p>Yes</p>
                            @endif
                        </div>
                        <div class="table-cell">
                            <p>{{ $bill->amount_due}}shs</p>
                        </div>
                        <div class="table-cell">
                            <p>{{ $bill->date_due }}</p>
                        </div>
                        <div class="table-cell">
                            <p>{{ $bill->amount_paid }} shs</p>
                        </div>
                        <div class="table-cell">
                            <p>{{ $bill->amount_due - $bill->amount_paid }} shs</p>
                        </div>
                    </div>
                    @empty
                        <p>You havent created any bills</p>
                    @endforelse
                </div>
              
            </div> --}}
        </div>
      
    </div>
    <script src="{{ asset('backdrop/backdrop.js') }}"></script>
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