<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Job - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
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

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2><i class="bi bi-plus-circle me-2"></i>Create New Job</h2>
                        <p class="text-muted mb-0">Fill in the details to post a new job</p>
                    </div>
                    <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Jobs
                    </a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.jobs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="title" class="form-label">Job Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title') }}"
                                           placeholder="e.g. Senior Full Stack Developer" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="company" class="form-label">Company <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('company') is-invalid @enderror"
                                           id="company" name="company" value="{{ old('company') }}"
                                           placeholder="Company Name" required>
                                    @error('company')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="logo" class="form-label">Company Logo</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                       id="logo" name="logo" accept="image/*">
                                <small class="text-muted">Allowed: JPG, PNG, GIF. Max: 2MB</small>
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                           id="location" name="location" value="{{ old('location') }}"
                                           placeholder="e.g. Jakarta, Indonesia" required>
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <input type="text" class="form-control @error('category') is-invalid @enderror"
                                           id="category" name="category" value="{{ old('category') }}"
                                           placeholder="e.g. IT & Software">
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Job Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="6"
                                          placeholder="Describe the job responsibilities, requirements, and benefits..." required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="job_type" class="form-label">Jenis Pekerjaan <span class="text-danger">*</span></label>
                                    <select class="form-select @error('job_type') is-invalid @enderror"
                                            id="job_type" name="job_type" required>
                                        <option value="">Pilih Jenis Pekerjaan</option>
                                        <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                                        <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                                        <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                        <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                                        <option value="freelance" {{ old('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                    </select>
                                    <input type="hidden" name="type" id="type" value="{{ old('job_type', 'full-time') }}">
                                    @error('job_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror"
                                            id="status" name="status" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="deadline" class="form-label">Application Deadline</label>
                                    <input type="date" class="form-control @error('deadline') is-invalid @enderror"
                                           id="deadline" name="deadline" value="{{ old('deadline') }}">
                                    @error('deadline')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="salary_min" class="form-label">Minimum Salary (Optional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control @error('salary_min') is-invalid @enderror"
                                               id="salary_min" name="salary_min" value="{{ old('salary_min') }}"
                                               placeholder="0" step="0.01" min="0">
                                        @error('salary_min')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="salary_max" class="form-label">Maximum Salary (Optional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control @error('salary_max') is-invalid @enderror"
                                               id="salary_max" name="salary_max" value="{{ old('salary_max') }}"
                                               placeholder="0" step="0.01" min="0">
                                        @error('salary_max')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>Create Job
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sync job_type with type field
        document.getElementById('job_type').addEventListener('change', function() {
            document.getElementById('type').value = this.value;
        });
    </script>
</body>
</html>
