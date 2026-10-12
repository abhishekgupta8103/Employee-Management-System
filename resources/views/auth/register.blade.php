
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Employee Management</title>
</head>
<body>
    <h2>Create Account</h2>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p style="color:red">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <p>
            <label>Name</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </p>

        <p>
            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </p>

        <p>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </p>

        <p>
            <label>Confirm Password</label><br>
            <input type="password" name="password_confirmation" required>
        </p>

        <button type="submit">Register</button>
    </form>

    <p>Already registered? <a href="{{ route('login') }}">Login</a></p>
</body>
</html>
