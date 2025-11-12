<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio - Creative Developer</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom Portfolio CSS -->
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
</head>
<body>
    <!-- Elegant Navbar -->
    <nav class="elegant-nav">
        <div class="container">
            <div class="nav-content">
                <a href="#home" class="logo">
                    <span class="logo-initial">M</span>
                    <span class="logo-text">Mohammad Avirza</span>
                </a>
                <button class="nav-toggle" id="navToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="nav-menu" id="navMenu">
                    <a href="#home" class="nav-link active">Home</a>
                    <a href="#about" class="nav-link">About</a>
                    <a href="#work" class="nav-link">Work</a>
                    <a href="#contact" class="nav-link">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-elegant">
        <div class="container">
            <div class="hero-content">
                <div class="hero-label">Ini portofolio</div>
                <h1 class="hero-headline">
                    Cuman portofolio<br>
                    <span class="hero-highlight">Coba coba</span>
                </h1>
                <p class="hero-text">
                    Job portal ada di bagian work
                </p>
                <div class="hero-cta">
                    <a href="#work" class="btn-elegant-primary">
                        <span>Explore My Work</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="#contact" class="btn-elegant-secondary">Get In Touch</a>
                </div>
            </div>
            <div class="hero-decoration">
                <div class="circle-1"></div>
                <div class="circle-2"></div>
                <div class="circle-3"></div>
            </div>
        </div>
        <div class="scroll-indicator">
            <span>Scroll</span>
            <div class="scroll-line"></div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-elegant">
        <div class="container">
            <div class="section-header">
                <span class="section-number">01</span>
                <h2 class="section-heading">About Me</h2>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-image-wrapper">
                        <div class="about-image-frame">
                            <img src="/images/IMG_0923.JPG"
                                 alt="Mohammad Avirza"
                                 class="about-profile-image">
                        </div>
                        <div class="about-badge">
                            <i class="bi bi-star-fill"></i>
                            <span>1,5 Years</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <h3 class="about-title">Mohammad Avirza Radyatanza itu nama saya</h3>
                        <p class="about-description text-justify">
                            Saya adalah mahasiswa D4 Teknologi Rekayasa Perangkat Lunak di Sekolah Vokasi Universitas Gadjah Mada yang memiliki minat tinggi terhadap pendidikan, teknologi, dan perkembangan masyarakat. Sejak jenjang pendidikan menengah atas, saya aktif dalam organisasi kelas maupun luar kelas yang membentuk saya menjadi pribadi yang disiplin, bertanggung jawab, serta mampu bekerja sama dalam tim. Ketertarikan saya dalam dunia organisasi dan teknologi memacu semangat saya untuk terus belajar, berkembang, dan membangun relasi yang luas. Saya percaya bahwa melalui penguasaan teknologi dan jejaring sosial yang kuat, saya dapat berkontribusi positif dalam menciptakan inovasi, khususnya di bidang industri game dan IT di Indonesia.
                        </p>
                        <div class="expertise-grid">
                            <div class="expertise-item">
                                <div class="expertise-icon"><i class="bi bi-brush"></i></div>
                                <h4>UI/UX Design</h4>
                                <p>Creating intuitive interfaces</p>
                            </div>
                            <div class="expertise-item">
                                <div class="expertise-icon"><i class="bi bi-code-square"></i></div>
                                <h4>Development</h4>
                                <p>Clean, scalable code</p>
                            </div>
                            <div class="expertise-item">
                                <div class="expertise-icon"><i class="bi bi-lightbulb"></i></div>
                                <h4>Strategy</h4>
                                <p>Leadership organisation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Work Section -->
    <section id="work" class="work-elegant">
        <div class="container">
            <div class="section-header">
                <span class="section-number">02</span>
                <h2 class="section-heading">Selected Work</h2>
            </div>
            <div class="work-grid">
                <div class="work-item" data-category="web">
                    <div class="work-image">
                        <div class="work-placeholder">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>
                        <div class="work-overlay">
                            <a href="{{ route('project.job-portal') }}" class="work-link">
                                <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="work-info">
                        <span class="work-category">Web Application - PPW2</span>
                        <h3 class="work-title">Job Portal System</h3>
                        <p class="work-desc">Full-stack job portal dengan CRUD, authentication, file upload, dan role-based access</p>
                    </div>
                </div>
                <div class="work-item" data-category="app">
                    <div class="work-image">
                        <div class="work-placeholder">
                            <i class="bi bi-phone"></i>
                        </div>
                        <div class="work-overlay">
                            <a href="#" class="work-link" onclick="alert('Project coming soon!'); return false;">
                                <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="work-info">
                        <span class="work-category">Mobile App - Coming Soon</span>
                        <h3 class="work-title">Productivity Suite</h3>
                        <p class="work-desc">Streamlined task management with elegant UX</p>
                    </div>
                </div>
                <div class="work-item" data-category="branding">
                    <div class="work-image">
                        <div class="work-placeholder">
                            <i class="bi bi-star"></i>
                        </div>
                        <div class="work-overlay">
                            <a href="#" class="work-link" onclick="alert('Project coming soon!'); return false;">
                                <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="work-info">
                        <span class="work-category">Branding - Coming Soon</span>
                        <h3 class="work-title">Creative Studio Identity</h3>
                        <p class="work-desc">Complete brand identity and digital presence</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-elegant">
        <div class="container">
            <div class="section-header">
                <span class="section-number">03</span>
                <h2 class="section-heading">Let's Connect</h2>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <h3 class="contact-headline">Have a project in mind?</h3>
                    <p class="contact-subtext">
                        I'm always interested in hearing about new projects and opportunities.
                        Let's create something amazing together.
                    </p>
                    <div class="contact-info-list">
                        <div class="contact-info-item">
                            <i class="bi bi-envelope"></i>
                            <div>
                                <span class="info-label">Email</span>
                                <a href="mailto:hello@example.com">avirzaradyatanza@gmail.com</a>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <i class="bi bi-telephone"></i>
                            <div>
                                <span class="info-label">Phone</span>
                                <a href="tel:+1234567890">+6281215733320</a>
                            </div>
                        </div>
                    </div>
                    <div class="social-links">
                        <a href="https://www.linkedin.com/in/radyatanza" class="social-link"><i class="bi bi-linkedin"></i></a>
                        <a href="https://github.com/MohammadAvirzaR" class="social-link"><i class="bi bi-github"></i></a>
                        <a href="https://www.instagram.com/radyatanzaa" class="social-link"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form class="contact-form-elegant">
                        <div class="form-group-elegant">
                            <label>Your Name</label>
                            <input type="text" placeholder="Your full name">
                        </div>
                        <div class="form-group-elegant">
                            <label>Email Address</label>
                            <input type="email" placeholder="john@gmail.com">
                        </div>
                        <div class="form-group-elegant">
                            <label>Message</label>
                            <textarea rows="5" placeholder="Tell me about your project..."></textarea>
                        </div>
                        <button type="submit" class="btn-elegant-submit">
                            <span>Send Message</span>
                            <i class="bi bi-send"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-elegant">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <span class="logo-initial">M</span>
                    <span class="logo-text">Mohammad Avirza</span>
                </div>
                <p class="footer-text">&copy; 2024 All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile Navigation Toggle
        const navToggle = document.getElementById('navToggle');
        const navMenu = document.getElementById('navMenu');

        navToggle.addEventListener('click', () => {
            navToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    navMenu.classList.remove('active');
                    navToggle.classList.remove('active');
                }
            });
        });

        // Active Nav Link on Scroll
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
