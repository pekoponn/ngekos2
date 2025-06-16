<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Ngekos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .register-container {
            background: white;
            padding: 3rem;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 2rem;
            font-size: 0.9rem;
        }

        h1 {
            font-size: 1.8rem;
            color: #1f2937;
            margin-bottom: 2rem;
            font-weight: 600;
        }

        /* Error messages styling */
        .error-container {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .error-container ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .error-container li {
            color: #dc2626;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            padding-left: 1.5rem;
            position: relative;
        }

        .error-container li:before {
            content: "⚠️";
            position: absolute;
            left: 0;
            top: 0;
        }

        .error-container li:last-child {
            margin-bottom: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        label {
            display: block;
            color: #374151;
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        input[type="text"], 
        input[type="email"], 
        input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s ease;
            background: #f9fafb;
        }

        input[type="text"]:focus, 
        input[type="email"]:focus, 
        input[type="password"]:focus {
            outline: none;
            border-color: #4f46e5;
            background: white;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .register-btn {
            width: 100%;
            padding: 0.875rem;
            background: #4f46e5;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-bottom: 1.5rem;
        }

        .register-btn:hover {
            background: #3730a3;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .login-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .login-link:hover {
            color: #4f46e5;
        }

        .login-link a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .divider {
            margin: 1.5rem 0;
            position: relative;
            text-align: center;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            background: white;
            padding: 0 1rem;
            color: #9ca3af;
            font-size: 0.8rem;
        }

        /* Animation untuk form muncul */
        .register-container {
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .register-container {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            .logo {
                font-size: 1.8rem;
            }
        }

        /* Input icons */
        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1.1rem;
        }

        .input-group input {
            padding-left: 2.5rem;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo">Ngekos</div>
        <p class="subtitle">Buat akun baru Anda</p>
        
        <h1>Daftar Akun Baru</h1>

        @if ($errors->any())
            <div class="error-container">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <div class="input-group">
                    <span class="input-icon">👤</span>
                    <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required />
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                    <span class="input-icon">📧</span>
                    <input type="email" id="email" name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required />
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <span class="input-icon">🔒</span>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required />
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-group">
                    <span class="input-icon">🔒</span>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password" required />
                </div>
            </div>

            <button type="submit" class="register-btn">Daftar</button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <p class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </p>
    </div>
</body>
</html>