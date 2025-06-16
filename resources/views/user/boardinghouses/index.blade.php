@extends('layouts.app')

@section('title', 'Temukan Kos Impianmu - Ngekost')

@section('styles')
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .hero-section {
            padding: 100px 20px;
            text-align: center;
            background: #edf5ff;
        }
        .hero-section .search-bar {
            background: #fff;
            padding: 10px 20px;
            border-radius: 50px;
            box-shadow: 0 4px 14px rgb(0 0 0 / 0.1);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        .search-bar input {
            border: none;
            outline: none;
            padding: 10px 20px;
            border-radius: 50px;
            background: #f0f0f0;
            flex-grow: 1;
        }
        .search-bar button {
            padding: 10px 20px;
            background: #ffcc5b;
            color: #fff;
            border: none;
            border-radius: 50px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .search-bar button:hover {
            background: #ffa500;
        }
        .filters {
            margin-bottom: 30px;
            padding: 20px;
            background: #f5f5f5;
            border-radius: 20px;
            box-shadow: 0 4px 14px rgb(0 0 0 / 0.05);
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .filter-item select {
            padding: 10px 20px;
            border-radius: 50px;
            border: none;
            background: #fff;
        }
        .filter-item label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        .kos-listings .kos-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 20px;
            display: grid;
        }
        .kos-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 14px rgb(0 0 0 / 0.05);
            overflow: hidden;
            transform: translateY(20px);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }
        .kos-card:hover {
            transform: translateY(0);
            box-shadow: 0 10px 20px rgb(0 0 0 / 0.1);
        }
        .kos-badge {
            padding: 5px 10px;
            background: #ffcc5b;
            color: #fff;
            font-weight: bold;
            border-radius: 12px;
            font-size: 0.9em;
            margin-bottom: 10px;
            display: inline-block;
        }
        .location, .price {
            margin-bottom: 10px;
        }
        .location i {
            color: #ffcc5b;
            margin-right: 5px;
        }
        .price {
            font-size: 1.5em;
            color: #ffcc5b;
        }
        .facilities span {
            background: #edf5ff;
            color: #555;
            padding: 5px 10px;
            border-radius: 12px;
            margin-bottom: 5px;
            font-size: 0.9em;
            display: inline-block;
        }
        .btn-detail {
            padding: 10px 20px;
            background: #ffcc5b;
            color: #fff;
            border-radius: 50px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            margin-top: 15px;
            transition: background 0.3s ease;
        }
        .btn-detail:hover {
            background: #ffa500;
        }
        .empty-state {
            text-align: center;
            padding: 50px;
            background: #f5f5f5;
            border-radius: 20px;
        }
    </style>
@endsection

@section('content')
    <section class="hero-section">
        <div class="hero-content">
            <h1>Temukan Kos Nyaman untuk Anda</h1>
            <p>Jelajahi berbagai pilihan kos sesuai keinginan</p>

            <form action="{{ route('boarding-houses.index') }}" method="GET" class="search-bar">
                <i class="fas fa-search text-gray-400 mr-2 ml-3"></i>
                <input type="text" name="search" placeholder="Cari berdasarkan lokasi atau nama kos…" 
                    value="{{ request('search') }}"> 
                <button type="submit"><i class="fas fa-search mr-2"></i>Cari</button>
            </form>
        </div>
    </section>

    <main class="container py-12">
        <form action="{{ route('boarding-houses.index') }}" method="GET">
            <div class="filters">
                <div class="filter-item">
                    <label for="city">Pilih Kota</label>
                    <select name="city" id="city">
                        <option value="">Semua Kota</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->slug }}"
                                {{ request('city') == $city->slug ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-item">
                    <label for="category">Tipe Kos</label>
                    <select name="category" id="category">
                        <option value="">Semua Tipe</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}"
                                {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"><i class="fas fa-filter mr-2 ml-1"></i>Terapkan Filter</button>
            </div>
        </form>

        <section class="kos-listings">
            <h2>✨ Kos Pilihan</h2>

            @if($boardingHouses->count()) 
                <div class="kos-grid">
                    @foreach($boardingHouses as $kos)
                        <div class="kos-card">
                            <img src="{{ $kos->thumbnail ? asset('storage/' . $kos->thumbnail) : 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=2070' }}"
                                alt="{{ $kos->name }}">    

                            <div class="p-5">
                                <span class="kos-badge">
                                   {{ $kos->type ?? 'Campur' }}
                                </span>

                                <h3>{{ $kos->name }}</h3>

                                <div class="location">
                                   <i class="fas fa-map-marker-alt mr-1 text-gray-500">
                                   </i>{{ $kos->city->name ?? '' }}
                                </div>

                                <div class="price">
                                   Rp {{ number_format($kos->price, 0, ',', '.') }} <span>/bulan</span>
                                </div>

                                <a href="{{ route('boarding-houses.show', $kos->slug) }}"
                                   class="btn-detail"><i class="fas fa-eye mr-2 ml-1">
                                   </i>Lihat Detail Lengkap</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $boardingHouses->withQueryString()->links() }}
                </div>

            @else
                <div class="empty-state">
                    <i class="fas fa-search-minus fa-5x mb-4 text-gray-400">
                    </i>
                    <h3>Oops! Kos Tidak Ditemukan</h3>
                    <p>Silakan perbarui filter atau kata kunci Anda.</p>
                    <a href="{{ route('boarding-houses.index') }}"
                       class="btn-detail"><i class="fas fa-refresh mr-2 ml-1">
                       </i>Reset</a>
                </div>
            @endif
        </section>
    </main>
@endsection
