
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <x-navbar />

    <div class="container-fluid py-4">
        <div class="row">
            <aside class="col-md-3 col-lg-2 mb-3">
                <x-sidebar />
            </aside>

            <main class="col-md-9 col-lg-10">
                <div class="card shadow-sm border-0 p-4 mb-4">
                    <h1>Employee Dashboard</h1>
                    <h5>Welcome, {{ $name }}!</h5>
                    <p>Role: {{ $role }}</p>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" type="submit">
                            Logout
                        </button>
                    </form>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="card p-3">
                            <h5>Total Employees</h5>
                            <h2>{{ $totalEmployees }}</h2>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card p-3">
                            <h5>Active Employees</h5>
                            <h2>{{ $activeEmployees }}</h2>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card p-3">
                            <h5>On Leave</h5>
                            <h2>{{ $onLeave }}</h2>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Team Members</h3>
                    <a href="{{ route('employees.index') }}"
                       class="btn btn-primary">
                        Manage Employees
                    </a>
                </div>

                <div class="row g-3">
                    @forelse ($employees as $employee)
                        <div class="col-md-6 col-xl-4">
                            <div class="card p-3 h-100">
                                <h5>{{ $employee->name }}</h5>
                                <p>{{ $employee->designation }}</p>
                                <p>{{ $employee->email }}</p>
                                <p>{{ $employee->phone ?: 'Not provided' }}</p>

                                <a href="{{ route('employees.edit', $employee) }}"
                                   class="btn btn-outline-primary">
                                    Edit Employee
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card p-4 text-center">
                                <h5>No employees found</h5>
                                <p>Add your first employee to get started.</p>
                                <a href="{{ route('employees.create') }}"
                                   class="btn btn-primary">
                                    Add Employee
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </main>
        </div>
    </div>

</body>
</html>
