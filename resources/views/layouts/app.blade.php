<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Ngekos')</title>

    <!-- CSS Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Custom CSS -->
    <style>
        :root {
            --primary: #667eea;
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            --text-dark: #2c3e50;
            --text-light: #6c757d;
            --border-radius: 15px;
            --shadow: 0 10px 30px rgba(0,0,0,0.1);
            --shadow-hover: 0 20px 40px rgba(0,0,0,0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: var(--text-dark);
            line-height: 1.6;
            padding-top: 70px;
        }

        /* Navbar Styles */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            -webkit-text-fill-color: transparent;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--text-dark) !important;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--accent-gradient);
            transition: left 0.3s ease;
            z-index: -1;
            border-radius: 25px;
        }

        .navbar-nav .nav-link:hover::before,
        .navbar-nav .nav-link.active::before {
            left: 0;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: white !important;
            transform: translateY(-2px);
        }

        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* Profile Dropdown Styles */
        .navbar .dropdown-toggle::after {
            display: none;
        }

        .navbar .dropdown-menu {
            border: none;
            box-shadow: var(--shadow);
            border-radius: var(--border-radius);
            padding: 0.5rem 0;
            margin-top: 10px;
        }

        .navbar .dropdown-item {
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
            border-radius: 5px;
            margin: 0 0.5rem;
            width: auto;
        }

        .navbar .dropdown-item:hover {
            background: var(--accent-gradient);
            color: white !important;
            transform: translateX(5px);
        }

        .navbar .dropdown-divider {
            margin: 0.5rem 1rem;
            border-color: rgba(0,0,0,0.1);
        }

        .profile-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Main Content */
        main {
            padding: 2rem 0;
            min-height: calc(100vh - 200px);
        }

        /* Footer */
        footer {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255,255,255,0.2);
            padding: 3rem 0 2rem;
            margin-top: 4rem;
            position: relative;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h5 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-dark);
            position: relative;
        }

        .footer-section h5::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent-gradient);
            border-radius: 2px;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section ul li a {
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: var(--text-dark);
            padding-left: 10px;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: white;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(0,0,0,0.1);
            color: var(--text-light);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.5rem;
            }
            
            body {
                padding-top: 60px;
            }
        }

        /* Loading Animation */
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255,255,255,0.3);
            border-top: 5px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-home"></i> Ngekos
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="fas fa-home me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}" href="{{ url('/categories') }}">
                            <i class="fas fa-th-large me-1"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">
                            <i class="fas fa-info-circle me-1"></i> Tentang Kami
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">
                            <i class="fas fa-envelope me-1"></i> Kontak
                        </a>
                    </li>
                    
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                     class="profile-avatar" alt="Profile Avatar">
                            @else
                                <i class="fas fa-user-circle"></i>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user me-2"></i> Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i> Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                    
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Masuk
                        </a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h5><i class="fas fa-home me-2"></i>Ngekos</h5>
                    <p class="text-muted">Platform terpercaya untuk menemukan kos impian Anda di seluruh Indonesia.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h5>Layanan</h5>
                    <ul>
                        <li><a href="#">Cari Kos</a></li>
                        <li><a href="#">Daftar Kos</a></li>
                        <li><a href="#">Bantuan</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h5>Perusahaan</h5>
                    <ul>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h5>Kontak</h5>
                    <ul>
                        <li><i class="fas fa-phone me-2"></i> +62 123 456 789</li>
                        <li><i class="fas fa-envelope me-2"></i> info@ngekos.com</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i> Surabaya, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Ngekos. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- JS Bootstrap Bundle (Popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Loading animation
        function showLoading() {
            document.body.innerHTML = `
                <div style="display: flex; justify-content: center; align-items: center; height: 100vh; background: var(--primary-gradient);">
                    <div class="loading-spinner"></div>
                </div>
            `;
        }

        // Scroll animations
        document.addEventListener('DOMContentLoaded', () => {
            const fadeElements = document.querySelectorAll('.fade-in');
            
            const fadeInObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.1 });

            fadeElements.forEach(element => {
                fadeInObserver.observe(element);
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>