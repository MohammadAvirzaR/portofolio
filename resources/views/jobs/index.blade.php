<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Vacancies - Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
        }

        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.1;
        }

        .filter-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .filter-btn {
            padding: 0.5rem 1.25rem;
            border-radius: 25px;
            border: 2px solid #e0e0e0;
            background: white;
            color: #666;
            font-weight: 500;
            transition: all 0.3s;
            cursor: pointer;
        }

        .filter-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }

        .filter-btn.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: transparent;
        }

        .job-card {
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            background: white;
            height: 100%;
        }

        .job-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.2);
            border-color: var(--primary);
        }

        .job-ribbon {
            position: absolute;
            top: 15px;
            right: -35px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 5px 40px;
            transform: rotate(45deg);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            z-index: 10;
        }

        .job-ribbon.full-time { background: linear-gradient(135deg, #10b981, #059669); }
        .job-ribbon.part-time { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .job-ribbon.contract { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .job-ribbon.internship { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
        .job-ribbon.freelance { background: linear-gradient(135deg, #ec4899, #db2777); }

        .company-logo {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #f0f0f0;
        }

        .badge-custom {
            padding: 0.4rem 0.85rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .btn-apply {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-apply:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .salary-badge {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            display: inline-block;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-briefcase-fill me-2"></i>Job Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('jobs.index') }}">Jobs</a>
                    </li>
                    @auth
                        @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.jobs.index') }}">Admin Panel</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.show') }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm ms-2">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm ms-2" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Find Your Dream Job</h1>
            <p class="lead mb-4">Discover amazing opportunities from top companies</p>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="Search jobs...">
                        <button class="btn btn-light" type="button">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <!-- Filter Section -->
        <div class="filter-card">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h5 class="mb-2"><i class="bi bi-funnel me-2"></i>Filter by Job Type</h5>
                    <p class="text-muted small mb-0">{{ $jobs->total() }} positions available</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <button class="filter-btn active" data-filter="all">
                        <i class="bi bi-grid-3x3-gap me-1"></i>All Jobs
                    </button>
                    <button class="filter-btn" data-filter="full-time">
                        <i class="bi bi-briefcase-fill me-1"></i>Full Time
                    </button>
                    <button class="filter-btn" data-filter="part-time">
                        <i class="bi bi-clock-fill me-1"></i>Part Time
                    </button>
                    <button class="filter-btn" data-filter="contract">
                        <i class="bi bi-file-earmark-text me-1"></i>Contract
                    </button>
                    <button class="filter-btn" data-filter="internship">
                        <i class="bi bi-mortarboard-fill me-1"></i>Internship
                    </button>
                    <button class="filter-btn" data-filter="freelance">
                        <i class="bi bi-laptop me-1"></i>Freelance
                    </button>
                </div>
            </div>
        </div>

        @if($jobs->count() > 0)
        <div class="row" id="jobsContainer">
            @foreach($jobs as $job)
            <div class="col-md-6 col-lg-4 mb-4 job-item" data-type="{{ $job->job_type ?? $job->type }}">
                <div class="card job-card h-100">
                    <div class="job-ribbon {{ $job->job_type ?? $job->type }}">
                        {{ ucfirst(str_replace('-', ' ', $job->job_type ?? $job->type)) }}
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                @if($job->logo)
                                <img src="{{ asset('storage/' . $job->logo) }}"
                                     alt="{{ $job->company }}"
                                     class="company-logo">
                                @else
                                <div class="bg-primary bg-opacity-10 company-logo d-flex align-items-center justify-content-center">
                                    <i class="bi bi-building fs-3 text-primary"></i>
                                </div>
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1 fw-bold">{{ Str::limit($job->title, 40) }}</h5>
                                <h6 class="text-muted mb-0">
                                    <i class="bi bi-building me-1"></i>{{ $job->company }}
                                </h6>
                            </div>
                        </div>

                        <div class="mb-3">
                            <span class="badge bg-secondary badge-custom me-2">
                                <i class="bi bi-geo-alt me-1"></i>{{ $job->location }}
                            </span>
                            @if($job->category)
                            <span class="badge bg-info badge-custom">
                                <i class="bi bi-tag me-1"></i>{{ $job->category }}
                            </span>
                            @endif
                        </div>

                        <p class="card-text text-muted small mb-3" style="min-height: 60px;">
                            {{ Str::limit($job->description, 100) }}
                        </p>

                        @if($job->salary_min || $job->salary_max)
                        <div class="mb-3">
                            <div class="salary-badge">
                                <i class="bi bi-cash-stack me-1"></i>
                                @if($job->salary_min && $job->salary_max)
                                    Rp {{ number_format($job->salary_min / 1000000, 1) }}M - {{ number_format($job->salary_max / 1000000, 1) }}M
                                @elseif($job->salary_min)
                                    From Rp {{ number_format($job->salary_min / 1000000, 1) }}M
                                @else
                                    Up to Rp {{ number_format($job->salary_max / 1000000, 1) }}M
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center text-muted small mb-3">
                            <span>
                                <i class="bi bi-clock me-1"></i>{{ $job->created_at->diffForHumans() }}
                            </span>
                            @if($job->deadline)
                            <span class="text-danger">
                                <i class="bi bi-calendar-x me-1"></i>{{ $job->deadline->format('M d') }}
                            </span>
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-outline-primary">
                                <i class="bi bi-eye me-2"></i>View Details
                            </a>
                            <button class="btn btn-apply"
                                    @auth
                                        onclick="window.location.href='{{ route('applications.create', $job->id) }}'"
                                    @else
                                        onclick="window.location.href='{{ route('login') }}'"
                                    @endauth>
                                <i class="bi bi-send me-2"></i>Apply Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $jobs->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <p class="text-muted mt-3 fs-5">No job vacancies available at the moment</p>
            <p class="text-muted">Please check back later for new opportunities</p>
        </div>
        @endif
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 Job Portal. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active state
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');
                const jobItems = document.querySelectorAll('.job-item');

                jobItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-type') === filter) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 10);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });

        // Initial animation
        document.querySelectorAll('.job-item').forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            setTimeout(() => {
                item.style.transition = 'all 0.3s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 50);
        });
    </script>
</body>
</html>
