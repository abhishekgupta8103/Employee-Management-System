
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Employee | EMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body { background: #f4f7fb; }
        .employee-card {
            max-width: 750px;
            border: 0;
            border-radius: 16px;
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(135deg, #0d6efd, #4f46e5);
            padding: 22px;
        }
        .form-label { font-weight: 600; }
        .photo-preview {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #dee2e6;
            margin: 10px 0;
        }
        .upload-box {
            background: #f8faff;
            border: 1px dashed #9caecb;
            border-radius: 10px;
            padding: 16px;
        }
    </style>
</head>

<body>
<div class="container py-5">
    <div class="card employee-card shadow-sm mx-auto">

        <div class="card-header text-white">
            <h3 class="mb-1">
                <i class="bi bi-pencil-square me-2"></i>Edit Employee
            </h3>
            <p class="mb-0 small">Update employee information and photo</p>
        </div>

        <div class="card-body p-4 p-md-5">

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Please fix these errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('employees.update', $employee) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name *</label>
                    <input type="text" id="name" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $employee->name) }}"
                           maxlength="255" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" id="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $employee->email) }}"
                           maxlength="255" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" id="phone" name="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $employee->phone) }}"
                               maxlength="20">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" id="position" name="position"
                               class="form-control @error('position') is-invalid @enderror"
                               value="{{ old('position', $employee->position) }}"
                               maxlength="255">
                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number" id="salary" name="salary"
                           class="form-control @error('salary') is-invalid @enderror"
                           value="{{ old('salary', $employee->salary) }}"
                           min="0" step="0.01">
                    @error('salary')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label d-block">Current Employee Photo</label>

                    @if($employee->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($employee->photo))
                        <img id="photoPreview"
                             src="{{ asset('storage/' . $employee->photo) }}"
                             alt="Current employee photo"
                             class="photo-preview">
                    @else
                        <div id="defaultAvatar"
                             class="photo-preview d-flex align-items-center justify-content-center bg-light"
                             style="font-size: 48px; color: #0d6efd;">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <img id="photoPreview"
                             class="photo-preview d-none"
                             alt="New employee photo preview">
                    @endif

                    <div class="upload-box mt-2">
                        <label for="photo" class="form-label">Choose New Photo</label>
                        <input type="file" id="photo" name="photo"
                               class="form-control @error('photo') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            JPG, JPEG, PNG or WEBP. Maximum size: 2 MB.
                            Leave empty to keep the current photo.
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle me-1"></i>Update Employee
                    </button>

                    <a href="{{ route('employees.index') }}"
                       class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photoPreview');
    const defaultAvatar = document.getElementById('defaultAvatar');

    photoInput.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            return;
        }

        const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        if (!allowedTypes.includes(file.type)) {
            alert('Please select a JPG, PNG or WEBP image.');
            this.value = '';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Photo size must not exceed 2 MB.');
            this.value = '';
            return;
        }

        photoPreview.src = URL.createObjectURL(file);
        photoPreview.classList.remove('d-none');

        if (defaultAvatar) {
            defaultAvatar.classList.add('d-none');
        }
    });
</script>

</body>
</html>
