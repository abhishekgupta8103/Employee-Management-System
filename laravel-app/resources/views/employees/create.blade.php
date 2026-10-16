
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Employee | EMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7fb;
            min-height: 100vh;
        }

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

        .form-label {
            font-weight: 600;
        }

        .photo-preview {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #dee2e6;
            display: none;
            margin-top: 15px;
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
                <i class="bi bi-person-plus-fill me-2"></i>
                Add New Employee
            </h3>
            <p class="mb-0 small">Enter employee details below</p>
        </div>

        <div class="card-body p-4 p-md-5">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('employees.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name *</label>
                    <input type="text"
                           id="name"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           maxlength="255"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address *</label>
                    <input type="email"
                           id="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           maxlength="255"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text"
                               id="phone"
                               name="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}"
                               maxlength="20">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text"
                               id="position"
                               name="position"
                               class="form-control @error('position') is-invalid @enderror"
                               value="{{ old('position') }}"
                               maxlength="255">
                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="number"
                           id="salary"
                           name="salary"
                           class="form-control @error('salary') is-invalid @enderror"
                           value="{{ old('salary') }}"
                           min="0"
                           step="0.01">
                    @error('salary')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="photo" class="form-label">Employee Photo</label>

                    <div class="upload-box">
                        <input type="file"
                               id="photo"
                               name="photo"
                               class="form-control @error('photo') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="form-text mt-2">
                            Allowed formats: JPG, JPEG, PNG, WEBP. Maximum size: 2 MB.
                        </div>

                        <img id="photoPreview"
                             class="photo-preview"
                             alt="Selected employee photo preview">
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-person-check-fill me-1"></i>
                        Save Employee
                    </button>

                    <a href="{{ route('employees.index') }}"
                       class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i>
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photoPreview');

    photoInput.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            photoPreview.removeAttribute('src');
            photoPreview.style.display = 'none';
            return;
        }

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {
            alert('Please select a JPG, PNG or WEBP image.');
            this.value = '';
            photoPreview.removeAttribute('src');
            photoPreview.style.display = 'none';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Photo size must not exceed 2 MB.');
            this.value = '';
            photoPreview.removeAttribute('src');
            photoPreview.style.display = 'none';
            return;
        }

        photoPreview.src = URL.createObjectURL(file);
        photoPreview.style.display = 'block';
    });
</script>

</body>
</html>
