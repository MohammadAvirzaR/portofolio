<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Applicants - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
        }
        .status-pending { background-color: #ffc107; color: #000; }
        .status-accepted { background-color: #28a745; color: #fff; }
        .status-rejected { background-color: #dc3545; color: #fff; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="bi bi-briefcase-fill me-2"></i>Admin Panel</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('admin.jobs.index') }}"><i class="bi bi-briefcase"></i> Jobs</a>
                <span class="nav-link">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&size=32&background=667eea&color=fff"
                         alt="Avatar" class="rounded-circle" style="width: 32px; height: 32px;">
                </span>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2><i class="bi bi-people-fill me-2"></i>All Applicants</h2>
                <p class="text-muted">{{ $applicants->total() }} total application(s)</p>
            </div>
            <div>
                <a href="{{ route('admin.applicants.export') }}" class="btn btn-success me-2">
                    <i class="bi bi-download me-2"></i>Export to Excel
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Filter Row -->
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by name or email...">
            </div>
            <div class="col-md-3">
                <select id="statusFilter" class="form-select">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="accepted">Accepted</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
        </div>

        @if($applicants->count() > 0)
        <div class="row">
            @foreach($applicants as $app)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100 shadow-sm hover-shadow" style="transition: transform 0.2s;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="card-title mb-1">{{ $app->user->name }}</h6>
                                <small class="text-muted">{{ $app->user->email }}</small>
                            </div>
                            <span class="badge status-{{ $app->status }}">
                                {{ ucfirst($app->status) }}
                            </span>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="bi bi-briefcase me-1"></i>{{ $app->job->title }}
                            </small>
                            <br>
                            <small class="text-muted">
                                <i class="bi bi-building me-1"></i>{{ $app->job->company_name }}
                            </small>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="bi bi-calendar me-1"></i>{{ $app->created_at->format('M d, Y H:i') }}
                            </small>
                        </div>

                        @if($app->admin_notes)
                        <div class="alert alert-light" style="font-size: 0.85rem;">
                            <strong>Notes:</strong> {{ $app->admin_notes }}
                        </div>
                        @endif

                        <div class="d-flex gap-2">
                            @if($app->cv_path)
                            <a href="{{ route('applications.download-cv', $app) }}" class="btn btn-sm btn-outline-primary flex-grow-1">
                                <i class="bi bi-download"></i> CV
                            </a>
                            @endif
                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#notesModal{{ $app->id }}">
                                <i class="bi bi-pencil"></i> Notes
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#statusModal{{ $app->id }}">
                                <i class="bi bi-gear"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Status Modal -->
                <div class="modal fade" id="statusModal{{ $app->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Status - {{ $app->user->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('applications.update-status', $app) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-select" required>
                                            <option value="pending" {{ $app->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="accepted" {{ $app->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                            <option value="rejected" {{ $app->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Notes Modal -->
                <div class="modal fade" id="notesModal{{ $app->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Admin Notes - {{ $app->user->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('applications.update-status', $app) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="notes" class="form-label">Notes</label>
                                        <textarea name="admin_notes" class="form-control" rows="4" placeholder="Add your notes...">{{ $app->admin_notes }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Notes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $applicants->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <p class="text-muted mt-3">No applications yet</p>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple client-side filtering (optional)
        document.getElementById('searchInput')?.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('.card').forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
