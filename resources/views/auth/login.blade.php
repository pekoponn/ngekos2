<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Ngekos</title>
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

        .login-container {
            background: white;
            padding: 3rem;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
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

        input[type="email"]:focus, 
        input[type="password"]:focus {
            outline: none;
            border-color: #4f46e5;
            background: white;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .login-btn {
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

        .login-btn:hover {
            background: #3730a3;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .register-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .register-link:hover {
            color: #4f46e5;
        }

        .register-link a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
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
        .login-container {
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
            .login-container {
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
    <div class="login-container">
        <div class="logo">Ngekos</div>
        <p class="subtitle">Masuk ke akun Anda</p>

        <h1>Login</h1>

        @if ($errors->any()) 
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                    <span class="input-icon">📧</span>
                    <input id="email" name="email" type="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <span class="input-icon">🔒</span>
                    <input id="password" name="password" type="password" placeholder="Masukkan password Anda" required>
                </div>
            </div>

            <button type="submit" class="login-btn">Masuk</button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <p class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </p>
    </div>
</body>
</html>