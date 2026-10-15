
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS | Professional Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5;
            --page-bg: #f5f7fb;
            --text: #172033;
            --muted: #748094;
        }

        body {
            background: var(--page-bg);
            color: var(--text);
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
        }

        .dashboard-heading {
            font-weight: 800;
            letter-spacing: -.7px;
        }

        .stat-card, .panel {
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 18px;
            box-shadow: 0 6px 24px rgba(20, 30, 60, .04);
        }

        .stat-card {
            transition: transform .2s, box-shadow .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(20, 30, 60, .08);
        }

        .stat-icon {
            width: 54px;
            height: 54px;
            display: grid;
            place-items: center;
            border-radius: 16px;
            font-size: 25px;
        }

        .chart-area {
            position: relative;
            height: 320px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: inline-grid;
            place-items: center;
            border-radius: 13px;
            background: #e9eaff;
            color: #4338ca;
            font-weight: 800;
        }

        .table > :not(caption) > * > * {
            padding: 15px 12px;
        }

        .table thead th {
            color: var(--muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .muted-text {
            color: var(--muted);
        }

        @media (max-width: 576px) {
            .chart-area { height: 260px; }
            .stat-card .card-body { padding: 18px !important; }
        }
    </style>
</head>

<body>
    <x-navbar />

    <main class="container-fluid px-3 px-lg-4 py-4">
        <div class="row g-4">

            <!-- Existing Sidebar -->
            <aside class="col-12 col-lg-3 col-xl-2">
                <x-sidebar />
            </aside>

            <!-- Dashboard -->
            <section class="col-12 col-lg-9 col-xl-10">

                <!-- Page Header -->
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <p class="text-primary fw-semibold mb-1">
                            <i class="bi bi-grid-1x2-fill me-1"></i> OVERVIEW
                        </p>
                        <h1 class="dashboard-heading h2 mb-2">Dashboard</h1>
                        <p class="muted-text mb-0">
                            Welcome back, {{ $name }}! Here's your employee overview.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('employees.create') }}" class="btn btn-success rounded-3 px-3 py-2">
    <i class="bi bi-person-plus-fill me-1"></i> Add Employee
</a>
<a href="{{ route('employees.index') }}" class="btn btn-primary rounded-3 px-3 py-2">
                            <i class="bi bi-people me-1"></i> Manage Employees
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger rounded-3 py-2">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row g-3 mb-4">

                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="card stat-card h-100">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="muted-text fw-medium">Total Employees</span>
                                    <div class="stat-icon text-primary bg-primary-subtle">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                </div>
                                <h2 class="fw-bold mb-1">{{ $totalEmployees }}</h2>
                                <small class="muted-text">Employees in database</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="card stat-card h-100">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="muted-text fw-medium">Job Positions</span>
                                    <div class="stat-icon text-success bg-success-subtle">
                                        <i class="bi bi-briefcase-fill"></i>
                                    </div>
                                </div>
                                <h2 class="fw-bold mb-1">{{ $totalPositions }}</h2>
                                <small class="muted-text">Unique positions</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="card stat-card h-100">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="muted-text fw-medium">Total Salary</span>
                                    <div class="stat-icon text-warning bg-warning-subtle">
                                        <i class="bi bi-wallet-fill"></i>
                                    </div>
                                </div>
                                <h2 class="fw-bold mb-1">
                                    ₹{{ number_format((float) $totalSalary, 2) }}
                                </h2>
                                <small class="muted-text">Combined salary amount</small>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Chart -->
                <div class="panel p-3 p-md-4 mb-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-4">
                        <div>
                            <h5 class="fw-bold mb-1">Employees by Position</h5>
                            <p class="muted-text small mb-0">
                                Distribution of employees across job roles
                            </p>
                        </div>
                        <span class="badge rounded-pill text-bg-light border px-3 py-2">
                            <i class="bi bi-bar-chart-fill text-primary me-1"></i> Live Data
                        </span>
                    </div>

                    @if ($positionData->isNotEmpty())
                        <div class="chart-area">
                            <canvas id="positionChart"></canvas>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-bar-chart-line display-4 text-secondary"></i>
                            <h6 class="fw-bold mt-3">No position data yet</h6>
                            <p class="muted-text mb-3">
                                Add employees with job positions to display this chart.
                            </p>
                            <a href="{{ route('employees.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-1"></i> Add Employee
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Recent Employees -->
                <div class="panel p-3 p-md-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                        <div>
                            <h5 class="fw-bold mb-1">Recent Employees</h5>
                            <p class="muted-text small mb-0">Latest five employee records</p>
                        </div>
                        <a href="{{ route('employees.index') }}" class="btn btn-outline-primary btn-sm rounded-3">
                            View All <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Email</th>
                                    <th>Position</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentEmployees as $employee)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="avatar">
                                                    {{ strtoupper(substr($employee->name, 0, 1)) }}
                                                </span>
                                                <span class="fw-semibold text-nowrap">
                                                    {{ $employee->name }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>{{ $employee->email }}</td>
                                        <td>
                                            <span class="badge rounded-pill text-bg-light border">
                                                {{ $employee->position ?: 'Not assigned' }}
                                            </span>
                                        </td>
                                        <td class="fw-semibold text-nowrap">
                                            @if ($employee->salary !== null)
                                                ₹{{ number_format((float) $employee->salary, 2) }}
                                            @else
                                                <span class="muted-text">Not set</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <i class="bi bi-person-plus display-6 text-secondary"></i>
                                            <p class="muted-text mt-2 mb-3">No employees found yet.</p>
                                            <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">
                                                Add First Employee
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
        </div>
    </main>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @if ($positionData->isNotEmpty())
        <script>
            const positionLabels = @json($positionData->pluck('position')->values());
            const positionCounts = @json($positionData->pluck('total')->values());

            const chartCanvas = document.getElementById('positionChart');

            new Chart(chartCanvas, {
                type: 'bar',
                data: {
                    labels: positionLabels,
                    datasets: [{
                        label: 'Employees',
                        data: positionCounts,
                        backgroundColor: '#4f46e5',
                        hoverBackgroundColor: '#3730a3',
                        borderRadius: 8,
                        maxBarThickness: 55
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        },
                        x: {
                            grid: { display: false }
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Employees: ' + context.raw;
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endif
</body>
</html>
