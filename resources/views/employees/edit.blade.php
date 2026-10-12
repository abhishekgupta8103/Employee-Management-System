
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm mx-auto" style="max-width: 700px;">
        <div class="card-header bg-warning">
            <h3 class="mb-0">Edit Employee</h3>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('employees.update', $employee) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $employee->name) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $employee->email) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone', $employee->phone) }}"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Position</label>
                    <input
                        type="text"
                        name="position"
                        class="form-control"
                        value="{{ old('position', $employee->position) }}"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Salary</label>
                    <input
                        type="number"
                        name="salary"
                        class="form-control"
                        min="0"
                        step="0.01"
                        value="{{ old('salary', $employee->salary) }}"
                    >
                </div>

                <button type="submit" class="btn btn-warning">
                    Update Employee
                </button>

                <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </form>

        </div>
    </div>
</div>

</body>
</html>
