<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
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

        .admin-badge {
            background: linear-gradient(135deg, var(--danger), #dc2626);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 0.5rem;
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

        .welcome-card .subtitle {
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .admin-alert {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1));
            border-left: 4px solid var(--danger);
            padding: 1rem;
            border-radius: 8px;
        }

        .admin-alert h5 {
            color: var(--danger);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .stat-card.success::before {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .stat-card.warning::before {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .stat-card.danger::before {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .stat-card.info::before {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
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

        .stat-card.info .stat-icon {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .stat-title {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .stat-description {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .stat-footer {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--light);
        }

        .btn-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-outline-gradient {
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-gradient:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: transparent;
        }

        .management-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .management-card h3 {
            color: var(--dark);
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--light);
        }

        .quick-action {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background: var(--light);
            border-radius: 12px;
            margin-bottom: 1rem;
            transition: all 0.3s;
        }

        .quick-action:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            transform: translateX(5px);
        }

        .quick-action:hover .action-icon {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .action-details h5 {
            margin: 0 0 0.25rem 0;
            font-size: 1rem;
            font-weight: 600;
        }

        .action-details p {
            margin: 0;
            font-size: 0.85rem;
            opacity: 0.8;
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
                <i class="bi bi-shield-check"></i> Job Portal Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> User Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jobs.index') }}"><i class="bi bi-briefcase"></i> View Jobs</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            <span class="admin-badge">ADMIN</span>
                        </span>
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
                <h2><i class="bi bi-shield-check"></i> Admin Dashboard</h2>
                <p class="subtitle">Welcome, {{ Auth::user()->name }}! You have full administrative access to manage the Job Portal system.</p>
                <div class="admin-alert">
                    <h5><i class="bi bi-exclamation-triangle-fill"></i> Administrative Access</h5>
                    <p class="mb-0">You have admin privileges and can access all administrative features. Use these powers responsibly.</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-title">Total Users</div>
                            <div class="stat-icon">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ \App\Models\User::count() }}</div>
                        <div class="stat-description">Registered users in the system</div>
                        <div class="stat-footer">
                            <a href="{{ route('admin.users') }}" class="btn-outline-gradient btn-sm w-100">
                                <i class="bi bi-eye"></i> View All Users
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-card success">
                        <div class="stat-header">
                            <div class="stat-title">Active Jobs</div>
                            <div class="stat-icon">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ \App\Models\Job::where('status', 'active')->count() }}</div>
                        <div class="stat-description">Currently active job postings</div>
                        <div class="stat-footer">
                            <a href="{{ route('admin.jobs.index') }}" class="btn-outline-gradient btn-sm w-100">
                                <i class="bi bi-gear"></i> Manage Jobs
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-card warning">
                        <div class="stat-header">
                            <div class="stat-title">Total Jobs</div>
                            <div class="stat-icon">
                                <i class="bi bi-file-earmark-text-fill"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ \App\Models\Job::count() }}</div>
                        <div class="stat-description">All job postings (active & inactive)</div>
                        <div class="stat-footer">
                            <a href="{{ route('admin.jobs.create') }}" class="btn-outline-gradient btn-sm w-100">
                                <i class="bi bi-plus-circle"></i> Create New Job
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-card danger">
                        <div class="stat-header">
                            <div class="stat-title">Administrators</div>
                            <div class="stat-icon">
                                <i class="bi bi-shield-fill-check"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ \App\Models\User::where('role', 'admin')->count() }}</div>
                        <div class="stat-description">Users with admin privileges</div>
                    </div>
                </div>
            </div>

            <!-- Management Section -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="management-card">
                        <h3><i class="bi bi-gear-fill"></i> Job Management</h3>

                        <a href="{{ route('admin.jobs.index') }}" class="quick-action text-decoration-none">
                            <div class="d-flex align-items-center">
                                <div class="action-icon">
                                    <i class="bi bi-list-ul"></i>
                                </div>
                                <div class="action-details">
                                    <h5>View All Jobs</h5>
                                    <p>Browse and manage all job postings</p>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right"></i>
                        </a>

                        <a href="{{ route('admin.jobs.create') }}" class="quick-action text-decoration-none">
                            <div class="d-flex align-items-center">
                                <div class="action-icon">
                                    <i class="bi bi-plus-circle"></i>
                                </div>
                                <div class="action-details">
                                    <h5>Create New Job</h5>
                                    <p>Post a new job opening</p>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right"></i>
                        </a>

                        <a href="{{ route('jobs.index') }}" class="quick-action text-decoration-none">
                            <div class="d-flex align-items-center">
                                <div class="action-icon">
                                    <i class="bi bi-eye"></i>
                                </div>
                                <div class="action-details">
                                    <h5>Public Job Listing</h5>
                                    <p>View jobs as users see them</p>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="management-card">
                        <h3><i class="bi bi-people-fill"></i> User Management</h3>

                        <a href="{{ route('admin.users') }}" class="quick-action text-decoration-none">
                            <div class="d-flex align-items-center">
                                <div class="action-icon">
                                    <i class="bi bi-person-lines-fill"></i>
                                </div>
                                <div class="action-details">
                                    <h5>View All Users</h5>
                                    <p>Manage registered users</p>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right"></i>
                        </a>

                        <a href="{{ route('profile.show') }}" class="quick-action text-decoration-none">
                            <div class="d-flex align-items-center">
                                <div class="action-icon">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <div class="action-details">
                                    <h5>My Profile</h5>
                                    <p>View and edit your profile</p>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right"></i>
                        </a>

                        <a href="{{ route('project.job-portal') }}" class="quick-action text-decoration-none">
                            <div class="d-flex align-items-center">
                                <div class="action-icon">
                                    <i class="bi bi-info-circle"></i>
                                </div>
                                <div class="action-details">
                                    <h5>About Job Portal</h5>
                                    <p>Project information and overview</p>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="management-card">
                <h3><i class="bi bi-clock-history"></i> Recent Job Postings</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Company</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Posted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Job::latest()->take(5)->get() as $job)
                            <tr>
                                <td><strong>{{ $job->title }}</strong></td>
                                <td>{{ $job->company }}</td>
                                <td>{{ $job->location }}</td>
                                <td><span class="badge bg-info">{{ ucfirst($job->type) }}</span></td>
                                <td>
                                    @if($job->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $job->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="bi bi-inbox" style="font-size: 2rem; color: #ddd;"></i>
                                    <p class="text-muted mt-2">No jobs posted yet</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
