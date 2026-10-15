
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS | Settings</title>

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

        .page-title {
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .settings-card {
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 16px;
            box-shadow: 0 5px 22px rgba(15, 23, 42, .045);
        }

        .setting-icon {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 13px;
            background: #eeefff;
            color: var(--primary);
            font-size: 22px;
        }

        .muted {
            color: var(--muted);
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
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
                    <i class="bi bi-gear-fill me-1"></i> PREFERENCES
                </p>

                <h1 class="page-title h2 mb-2">Settings</h1>

                <p class="muted mb-0">
                    Manage your account and security settings.
                </p>
            </div>

            <div class="settings-card p-4 p-md-5 mb-4">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="setting-icon">
                        <i class="bi bi-person-circle"></i>
                    </div>

                    <div>
                        <h4 class="fw-bold mb-1">Account Settings</h4>
                        <p class="muted mb-0">
                            Manage your personal information.
                        </p>
                    </div>
                </div>

                <div class="border rounded-3 p-3">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">Name and Email</h6>
                            <p class="muted small mb-0">
                                Update your name and email address.
                            </p>
                        </div>

<a href="{{ route('profile.index') }}"
   class="btn btn-outline-primary rounded-3">
    <i class="bi bi-person-gear me-1"></i>
    Manage Account
</a>

                    </div>
                </div>
            </div>

            <div class="settings-card p-4 p-md-5 mb-4">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="setting-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>

                    <div>
                        <h4 class="fw-bold mb-1">Security Settings</h4>
                        <p class="muted mb-0">
                            Keep your account secure.
                        </p>
                    </div>
                </div>

                <div class="border rounded-3 p-3">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">Password</h6>
                            <p class="muted small mb-0">
                                Change your password securely.
                            </p>
                        </div>

                        <a href="{{ route('profile.index') }}"
                            class="btn btn-outline-primary rounded-3">
                            <i class="bi bi-key me-1"></i>
                            Manage Security
                        </a>
                    </div>
                </div>
            </div>

            <div class="settings-card p-4">
                <div class="d-flex gap-3 align-items-start">
                    <div class="setting-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">Account Information</h5>

                        <p class="muted mb-2">
                            Signed in as
                            <strong>{{ auth()->user()->name }}</strong>
                        </p>

                        <p class="muted small mb-0">
                            Settings are available to authenticated users.
                            Existing profile and password validation remain in use.
                        </p>
                    </div>
                </div>
            </div>

        </section>
    </div>
</main>

<x-footer />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
