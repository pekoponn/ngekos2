@extends('layouts.app')
@section('title', $boardingHouse->name)

<style>
/* Professional Blue to Purple Theme */
:root {
    --primary-blue: #1e40af;
    --primary-purple: #7c3aed;
    --gradient-primary: linear-gradient(135deg, #1e40af 0%, #3b82f6 25%, #6366f1 75%, #7c3aed 100%);
    --gradient-secondary: linear-gradient(45deg, #f8faff 0%, #e0e7ff 100%);
    --gradient-card: linear-gradient(145deg, #ffffff 0%, #f1f5f9 100%);
    --text-primary: #1e293b;
    --text-secondary: #64748b;
    --text-light: #94a3b8;
    --bg-light: #f8fafc;
    --border-light: #e2e8f0;
    --shadow-soft: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-large: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    --border-radius: 12px;
    --border-radius-large: 20px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Global Styles */
body {
    background: var(--gradient-secondary);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    color: var(--text-primary);
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.main-content {
    padding: 2rem 0;
}

/* Breadcrumb */
.breadcrumb {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--border-light);
    padding: 1rem 0;
    position: sticky;
    top: 0;
    z-index: 100;
}

.breadcrumb-nav {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
}

.breadcrumb-nav a {
    color: var(--primary-blue);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    transition: var(--transition);
}

.breadcrumb-nav a:hover {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-purple) 100%);
    color: white;
    transform: translateY(-1px);
}

.breadcrumb-separator {
    color: var(--text-light);
    font-weight: bold;
}

/* Cards */
.card {
    background: var(--gradient-card);
    border-radius: var(--border-radius-large);
    box-shadow: var(--shadow-medium);
    border: 1px solid rgba(255, 255, 255, 0.8);
    margin-bottom: 2rem;
    overflow: hidden;
    position: relative;
    backdrop-filter: blur(10px);
}

.card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--gradient-primary);
}

.card-body {
    padding: 2rem;
}

.card-hero {
    border-radius: var(--border-radius-large);
    overflow: hidden;
    position: relative;
}

/* Hero Section */
.hero-image-container {
    position: relative;
    height: 400px;
    overflow: hidden;
}

.hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.hero-image:hover {
    transform: scale(1.05);
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(30, 64, 175, 0.8) 0%, rgba(124, 58, 237, 0.6) 100%);
}

.price-badge {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    color: var(--primary-blue);
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    box-shadow: var(--shadow-medium);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.hero-content {
    position: absolute;
    bottom: 2rem;
    left: 2rem;
    right: 2rem;
    color: white;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.hero-meta {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.meta-badge {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

/* Section Titles */
.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
}

.section-title::after {
    content: '';
    flex: 1;
    height: 2px;
    background: var(--gradient-primary);
    border-radius: 1px;
    margin-left: 1rem;
}

.section-title i {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--gradient-primary);
    color: white;
    border-radius: 50%;
    font-size: 0.875rem;
}

/* Address Section */
.address-section {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ff 100%);
    border-radius: var(--border-radius);
    border-left: 4px solid var(--primary-blue);
}

.address-text {
    font-size: 1.1rem;
    color: var(--text-primary);
    font-weight: 500;
    margin: 0;
}

/* Description */
.description-content {
    font-size: 1rem;
    line-height: 1.8;
    color: var(--text-secondary);
}

/* Grid Layouts */
.grid-2 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

.grid-3 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.grid-4 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
}

/* Facility Cards */
.facility-card {
    background: var(--gradient-card);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    text-align: center;
    box-shadow: var(--shadow-soft);
    border: 1px solid var(--border-light);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.facility-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--gradient-primary);
    transform: scaleX(0);
    transition: var(--transition);
}

.facility-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-large);
}

.facility-card:hover::before {
    transform: scaleX(1);
}

.facility-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 1rem;
    border: 3px solid var(--primary-blue);
}

.facility-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.facility-description {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

/* Room Cards */
.room-card {
    background: var(--gradient-card);
    border-radius: var(--border-radius-large);
    overflow: hidden;
    box-shadow: var(--shadow-medium);
    transition: var(--transition);
    border: 1px solid var(--border-light);
}

.room-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-large);
}

.room-images {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.image-gallery {
    display: flex;
    height: 100%;
    gap: 2px;
}

.gallery-image {
    flex: 1;
    height: 100%;
    object-fit: cover;
    cursor: pointer;
    transition: var(--transition);
}

.gallery-image:hover {
    transform: scale(1.05);
    filter: brightness(1.1);
}

.room-content {
    padding: 1.5rem;
}

.room-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.room-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-primary);
}

.availability-badge {
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 600;
}

.availability-badge.available {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.availability-badge.unavailable {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
}

.room-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.detail-label {
    font-size: 0.875rem;
    color: var(--text-light);
    font-weight: 500;
}

.detail-value {
    font-weight: 600;
    color: var(--text-primary);
}

.price-highlight {
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 1.1rem;
    font-weight: 700;
}

/* Buttons */
.btn {
    padding: 0.875rem 1.5rem;
    border-radius: var(--border-radius);
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: var(--transition);
    border: none;
    cursor: pointer;
    font-size: 0.95rem;
}

.btn-primary {
    background: var(--gradient-primary);
    color: white;
    box-shadow: var(--shadow-soft);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
    filter: brightness(1.05);
}

.btn-secondary {
    background: rgba(255, 255, 255, 0.9);
    color: var(--primary-blue);
    border: 2px solid var(--primary-blue);
    backdrop-filter: blur(10px);
}

.btn-secondary:hover {
    background: var(--gradient-primary);
    color: white;
    border-color: transparent;
    transform: translateY(-2px);
}

.btn-disabled {
    background: #e2e8f0;
    color: #94a3b8;
    cursor: not-allowed;
}

.btn-block {
    width: 100%;
}

/* Testimonial Cards */
.testimonial-card {
    background: var(--gradient-card);
    padding: 2rem;
    border-radius: var(--border-radius-large);
    box-shadow: var(--shadow-soft);
    border: 1px solid var(--border-light);
    position: relative;
    transition: var(--transition);
}

.testimonial-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-medium);
}

