<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Ngekos - Temukan Kos Terbaik</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --warning-gradient: linear-gradient(135deg, #fad961 0%, #f76b1c 100%);
            --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            --text-dark: #2c3e50;
            --text-light: #6c757d;
            --text-white: #ffffff;
            --border-radius: 15px;
            --shadow: 0 10px 30px rgba(0,0,0,0.1);
            --shadow-hover: 0 20px 40px rgba(0,0,0,0.15);
            --shadow-inset: inset 0 2px 4px rgba(0,0,0,0.1);
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
            overflow-x: hidden;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%);
            z-index: -1;
            animation: backgroundShift 10s ease-in-out infinite alternate;
        }

        @keyframes backgroundShift {
            0% { transform: scale(1) rotate(0deg); }
            100% { transform: scale(1.1) rotate(5deg); }
        }

        /* Header Styles */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        .logo {
            font-size: 2rem;
            font-weight: 800;
            text-decoration: none;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            transition: all 0.3s ease;
        }

        .logo::before {
            content: '🏠';
            position: absolute;
            left: -2.5rem;
            font-size: 1.5rem;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        .logo:hover {
            transform: scale(1.05);
            -webkit-text-fill-color: transparent;
        }

        .auth-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .login-btn, .register-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-btn {
            color: var(--text-dark);
            background: transparent;
            border: 2px solid transparent;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--accent-gradient);
            transition: left 0.3s ease;
            z-index: -1;
            border-radius: 50px;
        }

        .login-btn:hover::before {
            left: 0;
        }

        .login-btn:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .register-btn {
            background: var(--secondary-gradient);
            color: white;
            box-shadow: var(--shadow);
        }

        .register-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
            color: white;
        }

        /* Main Content */
        main {
            padding-top: 8rem;
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 2rem;
            padding-right: 2rem;
            text-align: center;
        }

        /* Success Message */
        .success-message {
            background: var(--success-gradient);
            color: white;
            padding: 1rem 2rem;
            border-radius: var(--border-radius);
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            animation: slideDown 0.5s ease-out;
            position: relative;
            overflow: hidden;
        }

        .success-message::before {
            content: '✓';
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2rem;
            font-weight: bold;
        }

        .success-message::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shimmer 2s ease-in-out infinite;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        /* Hero Section */
        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            animation: fadeInUp 1s ease-out;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: var(--text-light);
            margin-bottom: 4rem;
            font-weight: 400;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Features Section */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius);
            padding: 3rem 2rem;
            text-align: center;
            transition: all 0.4s ease;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: left 0.6s ease;
        }

        .feature-card:hover::before {
            left: 100%;
        }

        .feature-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: var(--shadow-hover);
        }

        .feature-card:nth-child(1):hover {
            background: linear-gradient(135deg, rgba(103, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        }

        .feature-card:nth-child(2):hover {
            background: linear-gradient(135deg, rgba(240, 147, 251, 0.1) 0%, rgba(245, 87, 108, 0.1) 100%);
        }

        .feature-card:nth-child(3):hover {
            background: linear-gradient(135deg, rgba(79, 172, 254, 0.1) 0%, rgba(0, 242, 254, 0.1) 100%);
        }

        .feature-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            display: block;
            transition: all 0.3s ease;
            position: relative;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.2) rotate(10deg);
            animation: pulse 1s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1.2) rotate(10deg); }
            50% { transform: scale(1.3) rotate(-10deg); }
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .feature-description {
            color: var(--text-light);
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* CTA Button */
        .cta-button {
            display: inline-block;
            background: var(--primary-gradient);
            color: white;
            padding: 1.25rem 3rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.2rem;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 1s ease-out 0.6s both;
            margin-bottom: 4rem;
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            transition: all 0.4s ease;
            transform: translate(-50%, -50%);
        }

        .cta-button:hover::before {
            width: 300px;
            height: 300px;
        }

        .cta-button:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: var(--shadow-hover);
            color: white;
        }

        .cta-button::after {
            content: '→';
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.3s ease;
            opacity: 0;
        }

        .cta-button:hover::after {
            opacity: 1;
            right: 1rem;
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
            margin-left: 6rem;
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
            .nav-container {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .features {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .feature-card {
                padding: 2rem 1.5rem;
            }

            main {
                padding-top: 12rem;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .auth-links {
                flex-direction: row;
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .feature-icon {
                font-size: 3rem;
            }

            .cta-button {
                padding: 1rem 2rem;
                font-size: 1.1rem;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-left: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            pointer-events: none;
            opacity: 0.1;
            font-size: 2rem;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: -2s;
        }

        .floating-element:nth-child(2) {
            top: 60%;
            right: 10%;
            animation-delay: -4s;
        }

        .floating-element:nth-child(3) {
            top: 80%;
            left: 20%;
            animation-delay: -1s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(120deg); }
            66% { transform: translateY(10px) rotate(240deg); }
        }
    </style>
</head>
<body>
    <!-- Floating Background Elements -->
    <div class="floating-element">🏠</div>
    <div class="floating-element">💰</div>
    <div class="floating-element">⭐</div>

    <header>
    <nav class="nav-container">
        <a href="#" class="logo">Ngekos</a>
        <div class="auth-links">
            <a href="{{ route('login') }}" class="login-btn">
                <i class="fas fa-sign-in-alt mr-2 ml-1"></i> Login
            </a>
            <a href="{{ route('register') }}" class="register-btn">
                <i class="fas fa-user-plus mr-2 ml-1"></i> Daftar
            </a>
        </div>
    </nav>
</header>

    <main>
        <!-- Success Message (Demo) -->
        <div class="success-message" style="display: none;" id="successMessage">
            Selamat datang di platform Ngekos! Mulai pencarian kos impian Anda sekarang.
        </div>

        <h1 class="hero-title">Selamat Datang di Ngekos</h1>
        <p class="hero-subtitle">Platform terbaik untuk menemukan kos sesuai kebutuhanmu</p>
        
        <div class="features">
            <div class="feature-card" onclick="animateCard(this)">
                <div class="feature-icon">🏠</div>
                <h3 class="feature-title">Pilihan Beragam</h3>
                <p class="feature-description">Ribuan kos dengan lokasi strategis di seluruh Indonesia</p>
            </div>
            <div class="feature-card" onclick="animateCard(this)">
                <div class="feature-icon">💰</div>
                <h3 class="feature-title">Harga Terjangkau</h3>
                <p class="feature-description">Sesuai dengan budget kamu, mulai dari yang ekonomis hingga premium</p>
            </div>
            <div class="feature-card" onclick="animateCard(this)">
                <div class="feature-icon">⭐</div>
                <h3 class="feature-title">Terverifikasi</h3>
                <p class="feature-description">Kos sudah terverifikasi dan aman dengan rating dari penghuni sebelumnya</p>
            </div>
        </div>

        <a href="#" class="cta-button" onclick="simulateSearch(this)">
            <i class="fas fa-search"></i> Cari Kos Sekarang
        </a>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h5><i class="fas fa-home me-2"></i>Ngekos</h5>
                    <p class="text-muted">Platform terpercaya untuk menemukan kos impian Anda di seluruh Indonesia.</p>
                    <div class="social-links">
                        <a href="#" class="social-link" onclick="showLoading()"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link" onclick="showLoading()"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link" onclick="showLoading()"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link" onclick="showLoading()"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h5>Layanan</h5>
                    <ul>
                        <li><a href="#" onclick="showLoading()">Cari Kos</a></li>
                        <li><a href="#" onclick="showLoading()">Daftar Kos</a></li>
                        <li><a href="#" onclick="showLoading()">Bantuan</a></li>
                        <li><a href="#" onclick="showLoading()">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h5>Perusahaan</h5>
                    <ul>
                        <li><a href="#" onclick="showLoading()">Tentang Kami</a></li>
                        <li><a href="#" onclick="showLoading()">Karir</a></li>
                        <li><a href="#" onclick="showLoading()">Blog</a></li>
                        <li><a href="#" onclick="showLoading()">Kontak</a></li>
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

    <script>
        // Animate success message on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Show success message after 1 second
            setTimeout(() => {
                const successMsg = document.getElementById('successMessage');
                if (successMsg) {
                    successMsg.style.display = 'block';
                    
                    // Hide after 5 seconds
                    setTimeout(() => {
                        successMsg.style.animation = 'slideDown 0.5s ease-out reverse';
                        setTimeout(() => {
                            successMsg.style.display = 'none';
                        }, 500);
                    }, 5000);
                }
            }, 1000);

            // Add scroll effect to header
            window.addEventListener('scroll', function() {
                const header = document.querySelector('header');
                if (window.scrollY > 50) {
                    header.style.background = 'rgba(255, 255, 255, 0.98)';
                    header.style.boxShadow = '0 10px 30px rgba(0,0,0,0.15)';
                } else {
                    header.style.background = 'rgba(255, 255, 255, 0.95)';
                    header.style.boxShadow = '0 10px 30px rgba(0,0,0,0.1)';
                }
            });

            console.log('🏠 Ngekos Welcome Page Ready!');
        });

        // Simulate navigation with loading
        function simulateNavigation(type) {
            const button = event.target.closest('a');
            const originalText = button.innerHTML;
            
            button.innerHTML = originalText + '<span class="loading"></span>';
            button.style.pointerEvents = 'none';
            
            setTimeout(() => {
                button.innerHTML = originalText;
                button.style.pointerEvents = 'auto';
                
                // Show success message
                const successMsg = document.getElementById('successMessage');
                successMsg.innerHTML = `${type === 'login' ? 'Login' : 'Registrasi'} berhasil! Selamat datang di Ngekos.`;
                successMsg.style.display = 'block';
                
                setTimeout(() => {
                    successMsg.style.animation = 'slideDown 0.5s ease-out reverse';
                    setTimeout(() => {
                        successMsg.style.display = 'none';
                        successMsg.style.animation = 'slideDown 0.5s ease-out';
                    }, 500);
                }, 3000);
            }, 1500);
        }

        // Simulate search with loading
        function simulateSearch(button) {
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari...';
            button.style.pointerEvents = 'none';
            
            setTimeout(() => {
                button.innerHTML = originalText;
                button.style.pointerEvents = 'auto';
                
                // Show search results message
                const successMsg = document.getElementById('successMessage');
                successMsg.innerHTML = '🎉 Pencarian dimulai! Menampilkan 500+ kos tersedia di area Anda.';
                successMsg.style.display = 'block';
                
                setTimeout(() => {
                    successMsg.style.animation = 'slideDown 0.5s ease-out reverse';
                    setTimeout(() => {
                        successMsg.style.display = 'none';
                        successMsg.style.animation = 'slideDown 0.5s ease-out';
                    }, 500);
                }, 4000);
            }, 2000);
        }

        // Animate feature card on click
        function animateCard(card) {
            card.style.animation = 'none';
            setTimeout(() => {
                card.style.animation = 'pulse 0.6s ease-in-out';
            }, 10);
            
            // Add temporary glow effect
            card.style.boxShadow = '0 0 30px rgba(103, 126, 234, 0.3)';
            setTimeout(() => {
                card.style.boxShadow = 'var(--shadow)';
            }, 600);
        }

        // Dynamic greeting based on time
        function updateGreeting() {
            const hour = new Date().getHours();
            const heroTitle = document.querySelector('.hero-title');
            
            if (hour < 12) {
                heroTitle.textContent = 'Selamat Pagi di Ngekos';
            } else if (hour < 17) {
                heroTitle.textContent = 'Selamat Siang di Ngekos';
            } else {
                heroTitle.textContent = 'Selamat Malam di Ngekos';
            }
        }

        // Update greeting on load
        updateGreeting();

        // Add subtle parallax effect
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.floating-element');
            
            parallaxElements.forEach((element, index) => {
                const speed = (index + 1) * 0.1;
                element.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.1}deg)`;
            });
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.login-btn, .register-btn, .cta-button').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = button.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(255,255,255,0.4);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    pointer-events: none;
                `;
                
                button.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>