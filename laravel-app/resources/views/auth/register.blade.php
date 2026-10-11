
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Employee Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e8f0ff, #f8f9fc);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .register-card {
            width: 100%;
            max-width: 480px;
            border: 0;
            border-radius: 20px;
        }

        .brand-icon {
            width: 60px;
            height: 60px;
            display: grid;
            place-items: center;
            margin: auto auto 15px;
            border-radius: 16px;
            background: #e7efff;
            color: #0d6efd;
            font-size: 28px;
        }

        .form-control {
            padding: 11px;
            border-radius: 9px;
        }

        .btn-register {
            padding: 12px;
            border-radius: 9px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="card register-card shadow-lg">
        <div class="card-body p-4 p-md-5">

            <div class="text-center mb-4">
                <div class="brand-icon">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <h3 class="fw-bold">Create Account</h3>
                <p class="text-secondary">Join the Employee Management System</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="registerForm"
                  action="{{ route('register.store') }}"
                  method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Full Name</label>
                    <input type="text" id="name" name="name"
                        class="form-control"
                        placeholder="Enter your full name"
                        value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input type="email" id="email" name="email"
                        class="form-control"
                        placeholder="Enter your email"
                        value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" id="password" name="password"
                        class="form-control"
                        placeholder="Create a password"
                        minlength="8" required>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation"
                           class="form-label fw-semibold">
                        Confirm Password
                    </label>
                    <input type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Confirm your password"
                        minlength="8" required>

                    <div id="passwordMessage"
                         class="text-danger small mt-1"></div>
                </div>

                <button type="submit"
                        class="btn btn-primary btn-register w-100">
                    <i class="bi bi-person-check me-2"></i>
                    Create Account
                </button>
            </form>

            <p class="text-center text-secondary mt-4 mb-0">
                Already have an account?
                <a href="{{ route('login') }}"
                   class="text-decoration-none fw-semibold">Login</a>
            </p>

            <div class="text-center mt-3">
                <a href="/"
                   class="text-secondary small text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <script>
        const password = document.getElementById('password');
        const confirmPassword =
            document.getElementById('password_confirmation');
        const message = document.getElementById('passwordMessage');
        const form = document.getElementById('registerForm');

        form.addEventListener('submit', function (event) {
            if (password.value !== confirmPassword.value) {
                event.preventDefault();
                message.textContent = 'Passwords do not match.';
                confirmPassword.focus();
            } else {
                message.textContent = '';
            }
        });
    </script>
</body>
</html>
