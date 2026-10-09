
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<x-navbar />

<main class="container py-5">
    <h1 class="fw-bold">Employee Dashboard</h1>
    <p class="text-secondary">Welcome, {{ $name }}!</p>
    <p>Role: {{ $role }}</p>

<div class="row g-4 mt-2">
    <div class="col-12 col-md-6 col-lg-4">
        <x-employee-card
            name="Rahul Sharma"
            role="Frontend Developer"
            status="Active"
        />
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <x-employee-card
            name="Priya Singh"
            role="UI/UX Designer"
            status="Active"
        />
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <x-employee-card
            name="Amit Kumar"
            role="Backend Developer"
            status="On Leave"
        />
    </div>
</div>

</main>

<footer class="text-center text-secondary py-4">
    Employee Management System &copy; 2026
</footer>

</body>
</html>
