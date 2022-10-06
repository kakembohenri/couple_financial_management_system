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
        <h3 class='bill-name'>Edit invoice</h3>
        <small>* <i>At this moment in time you can only edit the amount paid for a certain invoice</i></small>
        <div class='profile-container'>
            <form class='form form-profile_update' style='height: 15rem;' action='{{ route('store.edit') }}' method='POST'>
                @csrf
                <div class='form-profile'>
                    {{-- {{ $id }} --}}
                    <div class='profile-item'>
                        <input value='{{ $id }}' name='id' hidden readonly />
                        <input value='{{ $name }}' name='name' hidden readonly />
                        <label for="paid">Amount Paid:</label>
                        <input type='number' name='paid' />
                    </div>
                    
                </div>
                <button type='submit' class='btn'>Edit Invoice</button>
            </form>
        </div>    
    </div>
</body>
</html>