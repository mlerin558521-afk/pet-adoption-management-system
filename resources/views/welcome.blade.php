<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet Adoption Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="font-family: sans-serif; min-height: 100vh; display: flex; flex-direction: column; background-color: #f5ede8; margin: 0;">

    <header style="background: #7d4a3f; position: relative; z-index: 10; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px; display: flex; justify-content: space-between; align-items: center; height: 64px;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <img src="{{ asset('pams/paw.png') }}" alt="Logo" style="width: 36px; height: 36px; filter: brightness(0) invert(1);">
                <span style="font-weight: 800; font-size: 18px; color: white; letter-spacing: 2px; text-transform: uppercase;">Pet Adoption Center</span>
            </div>
            <div style="display: flex; gap: 24px; align-items: center;">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    @endif
                @endif
            </div>
        </div>
    </header>

    <main style="flex: 1; position: relative; overflow: hidden; display: flex; align-items: center; min-height: calc(100vh - 128px);">

        <div style="position: absolute; right: -60px; top: 50%; transform: translateY(-50%);
                    width: 620px; height: 620px; background: #c9937a; border-radius: 50%; opacity: 0.45; z-index: 0;">
        </div>
        <div style="position: absolute; right: 80px; top: 50%; transform: translateY(-50%);
                    width: 460px; height: 460px; background: #d4a892; border-radius: 50%; opacity: 0.5; z-index: 0;">
        </div>

        <div style="position: absolute; right: 0; bottom: 0; z-index: 1;">
            <img src="{{ asset('pams/pet.png') }}" alt="Pets" style="height: 88vh; max-width: 720px; object-fit: contain; object-position: bottom;">
        </div>

        <div style="position: relative; z-index: 2; max-width: 500px; padding: 48px; margin-left: 80px;">
            <h1 style="font-size: 44px; font-weight: 800; color: #1f2937; margin-bottom: 20px; line-height: 1.15;">
                Find Your New<br>Best Friend
            </h1>
            <p style="font-size: 17px; color: #374151; margin-bottom: 12px; line-height: 1.7;">
                Welcome to the Pet Adoption Management System — where love meets a forever home.
            </p>
            <p style="font-size: 15px; color: #6b7280; margin-bottom: 40px; line-height: 1.7;">
                Browse adorable pets, manage adoption requests, and help give them the family they deserve.
            </p>
            <div style="display: flex; gap: 16px; flex-wrap: wrap; align-items: center;">
                <a href="{{ route('login') }}" class="btn-primary">Get Started</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-outline">Join Us</a>
                @endif
            </div>
        </div>

    </main>

    <footer style="background: #7d4a3f; position: relative; z-index: 10; box-shadow: 0 -2px 8px rgba(0,0,0,0.1);">
        <div style="max-width: 1200px; margin: 0 auto; padding: 20px 24px; text-align: center; color: rgba(255,255,255,0.8); font-size: 14px;">
            © {{ date('Y') }} Pet Adoption Center. All rights reserved.
        </div>
    </footer>
    <style>
        .btn-primary {
            padding: 12px 28px;
            background: #7d4a3f;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: background 0.2s, transform 0.1s;
            display: inline-block;
        }
        .btn-primary:hover {
            background: #5c332b;
            transform: translateY(-2px);
        }
        .btn-outline {
            padding: 12px 28px;
            background: transparent;
            color: #7d4a3f;
            border: 2px solid #7d4a3f;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: background 0.2s, color 0.2s, transform 0.1s;
            display: inline-block;
        }
        .btn-outline:hover {
            background: #7d4a3f;
            color: white;
            transform: translateY(-2px);
        }
        .nav-link {
            color: white;
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            padding: 6px 4px;
            border-bottom: 2px solid transparent;
            transition: border-color 0.2s;
        }
        .nav-link:hover {
            border-bottom: 2px solid rgba(255,255,255,0.8);
        }
    </style>
</body>
</html>