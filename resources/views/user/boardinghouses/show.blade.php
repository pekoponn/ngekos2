@extends('layouts.app')

@section('title', $boardingHouse->name)

<style>
    /* Reset and Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #333;
        background: #f8f9fa;
    }

    /* Professional Color Palette */
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #34495e;
        --accent-color: #3498db;
        --success-color: #27ae60;
        --warning-color: #f39c12;
        --danger-color: #e74c3c;
        --light-bg: #ffffff;
        --section-bg: #f8f9fa;
        --border-color: #e1e8ed;
        --text-primary: #2c3e50;
        --text-secondary: #7f8c8d;
        --shadow-light: 0 2px 10px rgba(0,0,0,0.08);
        --shadow-medium: 0 4px 20px rgba(0,0,0,0.12);
        --shadow-heavy: 0 8px 30px rgba(0,0,0,0.15);
    }

    /* Layout Styles */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .main-content {
        padding: 20px 0;
    }

    /* Breadcrumb Styles */
    .breadcrumb {
        background: var(--primary-color);
        color: white;
        padding: 15px 0;
        margin-bottom: 30px;
    }

    .breadcrumb-nav {
        display: flex;
        align-items: center;
        font-size: 14px;
    }

    .breadcrumb a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb a:hover {
        color: white;
    }

    .breadcrumb-separator {
        color: rgba(255,255,255,0.6);
        margin: 0 8px;
    }

    /* Card Styles */
    .card {
        background: var(--light-bg);
        border-radius: 12px;
        box-shadow: var(--shadow-light);
        margin-bottom: 30px;
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
    }

    .card:hover {
        box-shadow: var(--shadow-medium);
        transform: translateY(-2px);
    }

    .card-hero {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        margin-bottom: 30px;
    }

    .hero-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.6) 100%);
    }

    .price-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--success-color);
        color: white;
        padding: 12px 20px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 16px;
        box-shadow: var(--shadow-medium);
    }

    .hero-content {
        position: absolute;
        bottom: 30px;
        left: 30px;
        color: white;
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .hero-meta {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .meta-badge {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
    }

    /* Content Sections */
    .card-body {
        padding: 30px;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 3px solid var(--accent-color);
        display: inline-block;
    }

    .section-title i {
        margin-right: 10px;
        color: var(--accent-color);
    }

    .address-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 25px;
        border-radius: 10px;
        border-left: 4px solid var(--accent-color);
        margin-bottom: 30px;
    }

    .address-text {
        font-size: 16px;
        color: var(--text-primary);
        line-height: 1.6;
    }

    .description-content {
        font-size: 16px;
        line-height: 1.8;
        color: var(--text-primary);
    }

    /* Grid Layouts */
    .grid-2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
    }

    .grid-3 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
    }

    .grid-4 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    /* Facility Cards */
    .facility-card {
        background: var(--light-bg);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 25px;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-light);
    }

    .facility-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-medium);
        border-color: var(--accent-color);
    }

    .facility-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
        box-shadow: var(--shadow-light);
    }

    .facility-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 10px;
    }

    .facility-description {
        color: var(--text-secondary);
        line-height: 1.5;
    }

    /* Room Cards */
    .room-card {
        background: var(--light-bg);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-light);
    }

    .room-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-medium);
    }

    .room-images {
        padding: 15px;
        background: var(--section-bg);
    }

    .image-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
        gap: 8px;
        max-height: 100px;
        overflow-y: auto;
    }

    .gallery-image {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .gallery-image:hover {
        border-color: var(--accent-color);
        transform: scale(1.05);
    }

    .room-content {
        padding: 25px;
    }

    .room-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .room-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .availability-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .available {
        background: var(--success-color);
        color: white;
    }

    .unavailable {
        background: var(--danger-color);
        color: white;
    }

    .room-details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .detail-item {
        background: var(--section-bg);
        padding: 15px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }

    .detail-label {
        font-size: 12px;
        color: var(--text-secondary);
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .detail-value {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-primary);
    }

    .price-highlight {
        color: var(--accent-color);
        font-size: 18px;
    }

    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
        box-shadow: var(--shadow-light);
    }

    .btn-primary {
        background: var(--accent-color);
        color: white;
    }

    .btn-primary:hover {
        background: #2980b9;
        transform: translateY(-1px);
        box-shadow: var(--shadow-medium);
    }

    .btn-secondary {
        background: var(--text-secondary);
        color: white;
    }

    .btn-secondary:hover {
        background: #6c7b7d;
        transform: translateY(-1px);
        box-shadow: var(--shadow-medium);
    }

    .btn-disabled {
        background: #95a5a6;
        color: white;
        cursor: not-allowed;
    }

    .btn-block {
        width: 100%;
    }

    .btn i {
        margin-right: 8px;
    }

    /* Testimonials */
    .testimonial-card {
        background: var(--light-bg);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 25px;
        position: relative;
        box-shadow: var(--shadow-light);
        transition: all 0.3s ease;
    }

    .testimonial-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
    }

    .rating-stars {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .stars {
        color: var(--warning-color);
        margin-right: 10px;
    }

    .rating-text {
        font-size: 12px;
        color: var(--text-secondary);
        font-weight: 600;
    }

    .testimonial-content {
        font-style: italic;
        font-size: 16px;
        line-height: 1.6;
        color: var(--text-primary);
        margin-bottom: 15px;
        position: relative;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        font-weight: 600;
        color: var(--text-primary);
    }

    .testimonial-author i {
        margin-right: 10px;
        color: var(--text-secondary);
    }

    /* Stats Cards */
    .stats-card {
        background: var(--primary-color);
        color: white;
        padding: 25px;
        border-radius: 10px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-light);
    }

    .stats-card:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-medium);
    }

    .stats-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        opacity: 0.8;
    }

    .stats-label {
        font-size: 14px;
        opacity: 0.9;
        margin-bottom: 10px;
    }

    .stats-value {
        font-size: 2rem;
        font-weight: 700;
    }

    /* Floating Action Button */
    .floating-action {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: var(--accent-color);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 15px 25px;
        font-weight: 600;
        box-shadow: var(--shadow-heavy);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .floating-action:hover {
        background: #2980b9;
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(52, 152, 219, 0.4);
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 2000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.8);
        backdrop-filter: blur(5px);
    }

    .modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 90%;
        max-height: 90%;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-heavy);
    }

    .modal-content img {
        width: 100%;
        height: auto;
        display: block;
    }

    .close-modal {
        position: absolute;
        top: 15px;
        right: 20px;
        color: white;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        background: rgba(0,0,0,0.5);
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .close-modal:hover {
        background: rgba(0,0,0,0.8);
        transform: scale(1.1);
    }

    /* Back Button */
    .back-section {
        text-align: center;
        margin-top: 40px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 0 15px;
        }

        .hero-title {
            font-size: 2rem;
        }

        .hero-content {
            bottom: 20px;
            left: 20px;
        }

        .price-badge {
            top: 15px;
            right: 15px;
            padding: 10px 16px;
            font-size: 14px;
        }

        .card-body {
            padding: 20px;
        }

        .room-details {
            grid-template-columns: 1fr;
        }

        .hero-meta {
            flex-direction: column;
            gap: 10px;
        }
    }

    /* Animation Classes */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <nav class="breadcrumb-nav">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <span class="breadcrumb-separator">/</span>
                <span>{{ $boardingHouse->name }}</span>
            </nav>
        </div>
    </div>

    <div class="container main-content">
        <!-- Hero Section -->
        <div class="card card-hero fade-in">
            @if($boardingHouse->thumbnail)
                <div class="hero-image-container">
                    <img src="{{ asset('storage/' . $boardingHouse->thumbnail) }}"
                         alt="{{ $boardingHouse->name }}"
                         class="hero-image">
                    <div class="hero-overlay"></div>
                    <div class="price-badge">
                        <i class="fas fa-tag"></i>
                        IDR {{ number_format($boardingHouse->price, 0, ',', '.') }}/bulan
                    </div>
                    <div class="hero-content">
                        <h1 class="hero-title">{{ $boardingHouse->name }}</h1>
                        <div class="hero-meta">
                            <span class="meta-badge">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $boardingHouse->city->name ?? '-' }}
                            </span>
                            <span class="meta-badge">
                                <i class="fas fa-tag"></i>
                                {{ $boardingHouse->category->name ?? '-' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card-body">
                <!-- Address Section -->
                <div class="address-section">
                    <h3 class="section-title">
                        <i class="fas fa-home"></i>
                        Alamat Lengkap
                    </h3>
                    <p class="address-text">{{ $boardingHouse->address }}</p>
                </div>

                <!-- Description Section -->
                <div>
                    <h3 class="section-title">
                        <i class="fas fa-info-circle"></i>
                        Deskripsi
                    </h3>
                    <div class="description-content">
                        {!! $boardingHouse->description !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Facilities Section -->
        @if($boardingHouse->bonuses && $boardingHouse->bonuses->count() > 0)
        <div class="card fade-in">
            <div class="card-body">
                <h2 class="section-title">
                    <i class="fas fa-gift"></i>
                    Bonus & Fasilitas
                </h2>
                <div class="grid-3">
                    @foreach($boardingHouse->bonuses as $bonus)
                        <div class="facility-card">
                            @if($bonus->image)
                                <img src="{{ asset('storage/' . $bonus->image) }}" 
                                     alt="{{ $bonus->name }}"
                                     class="facility-image">
                            @endif
                            <h4 class="facility-title">{{ $bonus->name }}</h4>
                            <p class="facility-description">{{ $bonus->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Rooms Section -->
        @if($boardingHouse->rooms && $boardingHouse->rooms->count() > 0)
        <div class="card fade-in">
            <div class="card-body">
                <h2 class="section-title">
                    <i class="fas fa-bed"></i>
                    Tipe Kamar Tersedia
                </h2>
                <div class="grid-2">
                    @foreach($boardingHouse->rooms as $room)
                        <div class="room-card">
                            <!-- Room Images -->
                            @if($room->images && $room->images->count() > 0)
                                <div class="room-images">
                                    <div class="image-gallery">
                                        @foreach($room->images as $image)
                                            <img src="{{ asset('storage/' . $image->image) }}" 
                                                 alt="{{ $room->name }}"
                                                 class="gallery-image"
                                                 onclick="openModal('{{ asset('storage/' . $image->image) }}')">
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="room-content">
                                <div class="room-header">
                                    <h3 class="room-title">{{ $room->name }}</h3>
                                    <span class="availability-badge {{ $room->is_available ? 'available' : 'unavailable' }}">
                                        {{ $room->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                                    </span>
                                </div>

                                <div class="room-details">
                                    <div class="detail-item">
                                        <div class="detail-label">Tipe Kamar</div>
                                        <div class="detail-value">{{ $room->room_type }}</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Luas Kamar</div>
                                        <div class="detail-value">{{ $room->square_feet }} m²</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Kapasitas</div>
                                        <div class="detail-value">{{ $room->capacity }} orang</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Harga/Bulan</div>
                                        <div class="detail-value price-highlight">IDR {{ number_format($room->price_per_month, 0, ',', '.') }}</div>
                                    </div>
                                </div>

                                @if($room->is_available)
                                    <button class="btn btn-primary btn-block">
                                        <i class="fas fa-phone"></i>
                                        Hubungi untuk Kamar Ini
                                    </button>
                                @else
                                    <button class="btn btn-disabled btn-block" disabled>
                                        <i class="fas fa-times"></i>
                                        Kamar Tidak Tersedia
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Testimonials Section -->
        @if($boardingHouse->testimonials && $boardingHouse->testimonials->count() > 0)
        <div class="card fade-in">
            <div class="card-body">
                <h2 class="section-title">
                    <i class="fas fa-comments"></i>
                    Testimoni Penghuni
                </h2>
                <div class="grid-2">
                    @foreach($boardingHouse->testimonials as $testi)
                        <div class="testimonial-card">
                            <div class="rating-stars">
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <span class="rating-text">Rating Excellent</span>
                            </div>
                            <div class="testimonial-content">
                                <i class="fas fa-quote-left"></i>
                                {{ $testi->content }}
                                <i class="fas fa-quote-right"></i>
                            </div>
                            <div class="testimonial-author">
                                <i class="fas fa-user-circle"></i>
                                {{ $testi->author }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
                
        <!-- Quick Stats Summary -->
        <div class="grid-4 fade-in">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="stats-label">Total Kamar</div>
                <div class="stats-value">{{ $boardingHouse->rooms->count() }}</div>
            </div>
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stats-label">Kamar Tersedia</div>
                <div class="stats-value">{{ $boardingHouse->rooms->where('is_available', true)->count() }}</div>
            </div>
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-gift"></i>
                </div>
                <div class="stats-label">Fasilitas</div>
                <div class="stats-value">{{ $boardingHouse->bonuses->count() }}</div>
            </div>
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stats-label">Testimoni</div>
                <div class="stats-value">{{ $boardingHouse->testimonials->count() ?? 0 }}</div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="back-section">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- Floating Contact Button -->
    <button class="floating-action" onclick="alert('Fitur kontak akan segera hadir!')">
        <i class="fas fa-phone"></i>
        Hubungi Kami
    </button>

    <!-- Image Modal -->
    <div id="imageModal" class="modal">
        <span class="close-modal" onclick="closeModal()">&times;</span>
        <div class="modal-content">
            <img id="modalImage" src="" alt="Room Image">
        </div>
    </div>

    <script>
        // Modal functionality
        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Smooth scroll for any anchor links
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

        // Add loading animation to buttons
        document.querySelectorAll('button:not([disabled])').forEach(button => {
            button.addEventListener('click', function() {
                if (!this.disabled) {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                    setTimeout(() => {
                        this.innerHTML = originalText;
                    }, 2000);
                }
            });
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all cards for animation
        document.querySelectorAll('.fade-in').forEach(element => {
            observer.observe(element);
        });
    </script>
@endsection