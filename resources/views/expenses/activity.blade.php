<!DOCTYPE html>
<html lang="en">
@extends('layout.header_nav')
<body>
    
    <div class='dashboard-main-container'>
        @extends('layout.navbar')
        <div class='dashboard-container'>
            <div class='dashboard-bills'>
                <div style='display: flex; justify-content: space-between; width: 90%;'>
                    <h3>Activity</h3>
                </div>
                <div class="table-container">
                    <div class="table-row table-head">
                        <div class="table-cell">
                            <p>Activity</p>
                        </div>
                        <div class="table-cell">
                            <p>Timestamp</p>
                        </div>
                    </div>
                    @foreach($activities as $activity)
                    <div class="table-row">
                        <div class="table-cell">
                            <p>{{ $activity->text }}</p>
                        </div>
                        <div class="table-cell">
                            <p>{{ date($activity->created_at) }} </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
</body>
    
</html>