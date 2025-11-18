<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemesan</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white flex flex-col items-center justify-center min-h-screen font-sans text-gray-800">

    <!-- Kotak transparan blur -->
    <div class="bg-blue-300 border border-white/30 rounded-3xl shadow-2xl p-8 w-90 text-center">
        <div class="flex justify-center mb-4">
            <div class="relative w-20 h-20">
                <img src="{{ asset('image/fix.png') }}" alt="Logo"
                    class="w-full h-full object-cover rounded-full shadow-lg ring-4 ring-white/70">
            </div>
        </div>

        <h1 class="text-3xl font-extrabold tracking-wide uppercase mt-4 mb-4 bg-white text-transparent bg-clip-text drop-shadow-sm">
            Mie Pansit Gajah Siantar
        </h1>
        <form action="{{ route('customer.data.store') }}" method="POST" class="space-y-4">
            @csrf 

            <input type="text" name="nama" placeholder="Nama Anda" required
                   value="{{ old('nama') }}"
                   class="w-full px-4 py-3 rounded-xl bg-white/30 text-black placeholder-gray focus:outline-none focus:ring-2 focus:ring-blue-300">
            @error('nama')
                <p class="text-red-600 text-xs text-left">{{ $message }}</p>
            @enderror

            <input type="number" name="no_meja" placeholder="Nomor Meja" required
                   value="{{ old('no_meja') }}"
                   class="w-full px-4 py-3 rounded-xl bg-white/30 text-black placeholder-gray focus:outline-none focus:ring-2 focus:ring-blue-300">
            @error('no_meja')
                <p class="text-red-600 text-xs text-left">{{ $message }}</p>
            @enderror

            <button type="submit"
                    class="w-full mt-2 bg-blue-500 hover:bg-blue-400 text-white font-semibold py-3 rounded-full shadow-lg transition-all duration-300 hover:scale-105">
                NEXT
            </button>
        </form>
    </div>

    <p class="absolute bottom-8 text-xs text-gray-800">
        © {{ date('Y') }} Mie Pansit Gajah Siantar. Semua hak dilindungi.
    </p>

</body>
</html>