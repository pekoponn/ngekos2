@extends('layouts.app')

@section('content')
<h1>Daftar Kos</h1>

@if($boardingHouses->count())
    <div>
        @foreach ($boardingHouses as $house)
            <div style="border:1px solid #ddd; padding:10px; margin-bottom:10px;">
                @if($house->thumbnail)
                    <img src="{{ asset('storage/' . $house->thumbnail) }}" alt="{{ $house->name }}" width="150" />
                @else
                    <p><i>Tidak ada gambar</i></p>
                @endif

                <h3><a href="{{ route('boarding-house.show', $house->slug) }}">{{ $house->name }}</a></h3>
                <p>Kota: {{ $house->city->name ?? 'Tidak diketahui' }}</p>
                <p>Harga mulai dari: Rp {{ number_format($house->price) }}</p>
            </div>
        @endforeach
    </div>

    {{ $boardingHouses->links() }}
@else
    <p>Tidak ada kos yang tersedia.</p>
@endif

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
@endsection
