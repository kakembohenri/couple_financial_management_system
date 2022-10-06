<!DOCTYPE html>
<html lang="en">
@extends('layout.header_nav')
<body>
    <div class='dashboard-main-container'>
        @extends('layout.navbar')
        <div class='profile-header'>
            <h2>Bills</h2>
        </div>
        <h3 class='bill-name'>Add new bill</h3>
        <div class='profile-container'>
            <form class='form form-profile_update' action=''>
                <div class='form-profile'>
                    <div class='profile-item'>
                        <label for="name">Bill name:</label>
                        <input type='text' value='DSTV' />
                    </div>
                    <div class='profile-item'>
                        <label for="amount_due">Amount due:</label>
                        <input type='text' value='2000' />
                    </div>
                    <div class='profile-item'>
                        <label for="paid">Paid:</label>
                        <input type='text' value='1000' />
                    </div>
                    <div class='profile-item'>
                        <label for="date">Date due:</label>
                        <input type="date">
                    </div>
                    
                </div>
                <button class='btn'>Create Bill</button>
            </form>
        </div>    
    </div>
</body>
</html>