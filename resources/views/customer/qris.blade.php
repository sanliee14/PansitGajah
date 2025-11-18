<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran QRIS | Mie Pansit Gajah Siantar</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-100 font-sans text-gray-800 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-blue-500 text-white py-4 px-6 shadow-md">
        <h1 class="text-lg font-bold">Pembayaran QRIS</h1>
        <p class="text-sm">Silakan lakukan pembayaran sesuai total pesanan Anda</p>
    </header>

    <!-- Konten Utama -->
    <main class="flex-1 flex flex-col items-center justify-center px-6 py-8 space-y-6">

        <!-- Kartu QRIS -->
        <div class="bg-white rounded-2xl shadow-lg p-6 text-center w-full max-w-sm">
            <h2 class="text-lg font-bold text-blue-700 mb-3">Scan QRIS untuk Membayar</h2>
            <img src="{{ asset('image/qris.png') }}" alt="QRIS" class="w-60 h-60 mx-auto rounded-lg shadow-md mb-4">

            <!-- Tombol Simpan -->
            <a href="{{ asset('image/qris.png') }}" download="QRIS_MiePansitGajahSiantar.png"
            class="inline-block bg-blue-500 text-white font-semibold px-4 py-2 rounded-full hover:bg-blue-400 transition">
            Simpan QRIS
            </a>
        </div>

        <!-- Form Upload Bukti -->
        <div class="bg-blue-200/80 rounded-2xl p-5 w-full max-w-sm shadow-lg">
            <h3 class="font-bold text-gray-800 mb-2">Upload Bukti Pembayaran</h3>
            
            <form action="{{ route('customer.proses') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg text-sm" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @if (Session::has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg text-sm" role="alert">
                        <p>{{ Session::get('error') }}</p>
                    </div>
                @endif

                <input type="file" name="bukti_pembayaran" accept="image/*" required 
                       class="w-full p-2 bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200">
                
                <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-400 text-white font-semibold py-2 rounded-full transition">
                    Kirim Bukti Pembayaran
                </button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white text-center py-3 text-sm shadow-[0_-4px_10px_rgba(0,0,0,0.1)]">
        © {{ date('Y') }} Mie Pansit Gajah Siantar — Pembayaran Aman dengan QRIS
    </footer>

</body>
</html>