<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ngekos - Temukan Kos Impianmu</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo i {
            color: #FFD700;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 25px;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 4rem 0;
            color: white;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: fadeInUp 1s ease-out;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .search-bar {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1.5rem;
            padding-right: 4rem;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            outline: none;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
        }

        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            transform: translateY(-50%) scale(1.05);
        }

        /* Main Content */
        .main-content {
            background: white;
            margin: 2rem 0;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .content-header {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 2rem;
            text-align: center;
        }

        .content-header h2 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .content-header p {
            color: #666;
            font-size: 1.1rem;
        }

        /* Boarding House Grid */
        .boarding-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            padding: 2rem;
        }

        .boarding-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .boarding-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .card-image {
            height: 200px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            position: relative;
            overflow: hidden;
        }

        .card-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect width="100" height="100" fill="%23667eea"/><path d="M20 20h15v15H20zm25 0h15v15H45zm25 0h15v15H70zM20 45h15v15H20zm25 0h15v15H45zm25 0h15v15H70zM20 70h15v15H20zm25 0h15v15H45zm25 0h15v15H70z" fill="%23764ba2" opacity="0.3"/></svg>') center/cover;
            opacity: 0.3;
        }

        .card-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 215, 0, 0.9);
            color: #333;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .card-content {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-location {
            display: flex;
            align-items: center;
            color: #666;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .card-location i {
            margin-right: 0.5rem;
            color: #667eea;
        }

        .card-features {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .feature-tag {
            background: #e3f2fd;
            color: #1976d2;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .card-price {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
        }

        .price-period {
            font-size: 0.9rem;
            color: #666;
        }

        .view-btn {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .view-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            padding: 2rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.8rem 1.2rem;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .pagination a {
            background: #f5f5f5;
            color: #333;
        }

        .pagination a:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .pagination .current {
            background: #667eea;
            color: white;
        }

        /* Footer */
        .footer {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-top: 2rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-animate {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .nav-links {
                display: none;
            }
            
            .boarding-grid {
                grid-template-columns: 1fr;
                padding: 1rem;
            }
            
            .container {
                padding: 0 10px;
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
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="nav">
                <a href="/" class="logo">
                    <i class="fas fa-home"></i>
                    Ngekos
                </a>
                <ul class="nav-links">
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="#cari">Cari Kos</a></li>
                    <li><a href="#tentang">Tentang</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Temukan Kos Impianmu</h1>
            <p>Ribuan pilihan kos terbaik dengan fasilitas lengkap dan harga terjangkau</p>
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Cari berdasarkan lokasi, nama kos, atau fasilitas...">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <main class="main-content">
            <div class="content-header">
                <h2>Kos Terpopuler</h2>
                <p>Pilihan terbaik dari berbagai kota di Indonesia</p>
            </div>

            <!-- Boarding House Grid -->
            <div class="boarding-grid" id="boardingGrid">
                <!-- Sample boarding house cards - replace with PHP loop -->
                <div class="boarding-card card-animate" onclick="viewDetails('kos-putri-melati')">
                    <div class="card-image">
                        <div class="card-badge">Terpopuler</div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Kos Putri Melati</h3>
                        <div class="card-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Jakarta Selatan
                        </div>
                        <div class="card-features">
                            <span class="feature-tag">WiFi</span>
                            <span class="feature-tag">AC</span>
                            <span class="feature-tag">Laundry</span>
                            <span class="feature-tag">Parkir</span>
                        </div>
                        <div class="card-price">
                            <div>
                                <span class="price">Rp 1.5jt</span>
                                <span class="price-period">/bulan</span>
                            </div>
                            <button class="view-btn">Lihat Detail</button>
                        </div>
                    </div>
                </div>

                <div class="boarding-card card-animate" onclick="viewDetails('kos-putra-indah')">
                    <div class="card-image">
                        <div class="card-badge">Rekomendasi</div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Kos Putra Indah Residence</h3>
                        <div class="card-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Bandung
                        </div>
                        <div class="card-features">
                            <span class="feature-tag">WiFi</span>
                            <span class="feature-tag">Dapur</span>
                            <span class="feature-tag">Security</span>
                        </div>
                        <div class="card-price">
                            <div>
                                <span class="price">Rp 1.2jt</span>
                                <span class="price-period">/bulan</span>
                            </div>
                            <button class="view-btn">Lihat Detail</button>
                        </div>
                    </div>
                </div>

                <div class="boarding-card card-animate" onclick="viewDetails('kos-family-jogja')">
                    <div class="card-image">
                        <div class="card-badge">Promo</div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Kos Family Jogja</h3>
                        <div class="card-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Yogyakarta
                        </div>
                        <div class="card-features">
                            <span class="feature-tag">WiFi</span>
                            <span class="feature-tag">AC</span>
                            <span class="feature-tag">Breakfast</span>
                        </div>
                        <div class="card-price">
                            <div>
                                <span class="price">Rp 800rb</span>
                                <span class="price-period">/bulan</span>
                            </div>
                            <button class="view-btn">Lihat Detail</button>
                        </div>
                    </div>
                </div>

                <div class="boarding-card card-animate" onclick="viewDetails('kos-modern-surabaya')">
                    <div class="card-image">
                        <div class="card-badge">Baru</div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Kos Modern Surabaya</h3>
                        <div class="card-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Surabaya
                        </div>
                        <div class="card-features">
                            <span class="feature-tag">WiFi</span>
                            <span class="feature-tag">Gym</span>
                            <span class="feature-tag">Rooftop</span>
                        </div>
                        <div class="card-price">
                            <div>
                                <span class="price">Rp 2jt</span>
                                <span class="price-period">/bulan</span>
                            </div>
                            <button class="view-btn">Lihat Detail</button>
                        </div>
                    </div>
                </div>

                <div class="boarding-card card-animate" onclick="viewDetails('kos-ekonomis-malang')">
                    <div class="card-image">
                        <div class="card-badge">Hemat</div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Kos Ekonomis Malang</h3>
                        <div class="card-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Malang
                        </div>
                        <div class="card-features">
                            <span class="feature-tag">WiFi</span>
                            <span class="feature-tag">Dapur</span>
                            <span class="feature-tag">Parkir</span>
                        </div>
                        <div class="card-price">
                            <div>
                                <span class="price">Rp 600rb</span>
                                <span class="price-period">/bulan</span>
                            </div>
                            <button class="view-btn">Lihat Detail</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <a href="#" class="prev-btn">
                    <i class="fas fa-chevron-left"></i> Sebelumnya
                </a>
                <span class="current">1</span>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#" class="next-btn">
                    Selanjutnya <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Ngekos. Semua hak dilindungi. Temukan kos terbaik untuk masa depan cerah!</p>
        </div>
    </footer>

    <script>
        // Search functionality
        document.querySelector('.search-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        document.querySelector('.search-btn').addEventListener('click', performSearch);

        function performSearch() {
            const query = document.querySelector('.search-input').value;
            const btn = document.querySelector('.search-btn');
            
            // Show loading
            btn.innerHTML = '<div class="loading"></div>';
            
            // Simulate search (replace with actual search logic)
            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-search"></i>';
                alert(`Mencari: "${query}"`);
            }, 1000);
        }

        // View details function
        function viewDetails(slug) {
            // Add loading effect
            event.target.closest('.boarding-card').style.opacity = '0.7';
            
            // Simulate navigation (replace with actual navigation)
            setTimeout(() => {
                window.location.href = `/boarding-house/${slug}`;
            }, 300);
        }

        // Animate cards on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all cards
        document.querySelectorAll('.boarding-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add hover effects for cards
        document.querySelectorAll('.boarding-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>