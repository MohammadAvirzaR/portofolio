<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Jobs - Admin Panel</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .import-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
        }
        .drop-zone {
            border: 2px dashed var(--primary);
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #f8f9ff;
        }
        .drop-zone.active {
            background-color: var(--primary);
            color: white;
            border-color: white;
        }
        .drop-zone:hover {
            border-color: var(--secondary);
        }
    </style>
</head>
<body>
    <div class="import-card">
        <div class="card-body p-5">
            <h3 class="mb-2"><i class="bi bi-cloud-upload me-2"></i>Import Jobs</h3>
            <p class="text-muted mb-4">Upload an Excel file to import multiple jobs at once</p>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <form action="{{ route('admin.jobs.import') }}" method="POST" enctype="multipart/form-data" id="importForm">
                @csrf

                <div class="drop-zone" id="dropZone">
                    <i class="bi bi-cloud-upload fs-1"></i>
                    <p class="mt-3 mb-0">
                        <strong>Click to upload</strong> or drag and drop
                    </p>
                    <small class="text-muted d-block mt-1">XLSX or CSV files only</small>
                </div>

                <input type="file" id="fileInput" name="file" class="d-none" accept=".xlsx,.xls,.csv">

                <div id="filePreview" class="mt-3 d-none">
                    <div class="alert alert-light">
                        <strong id="fileName"></strong>
                        <span id="fileSize" class="text-muted"></span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3" id="submitBtn" disabled>
                    <i class="bi bi-cloud-upload me-2"></i>Import Jobs
                </button>
                <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                    <i class="bi bi-arrow-left me-2"></i>Back
                </a>
            </form>

            <hr class="my-4">

            <h6 class="mb-3">Template Format</h6>
            <p class="text-muted small">Your Excel file should have these columns:</p>
            <ul class="text-muted small">
                <li><strong>title</strong> - Job title</li>
                <li><strong>description</strong> - Job description</li>
                <li><strong>company_name</strong> - Company name</li>
                <li><strong>location</strong> - Job location</li>
                <li><strong>salary_range</strong> - Salary range (optional)</li>
                <li><strong>job_type</strong> - Full-time, Part-time, Contract</li>
                <li><strong>status</strong> - active or inactive</li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const submitBtn = document.getElementById('submitBtn');

        // Click to upload
        dropZone.addEventListener('click', () => fileInput.click());

        // Drag and drop
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('active');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('active');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('active');
            fileInput.files = e.dataTransfer.files;
            updateFilePreview();
        });

        // File input change
        fileInput.addEventListener('change', updateFilePreview);

        function updateFilePreview() {
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                fileName.textContent = file.name;
                fileSize.textContent = `(${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                filePreview.classList.remove('d-none');
                submitBtn.disabled = false;
                dropZone.innerHTML = `<i class="bi bi-check-circle text-success fs-1"></i><p class="mt-2 mb-0"><strong>File ready</strong></p>`;
            }
        }
    </script>
</body>
</html>
