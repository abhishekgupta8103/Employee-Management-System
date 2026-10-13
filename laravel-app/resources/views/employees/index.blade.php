<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2>Employee Management</h2>

    <form action="{{ route('employees.index') }}" method="GET" class="card card-body mb-4">
        <div class="row g-3">
            <div class="col-md-5">
                <label for="search" class="form-label">Search Employee</label>
                <input type="text" name="search" id="search" class="form-control"
                       placeholder="Enter name or email" value="{{ request('search') }}">
            </div>

            <div class="col-md-4">
                <label for="position" class="form-label">Filter by Position</label>
                <select name="position" id="position" class="form-select">
                    <option value="">All Positions</option>
                    @foreach($positions as $position)
                        <option value="{{ $position }}" @selected(request('position') === $position)>
                            {{ $position }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <h4>Employee List ({{ $employees->total() }} Employees Found)</h4>

    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
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
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone ?: 'N/A' }}</td>
                        <td>{{ $employee->position ?: 'N/A' }}</td>
                        <td>{{ $employee->salary ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this employee?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center">No employees found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $employees->links('pagination::bootstrap-5') }}

    <a href="{{ route('dashboard') }}" class="btn btn-link mt-3">Back to Dashboard</a>
</div>
</body>
</html>