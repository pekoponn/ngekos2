@extends('layouts.app')

@section('content')
<h1>Booking Kamar {{ $room->name }} di {{ $boardingHouse->name }}</h1>

<form method="POST" action="{{ route('boarding-house.book.submit', [$boardingHouse->slug, $room->id]) }}">
    @csrf
    <label>Nama</label>
    <input type="text" name="name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Nomor Telepon</label>
    <input type="text" name="phone_number" required>

    <label>Tanggal Mulai</label>
    <input type="date" name="start_date" required>

    <label>Durasi (bulan)</label>
    <input type="number" name="duration" min="1" required>

    <label>Metode Pembayaran</label>
    <select name="payment_method" required>
        <option value="down_payment">Down Payment</option>
        <option value="full_payment">Full Payment</option>
    </select>

    <button type="submit">Booking</button>
</form>

@endsection
