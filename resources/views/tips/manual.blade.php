<!DOCTYPE html>
<html lang="en">
    @extends('layout.header_nav')
    <body>
        <div class='dashboard-main-container'>
            @extends('layout.navbar')
            <div class='profile-header'>
                <h2>How to manage your finances</h2>
            </div>
            <ol style="margin:1rem 0rem; padding-left:2rem;" >
                <li>Track your spending to improve your finances</li>
                <li>Create a realistic monthly budget </li>
                <li>Build up your savings even if it takes time</li>
                <li>Pay your bills on time every month</li>
                <li>Cut back on recurring charges</li>
                <li>Save up cash to afford big purchases</li>
                <li>Start an investment strategy</li>
            </ol>    
        </div>
    </body>
    <style>
        li{
            margin:1rem 0rem;
        }
    </style>
</html>