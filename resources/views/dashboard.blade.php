
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <x-navbar />

    <div class="container-fluid py-4">
        <div class="row g-4">

            <aside class="col-12 col-lg-3 col-xl-2">
                <x-sidebar />
            </aside>

            <main class="col-12 col-lg-9 col-xl-10">

                <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h1 class="fw-bold">Employee Dashboard</h1>
                            <p class="text-secondary mb-1">
                                Welcome, {{ $name }}!
                            </p>
                            <p>Role: {{ $role }}</p>
                        </div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger" type="submit">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <p class="text-secondary">Total Employees</p>
                                <h2>{{ $totalEmployees }}</h2>
                                <i class="bi bi-people-fill text-primary fs-3"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <p class="text-secondary">Active Employees</p>
                                <h2>{{ $activeEmployees }}</h2>
                                <i class="bi bi-person-check-fill text-success fs-3"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <p class="text-secondary">On Leave</p>
                                <h2>{{ $onLeave }}</h2>
                                <i class="bi bi-calendar-check-fill text-warning fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                    <h3 class="fw-bold">Team Members</h3>

                    <a href="{{ route('employees.index') }}" class="btn btn-primary">
                        <i class="bi bi-people"></i> Manage Employees
                    </a>
                </div>

                <div class="row g-4">
                    @forelse($employees as $employee)
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h5 class="fw-bold">
                                        <i class="bi bi-person-circle text-primary"></i>
                                        {{ $employee->name }}
                                    </h5>

                                    <p class="text-secondary">
                                        {{ $employee->position ?? 'Employee' }}
                                    </p>

                                    <p>
                                        <i class="bi bi-envelope"></i>
                                        {{ $employee->email }}
                                    </p>

                                    <p>
                                        <i class="bi bi-telephone"></i>
                                        {{ $employee->phone ?: 'Not provided' }}
                                    </p>

                                    <a href="{{ route('employees.edit', $employee) }}"
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card border-0 shadow-sm text-center p-5">
                                <i class="bi bi-people display-4 text-secondary"></i>
                                <h4 class="mt-3">No employees found</h4>
                                <p class="text-secondary">
                                    Add your first employee to see them here.
                                </p>

                                <a href="{{ route('employees.create') }}"
                                   class="btn btn-primary mx-auto">
                                    <i class="bi bi-plus-lg"></i> Add Employee
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

            </main>
        </div>
    </div>

    <footer class="text-center text-secondary py-4">
        Employee Management System &copy; 2026
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
