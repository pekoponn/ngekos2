<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Ngekos - Temukan Kos Terbaik</title>
</head>
<body>
    <header>
        <h1>Selamat datang di Ngekos</h1>
    </header>

    <main>
        <p>Platform terbaik untuk menemukan kos sesuai kebutuhanmu.</p>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <a href="{{ route('login') }}">Login</a> |
        <a href="{{ route('register') }}">Daftar</a>
    </main>
    <footer>
        <p>&copy; 2025 Ngekos</p>
    </footer>
</body>
</html>
