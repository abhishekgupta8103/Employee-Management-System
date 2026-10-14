
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS | My Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5;
            --page-bg: #f5f7fb;
            --muted: #718096;
        }

        body {
            background: var(--page-bg);
            color: #172033;
            font-family: "Segoe UI", system-ui, sans-serif;
        }

        .profile-card {
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 18px;
            box-shadow: 0 5px 22px rgba(15, 23, 42, .045);
        }

        .profile-avatar {
            width: 88px;
            height: 88px;
            display: grid;
            place-items: center;
            border-radius: 24px;
            background: #e8eaff;
            color: var(--primary);
            font-size: 34px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .page-title {
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .muted {
            color: var(--muted);
        }

        .form-control {
            padding: 12px 14px;
            border-radius: 10px;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .2rem rgba(79, 70, 229, .12);
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .section-icon {
            width: 46px;
            height: 46px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: #eeefff;
            color: var(--primary);
            font-size: 21px;
            flex-shrink: 0;
        }

        .edit-option {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            border: 1px solid #e8eaf2;
            border-radius: 14px;
            color: #172033;
            background: #fff;
            text-align: left;
            transition: .2s ease;
        }

        .edit-option:hover {
            border-color: var(--primary);
            background: #f8f8ff;
            transform: translateY(-2px);
        }

        .edit-option .arrow {
            margin-left: auto;
            color: var(--muted);
        }

        .detail-label {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 5px;
        }

        .detail-value {
            font-weight: 600;
            overflow-wrap: anywhere;
        }
    </style>
</head>
<body>

<x-navbar />

<main class="container-fluid py-4 px-3 px-lg-4">
    <div class="row g-4">

        <aside class="col-12 col-lg-3 col-xl-2">
            <x-sidebar />
        </aside>

        <section class="col-12 col-lg-9 col-xl-10">

            <div class="mb-4">
                <p class="text-primary fw-semibold mb-1">
                    <i class="bi bi-person-badge me-1"></i> ACCOUNT
                </p>
                <h1 class="page-title h2 mb-2">My Profile</h1>
                <p class="muted mb-0">
                    View and manage your personal account information.
                </p>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('password_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-shield-check me-2"></i>
                    {{ session('password_success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>Please check the following:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- PROFILE DETAILS --}}
            <div id="profileView"
                 class="profile-card p-4 p-md-5 mb-4
                 {{ $errors->any() ? 'd-none' : '' }}">

                <div class="d-flex flex-wrap align-items-center gap-4 mb-4">
                    <div class="profile-avatar">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <div class="flex-grow-1">
                        <h3 class="fw-bold mb-1">{{ $user->name }}</h3>
                        <p class="muted mb-2">{{ $user->email }}</p>
                        <span class="badge text-bg-success rounded-pill px-3 py-2">
                            <i class="bi bi-patch-check-fill me-1"></i>
                            Authenticated Account
                        </span>
                    </div>

                    <span class="badge text-bg-light border text-dark p-3">
                        <i class="bi bi-person-vcard text-primary me-1"></i>
                        User ID: {{ $user->id }}
                    </span>
                </div>

                <hr class="my-4">

                <h5 class="fw-bold mb-4">Account Details</h5>

                <div class="row g-4 mb-4">
                    <div class="col-12 col-md-6">
                        <div class="detail-label">Full Name</div>
                        <div class="detail-value">{{ $user->name }}</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="detail-label">Email Address</div>
                        <div class="detail-value">{{ $user->email }}</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="detail-label">Account Created</div>
                        <div class="detail-value">
                            {{ $user->created_at?->format('d M Y') ?? 'Not available' }}
                        </div>
                    </div>
                </div>

                <button type="button" id="editProfileButton"
                        class="btn btn-primary rounded-3 px-4 py-2">
                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Profile
                </button>
            </div>

            {{-- EDIT OPTIONS --}}
            <div id="editOptions"
                 class="profile-card p-4 p-md-5 mb-4 d-none">

                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="section-icon">
                        <i class="bi bi-sliders"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">Edit Profile</h4>
                        <p class="muted mb-0">Choose what you want to update.</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-xl-6">
                        <button type="button" id="showDetailsButton"
                                class="edit-option w-100 h-100">
                            <span class="section-icon">
                                <i class="bi bi-person-lines-fill"></i>
                            </span>
                            <span>
                                <strong class="d-block mb-1">Change Name & Email</strong>
                                <small class="muted">Update your personal information</small>
                            </span>
                            <i class="bi bi-chevron-right arrow"></i>
                        </button>
                    </div>

                    <div class="col-12 col-xl-6">
                        <button type="button" id="showPasswordButton"
                                class="edit-option w-100 h-100">
                            <span class="section-icon">
                                <i class="bi bi-shield-lock"></i>
                            </span>
                            <span>
                                <strong class="d-block mb-1">Change Password</strong>
                                <small class="muted">Update your account password securely</small>
                            </span>
                            <i class="bi bi-chevron-right arrow"></i>
                        </button>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-secondary mt-4"
                        data-back-profile>
                    <i class="bi bi-arrow-left me-1"></i> Cancel
                </button>
            </div>

            {{-- CHANGE NAME AND EMAIL --}}
            <div id="detailsForm" class="profile-card p-4 p-md-5 mb-4 d-none">

                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="section-icon">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">Personal Information</h4>
                        <p class="muted mb-0">Change your name and email address.</p>
                    </div>
                </div>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Full Name</label>
                        <input type="text" id="name" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}"
                               maxlength="255" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <input type="email" id="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}"
                               maxlength="255" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary rounded-3 px-4 py-2">
                        <i class="bi bi-check2-circle me-1"></i> Save Changes
                    </button>

                    <button type="button" class="btn btn-outline-secondary ms-2 mt-2 mt-sm-0"
                            data-back-profile>
                        Cancel
                    </button>
                </form>
            </div>

            {{-- CHANGE PASSWORD --}}
            <div id="passwordForm" class="profile-card p-4 p-md-5 mb-4 d-none">

                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="section-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">Change Password</h4>
                        <p class="muted mb-0">Verify your current password first.</p>
                    </div>
                </div>

                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-semibold">
                            Current Password
                        </label>
                        <input type="password" id="current_password" name="current_password"
                               class="form-control @error('current_password') is-invalid @enderror"
                               autocomplete="current-password" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">New Password</label>
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               minlength="8" autocomplete="new-password" required>
                        <div class="form-text">Use at least 8 characters.</div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">
                            Confirm New Password
                        </label>
                        <input type="password" id="password_confirmation"
                               name="password_confirmation" class="form-control"
                               minlength="8" autocomplete="new-password" required>
                    </div>

                    <button type="submit" class="btn btn-primary rounded-3 px-4 py-2">
                        <i class="bi bi-key me-1"></i> Update Password
                    </button>

                    <button type="button" class="btn btn-outline-secondary ms-2 mt-2 mt-sm-0"
                            data-back-profile>
                        Cancel
                    </button>
                </form>
            </div>

            <div class="profile-card p-4">
                <div class="d-flex gap-3 align-items-start">
                    <i class="bi bi-info-circle-fill text-primary fs-4"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Account Security</h6>
                        <p class="muted mb-0">
                            Your account details are available only after authentication.
                            Passwords are hashed before being stored.
                        </p>
                    </div>
                </div>
            </div>

        </section>
    </div>
</main>

<x-footer />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const profileView = document.getElementById('profileView');
    const editOptions = document.getElementById('editOptions');
    const detailsForm = document.getElementById('detailsForm');
    const passwordForm = document.getElementById('passwordForm');

    function showSection(section) {
        [profileView, editOptions, detailsForm, passwordForm].forEach(element => {
            element.classList.add('d-none');
        });

        section.classList.remove('d-none');
    }

    document.getElementById('editProfileButton').addEventListener('click', () => {
        showSection(editOptions);
    });

    document.getElementById('showDetailsButton').addEventListener('click', () => {
        showSection(detailsForm);
    });

    document.getElementById('showPasswordButton').addEventListener('click', () => {
        showSection(passwordForm);
    });

    document.querySelectorAll('[data-back-profile]').forEach(button => {
        button.addEventListener('click', () => {
            showSection(profileView);
        });
    });

    @if ($errors->has('current_password') || $errors->has('password'))
        showSection(passwordForm);
    @elseif ($errors->has('name') || $errors->has('email'))
        showSection(detailsForm);
    @endif
</script>

</body>
</html>
