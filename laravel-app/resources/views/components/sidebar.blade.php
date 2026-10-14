
<aside class="bg-white border rounded-3 p-3 shadow-sm">

    <h5 class="fw-bold mb-4">
        <i class="bi bi-grid-fill me-2 text-primary"></i>
        Main Menu
    </h5>

    <nav class="nav flex-column gap-2">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="nav-link rounded p-3 {{ request()->routeIs('dashboard') ? 'active bg-primary text-white' : 'text-dark' }}">
            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
        </a>

        {{-- Employees --}}
        <a href="{{ route('employees.index') }}"
           class="nav-link rounded p-3 {{ request()->routeIs('employees.*') ? 'active bg-primary text-white' : 'text-dark' }}">
            <i class="bi bi-people me-2"></i>
            Employees
        </a>

        {{-- My Profile --}}
        <a href="{{ route('profile.index') }}"
           class="nav-link rounded p-3 {{ request()->routeIs('profile.*') ? 'active bg-primary text-white' : 'text-dark' }}">
            <i class="bi bi-person-circle me-2"></i>
            My Profile
        </a>

        {{-- Attendance: placeholder for a future feature --}}
        <a href="#"
           class="nav-link text-dark rounded p-3">
            <i class="bi bi-calendar-check me-2"></i>
            Attendance
        </a>

        {{-- Settings: placeholder for a future feature --}}
        <a href="#"
           class="nav-link text-dark rounded p-3">
            <i class="bi bi-gear me-2"></i>
            Settings
        </a>

    </nav>

</aside>
