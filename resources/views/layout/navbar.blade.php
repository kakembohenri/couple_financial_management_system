<nav>
    <div class='nav-main-container'>
        <div class='nav-icon-container'>
            <a style='text-decoration: none;' href="{{ route('dashboard') }}">
            
                <h3 style='color: black; '>Couple Financial Management System</h3>
            </a>
            <div class='nav-profile-logout'>
                <a href="{{ route('profile', ['name' => auth()->user()->username]) }}">My Profile</a>
                <form action="{{ route('logout') }}" class='form-logout' method="post">
                    @csrf
                    <button type='submit' class='btn btn-logout'>
                        Logout
                    </button>
                </form>
            </div>
            <a href="{{ route('inbox') }}">Inbox</a>
        </div>
        <div class='main-nav-links'>
            <div class='nav-link-container'>
                <h4>Tips</h4>
                <div class='nav-links'>
                    <a href="{{ route('manual') }}">How to manage your finances</a>
                    {{-- <a href="{{ route('faqs') }}">FAQ's</a> --}}
                </div>
            </div>
            <div class='nav-link-container'>
                <h4>Bills</h4>
                {{-- <span>Total due: <span class='link-amount'>10000</span></span> --}}
                <div class='nav-links'>
                   <a href='{{ route('bills', ['name' => 'Rent']) }}'>Rent</a>
                   <a href='{{ route('bills', ['name' => 'Electricity']) }}'>Electricity</a>
                   <a href='{{ route('bills', ['name' => 'Fuel']) }}'>Fuel</a>
                   <a href='{{ route('bills', ['name' => 'Medical']) }}'>Medical</a>
                   <a href='{{ route('bills', ['name' => 'Food']) }}'>Food</a>
                   <a href='{{ route('bills', ['name' => 'Water']) }}'>Water</a>
                </div>
            </div>
            <div class='nav-link-container'>
                <h4>Accounts</h4>
                <div class='nav-links'>
                    <a href="{{ route('account', ['name' => 'Joint savings']) }}">Joint savings</a>
                    <a href="{{ route('account', ['name' => 'Joint expenditures']) }}">Joint expenditures</a>
                    <a href="{{ route('account', ['name' => 'My savings']) }}">My savings</a>
                    <a href="{{ route('account', ['name' => 'My expenditures']) }}">My expenditures</a>
                </div>
            </div>
            <div class='nav-link-container'>
                <h4>Budget</h4>
                <div class='nav-links'>
                    <a href="{{ route('paid') }}">Paid expenditures</a>
                    <a href="{{ route('unpaid') }}">Unpaid expenditures</a>
                    <a href="{{ route('report') }}">Report</a>
                </div>
            </div>
            <div class='nav-link-container'>
                <h4>Expenses</h4>
                <div class='nav-links'>
                    <a href="{{ route('activity') }}">Activity</a>
                    <a href="{{ route('upcoming') }}">Upcoming</a>
                    
                </div>
            </div>
        </div>
    </div>
</nav>