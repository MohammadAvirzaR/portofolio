<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants for {{ $job->title }} - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
        }
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
                <h2><i class="bi bi-people-fill me-2"></i>Applicants for {{ $job->title }}</h2>
                <p class="text-muted">{{ $applicants->total() }} application(s)</p>
            </div>
            <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Jobs
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if($applicants->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Applicant Name</th>
                        <th>Email</th>
                        <th>Applied Date</th>
                        <th>CV</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicants as $app)
                    <tr>
                        <td>
                            <strong>{{ $app->user->name }}</strong>
                        </td>
                        <td>
                            <small>{{ $app->user->email }}</small>
                        </td>
                        <td>
                            <small class="text-muted">{{ $app->created_at->format('M d, Y H:i') }}</small>
                        </td>
                        <td>
                            @if($app->cv_path)
                            <a href="{{ route('applications.download-cv', $app) }}" class="btn btn-sm btn-outline-primary" title="Download CV">
                                <i class="bi bi-download"></i> PDF
                            </a>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('applications.update-status', $app) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="pending" {{ $app->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="accepted" {{ $app->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                    <option value="rejected" {{ $app->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#notesModal{{ $app->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('applications.destroy', $app) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this application?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Notes Modal -->
                    <div class="modal fade" id="notesModal{{ $app->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Admin Notes for {{ $app->user->name }}</h5>
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
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $applicants->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <p class="text-muted mt-3">No applications for this job yet</p>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
