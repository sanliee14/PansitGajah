<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mie Pansit Gajah Siantar</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gradient-to-b from-blue-100 via-blue-200 to-white flex flex-col items-center justify-center min-h-screen font-sans text-gray-800">

    <!-- Wrapper utama -->
    <div class="text-center p-6 max-w-3xl mx-auto">

        <!-- Logo dan judul -->
        <div class="flex flex-col items-center mb-8">
            <div class="relative w-28 h-28">
            <div class="absolute inset-0 bg-blue-400 blur-2xl opacity-30 rounded-full"></div>
        <img src="{{ asset('image/fix.png') }}" alt="Logo"
            class="relative w-28 h-28 object-cover rounded-full shadow-lg ring-4 ring-white/70 transition-transform duration-300 hover:scale-110">
        </div>
        <h1 class="text-3xl font-extrabold tracking-wide uppercase mt-4 bg-gradient-to-r from-blue-600 to-blue-400 text-transparent bg-clip-text drop-shadow-sm">
        Mie Pansit Gajah Siantar
        </h1>
        <!-- <p class="mt-2 text-gray-600 italic text-sm">Rasa legendaris dari Siantar, kini hadir untukmu!</p> -->
    </div>

        <!-- Gambar Produk -->
        <!-- <div class="w-full mb-8">
            <img src="{{ asset('image/5.jpeg') }}" alt="Mie Pansit" 
                class="w-full rounded-3xl shadow-2xl object-cover   hover:shadow-blue-500/30">
        </div> -->

        <!-- Tombol ORDER -->
        <a href="{{ url('/customer/data') }}" 
            class="inline-block bg-blue-500 text-white font-bold py-3 px-10 rounded-full shadow-lg hover:shadow-blue-400/60 hover:from-blue-500 hover:to-blue-300 transform hover:-translate-y-1 transition-all duration-300">
            PESAN SEKARANG 🍜
        </a>

        <!-- Footer kecil -->
        <p class="mt-8 text-xs text-gray-500">© {{ date('Y') }} Mie Pansit Gajah Siantar. Semua hak dilindungi.</p>
    </div>

</body>
</html>
