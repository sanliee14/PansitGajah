<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Judul halamannya akan dinamis --}}
    <title>@yield('title') | Mie Pansit Gajah Siantar</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-blue-100 font-sans text-gray-800 relative min-h-screen pb-24">

    <!-- Header (Sama untuk semua halaman) -->
    <header class="relative w-full">
        <img src="{{ asset('image/5.jpeg') }}" alt="Background" class="w-full h-48 object-cover">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
            <img src="{{ asset('image/fix.png') }}" alt="Logo"
                class="w-20 h-20 rounded-full ring-4 ring-white shadow-lg mb-2 object-cover">
            <h1 class="text-2xl font-extrabold text-white tracking-wide drop-shadow-lg">Kasir - Mie Pansit Gajah</h1>
        </div>
    </header>

    <!-- Konten Halaman (Ini yang akan berubah-ubah) -->
    <main class="mt-8 flex flex-col items-center px-6">
        @yield('content')
    </main>

    <!-- Copyright Footer -->
    <p class="absolute bottom-8 text-xs text-gray-800 left-0 right-0 text-center">
        © {{ date('Y') }} Mie Pansit Gajah Siantar. Semua hak dilindungi.
    </p>

    <!-- Font Awesome (Sama untuk semua halaman) -->
    <script src="https://kit.fontawesome.com/a2e0a6c5f6.js" crossorigin="anonymous"></script>
</body>
</html>