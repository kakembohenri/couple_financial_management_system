<!DOCTYPE html>
<html lang="en">
@extends('layout.header_nav')
<body>
    
    <div class='dashboard-main-container'>
        <div class='dashboard-container'>
            <div class='dashboard-bills'>
               {{-- <div>
                <p>Press control-p to print the report</p>
               </div> --}}
                <div class="table-container">
                    <div class="table-row table-head">
                        <div class="table-cell">
                            <p>Bill Name</p>
                        </div>
                        <div class="table-cell">
                            <p>Couple bill</p>
                        </div>
                        <div class="table-cell">
                            <p>Amount Due</p>
                        </div>
                        <div class="table-cell">
                            <p>Date Due</p>
                        </div>
                        <div class="table-cell">
                            <p>Amount Paid</p>
                        </div>
                        <div class="table-cell">
                            <p>Balance</p>
                        </div>
                    </div>
                    @foreach($bills as $bill)
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
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
    
</html>