@extends('layouts.app')

@section('title', 'Temukan Kos Impianmu - Ngekost')

@section('styles')
<style>
    /* ======== GLOBAL STYLES & VARIABLES ======== */
    :root {
        --primary-color: #4A90E2;
        --secondary-color: #50E3C2;
        --dark-color: #333;
        --light-color: #f4f4f4;
        --grey-color: #888;
        --body-bg: #f8f9fa;
        --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .hero-section {
        height: 400px;
        background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?q=80&w=2071') no-repeat center center/cover;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #fff;
    }

    .search-bar {
        display: flex;
        background: #fff;
        border-radius: 30px;
        padding: 10px;
        max-width: 600px;
        margin: 0 auto;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    /* ======== MAIN CONTENT ======== */
    .filters {
        display: flex;
        gap: 20px;
        align-items: flex-end;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 40px;
        box-shadow: var(--card-shadow);
        flex-wrap: wrap;
    }

    .btn-filter {
        background-color: var(--secondary-color);
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s ease;
        height: 42px;
    }

    /* ======== KOS LISTINGS ======== */
    .kos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
    }

    .kos-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .kos-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 10px;
    }
    .kos-badge.putri { background-color: #E91E63; }
    .kos-badge.putra { background-color: #2196F3; }
    .kos-badge.campur { background-color: #9C27B0; }

    .btn-detail {
        display: block;
        background-color: var(--primary-color);
        color: #fff;
        text-align: center;
        padding: 12px;
        border-radius: 5px;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    /* ======== RESPONSIVE DESIGN ======== */
    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.2rem;
        }
        
        .filters {
            flex-direction: column;
            align-items: stretch;
        }
    }

    @media (max-width: 480px) {
        .hero-content h1 {
            font-size: 1.8rem;
        }
        .search-bar {
            flex-direction: column;
            gap: 10px;
            padding: 15px;
        }
    }
</style>
@endsection

@section('content')
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 class="text-4xl font-bold mb-4">Temukan Kos Nyaman untuk Anda</h1>
            <p class="text-xl mb-8">Jelajahi berbagai pilihan kos terbaik di seluruh Indonesia</p>
            
            <form action="{{ route('boarding-houses.index') }}" method="GET" class="search-bar">
                <i class="fas fa-search text-gray-400 mx-3"></i>
                <input type="text" name="search" placeholder="Cari berdasarkan lokasi atau nama kos..." 
                       class="flex-grow outline-none">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition">
                    Cari
                </button>
            </form>
        </div>
    </div>
</section>

<main class="container py-12">
    <div class="filters">
        <div class="filter-item flex-1">
            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
            <select name="city" id="city" class="w-full p-2 border border-gray-300 rounded">
                <option value="">Semua Kota</option>
                @foreach($cities as $city)
                    <option value="{{ $city->slug }}" {{ request('city') == $city->slug ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="filter-item flex-1">
            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Tipe Kos</label>
            <select name="category" id="category" class="w-full p-2 border border-gray-300 rounded">
                <option value="">Semua Tipe</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="button" class="btn-filter hover:bg-teal-400">
            Filter
        </button>
    </div>

    <section class="kos-listings">
        <h2 class="text-3xl font-semibold mb-8">Daftar Kos Tersedia</h2>
        
        @if($boardingHouses->count())
            <div class="kos-grid">
                @foreach($boardingHouses as $kos)
                    <div class="kos-card hover:-translate-y-1 hover:shadow-lg">
                        <img src="{{ $kos->thumbnail ? asset('storage/' . $kos->thumbnail) : 'https://via.placeholder.com/300x200?text=No+Image' }}" 
                             alt="{{ $kos->name }}" class="w-full h-48 object-cover">
                        
                        <div class="p-5">
                            <span class="kos-badge {{ strtolower($kos->type ?? 'campur') }}">
                                {{ $kos->type ?? 'Campur' }}
                            </span>
                            
                            <h3 class="text-xl font-bold mb-2">{{ $kos->name }}</h3>
                            
                            <div class="flex items-center text-gray-500 mb-4">
                                <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                                <span>{{ $kos->city->name ?? 'Lokasi tidak diketahui' }}</span>
                            </div>
                            
                            <div class="text-blue-500 font-bold text-2xl mb-4">
                                Rp {{ number_format($kos->price, 0, ',', '.') }}
                                <span class="text-gray-500 text-sm font-normal">/bulan</span>
                            </div>
                            
                            <div class="flex flex-wrap gap-3 pb-4 mb-4 border-b border-gray-200 text-gray-600 text-sm">
                                <span><i class="fas fa-wifi text-teal-400 mr-1"></i> WiFi</span>
                                <span><i class="fas fa-tshirt text-teal-400 mr-1"></i> Laundry</span>
                                <span><i class="fas fa-car text-teal-400 mr-1"></i> Parkir</span>
                            </div>
                            
                            <a href="{{ route('boarding-houses.show', $kos->slug) }}" 
                               class="btn-detail hover:bg-blue-600">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $boardingHouses->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center bg-white rounded-lg shadow p-12">
                <i class="fas fa-search fa-3x text-gray-400 mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Kos Tidak Ditemukan</h3>
                <p class="text-gray-600 mb-4">Maaf, kami tidak menemukan kos yang sesuai dengan kriteria Anda.</p>
                <a href="{{ route('boarding-houses.index') }}" 
                   class="btn-detail inline-block hover:bg-blue-600">
                    Reset Pencarian
                </a>
            </div>
        @endif
    </section>
</main>
@endsection

@section('scripts')
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    // Filter functionality
    document.querySelector('.btn-filter').addEventListener('click', function() {
        const city = document.getElementById('city').value;
        const category = document.getElementById('category').value;
        const url = new URL(window.location.href);
        
        if(city) url.searchParams.set('city', city);
        else url.searchParams.delete('city');
        
        if(category) url.searchParams.set('category', category);
        else url.searchParams.delete('category');
        
        window.location.href = url.toString();
    });
</script>
@endsection