.rating-stars {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.stars {
    display: flex;
    gap: 0.25rem;
}

.stars i {
    color: #fbbf24;
    font-size: 1.1rem;
}

.rating-text {
    color: var(--text-secondary);
    font-weight: 500;
    font-size: 0.9rem;
}

.testimonial-content {
    font-style: italic;
    color: var(--text-secondary);
    margin: 1.5rem 0;
    position: relative;
    padding: 0 1rem;
    line-height: 1.7;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: var(--text-primary);
}

/* Stats Cards */
.stats-card {
    background: var(--gradient-card);
    padding: 2rem;
    border-radius: var(--border-radius-large);
    text-align: center;
    box-shadow: var(--shadow-soft);
    border: 1px solid var(--border-light);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.stats-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--gradient-primary);
}

.stats-card:hover {
    transform: translateY(-4px) scale(1.02);
    box-shadow: var(--shadow-large);
}

.stats-icon {
    width: 60px;
    height: 60px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
    font-size: 1.5rem;
}

.stats-label {
    font-size: 0.9rem;
    color: var(--text-secondary);
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.stats-value {
    font-size: 2rem;
    font-weight: 800;
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Back Section */
.back-section {
    text-align: center;
    margin: 3rem 0;
}

/* Floating Action Button */
.floating-action {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    background: var(--gradient-primary);
    color: white;
    border: none;
    border-radius: 50px;
    padding: 1rem 2rem;
    font-weight: 600;
    box-shadow: var(--shadow-large);
    cursor: pointer;
    transition: var(--transition);
    z-index: 1000;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.floating-action:hover {
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 20px 40px -10px rgba(30, 64, 175, 0.4);
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 10000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(10px);
}

.modal-content {
    position: relative;
    margin: auto;
    padding: 20px;
    width: 90%;
    max-width: 800px;
    top: 50%;
    transform: translateY(-50%);
}

.modal-content img {
    width: 100%;
    height: auto;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-large);
}

.close-modal {
    position: absolute;
    top: 10px;
    right: 20px;
    color: white;
    font-size: 2rem;
    font-weight: bold;
    cursor: pointer;
    z-index: 10001;
    transition: var(--transition);
}

.close-modal:hover {
    color: #ccc;
    transform: scale(1.1);
}

/* Animations */
.fade-in {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.fade-in.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 0 15px;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .grid-2, .grid-3, .grid-4 {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .room-details {
        grid-template-columns: 1fr;
    }
    
    .floating-action {
        bottom: 1rem;
        right: 1rem;
        padding: 0.75rem 1.5rem;
        font-size: 0.9rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .hero-image-container {
        height: 250px;
    }
    
    .price-badge {
        top: 1rem;
        right: 1rem;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
    
    .hero-content {
        bottom: 1rem;
        left: 1rem;
        right: 1rem;
    }
    
    .hero-title {
        font-size: 1.5rem;
    }
}

/* Loading Animations */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.loading {
    animation: pulse 1.5s ease-in-out infinite;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Focus states for accessibility */
.btn:focus,
.gallery-image:focus {
    outline: 2px solid var(--primary-blue);
    outline-offset: 2px;
}

/* Print styles */
@media print {
    .floating-action,
    .modal {
        display: none !important;
    }
}
</style>

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <nav class="breadcrumb-nav">
                <a href="{{ route('dashboard') }}">
                    <br><br><br><br><br>
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
                    Kamar {{ $boardingHouse->name }}
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
                if (!this.disabled && !this.classList.contains('floating-action')) {
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

        // Add parallax effect to hero image
        window.addEventListener('scroll', () => {
            const heroImage = document.querySelector('.hero-image');
            if (heroImage) {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.5;
                heroImage.style.transform = `translateY(${rate}px)`;
            }
        });

        // Add contact info to floating button
        document.querySelector('.floating-action').addEventListener('click', function() {
            const phoneNumber = '{{ $boardingHouse->phone_number }}';
            if (phoneNumber) {
                const message = `Halo! Saya tertarik dengan ${document.querySelector('.hero-title').textContent}. Bisa berikan informasi lebih lanjut?`;
                const whatsappUrl = `https://wa.me/${phoneNumber.replace(/[^0-9]/g, '')}?text=${encodeURIComponent(message)}`;
                window.open(whatsappUrl, '_blank');
            } else {
                alert('Nomor telepon tidak tersedia. Silakan hubungi admin.');
            }
        });

        // Add smooth fade-in animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                document.querySelectorAll('.fade-in').forEach((element, index) => {
                    setTimeout(() => {
                        element.classList.add('visible');
                    }, index * 100);
                });
            }, 100);
        });
    </script>
@endsection