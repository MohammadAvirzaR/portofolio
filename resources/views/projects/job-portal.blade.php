<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal - Project Showcase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --dark: #1a1a2e;
            --light: #f8f9fa;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--dark);
        }

        .project-hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 5rem 0 3rem;
            position: relative;
            overflow: hidden;
        }

        .project-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="40" stroke="rgba(255,255,255,0.1)" stroke-width="2" fill="none"/></svg>');
            opacity: 0.1;
        }

        .project-hero .container {
            position: relative;
            z-index: 1;
        }

        .back-link {
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            transition: all 0.3s;
        }

        .back-link:hover {
            color: rgba(255,255,255,0.8);
            transform: translateX(-5px);
        }

        .project-badge {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .feature-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: all 0.3s;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .tech-badge {
            background: var(--light);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            display: inline-block;
            margin: 0.25rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--dark);
        }

        .cta-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 4rem 0;
            color: white;
            margin-top: 4rem;
        }

        .btn-custom {
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-custom-white {
            background: white;
            color: var(--primary);
        }

        .btn-custom-white:hover {
            background: rgba(255,255,255,0.9);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .btn-custom-outline {
            background: transparent;
            border: 2px solid white;
            color: white;
        }

        .btn-custom-outline:hover {
            background: white;
            color: var(--primary);
        }

        .screenshot-placeholder {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 12px;
            padding: 3rem;
            text-align: center;
            color: #6c757d;
            border: 2px dashed #dee2e6;
        }

        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stats-label {
            color: #6c757d;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="project-hero">
        <div class="container">
            <a href="/" class="back-link">
                <i class="bi bi-arrow-left"></i>
                <span>Back to Portfolio</span>
            </a>

            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="project-badge">
                        <i class="bi bi-code-square me-2"></i>
                        Web Application Project
                    </div>
                    <h1 class="display-4 fw-bold mb-3">Job Portal System</h1>
                    <p class="lead mb-4">
                        Sistem portal lowongan pekerjaan lengkap dengan fitur CRUD, autentikasi, upload file,
                        dan role-based access control. Dibangun menggunakan Laravel Framework.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('jobs.index') }}" class="btn-custom btn-custom-white">
                            <i class="bi bi-eye"></i>
                            View Live Demo
                        </a>
                        <a href="{{ route('login') }}" class="btn-custom btn-custom-outline">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Admin Login
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="stats-grid">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="stats-card">
                                    <div class="stats-number">{{ \App\Models\Job::count() }}</div>
                                    <div class="stats-label">Total Jobs</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-card">
                                    <div class="stats-number">{{ \App\Models\Job::where('status', 'active')->count() }}</div>
                                    <div class="stats-label">Active Jobs</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-card">
                                    <div class="stats-number">{{ \App\Models\User::count() }}</div>
                                    <div class="stats-label">Registered Users</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-card">
                                    <div class="stats-number">5+</div>
                                    <div class="stats-label">Features</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Overview -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-3">Project Overview</h2>
                    <p class="text-muted">
                        Job Portal adalah aplikasi web yang memungkinkan perusahaan memposting lowongan pekerjaan
                        dan pencari kerja untuk melihat dan melamar pekerjaan. Sistem ini dilengkapi dengan
                        panel admin untuk mengelola semua data lowongan.
                    </p>
                </div>
            </div>

            <!-- Features -->
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Authentication System</h4>
                        <p class="text-muted mb-0">
                            Sistem login dan registrasi lengkap dengan middleware untuk keamanan.
                            Role-based access untuk admin dan user biasa.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Full CRUD Operations</h4>
                        <p class="text-muted mb-0">
                            Create, Read, Update, Delete untuk data lowongan pekerjaan.
                            Admin dapat mengelola semua data dengan mudah.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-cloud-upload"></i>
                        </div>
                        <h4 class="fw-bold mb-3">File Upload</h4>
                        <p class="text-muted mb-0">
                            Upload logo perusahaan dengan validasi file.
                            Mendukung JPG, PNG, GIF dengan maksimal 2MB.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <h4 class="fw-bold mb-3">User Profile</h4>
                        <p class="text-muted mb-0">
                            Halaman profil user untuk mengatur informasi akun,
                            ganti password, dan mengelola data pribadi.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-grid"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Admin Dashboard</h4>
                        <p class="text-muted mb-0">
                            Dashboard admin dengan statistik lengkap untuk
                            monitoring aktivitas dan data sistem.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Public Job Listing</h4>
                        <p class="text-muted mb-0">
                            Halaman publik untuk menampilkan semua lowongan aktif
                            dengan tampilan yang menarik dan responsif.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Technology Stack -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Technology Stack</h3>
                        <p class="text-muted">Tools dan teknologi yang digunakan dalam project ini</p>
                    </div>
                    <div class="text-center">
                        <span class="tech-badge"><i class="bi bi-code-slash me-2"></i>Laravel 12</span>
                        <span class="tech-badge"><i class="bi bi-database me-2"></i>MySQL</span>
                        <span class="tech-badge"><i class="bi bi-bootstrap me-2"></i>Bootstrap 5</span>
                        <span class="tech-badge"><i class="bi bi-file-code me-2"></i>Blade Template</span>
                        <span class="tech-badge"><i class="bi bi-diagram-3 me-2"></i>MVC Pattern</span>
                        <span class="tech-badge"><i class="bi bi-shield-check me-2"></i>Middleware</span>
                        <span class="tech-badge"><i class="bi bi-gear me-2"></i>Eloquent ORM</span>
                        <span class="tech-badge"><i class="bi bi-key me-2"></i>Authentication</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Screenshots -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="fw-bold">Project Screenshots</h3>
                <p class="text-muted">Preview tampilan aplikasi Job Portal</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="screenshot-placeholder">
                        <i class="bi bi-image" style="font-size: 3rem;"></i>
                        <p class="mb-0 mt-3">Public Job Listing Page</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="screenshot-placeholder">
                        <i class="bi bi-image" style="font-size: 3rem;"></i>
                        <p class="mb-0 mt-3">Admin Dashboard</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="screenshot-placeholder">
                        <i class="bi bi-image" style="font-size: 3rem;"></i>
                        <p class="mb-0 mt-3">Job Management Panel</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="screenshot-placeholder">
                        <i class="bi bi-image" style="font-size: 3rem;"></i>
                        <p class="mb-0 mt-3">User Profile Page</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">Ready to Explore?</h2>
            <p class="lead mb-4">
                Lihat demo langsung atau login sebagai admin untuk mengakses semua fitur
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('jobs.index') }}" class="btn-custom btn-custom-white">
                    <i class="bi bi-box-arrow-up-right"></i>
                    View Live Demo
                </a>
                <a href="{{ route('login') }}" class="btn-custom btn-custom-outline">
                    <i class="bi bi-key"></i>
                    Login as Admin
                </a>
            </div>
            <div class="mt-4">
                <small class="opacity-75">
                    Demo Login: admin@portfolio.com / admin123
                </small>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white text-center">
        <div class="container">
            <p class="mb-0">&copy; 2025 Mohammad Avirza. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
