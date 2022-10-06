<!DOCTYPE html>
<html lang="en">
    @extends('layout.header_nav')
    <body>
       
        <div class='dashboard-main-container'>
            @extends('layout.navbar')
            <div class='profile-header'>
                <h2>Bills</h2>
                <div class='bill-header'>
                    <h3>Current bill:</h3>
                    @if($latest !== null)
                    <div class='current-bill'>
                        <div>
                            <h4>Amount due</h4>
                            <span>{{ $latest->amount_due }}</span>
                        </div>
                        <div>
                            <h4>Amount paid</h4>
                            <span>{{ $latest->amount_paid }}</span>
                        </div>
                        <div>
                            <h4>Date due</h4>
                            <span>{{ $latest->date_due }}</span>
                        </div>
                    </div>
                    @else
                        <p>You are free to create a new invoice</p>
                    @endif
                </div>
                <div>
                    {{-- <a href="{{ route('add.bill') }}" class='btn'>Add new Bill</a> --}}
                    <a href="{{ route('add.invoice', ['name' => $name]) }}" class='btn'>Add new invoice</a>
                </div>
            </div>
            <h3 class='bill-name'>{{ $name }}</h3>
            @forelse($bills as $bill)
            @if(!empty($bill['name']))
            @if($bill['name'] === $name)
            <div class='bills-container'>
                <div class='bill'>
                    <h4>{{ $bill['date'] }}</h4>
                    {{-- <div>{{ print_r($bill) }}</div> --}}
                    @foreach($bill as $items)
                    
                    {{-- <div>{{ gettype($item) }}</div> --}}
                    @if(gettype($items) === 'object')
                    @foreach($items as $item)
                    <div class='bill-amounts'>
                        <div>
                            <h5>Amount Due</h5>
                            <span>{{ $item->amount_due }} shs</span>
                        </div>
                        <div>
                            <h5>Amount Paid</h5>
                            <span>{{ $item->amount_paid }} shs</span>
                            {{-- <span>{{ gettype($item) }}</span> --}}
                        </div>
                        <div>
                            <h5>Balance</h5>
                            <span>{{ $item->amount_due - $item->amount_paid }} shs</span>
                        </div>
                        
                        <a href='{{ route('edit.invoice', ['name' => $name,'id' => $item->id, 'paid' => $item->amount_paid]) }}' class='btn btn-invite' id='btn-invite'>Edit</a>
                        
                    </div>
                    @endforeach
                    @endif
                    @endforeach
                </div>
            </div>  
            @else
                <p>No bills for {{ $name }}</p>
            @endif
            @endif
            @empty
            <p>No bills for {{ $name }}</p>
            @endforelse
        </div>
    </body>
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
</html>