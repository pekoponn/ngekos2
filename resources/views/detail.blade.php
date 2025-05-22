@extends('layouts.app')

@section('content')
<h1>{{ $boardingHouse->name }}</h1>
<img src="{{ asset('storage/' . $boardingHouse->thumbnail) }}" alt="{{ $boardingHouse->name }}" width="300">

<p>{{ $boardingHouse->description }}</p>
<p>Kota: {{ $boardingHouse->city->name }}</p>
<p>Kategori: {{ $boardingHouse->category->name }}</p>
<p>Alamat: {{ $boardingHouse->address }}</p>
<p>Harga: Rp {{ number_format($boardingHouse->price) }}</p>

<h3>Daftar Kamar:</h3>
@foreach($boardingHouse->rooms as $room)
    <div>
        <h4>{{ $room->name }} ({{ $room->room_type }})</h4>
        <p>Harga: Rp {{ number_format($room->price_per_month) }}/bulan</p>
        <p>Kapasitas: {{ $room->capacity }} orang</p>
        @if($room->is_available)
            <a href="{{ route('boarding-house.book.form', [$boardingHouse->slug, $room->id]) }}">Booking Kamar</a>
        @else
            <p>Kamar tidak tersedia</p>
        @endif
    </div>
@endforeach

@endsection
