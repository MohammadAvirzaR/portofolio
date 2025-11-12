<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
        }
        .profile-avatar {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #667eea;
            margin: 0 auto 1rem;
        }
        .info-card {
            border-left: 4px solid #667eea;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Portfolio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    @if(Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('profile.show') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm ms-2">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="profile-header text-center">
        <div class="container">
            <div class="profile-avatar">
                <i class="bi bi-person-fill"></i>
            </div>
            <h1 class="mb-2">{{ $user->name }}</h1>
            <p class="mb-0">
                <i class="bi bi-envelope-fill me-2"></i>{{ $user->email }}
            </p>
            <span class="badge bg-light text-dark mt-2">{{ ucfirst($user->role) }}</span>
        </div>
    </div>

    <div class="container my-5">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row">
            <!-- Profile Information -->
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Profile Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Update Profile
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.password.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                       id="current_password" name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control"
                                       id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-key me-2"></i>Change Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Account Details -->
            <div class="col-md-4">
                <div class="card shadow-sm info-card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Account Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted d-block">Member Since</small>
                            <strong>{{ $user->created_at->format('F d, Y') }}</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Last Updated</small>
                            <strong>{{ $user->updated_at->format('F d, Y') }}</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Account Type</small>
                            <strong class="text-capitalize">{{ $user->role }}</strong>
                        </div>
                        <div class="mb-0">
                            <small class="text-muted d-block">Email Status</small>
                            @if($user->email_verified_at)
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i>Verified
                                </span>
                            @else
                                <span class="badge bg-warning">
                                    <i class="bi bi-exclamation-circle me-1"></i>Not Verified
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-danger">
                    <div class="card-header bg-white border-danger">
                        <h5 class="mb-0 text-danger"><i class="bi bi-exclamation-triangle me-2"></i>Danger Zone</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Once you delete your account, all of its resources and data will be permanently deleted.</p>
                        <button type="button" class="btn btn-danger btn-sm w-100" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash me-2"></i>Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-danger">
                    <h5 class="modal-title text-danger">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                        <div class="mb-3">
                            <label for="password" class="form-label">Please enter your password to confirm</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
