
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Employee Management</h2>

        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            + Add Employee
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            Please check the submitted employee details.
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">

            <table class="table table-striped table-hover mb-0">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone ?? '-' }}</td>
                            <td>{{ $employee->position ?? '-' }}</td>
                            <td>{{ $employee->salary ?? '-' }}</td>

                            <td>
                                <div class="d-flex gap-2">

                                    <a href="{{ route('employees.edit', $employee) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('employees.destroy', $employee) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this employee?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>

                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                No employees found. Click Add Employee to get started.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary mt-3">
        Back to Dashboard
    </a>

</div>

</body>
</html>
