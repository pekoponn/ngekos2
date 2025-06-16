@extends('layouts.app') {{-- Ganti sesuai layout kamu --}}

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Kos-Kosan</h1>

    @foreach ($boardingHouses as $house)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $house->name }}</h5>
                <p>{{ $house->description }}</p>
                <p><strong>Kota:</strong> {{ $house->city->name ?? '-' }}</p>
                <p><strong>Harga Mulai:</strong> Rp{{ number_format($house->rooms->min('price') ?? 0) }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection
