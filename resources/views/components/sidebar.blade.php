
<div class="bg-white border rounded-3 p-4 shadow-sm">
    <h4 class="fw-bold mb-4">
        <i class="bi bi-grid-fill text-primary me-2"></i>
        Main Menu
    </h4>

    <div class="d-grid gap-2">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="btn text-start {{ request()->routeIs('dashboard') ? 'btn-primary' : 'btn-light' }}">
            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
        </a>

        <!-- Employee List -->
        <a href="{{ route('employees.index') }}"
           class="btn text-start {{ request()->routeIs('employees.index', 'employees.show', 'employees.edit', 'employees.update', 'employees.destroy') ? 'btn-primary' : 'btn-light' }}">
            <i class="bi bi-people me-2"></i>
            Employees
        </a>

        <!-- Add Employee -->
        <a href="{{ route('employees.create') }}"
           class="btn text-start {{ request()->routeIs('employees.create', 'employees.store') ? 'btn-primary' : 'btn-light' }}">
            <i class="bi bi-person-plus me-2"></i>
            Add Employee
        </a>

        <!-- Attendance (not implemented yet) -->
        <button type="button"
                class="btn btn-light text-start"
                disabled>
            <i class="bi bi-calendar-check me-2"></i>
            Attendance
            <span class="badge text-bg-secondary float-end">Soon</span>
        </button>

        <!-- Settings (not implemented yet) -->
        <button type="button"
                class="btn btn-light text-start"
                disabled>
            <i class="bi bi-gear me-2"></i>
            Settings
            <span class="badge text-bg-secondary float-end">Soon</span>
        </button>

    </div>
</div>
