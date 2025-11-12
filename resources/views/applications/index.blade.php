<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications - Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
        }

        body {
            background: #f5f5f5;
        }

        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 3rem 0;
        }

        .application-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary);
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .application-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-accepted {
            background: #d1fae5;
            color: #065f46;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/"><i class="bi bi-briefcase-fill"></i> Job Portal</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('jobs.index') }}"><i class="bi bi-search"></i> Browse Jobs</a>
                <a class="nav-link active" href="{{ route('applications.index') }}"><i class="bi bi-file-earmark"></i> My Applications</a>
            </div>
        </div>
    </nav>

    <div class="hero text-center">
        <div class="container">
            <h1 class="display-5 fw-bold mb-2">My Job Applications</h1>
            <p class="lead mb-0">Track the status of your applications</p>
        </div>
    </div>

    <div class="container my-5">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if($applications->count() > 0)
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="mb-4">
                    <p class="text-muted">You have submitted <strong>{{ $applications->total() }}</strong> application(s)</p>
                </div>

                @foreach($applications as $app)
                <div class="application-card">
                    <div class="row align-items-start">
                        <div class="col-md-8">
                            <h5 class="mb-2 fw-bold">{{ $app->job->title }}</h5>
                            <p class="text-muted mb-2">
                                <i class="bi bi-building me-1"></i>{{ $app->job->company }} •
                                <i class="bi bi-geo-alt me-1"></i>{{ $app->job->location }}
                            </p>
                            <p class="text-muted small">
                                <i class="bi bi-calendar me-1"></i>Applied {{ $app->created_at->diffForHumans() }}
                            </p>

                            @if($app->admin_notes)
                            <div class="alert alert-info small mt-2 mb-0">
                                <i class="bi bi-info-circle me-1"></i>
                                <strong>Admin Notes:</strong> {{ $app->admin_notes }}
                            </div>
                            @endif
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="mb-3">
                                <span class="status-badge status-{{ $app->status }}">
                                    <i class="bi bi-{{ $app->status === 'pending' ? 'hourglass-split' : ($app->status === 'accepted' ? 'check-circle' : 'x-circle') }} me-1"></i>
                                    {{ ucfirst($app->status) }}
                                </span>
                            </div>
                            <a href="{{ route('applications.download-cv', $app) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-download me-1"></i>Download CV
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="mt-4">
                    {{ $applications->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-lg-8 mx-auto text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ddd;"></i>
                <p class="text-muted mt-3">You haven't submitted any applications yet</p>
                <a href="{{ route('jobs.index') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-search me-2"></i>Browse Available Jobs
                </a>
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
