
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System | Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <x-navbar />

    <main class="container-fluid py-4 px-3 px-lg-4">
        <div class="row g-4">

            {{-- Sidebar: keep only one sidebar --}}
            <aside class="col-12 col-lg-3 col-xl-2">
                <x-sidebar />
            </aside>

            {{-- Main Dashboard --}}
            <section class="col-12 col-lg-9 col-xl-10">

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Error Message --}}
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Welcome Card --}}
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex flex-column flex-md-row
                                    justify-content-between align-items-md-center gap-3">
                            <div>
                                <h1 class="fw-bold mb-2">Employee Dashboard</h1>
                                <p class="text-secondary mb-1">
                                    Welcome, {{ $name }}!
                                </p>
                                <p class="mb-0">
                                    Role: {{ $role }}
                                </p>
                            </div>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger px-4">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Statistics --}}
                <div class="row g-4 mb-4">

                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4 d-flex
                                        justify-content-between align-items-center">
                                <div>
                                    <p class="text-secondary mb-2">Total Employees</p>
                                    <h2 class="fw-bold mb-0">{{ $totalEmployees }}</h2>
                                </div>
                                <div class="bg-primary-subtle text-primary rounded-3 p-3">
                                    <i class="bi bi-people-fill fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4 d-flex
                                        justify-content-between align-items-center">
                                <div>
                                    <p class="text-secondary mb-2">Active Employees</p>
                                    <h2 class="fw-bold mb-0">{{ $activeEmployees }}</h2>
                                </div>
                                <div class="bg-success-subtle text-success rounded-3 p-3">
                                    <i class="bi bi-person-check-fill fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4 d-flex
                                        justify-content-between align-items-center">
                                <div>
                                    <p class="text-secondary mb-2">On Leave</p>
                                    <h2 class="fw-bold mb-0">{{ $onLeave }}</h2>
                                </div>
                                <div class="bg-warning-subtle text-warning rounded-3 p-3">
                                    <i class="bi bi-calendar-check-fill fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Team Members Heading --}}
                <div class="d-flex flex-column flex-md-row
                            justify-content-between align-items-md-center gap-3 mb-3">
                    <h4 class="fw-bold mb-0">
                        <i class="bi bi-people me-2"></i>
                        Team Members
                    </h4>

                    <a href="{{ route('employees.index') }}" class="btn btn-primary">
                        <i class="bi bi-person-lines-fill me-1"></i>
                        Manage Employees
                    </a>
                </div>

                {{-- Employee Cards --}}
                <div class="row g-4">
                    @forelse($employees as $employee)
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">

                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="bg-primary-subtle text-primary rounded-circle p-3">
                                            <i class="bi bi-person-fill fs-4"></i>
                                        </div>

                                        <div class="min-w-0">
                                            <h5 class="fw-bold mb-1 text-break">
                                                {{ $employee->name }}
                                            </h5>
                                            <p class="text-secondary mb-0">
                                                {{ $employee->position ?: 'Position not provided' }}
                                            </p>
                                        </div>
                                    </div>

                                    <p class="mb-2 text-break">
                                        <i class="bi bi-envelope me-2 text-secondary"></i>
                                        {{ $employee->email }}
                                    </p>

                                    <p class="mb-3">
                                        <i class="bi bi-telephone me-2 text-secondary"></i>
                                        {{ $employee->phone ?: 'Not provided' }}
                                    </p>

                                    <div class="d-flex justify-content-between
                                                align-items-center gap-2">
                                        <span class="badge bg-primary">Employee</span>

                                        <a href="{{ route('employees.edit', $employee) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil me-1"></i>
                                            Edit
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center py-5">
                                    <i class="bi bi-people display-4 text-secondary"></i>
                                    <h5 class="mt-3">No employees found</h5>
                                    <p class="text-secondary">
                                        Add your first employee to see them here.
                                    </p>

                                    <a href="{{ route('employees.create') }}"
                                       class="btn btn-primary">
                                        <i class="bi bi-plus-lg me-1"></i>
                                        Add Employee
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

            </section>
        </div>
    </main>

    <footer class="text-center text-secondary py-4">
        Employee Management System &copy; 2026
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
