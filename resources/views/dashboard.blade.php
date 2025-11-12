<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ Auth::user()->name }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1f2937;
            --light: #f3f4f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-brand i {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .main-container {
            padding: 2rem 0;
        }

        .welcome-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .welcome-card h2 {
            color: var(--dark);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .welcome-card p {
            color: #6b7280;
            margin-bottom: 0;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            border-left: 4px solid var(--primary);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-card.success {
            border-left-color: var(--success);
        }

        .stat-card.warning {
            border-left-color: var(--warning);
        }

        .stat-card.danger {
            border-left-color: var(--danger);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .stat-card.success .stat-icon {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .stat-card.warning .stat-icon {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .stat-card.danger .stat-icon {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .content-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .content-card h3 {
            color: var(--dark);
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--light);
        }

        .quick-link {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: var(--light);
            border-radius: 12px;
            margin-bottom: 1rem;
            text-decoration: none;
            color: var(--dark);
            transition: all 0.3s;
        }

        .quick-link:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            transform: translateX(5px);
        }

        .quick-link i {
            font-size: 1.5rem;
            margin-right: 1rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 8px;
        }

        .quick-link:hover i {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .btn-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        @media (max-width: 768px) {
            .stat-card {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('project.job-portal') }}">
                <i class="bi bi-briefcase-fill"></i> Job Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jobs.index') }}"><i class="bi bi-search"></i> Browse Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.show') }}"><i class="bi bi-person"></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-gradient btn-sm ms-2">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <div class="container">
            <!-- Welcome Section -->
            <div class="welcome-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2>Welcome back, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h2>
                        <p>Here's your Job Portal dashboard overview</p>
                    </div>
                    <div class="text-muted">
                        <i class="bi bi-calendar3"></i> {{ now()->format('l, F j, Y') }}
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>
                        <div class="stat-value">{{ \App\Models\Job::where('status', 'active')->count() }}</div>
                        <div class="stat-label">Active Jobs</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="stat-card success">
                        <div class="stat-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="stat-value">{{ \App\Models\Job::distinct('company')->count('company') }}</div>
                        <div class="stat-label">Companies</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="stat-card warning">
                        <div class="stat-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="stat-value">{{ \App\Models\User::count() }}</div>
                        <div class="stat-label">Total Users</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="stat-card danger">
                        <div class="stat-icon">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <div class="stat-value">{{ \App\Models\Job::where('deadline', '>', now())->count() }}</div>
                        <div class="stat-label">Open Positions</div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="content-card">
                        <h3><i class="bi bi-briefcase"></i> Recent Job Postings</h3>
                        <div class="list-group">
                            @forelse(\App\Models\Job::where('status', 'active')->latest()->take(5)->get() as $job)
                            <a href="{{ route('jobs.index') }}" class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1">{{ $job->title }}</h5>
                                        <p class="mb-1 text-muted">
                                            <i class="bi bi-building"></i> {{ $job->company }} •
                                            <i class="bi bi-geo-alt"></i> {{ $job->location }}
                                        </p>
                                        <small class="text-muted">
                                            <i class="bi bi-clock"></i> Posted {{ $job->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <span class="badge bg-success">{{ ucfirst($job->type) }}</span>
                                </div>
                            </a>
                            @empty
                            <div class="text-center py-4">
                                <i class="bi bi-inbox" style="font-size: 3rem; color: #ddd;"></i>
                                <p class="text-muted mt-2">No jobs available yet</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="content-card">
                        <h3><i class="bi bi-lightning-charge"></i> Quick Links</h3>
                        <a href="{{ route('jobs.index') }}" class="quick-link">
                            <i class="bi bi-search"></i>
                            <span>Browse All Jobs</span>
                        </a>
                        <a href="{{ route('profile.show') }}" class="quick-link">
                            <i class="bi bi-person-circle"></i>
                            <span>My Profile</span>
                        </a>
                        @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.jobs.index') }}" class="quick-link">
                            <i class="bi bi-gear-fill"></i>
                            <span>Manage Jobs</span>
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="quick-link">
                            <i class="bi bi-shield-check"></i>
                            <span>Admin Panel</span>
                        </a>
                        @endif
                        <a href="{{ route('project.job-portal') }}" class="quick-link">
                            <i class="bi bi-info-circle"></i>
                            <span>About Job Portal</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
