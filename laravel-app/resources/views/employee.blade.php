
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

    <x-navbar />

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
                    <p class="text-secondary mb-1">Welcome, {{ $name }}!</p>
                    <p class="mb-0">Role: {{ $role }}</p>
                </div>

                <!-- Summary Cards -->
                <div class="row g-4 mb-4">

                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-secondary mb-2">Total Employees</p>
                                    <h2 class="fw-bold mb-0">3</h2>
                                </div>
                                <div class="bg-primary-subtle text-primary rounded-3 p-3">
                                    <i class="bi bi-people-fill fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-secondary mb-2">Active Employees</p>
                                    <h2 class="fw-bold mb-0">2</h2>
                                </div>
                                <div class="bg-success-subtle text-success rounded-3 p-3">
                                    <i class="bi bi-person-check-fill fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-secondary mb-2">On Leave</p>
                                    <h2 class="fw-bold mb-0">1</h2>
                                </div>
                                <div class="bg-warning-subtle text-warning rounded-3 p-3">
                                    <i class="bi bi-calendar-check-fill fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>

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

    <!-- Reusable Footer -->
    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
