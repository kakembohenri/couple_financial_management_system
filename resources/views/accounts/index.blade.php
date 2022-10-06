<!DOCTYPE html>
<html lang="en">
<head>
    @extends('layout.header_nav')
</head>
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
            <div>
                <a href="{{ route('accounts.add', ['name' => $name]) }}" class='btn'>Add Account</a>
                
            </div>
        </div>
        <h3 class='bill-name'>{{ $name }}</h3>
        <div class="table-container">
            <div class="table-row table-head">
                <div class="table-cell">
                    <p>Account Name</p>
                </div>
                <div class="table-cell">
                    <p>Account details</p>
                </div>
                
               
                @if($name == 'Joint savings' || $name == 'My savings')
                <div class="table-cell">
                    <p>Saving target</p>
                </div>
                <div class="table-cell">
                    <p>Account deposit</p>
                </div>
                <div class="table-cell">
                    <p>Balance</p>
                </div>
                @else
                <div class="table-cell">
                    <p>Account deposit</p>
                </div>
                @endif
            </div>
            @forelse($accounts as $account)
            @forelse($account as $item)
            <div class="table-row">
                <div class="table-cell">
                    <p>{{ $item->name }}</p>
                </div>
                <div class="table-cell">
                   <p>{{ $item->about }}</p>
                </div>
                
                @if($name == 'Joint savings' || $name == 'My savings')
                <div class="table-cell">
                    <p>{{ $item->target }} shs</p>
                 </div>
                 <div class="table-cell">
                    <p>{{ $item->deposit }} shs</p>
                </div>
                <div class="table-cell">
                    <p>{{ $item->target - $item->deposit }} shs</p>
                </div>
                @else
                <div class="table-cell">
                    <p>{{ $item->deposit }} shs</p>
                </div>
               @endif
            </div>
            
            <div class='account-table-actions'>
                @if($name == 'Joint savings' || $name == 'My savings')
                {{-- <a href="{{ route('add.saving', ['id' =>$item->id]) }}">Add saving</a> --}}
                @endif
                <form action="{{ route('delete.account', ['id' => $item->id]) }}" onsubmit="return confirm('Are you sure you want to delete?')" method='post'>
                    @csrf
                    <button type='submit'>Delete</button>
                </form>
                <a href="{{  route('add.saving', ['id' =>$item->id]) }}">Edit</a>
            </div>
            @empty
            <p>No accounts under {{ $name }}</p>

            @endforelse
            @empty
                <p>No accounts under {{ $name }}</p>
            @endforelse
        </div>
        {{-- <div class='bills-container'>
            @forelse($accounts as $account)
            @forelse($account as $item)
            <div class='bill'>
                <h4>{{ $item->name }}</h4>
                <p>{{ $item->about }}</p>
                <p style='margin:0.6rem 0rem;'>Deposit: {{ $item->deposit }} shs</p>
            </div>
            @empty
            <p>No accounts under {{ $name }}</p>

            @endforelse
            @empty
                <p>No accounts under {{ $name }}</p>
            @endforelse
        </div>  --}}
         
    </div>
</body>
</html>