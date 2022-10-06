<nav>
    <div class='nav-main-container'>
            <h3>CFMS</h3>
        <div class='main-nav-links'>
            
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.profile') }}">My Profile</a>
            
               <a href="{{ route('admin.manage') }}">Manage Users</a>
            
                <a href="{{ route('admin.create') }}">Create user profile</a>
            
                <form action="{{ route('logout') }}" class='form-logout' method='post'>
                    @csrf
                    <button type='submit' class='btn btn-logout'>
                        Logout
                    </button>
                </form>
        </div>
    </div>
</nav>