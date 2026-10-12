
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Employee Management</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 320px;
            box-shadow: 0 5px 20px #0001;
        }

        h2 { text-align: center; }

        input, button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input {
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            background: #2563eb;
            color: white;
            border: 0;
            border-radius: 6px;
            cursor: pointer;
        }

        .error { color: red; }
    </style>
</head>

<body>
    <div class="box">
        <h2>Employee Management</h2>
        <p>Login to your account</p>

        @if ($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Enter your email"
                required
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                required
            >

            <button type="submit">Login</button>
        </form>

        <p>
            New user?
            <a href="{{ route('register') }}">Register here</a>
        </p>
    </div>
</body>
</html>
