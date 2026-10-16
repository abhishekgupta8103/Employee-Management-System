
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Management | EMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.min.css">

    <style>
        body { background: #f4f7fb; }
        .employee-photo {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #dee2e6;
        }
        .avatar-placeholder {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #e7efff;
            color: #0d6efd;
            font-size: 21px;
        }
        .page-card { border: 0; border-radius: 14px; }
        .table th, .table td { vertical-align: middle; }
    </style>
</head>

<body>
<div class="container py-5">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Employee Management</h2>
            <p class="text-secondary mb-0">Manage your employee records</p>
        </div>

        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus-fill me-1"></i> Add Employee
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card page-card shadow-sm mb-4">
        <div class="card-body p-4">
            <form action="{{ route('employees.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-5">
                        <label for="search" class="form-label">Search Employee</label>
                        <input type="text" name="search" id="search"
                               class="form-control"
                               placeholder="Enter name or email"
                               value="{{ request('search') }}">
                    </div>

                    <div class="col-md-4">
                        <label for="position" class="form-label">Filter by Position</label>
                        <select name="position" id="position" class="form-select">
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
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search me-1"></i> Search
                        </button>
                        <a href="{{ route('employees.index') }}"
                           class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card page-card shadow-sm">
        <div class="card-body p-4">
            <h5 class="mb-3">
                Employee List
                <span class="badge text-bg-primary">{{ $employees->total() }}</span>
            </h5>

            <div class="table-responsive">
                <table class="table table-hover table-bordered bg-white align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
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

                            <td>
                                @if($employee->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($employee->photo))
                                    <img
                                        src="{{ asset('storage/' . $employee->photo) }}"
                                        alt="{{ $employee->name }}"
                                        class="employee-photo">
                                @else
                                    <span class="avatar-placeholder" title="No photo">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                @endif
                            </td>

                            <td class="fw-semibold">{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone ?: 'N/A' }}</td>
                            <td>{{ $employee->position ?: 'N/A' }}</td>
                            <td>
                                {{ $employee->salary !== null
                                    ? number_format((float) $employee->salary, 2)
                                    : 'N/A' }}
                            </td>

                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('employees.edit', $employee) }}"
                                       class="btn btn-sm btn-primary" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('employees.destroy', $employee) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this employee?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger"
                                                title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                No employees found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $employees->links() }}
            </div>
        </div>
    </div>

    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary mt-4">
        <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
    </a>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
