
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Employee Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e8f0ff, #f8f9fc);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .login-card {
            max-width: 450px;
            width: 100%;
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.12);
        }

        .brand-icon {
            width: 65px;
            height: 65px;
            display: grid;
            place-items: center;
            background: #e7efff;
            color: #0d6efd;
            border-radius: 18px;
            font-size: 30px;
            margin: 0 auto 16px;
        }

        .form-control {
            padding: 12px;
            border-radius: 10px;
        }

        .input-group .form-control {
            border-radius: 10px 0 0 10px;
        }

        .input-group .btn {
            border-radius: 0 10px 10px 0;
        }

        .btn-login {
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
        }

        .form-label {
            color: #273449;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="card login-card">
    <div class="card-body p-4 p-md-5">

        <div class="text-center mb-4">
            <div class="brand-icon">
                <i class="bi bi-people-fill"></i>
            </div>

            <h3 class="fw-bold">Welcome Back!</h3>
            <p class="text-secondary">
                Login to your employee account
            </p>
        </div>

        {{-- Success message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}

                <button type="button" class="btn-close"
                        data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Laravel login form --}}
        <form id="loginForm"
              action="{{ route('login.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">
                    Email Address
                </label>

                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-envelope"></i>
                    </span>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Enter your email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required
                        autofocus
                    >
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">
                    Password
                </label>

                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-lock"></i>
                    </span>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >

                    <button
                        class="btn btn-outline-secondary"
                        type="button"
                        id="togglePassword"
                        aria-label="Show password"
                    >
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="remember"
                        name="remember"
                        value="1"
                    >

                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>

                <span class="text-secondary small">
                    Forgot password?
                </span>
            </div>

            <button type="submit"
                    class="btn btn-primary btn-login w-100">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Login
            </button>

        </form>

        <p class="text-center text-secondary mt-4 mb-0">
            Don't have an account?
            <a href="{{ route('register') }}"
               class="fw-semibold">
                Create Account
            </a>
        </p>

        <div class="text-center mt-3">
            <a href="/"
               class="text-secondary small">
                <i class="bi bi-arrow-left me-1"></i>
                Back to Dashboard
            </a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    // Show or hide password
    togglePassword.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';

        passwordInput.type = isPassword ? 'text' : 'password';

        togglePassword.innerHTML = isPassword
            ? '<i class="bi bi-eye-slash"></i>'
            : '<i class="bi bi-eye"></i>';

        togglePassword.setAttribute(
            'aria-label',
            isPassword ? 'Hide password' : 'Show password'
        );
    });

    // IMPORTANT:
    // Do not use event.preventDefault() here.
    // The form must submit to Laravel for real authentication.
</script>

</body>
</html>
