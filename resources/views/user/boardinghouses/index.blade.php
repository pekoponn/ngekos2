@extends('layouts.app')

@section('title', 'Temukan Kos Impianmu - Ngekost')

<style>
    /* ======== GLOBAL STYLES & VARIABLES ======== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --primary-color: #4A90E2;
        --secondary-color: #50E3C2;
        --dark-color: #333;
        --light-color: #f4f4f4;
        --grey-color: #888;
        --body-bg: #f8f9fa;
        --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--body-bg);
        line-height: 1.6;
        color: var(--dark-color);
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* ======== HERO SECTION ======== */
    .hero-section {
        height: 500px;
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?q=80&w=2071') no-repeat center center/cover;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #fff;
        position: relative;
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .hero-content p {
        font-size: 1.4rem;
        margin-bottom: 3rem;
        opacity: 0.95;
    }

    .search-bar {
        display: flex;
        background: #fff;
        border-radius: 50px;
        padding: 8px;
        max-width: 700px;
        margin: 0 auto;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        align-items: center;
        backdrop-filter: blur(10px);
    }

    .search-bar i {
        color: #9CA3AF;
        margin: 0 15px;
        font-size: 1.2rem;
    }

    .search-bar input {
        flex-grow: 1;
        outline: none;
        border: none;
        padding: 15px 10px;
        font-size: 1.1rem;
        background: transparent;
    }

    .search-bar input::placeholder {
        color: #9CA3AF;
    }

    .search-bar button {
        background: linear-gradient(135deg, var(--primary-color), #357ABD);
        color: white;
        padding: 15px 30px;
        border: none;
        border-radius: 40px;
        cursor: pointer;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
    }

    .search-bar button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(74, 144, 226, 0.4);
    }

    /* ======== MAIN CONTENT ======== */
    .main-content {
        padding: 4rem 0;
    }

    .filters {
        display: flex;
        gap: 25px;
        align-items: flex-end;
        background: #fff;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 50px;
        box-shadow: var(--card-shadow);
        flex-wrap: wrap;
        border: 1px solid rgba(74, 144, 226, 0.1);
    }

    .filter-item {
        flex: 1;
        min-width: 200px;
    }

    .filter-item label {
        display: block;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 8px;
    }

    .filter-item select {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #E5E7EB;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }

    .filter-item select:focus {
        border-color: var(--primary-color);
        outline: none;
        box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
    }

    .btn-filter {
        background: linear-gradient(135deg, var(--secondary-color), #26D0CE);
        color: #fff;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        height: fit-content;
        box-shadow: 0 4px 15px rgba(80, 227, 194, 0.3);
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(80, 227, 194, 0.4);
    }

    /* ======== KOS LISTINGS ======== */
    .kos-listings h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 3rem;
        color: var(--dark-color);
        text-align: center;
        position: relative;
    }

    .kos-listings h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 2px;
    }

    .results-info {
        text-align: center;
        margin-bottom: 2rem;
        color: var(--grey-color);
        font-size: 1.1rem;
    }

    .kos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 35px;
    }

    .kos-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: all 0.4s ease;
        border: 1px solid rgba(0,0,0,0.05);
        position: relative;
    }

    .kos-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(74, 144, 226, 0.05), rgba(80, 227, 194, 0.05));
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 20px;
    }

    .kos-card:hover::before {
        opacity: 1;
    }

    .kos-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .kos-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .kos-card:hover img {
        transform: scale(1.05);
    }

    .card-content {
        padding: 25px;
        position: relative;
    }

    .kos-badge {
        display: inline-block;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 15px;
        text-transform: capitalize;
        position: relative;
        overflow: hidden;
    }

    .kos-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }

    .kos-badge:hover::before {
        left: 100%;
    }

    .kos-badge.putri { 
        background: linear-gradient(135deg, #E91E63, #C2185B); 
    }
    .kos-badge.putra { 
        background: linear-gradient(135deg, #2196F3, #1976D2); 
    }
    .kos-badge.campur { 
        background: linear-gradient(135deg, #9C27B0, #7B1FA2); 
    }

    .kos-card h3 {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--dark-color);
        line-height: 1.3;
    }

    .location-info {
        display: flex;
        align-items: center;
        color: #6B7280;
        margin-bottom: 20px;
        font-size: 1rem;
    }

    .location-info i {
        color: var(--primary-color);
        margin-right: 8px;
        font-size: 1.1rem;
    }

    .price-info {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 25px;
        display: flex;
        align-items: baseline;
        gap: 8px;
    }

    .price-period {
        color: #6B7280;
        font-size: 1rem;
        font-weight: 500;
    }

    .btn-detail {
        display: block;
        background: linear-gradient(135deg, var(--primary-color), #357ABD);
        color: #fff;
        text-align: center;
        padding: 15px 20px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-detail::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-detail:hover::before {
        left: 100%;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(74, 144, 226, 0.4);
        text-decoration: none;
        color: #fff;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        background: white;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        padding: 4rem 2rem;
        margin: 3rem 0;
    }

    .empty-state i {
        font-size: 4rem;
        color: #D1D5DB;
        margin-bottom: 2rem;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--dark-color);
    }

    .empty-state p {
        color: #6B7280;
        margin-bottom: 2rem;
        font-size: 1.1rem;
    }

    .pagination-wrapper {
        margin-top: 4rem;
        display: flex;
        justify-content: center;
    }

    /* Pagination Styling */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin: 2rem 0;
    }

    .pagination .page-link {
        padding: 10px 15px;
        border: 2px solid #E5E7EB;
        border-radius: 8px;
        color: var(--dark-color);
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .pagination .page-link:hover {
        border-color: var(--primary-color);
        background-color: var(--primary-color);
        color: white;
    }

    .pagination .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    /* Active filters indicator */
    .active-filters {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .filter-tag {
        background: var(--primary-color);
        color: white;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .filter-tag .remove {
        cursor: pointer;
        font-weight: bold;
    }

    /* ======== RESPONSIVE DESIGN ======== */
    @media (max-width: 1024px) {
        .kos-grid {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }
    }

    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.5rem;
        }
        
        .hero-content p {
            font-size: 1.2rem;
        }
        
        .filters {
            flex-direction: column;
            align-items: stretch;
            gap: 20px;
        }

        .filter-item {
            min-width: 100%;
        }

        .kos-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .kos-listings h2 {
            font-size: 2rem;
        }
    }

    @media (max-width: 480px) {
        .hero-section {
            height: 400px;
        }

        .hero-content h1 {
            font-size: 2rem;
        }
        
        .hero-content p {
            font-size: 1rem;
        }
        
        .search-bar {
            flex-direction: column;
            gap: 15px;
            padding: 20px;
            border-radius: 20px;
        }

        .search-bar input {
            width: 100%;
            text-align: center;
            padding: 15px;
        }

        .search-bar button {
            width: 100%;
            padding: 15px;
        }

        .container {
            padding: 0 15px;
        }

        .filters {
            padding: 20px;
        }

        .card-content {
            padding: 20px;
        }
    }

    /* Loading Animation */
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

    .kos-card {
        animation: fadeInUp 0.6s ease forwards;
    }

    .kos-card:nth-child(1) { animation-delay: 0.1s; }
    .kos-card:nth-child(2) { animation-delay: 0.2s; }
    .kos-card:nth-child(3) { animation-delay: 0.3s; }
    .kos-card:nth-child(4) { animation-delay: 0.4s; }
    .kos-card:nth-child(5) { animation-delay: 0.5s; }
    .kos-card:nth-child(6) { animation-delay: 0.6s; }
</style>

@section('content')
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1>Temukan Kos Nyaman untuk Anda</h1>
            <p>Jelajahi berbagai pilihan kos terbaik di seluruh Indonesia</p>
            
            <form action="{{ route('boarding-houses.index') }}" method="GET" class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" name="search" placeholder="Cari berdasarkan lokasi atau nama kos..." 
                       value="{{ request('search') }}">
                <button type="submit">
                    <i class="fas fa-search"></i> Cari
                </button>
            </form>
        </div>
    </div>
</section>

<main class="container main-content">
    <!-- Active Filters -->
    @if(request()->hasAny(['search', 'city', 'category']))
        <div class="active-filters">
            @if(request('search'))
                <div class="filter-tag">
                    <i class="fas fa-search"></i>
                    "{{ request('search') }}"
                    <span class="remove" onclick="removeFilter('search')">&times;</span>
                </div>
            @endif
            @if(request('city'))
                @php
                    $selectedCity = $cities->where('slug', request('city'))->first();
                @endphp
                @if($selectedCity)
                    <div class="filter-tag">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $selectedCity->name }}
                        <span class="remove" onclick="removeFilter('city')">&times;</span>
                    </div>
                @endif
            @endif
            @if(request('category'))
                @php
                    $selectedCategory = $categories->where('slug', request('category'))->first();
                @endphp
                @if($selectedCategory)
                    <div class="filter-tag">
                        <i class="fas fa-home"></i>
                        {{ $selectedCategory->name }}
                        <span class="remove" onclick="removeFilter('category')">&times;</span>
                    </div>
                @endif
            @endif
        </div>
    @endif

    <!-- Form Filter yang Diperbaiki -->
    <form id="filter-form" action="{{ route('boarding-houses.index') }}" method="GET">
        <!-- Simpan parameter search jika ada -->
        @if(request('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
        @endif
        
        <div class="filters">
            <div class="filter-item">
                <label for="city">
                    <i class="fas fa-map-marker-alt"></i> Kota
                </label>
                <select name="city" id="city">
                    <option value="">Semua Kota</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->slug }}" {{ request('city') == $city->slug ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="filter-item">
                <label for="category">
                    <i class="fas fa-home"></i> Kategori
                </label>
                <select name="category" id="category">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn-filter">
                <i class="fas fa-filter"></i> Filter
            </button>
        </div>
    </form>
        
        @if($boardingHouses->count() > 0)
            <div class="kos-grid">
                @foreach($boardingHouses as $kos)
                    <div class="kos-card">
                        <img src="{{ $kos->thumbnail ? asset('storage/' . $kos->thumbnail) : 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400&h=250&fit=crop' }}" 
                             alt="{{ $kos->name }}" 
                             onerror="this.src='https://via.placeholder.com/400x250?text=No+Image'">
                        
                        <div class="card-content">
                            @if($kos->category)
                                <span class="kos-badge {{ strtolower($kos->category->name) }}">
                                    {{ $kos->category->name }}
                                </span>
                            @else
                                <span class="kos-badge campur">
                                    Umum
                                </span>
                            @endif
                            
                            <h3>{{ $kos->name }}</h3>
                            
                            <div class="location-info">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $kos->city->name ?? 'Lokasi tidak diketahui' }}</span>
                            </div>
                            
                            <div class="price-info">
                                Rp {{ number_format($kos->price ?? 0, 0, ',', '.') }}
                                <span class="price-period">/bulan</span>
                            </div>
                            
                            <a href="{{ route('boarding-houses.show', $kos->slug) }}" class="btn-detail">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $boardingHouses->withQueryString()->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-search"></i>
                <h3>Kos Tidak Ditemukan</h3>
                <p>
                    @if(request()->hasAny(['search', 'city', 'category']))
                        Maaf, kami tidak menemukan kos yang sesuai dengan kriteria pencarian Anda.
                    @else
                        Belum ada kos yang tersedia saat ini.
                    @endif
                </p>
                @if(request()->hasAny(['search', 'city', 'category']))
                    <a href="{{ route('boarding-houses.index') }}" class="btn-detail">
                        <i class="fas fa-refresh"></i> Reset Pencarian
                    </a>
                @endif
            </div>
        @endif
    </section>
</main>
@endsection

@section('scripts')
<script>
    // Fungsi untuk menghapus filter
    function removeFilter(filterType) {
        const url = new URL(window.location.href);
        url.searchParams.delete(filterType);
        url.searchParams.delete('page'); // Reset ke halaman pertama
        
        // Submit form filter setelah menghapus parameter
        document.getElementById('filter-form').action = url.toString();
        document.getElementById('filter-form').submit();
    }

    // Auto-submit search form dengan debounce
    let searchTimeout;
    const searchInput = document.querySelector('.search-bar input[name="search"]');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.length >= 3 || this.value.length === 0) {
                    this.form.submit();
                }
            }, 500);
        });
    }

    // Animasi kartu kos
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, observerOptions);

    // Terapkan animasi pada semua kartu kos
    document.querySelectorAll('.kos-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });

    // Loading indicator
    function showLoading() {
        const grid = document.querySelector('.kos-grid');
        if (grid) {
            grid.style.opacity = '0.6';
            grid.style.pointerEvents = 'none';
        }
    }

    // Tambahkan loading state saat filter di-submit
    document.getElementById('filter-form').addEventListener('submit', showLoading);
</script>
@endsection