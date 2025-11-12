<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Management - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: calc(100vh - 56px);
            background: #2c3e50;
        }
        .sidebar a {
            color: #ecf0f1;
            padding: 1rem 1.5rem;
            display: block;
            text-decoration: none;
            transition: all 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #34495e;
            border-left: 4px solid #3498db;
        }
        .job-card {
            transition: transform 0.2s;
        }
        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .badge-type {
            font-size: 0.75rem;
            padding: 0.35rem 0.65rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="bi bi-briefcase-fill me-2"></i>Admin Panel
            </a>
            <div class="d-flex align-items-center">
                <span class="navbar-text text-white me-3">
                    <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->name }}
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 px-0 sidebar">
                <div class="py-3">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.users') }}">
                        <i class="bi bi-people-fill me-2"></i>Users
                    </a>
                    <a href="{{ route('admin.jobs.index') }}" class="active">
                        <i class="bi bi-briefcase-fill me-2"></i>Jobs
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">
                <div class="container-fluid py-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2><i class="bi bi-briefcase-fill me-2"></i>Job Management</h2>
                            <p class="text-muted mb-0">Manage all job postings</p>
                        </div>
                        <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Add New Job
                        </a>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted mb-1">Total Jobs</h6>
                                            <h3 class="mb-0">{{ \App\Models\Job::count() }}</h3>
                                        </div>
                                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                                            <i class="bi bi-briefcase-fill text-primary fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted mb-1">Active Jobs</h6>
                                            <h3 class="mb-0">{{ \App\Models\Job::where('status', 'active')->count() }}</h3>
                                        </div>
                                        <div class="bg-success bg-opacity-10 p-3 rounded">
                                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted mb-1">Closed Jobs</h6>
                                            <h3 class="mb-0">{{ \App\Models\Job::where('status', 'closed')->count() }}</h3>
                                        </div>
                                        <div class="bg-danger bg-opacity-10 p-3 rounded">
                                            <i class="bi bi-x-circle-fill text-danger fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted mb-1">This Month</h6>
                                            <h3 class="mb-0">{{ \App\Models\Job::whereMonth('created_at', now()->month)->count() }}</h3>
                                        </div>
                                        <div class="bg-info bg-opacity-10 p-3 rounded">
                                            <i class="bi bi-calendar-check text-info fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jobs Table -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">All Job Postings</h5>
                        </div>
                        <div class="card-body p-0">
                            @if($jobs->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Logo</th>
                                            <th>Title</th>
                                            <th>Company</th>
                                            <th>Location</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Deadline</th>
                                            <th>Created</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jobs as $job)
                                        <tr>
                                            <td>
                                                @if($job->logo)
                                                <img src="{{ asset('storage/' . $job->logo) }}"
                                                     alt="{{ $job->company }}"
                                                     class="img-thumbnail"
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                                     style="width: 50px; height: 50px; border-radius: 4px;">
                                                    <i class="bi bi-building"></i>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $job->title }}</strong>
                                                @if($job->category)
                                                <br><small class="text-muted">{{ $job->category }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $job->company }}</td>
                                            <td>
                                                <i class="bi bi-geo-alt-fill text-muted me-1"></i>{{ $job->location }}
                                            </td>
                                            <td>
                                                <span class="badge badge-type bg-info">
                                                    {{ ucfirst(str_replace('-', ' ', $job->job_type ?? $job->type)) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($job->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                                @else
                                                <span class="badge bg-secondary">Closed</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($job->deadline)
                                                {{ $job->deadline->format('M d, Y') }}
                                                @else
                                                <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $job->created_at->format('M d, Y') }}</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin.jobs.edit', $job) }}"
                                                       class="btn btn-outline-primary" title="Edit">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $job->id }}"
                                                            title="Delete">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $job->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title">
                                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>Confirm Delete
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="mb-3">Are you sure you want to delete this job posting?</p>
                                                        <div class="alert alert-warning mb-0">
                                                            <strong><i class="bi bi-briefcase me-1"></i>{{ $job->title }}</strong><br>
                                                            <small class="text-muted">{{ $job->company }} • {{ $job->location }}</small>
                                                        </div>
                                                        <p class="text-danger small mt-3 mb-0">
                                                            <i class="bi bi-info-circle me-1"></i>This action cannot be undone.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            <i class="bi bi-x-circle me-1"></i>Cancel
                                                        </button>
                                                        <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="bi bi-trash-fill me-1"></i>Delete Job
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer bg-white">
                                {{ $jobs->links() }}
                            </div>
                            @else
                            <div class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted"></i>
                                <p class="text-muted mt-3">No jobs posted yet</p>
                                <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Post Your First Job
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
</body>
</html>
