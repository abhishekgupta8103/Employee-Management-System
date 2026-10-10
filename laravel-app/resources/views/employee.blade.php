
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <x-navbar />
    <!-- Main Layout -->
    <main class="container-fluid py-4 px-3 px-lg-4">
        <div class="row g-4">

            <!-- Sidebar -->
            <aside class="col-12 col-lg-3 col-xl-2">
                <x-sidebar />
            </aside>

            <!-- Dashboard Content -->
            <section class="col-12 col-lg-9 col-xl-10">

                <!-- Welcome Card -->
                <div class="bg-white border rounded-3 p-4 shadow-sm mb-4">
                    <h1 class="fw-bold mb-2">Employee Dashboard</h1>

                    <p class="text-secondary mb-1">
                        Welcome, {{ $name }}!
                    </p>

                    <p class="mb-0">
                        Role: {{ $role }}
                    </p>
                </div>

                <!-- Team Members -->
                <h4 class="fw-bold mb-3">
                    <i class="bi bi-people me-2"></i>Team Members
                </h4>

                <div class="row g-4">

                    <div class="col-12 col-md-6 col-xl-4">
                        <x-employee-card
                            name="Rahul Sharma"
                            role="Frontend Developer"
                            status="Active"
                        />
                    </div>

                    <div class="col-12 col-md-6 col-xl-4">
                        <x-employee-card
                            name="Priya Singh"
                            role="UI/UX Designer"
                            status="Active"
                        />
                    </div>

                    <div class="col-12 col-md-6 col-xl-4">
                        <x-employee-card
                            name="Amit Kumar"
                            role="Backend Developer"
                            status="On Leave"
                        />
                    </div>

                </div>
            </section>
        </div>
    </main>

<!-- Footer -->
<footer class="bg-white border-top text-center text-secondary py-4 mt-4">
    <p class="mb-1">
        Employee Management System &copy; 2026
    </p>
    <small>Built with Laravel Blade and Bootstrap 5</small>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>