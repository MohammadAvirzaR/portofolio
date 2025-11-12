<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --dark: #1a1a2e;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }

        .auth-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
        }

        .auth-left {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .auth-left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 30px 30px;
        }

        .auth-brand {
            position: relative;
            z-index: 1;
            margin-bottom: 3rem;
        }

        .brand-logo {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .auth-hero {
            position: relative;
            z-index: 1;
        }

        .auth-hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .auth-hero p {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .feature-list {
            margin-top: 2rem;
            position: relative;
            z-index: 1;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-right {
            padding: 3rem;
        }

        .auth-header {
            margin-bottom: 2rem;
        }

        .auth-header h2 {
            color: var(--dark);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .auth-header p {
            color: #6c757d;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        }

        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.3);
        }

        .link-primary {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .link-primary:hover {
            color: var(--secondary);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            text-decoration: none;
            margin-bottom: 2rem;
            transition: all 0.3s;
        }

        .back-link:hover {
            color: rgba(255,255,255,0.8);
            transform: translateX(-5px);
        }

        @media (max-width: 768px) {
            .auth-left {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="auth-card">
            <div class="row g-0">
                <!-- Left Side - Hero -->
                <div class="col-lg-5 auth-left">
                    <a href="{{ route('project.job-portal') }}" class="back-link">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back to Project</span>
                    </a>

                    <div class="auth-brand">
                        <div class="brand-logo">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>
                        <h3 class="mb-0">Job Portal</h3>
                    </div>

                    <div class="auth-hero">
                        <h1>Join Us Today!</h1>
                        <p>Create your account and start exploring amazing job opportunities</p>
                    </div>

                    <div class="feature-list">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <span>Quick & Easy Registration</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-search"></i>
                            </div>
                            <span>Browse Job Listings</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-bell"></i>
                            </div>
                            <span>Get Job Notifications</span>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Form -->
                <div class="col-lg-7 auth-right">
                    <div class="auth-header">
                        <h2>Create Account</h2>
                        <p>Fill in your details to get started</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="bi bi-person"></i>
                                Full Name
                            </label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Enter your full name"
                            />
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope"></i>
                                Email Address
                            </label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                required
                                autocomplete="username"
                                placeholder="your.email@example.com"
                            />
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock"></i>
                                Password
                            </label>
                            <div class="password-wrapper">
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Create a strong password"
                                />
                                <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')">
                                    <i class="bi bi-eye" id="toggleIcon1"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">
                                <i class="bi bi-lock-fill"></i>
                                Confirm Password
                            </label>
                            <div class="password-wrapper">
                                <input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Re-enter your password"
                                />
                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                                    <i class="bi bi-eye" id="toggleIcon2"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-person-plus me-2"></i>Create Account
                        </button>

                        <!-- Login Link -->
                        <div class="text-center mt-4">
                            <p class="text-muted mb-0">
                                Already have an account?
                                <a href="{{ route('login') }}" class="link-primary">Sign In</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>
