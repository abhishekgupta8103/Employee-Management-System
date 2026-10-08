
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Employee Management</a>
        <span class="text-white">Day 12 - Laravel Blade</span>
    </div>
</nav>

<main class="container py-5">
    <h1 class="fw-bold">Employee Dashboard</h1>
    <p class="text-secondary">Welcome, {{ $name }}!</p>
    <p>Role: {{ $role }}</p>

    <div class="row g-4 mt-2">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Rahul Sharma</h5>
                    <p>Frontend Developer</p>
                    <span class="badge bg-success">Active</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Priya Singh</h5>
                    <p>UI/UX Designer</p>
                    <span class="badge bg-success">Active</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Amit Kumar</h5>
                    <p>Backend Developer</p>
                    <span class="badge bg-secondary">On Leave</span>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="text-center text-secondary py-4">
    Employee Management System &copy; 2026
</footer>

</body>
</html>
```