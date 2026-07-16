<?php
// ============================================================
// LOGIN PAGE — no DB, client-side validation only (dummy)
// ============================================================
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- <link rel="stylesheet" href="../css/login.css"> -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bs-tertiary-bg);
            padding: 1.5rem;
        }

        .login-wrap {
            width: 100%;
            max-width: 400px;
        }

        .login-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .6rem;
            margin-bottom: 1.75rem;
        }

        .login-brand .brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-brand .brand-icon i {
            font-size: 1.2rem;
        }

        .login-brand span {
            font-size: 1.15rem;
            font-weight: 700;
        }

        .login-card {
            border: 1px solid var(--bs-border-color);
            box-shadow: none;
        }

        .login-card .card-body {
            padding: 2rem 1.85rem;
        }

        .login-title {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: .25rem;
        }

        .login-sub {
            font-size: .84rem;
            color: var(--bs-secondary-color);
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-size: .82rem;
            font-weight: 600;
        }

        .input-group-text {
            background: transparent;
            border-right: none;
        }

        .form-control {
            border-left: none;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: var(--bs-border-color);
        }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: #a7a7a7;
        }

        .btn-login {
            border: none;
            font-weight: 600;
            padding: .55rem 0;
        }

        .toggle-pass {
            cursor: pointer;
        }

        .invalid-feedback {
            font-size: .76rem;
        }

        .login-footer-text {
            text-align: center;
            font-size: .8rem;
            color: var(--bs-secondary-color);
            margin-top: 1.25rem;
        }
    </style>
</head>

<body>

    <div class="login-wrap">

        <div class="login-brand">
            <span>InvoiceApp</span>
        </div>

        <div class="card login-card">
            <div class="card-body">
                <div class="login-title">Sign in to your account</div>

                <form id="loginForm" novalidate>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="you@example.com" autocomplete="email" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter your password" autocomplete="current-password" required
                                minlength="6">
                        </div>
                    </div>

                    <!-- <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label small" for="remember">Remember me</label>
                        </div>
                        <a href="#" class="small text-decoration-none">Forgot password?</a>
                    </div> -->

                    <div id="loginAlert" class="alert alert-danger py-2 small d-none" role="alert"></div>

                    <button type="submit" class="btn btn-login w-100 text-white btn-primary">Sign In</button>
                    <!-- <div class="social-auth-links text-center mb-3 d-grid gap-2">
                        <p class="mb-1">- OR -</p>
                        <a href="#" class="btn btn-secondary">
                            <i class="bi bi-google me-2"></i> Sign in using Google
                        </a>
                    </div> -->
                    <div class="d-flex justify-content-center align-items-center mt-2">
                        <small>Email : admin@example.com | Pass : password123</small>
                    </div>
                </form>
            </div>
        </div>

        <div class="login-footer-text">
            &copy; <?= date('Y') ?> InvoiceApp. All rights reserved.
        </div>

    </div>

    <script src="../dist/js/adminlte.min.js"></script>
    <script>

        // ── Client-side validation (no DB, dummy check) ──
        const form = document.getElementById('loginForm');
        const loginAlert = document.getElementById('loginAlert');

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            e.stopPropagation();

            loginAlert.classList.add('d-none');

            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            form.classList.add('was-validated');

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            // Dummy credential check — replace with real auth later
            const DUMMY_USER = { email: 'admin@example.com', password: 'password123' };

            if (email && password === DUMMY_USER.password) {
                window.location.href = '../dashboard/dashboard.php';
            } else {
                loginAlert.textContent = 'Username, email, or password is incorrect.';
                loginAlert.classList.remove('d-none');
            }
        });
    </script>
</body>

</html>