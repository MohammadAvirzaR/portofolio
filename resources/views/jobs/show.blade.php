<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->title }} - Detail Lowongan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
        }
        .hero-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 3rem 0;
        }
        .detail-card {
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            border: none;
        }
        .info-badge {
            background: #f8f9ff;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
        }
        .btn-apply-now {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
        }
        .btn-apply-now:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-briefcase-fill me-2"></i>Job Portal
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('jobs.index') }}">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Lowongan
                </a>
            </div>
        </div>
    </nav>

    <div class="hero-gradient">
        <div class="container">
            <h1 class="display-5 fw-bold">{{ $job->title }}</h1>
            <p class="lead mb-0">
                <i class="bi bi-building me-2"></i>{{ $job->company_name }}
                <span class="mx-3">|</span>
                <i class="bi bi-geo-alt me-2"></i>{{ $job->location }}
            </p>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <!-- Job Description -->
            <div class="col-lg-8">
                <div class="card detail-card mb-4">
                    <div class="card-body p-4">
                        <h4 class="mb-4">
                            <i class="bi bi-file-text me-2"></i>Deskripsi Pekerjaan
                        </h4>
                        <div class="job-description">
                            {!! nl2br(e($job->description)) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Info Sidebar -->
            <div class="col-lg-4">
                <div class="card detail-card sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Informasi Lowongan</h5>

                        <div class="info-badge">
                            <small class="text-muted d-block mb-1">Tipe Pekerjaan</small>
                            <strong>
                                <i class="bi bi-briefcase me-1"></i>
                                {{ ucfirst(str_replace('-', ' ', $job->job_type)) }}
                            </strong>
                        </div>

                        <div class="info-badge">
                            <small class="text-muted d-block mb-1">Lokasi</small>
                            <strong>
                                <i class="bi bi-geo-alt me-1"></i>
                                {{ $job->location }}
                            </strong>
                        </div>

                        @if($job->salary_range)
                        <div class="info-badge">
                            <small class="text-muted d-block mb-1">Gaji</small>
                            <strong class="text-success">
                                <i class="bi bi-cash-stack me-1"></i>
                                {{ $job->salary_range }}
                            </strong>
                        </div>
                        @endif

                        <div class="info-badge">
                            <small class="text-muted d-block mb-1">Diposting</small>
                            <strong>
                                <i class="bi bi-clock me-1"></i>
                                {{ $job->created_at->diffForHumans() }}
                            </strong>
                        </div>

                        @if($job->deadline)
                        <div class="info-badge">
                            <small class="text-muted d-block mb-1">Batas Waktu</small>
                            <strong class="text-danger">
                                <i class="bi bi-calendar-x me-1"></i>
                                {{ $job->deadline->format('d M Y') }}
                            </strong>
                        </div>
                        @endif

                        <hr class="my-4">

                        @auth
                            @if($hasApplied)
                                <div class="alert alert-info">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Anda sudah melamar untuk posisi ini
                                </div>
                                <a href="{{ route('applications.index') }}" class="btn btn-outline-primary w-100">
                                    <i class="bi bi-list me-2"></i>Lihat Aplikasi Saya
                                </a>
                            @else
                                <a href="{{ route('applications.create', $job->id) }}" class="btn btn-apply-now w-100">
                                    <i class="bi bi-send me-2"></i>Lamar Sekarang
                                </a>
                                <small class="text-muted d-block text-center mt-2">
                                    Siapkan CV Anda dalam format PDF
                                </small>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-apply-now w-100">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login untuk Melamar
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
