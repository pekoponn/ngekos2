@extends('layouts.app')

@section('content')
<h1>{{ $house->name }}</h1>

@if($house->thumbnail)
    <img src="{{ asset('storage/' . $house->thumbnail) }}" alt="{{ $house->name }}" width="300">
@endif

<p><strong>Alamat:</strong> {{ $house->address }}</p>
<p><strong>Kota:</strong> {{ $house->city->name ?? 'Tidak diketahui' }}</p>
<p><strong>Harga mulai:</strong> Rp {{ number_format($house->price) }}</p>

<hr>
<h2>Daftar Kamar</h2>

@if($house->rooms->count())
    @foreach($house->rooms as $room)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <h3>{{ $room->name }} ({{ $room->room_type }})</h3>
            <p>Luas: {{ $room->square_feet }} m²</p>
            <p>Kapasitas: {{ $room->capacity }} orang</p>
            <p>Harga per bulan: Rp {{ number_format($room->price_per_month) }}</p>
            <p>Status: {{ $room->is_available ? 'Tersedia' : 'Tidak tersedia' }}</p>

            @if($room->roomImages->count())
                <div style="display:flex; gap:10px;">
                    @foreach($room->roomImages as $img)
                        <img src="{{ asset('storage/' . $img->image) }}" alt="Gambar kamar" width="120">
                    @endforeach
                </div>
            @else
                <p><i>Tidak ada gambar kamar</i></p>
            @endif
        </div>
    @endforeach
@else
    <p><i>Tidak ada kamar tersedia</i></p>
@endif

<a href="{{ route('dashboard') }}">← Kembali ke Dashboard</a>
@endsection
