<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Figtree', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f5ede8;
        }
        header {
            background: #7d4a3f;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            z-index: 10;
        }
        header .inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 64px;
        }
        header a {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        header span {
            font-weight: 800;
            font-size: 18px;
            color: white;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 40px 16px;
        }
        .blob1 {
            position: absolute;
            right: -60px;
            top: 50%;
            transform: translateY(-50%);
            width: 620px;
            height: 620px;
            background: #c9937a;
            border-radius: 50%;
            opacity: 0.45;
            z-index: 0;
        }
        .blob2 {
            position: absolute;
            right: 80px;
            top: 50%;
            transform: translateY(-50%);
            width: 460px;
            height: 460px;
            background: #d4a892;
            border-radius: 50%;
            opacity: 0.5;
            z-index: 0;
        }
        .pet-img {
            position: absolute;
            right: 0;
            bottom: 0;
            z-index: 1;
        }
        .pet-img img {
            height: 88vh;
            max-width: 720px;
            object-fit: contain;
            object-position: bottom;
        }
        .card {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 32px rgba(125, 74, 63, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        .card-title {
            font-size: 26px;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 6px;
        }
        .card-subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 28px;
        }
        footer {
            background: #7d4a3f;
            box-shadow: 0 -2px 8px rgba(0,0,0,0.1);
            z-index: 10;
        }
        footer .inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 24px;
            text-align: center;
            color: rgba(255,255,255,0.8);
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="inner">
            <a href="/">
                <img src="{{ asset('pams/paw.png') }}" alt="Logo" style="width:36px;height:36px;filter:brightness(0) invert(1);">
                <span>Pet Adoption Center</span>
            </a>
        </div>
    </header>

    <!-- Main -->
    <main>
        <div class="blob1"></div>
        <div class="blob2"></div>

        <div class="pet-img">
            <img src="{{ asset('pams/pet.png') }}" alt="Pets">
        </div>

        <div class="card">
            <div class="card-title">Welcome back 🐾</div>
            <div class="card-subtitle">Sign in to your account to continue</div>
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="inner">
            © {{ date('Y') }} Pet Adoption Center. All rights reserved.
        </div>
    </footer>

</body>
</html>