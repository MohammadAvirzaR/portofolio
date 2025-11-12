<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for {{ $job->title }} - Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
        }

        body {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .apply-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            max-width: 600px;
            margin: 0 auto;
            padding: 2.5rem;
        }

        .job-info {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
        }

        .job-info h2 {
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .job-info p {
            margin-bottom: 0.25rem;
            opacity: 0.95;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 8px;
            border: 2px solid #e0e0e0;
            padding: 0.75rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .upload-area {
            border: 2px dashed #667eea;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            background: rgba(102, 126, 234, 0.05);
            cursor: pointer;
            transition: all 0.3s;
        }

        .upload-area:hover {
            background: rgba(102, 126, 234, 0.1);
            border-color: var(--secondary);
        }

        .upload-area i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .file-info {
            margin-top: 1rem;
            padding: 1rem;
            background: #f0f0f0;
            border-radius: 8px;
            display: none;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/"><i class="bi bi-briefcase-fill"></i> Job Portal</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('jobs.index') }}"><i class="bi bi-arrow-left"></i> Back to Jobs</a>
            </div>
        </div>
    </nav>

    <div class="apply-container">
        <div class="job-info">
            <h2><i class="bi bi-briefcase-fill me-2"></i>{{ $job->title }}</h2>
            <p><i class="bi bi-building me-1"></i>{{ $job->company }}</p>
            <p><i class="bi bi-geo-alt me-1"></i>{{ $job->location }}</p>
            <p class="mb-0">
                <span class="badge bg-white text-primary">{{ ucfirst(str_replace('-', ' ', $job->job_type ?? $job->type)) }}</span>
            </p>
        </div>

        <form action="{{ route('applications.store', $job->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h5 class="mb-3 fw-bold">Submit Your Application</h5>

            <div class="mb-3">
                <label for="cv" class="form-label">
                    <i class="bi bi-file-earmark-pdf me-1"></i>Upload Your CV (PDF)
                </label>
                <div class="upload-area" onclick="document.getElementById('cv').click()">
                    <i class="bi bi-cloud-arrow-up"></i>
                    <div>
                        <p class="mb-1 fw-bold">Click to upload or drag and drop</p>
                        <p class="text-muted small mb-0">PDF file • Max 5MB</p>
                    </div>
                </div>
                <input type="file" id="cv" name="cv" class="d-none" accept=".pdf" required>
                <div id="fileInfo" class="file-info">
                    <div id="fileName"></div>
                    <div class="text-muted small mt-2">Ready to submit</div>
                </div>
                @error('cv')
                    <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-submit">
                    <i class="bi bi-send me-2"></i>Submit Application
                </button>
            </div>
        </form>

        <div class="alert alert-info mt-4 mb-0">
            <i class="bi bi-info-circle me-2"></i>
            <strong>Note:</strong> Please make sure your CV is clear and professional. Admin will review it shortly.
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const fileInput = document.getElementById('cv');
        const uploadArea = document.querySelector('.upload-area');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');

        // File input change
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                const file = this.files[0];
                fileName.innerHTML = `<i class="bi bi-check-circle text-success me-2"></i><strong>${file.name}</strong> (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                fileInfo.style.display = 'block';
            }
        });

        // Drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.background = 'rgba(102, 126, 234, 0.15)';
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.background = 'rgba(102, 126, 234, 0.05)';
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.style.background = 'rgba(102, 126, 234, 0.05)';
            if (e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });
    </script>
</body>
</html>
