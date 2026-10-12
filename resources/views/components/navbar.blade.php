
<nav style="background:#2563eb; padding:15px 30px; color:white; display:flex; justify-content:space-between; align-items:center;">
    <h2 style="margin:0;">Employee Management</h2>

    <div>
        <a href="/" style="color:white; margin-right:15px;">Dashboard</a>
        <a href="/employees" style="color:white; margin-right:15px;">Employees</a>

        @auth
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" style="padding:8px 14px; cursor:pointer;">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" style="color:white;">Login</a>
        @endauth
    </div>
</nav>
