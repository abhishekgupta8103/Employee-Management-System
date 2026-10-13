
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Employee Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f4f7fb;
            font-family: Arial, sans-serif;
        }

        .page-title {
            font-weight: 700;
            color: #212529;
        }

        .custom-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        }

        .form-control, .form-select {
            min-height: 42px;
        }

        .table th, .table td {
            padding: 14px;
            white-space: nowrap;
        }

        .table thead th {
            background: #212529;
            color: white;
        }

        .salary {
            font-weight: 600;
            color: #198754;
        }
    </style>
</head>

<body>

<div class="container py-5">

    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between
                align-items-center gap-3 mb-4">

        <div>
            <h2 class="page-title">Employee Management</h2>
            <p class="text-secondary mb-0">
                Manage your team members in one place
            </p>
        </div>

        <a href="{{ route('employees.create') }}"
           class="btn btn-primary">
            + Add Employee
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- Search and Filter -->
    <div class="card custom-card mb-4">
        <div class="card-body p-4">

            <h5 class="fw-bold mb-3">Search & Filter Employees</h5>

            <form action="{{ route('employees.index') }}"
                  method="GET">

                <div class="row g-3">

                    <div class="col-md-5">
                        <label for="search" class="form-label">
                            Search Employee
                        </label>

                        <input type="text"
                               name="search"
                               id="search"
                               class="form-control"
                               placeholder="Enter name or email"
                               value="{{ request('search') }}">
                    </div>

                    <div class="col-md-4">
                        <label for="position" class="form-label">
                            Filter by Position
                        </label>

                        <select name="position"
                                id="position"
                                class="form-select">

                            <option value="">All Positions</option>

                            @foreach($positions as $position)
                                <option value="{{ $position }}"
                                    @selected(request('position') === $position)>
                                    {{ $position }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-end gap-2">

                        <button type="submit"
                                class="btn btn-primary flex-grow-1">
                            Search
                        </button>

                        <a href="{{ route('employees.index') }}"
                           class="btn btn-outline-secondary">
                            Reset
                        </a>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Employee Table -->
    <div class="card custom-card">
        <div class="card-body p-3">

            <div class="d-flex flex-wrap justify-content-between
                        align-items-center gap-2 mb-3">

                <h5 class="fw-bold mb-0">Employee List</h5>

                <span class="badge text-bg-primary">
                    {{ $employees->total() }} Employees Found
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Salary</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>

                                <td class="fw-semibold">
                                    {{ $employee->name }}
                                </td>

                                <td>{{ $employee->email }}</td>

                                <td>{{ $employee->phone ?: 'N/A' }}</td>

                                <td>
                                    {{ $employee->position ?: 'N/A' }}
                                </td>

                                <td class="salary">
                                    {{ $employee->salary !== null
                                        ? number_format((float) $employee->salary, 2)
                                        : 'N/A' }}
                                </td>

                                <td>
                                    <div class="d-flex gap-2">

                                        <a href="{{ route('employees.edit', $employee) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('employees.destroy', $employee) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this employee?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7"
                                    class="text-center py-5 text-secondary">
                                    No employees found.
                                    Try resetting the filters.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $employees->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

    <!-- Back Button -->
    <a href="{{ route('dashboard') }}"
       class="btn btn-link mt-3 text-decoration-none">
        &larr; Back to Dashboard
    </a>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
