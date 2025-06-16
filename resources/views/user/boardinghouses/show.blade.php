@extends('layouts.app')

@section('title', $boardingHouse->name)

<style>
    /* ===== GLOBAL STYLES ===== */
    .boarding-house-container {
        max-width: 80rem;
        margin-left: auto;
        margin-right: auto;
        padding: 2.5rem 1rem;
    }

    /* ===== CARD STYLES ===== */
    .boarding-house-card {
        background-color: #f9fafb;
        border-radius: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .boarding-house-card:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        transform: translateY(-2px);
    }

    /* ===== IMAGE STYLES ===== */
    .boarding-house-image {
        width: 100%;
        height: 24rem;
        object-fit: cover;
        object-position: center;
    }

    /* ===== CONTENT STYLES ===== */
    .boarding-house-content {
        padding: 1.5rem;
    }

    .boarding-house-title {
        font-size: 2.25rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 1rem;
    }

    /* ===== META INFO STYLES ===== */
    .boarding-house-meta {
        color: #4b5563;
        margin-bottom: 1rem;
    }

    .meta-item {
        display: inline-block;
        margin-right: 1rem;
    }

    .meta-icon {
        margin-right: 0.25rem;
        color: #6b7280;
    }

    /* ===== DESCRIPTION STYLES ===== */
    .boarding-house-description {
        color: #374151;
        line-height: 1.625;
        margin-bottom: 1.5rem;
    }

    .description-label {
        font-weight: 600;
        color: #111827;
    }

    /* ===== GRID LAYOUT STYLES ===== */
    .features-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    @media (min-width: 768px) {
        .features-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* ===== FEATURE BOX STYLES ===== */
    .feature-box {
        background-color: #f3f4f6;
        padding: 1rem;
        border-radius: 0.5rem;
    }

    .feature-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 1rem;
    }

    /* ===== LIST STYLES ===== */
    .feature-list {
        list-style-position: inside;
        list-style-type: decimal;
        padding-left: 1rem;
    }

    /* ===== TESTIMONIAL STYLES ===== */
    .testimonial-item {
        background-color: #f9fafb;
        padding: 0.75rem;
        border-radius: 0.375rem;
        box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.05);
        margin-bottom: 0.5rem;
    }

    .testimonial-text {
        font-style: italic;
    }

    .testimonial-author {
        display: block;
        text-align: right;
        font-size: 0.875rem;
        color: #6b7280;
    }

    /* ===== BUTTON STYLES ===== */
    .back-button {
        display: inline-block;
        background-color: #3b82f6;
        color: #f9fafb;
        padding: 0.5rem 1.5rem;
        border-radius: 0.375rem;
        transition: all 0.3s ease;
    }

    .back-button:hover {
        background-color: #2563eb;
        transform: translateX(0.25rem);
    }
</style>

@section('content')
<div class="boarding-house-container">
    <div class="boarding-house-card">
        @if($boardingHouse->image)
            <img src="{{ asset('storage/' . $boardingHouse->image) }}"
                 alt="{{ $boardingHouse->name }}"
                 class="boarding-house-image">
        @endif

        <div class="boarding-house-content">
            <h1 class="boarding-house-title">
                {{ $boardingHouse->name }}
            </h1>

            <div class="boarding-house-meta">
                <span class="meta-item">
                    <i class="fas fa-map-marker-alt meta-icon"></i>{{ $boardingHouse->city->name ?? '-' }}
                </span>
                <span class="meta-item">
                    <i class="fas fa-venus-mars meta-icon"></i>{{ $boardingHouse->category->name ?? '-' }}
                </span>
            </div>

            <div class="boarding-house-description">
                <p><span class="description-label">Alamat:</span> {{ $boardingHouse->address }}</p>
                <p class="mt-2"><span class="description-label">Deskripsi:</span></p>
                <p>{{ $boardingHouse->description }}</p>
            </div>

            <div class="features-grid">
                <div class="feature-box">
                    <h2 class="feature-title">Bonus / Fasilitas</h2>
                    <ul class="feature-list">
                        @forelse($boardingHouse->bonuses as $bonus)
                            <li>{{ $bonus->name }}</li>
                        @empty
                            <li>Tidak ada bonus tersedia</li>
                        @endforelse
                    </ul>
                </div>

                <div class="feature-box">
                    <h2 class="feature-title">Testimoni Penghuni</h2>
                    @forelse($boardingHouse->testimonials as $testi)
                        <div class="testimonial-item">
                            <p class="testimonial-text">"{{ $testi->content }}"</p>
                            <small class="testimonial-author">— {{ $testi->author }}</small>
                        </div>
                    @empty
                        <p class="boarding-house-description">Belum ada testimoni.</p>
                    @endforelse
                </div>
            </div>

            <a href="{{ route('dashboard') }}" class="back-button">
                &larr; Kembali ke Daftar Kos
            </a>
        </div>
    </div>
</div>
@endsection