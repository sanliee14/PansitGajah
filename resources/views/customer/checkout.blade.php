@php
    $cartItems = Session::get('cart', []);
    $customerName = Session::get('customer_nama', 'Customer');
    $customerMeja = Session::get('customer_meja', '-');
    
    $cartTotal = 0;
    foreach ($cartItems as $id => $details) {
        $cartTotal += $details['harga'] * $details['jumlah'];
    }
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran | Mie Pansit Gajah Siantar</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/a2e0a6c5f6.js" crossorigin="anonymous"></script>
</head>
<body class="bg-blue-100 font-sans text-gray-800 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-blue-500 text-white py-4 px-6 shadow-md">
        <h1 class="text-lg font-bold">Pesanan Anda</h1>
        <p class="text-sm">{{ $customerName }} | Nomor Meja : {{ $customerMeja }}</p>
    </header>

    <!-- Konten Pesanan -->
    <main class="flex-1 overflow-y-auto px-5 py-4 space-y-4">

        <!-- Tombol Tambah Pesanan -->
        <a href="{{ route('customer.makanan') }}"
            class="block text-center w-full bg-white text-sm font-semibold text-blue-800 hover:text-blue-600 py-3 rounded-2xl shadow">
            <i class="fas fa-plus mr-2"></i>Tambah Pesanan
        </a>

        @forelse ($cartItems as $id => $item)
        <div class="bg-blue-200 rounded-2xl p-4 relative">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ $item['gambar'] ?? asset('image/4.jpeg') }}" alt="Menu" class="w-16 h-16 rounded-xl object-cover">
                    <div>
                        <p class="font-semibold text-gray-800">{{ $item['nama'] }}</p>
                        <p class="text-sm text-gray-700">Rp{{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- Tombol interaktif (+/-) --}}
                <div class="flex items-center gap-2">
                    <!-- Tombol Kurang (-) -->
                    <form action="{{ route('customer.cart.decrease', $id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white font-bold w-7 h-7 rounded-full flex items-center justify-center shadow hover:bg-red-600 transition">-</button>
                    </form>
                    
                    <!-- Jumlah -->
                    <span class="font-semibold text-gray-800 px-2">{{ $item['jumlah'] }}</span>
                    
                    <!-- Tombol Tambah (+) -->
                    <form action="{{ route('customer.cart.increase', $id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white font-bold w-7 h-7 rounded-full flex items-center justify-center shadow hover:bg-green-600 transition">+</button>
                    </form>

                    <!-- Tombol Hapus (X) -->
                    <form action="{{ route('customer.cart.remove', $id) }}" method="POST" class="ml-2">
                        @csrf
                        <button type="submit" class="bg-gray-400 text-white font-bold w-7 h-7 rounded-full flex items-center justify-center shadow hover:bg-gray-500 transition" title="Hapus item">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl p-4 text-center text-gray-500">
            Keranjang Anda kosong.
        </div>
        @endforelse

        <!-- Catatan -->
        <div class="bg-blue-200 rounded-2xl p-4">
            <label class="block text-sm font-semibold mb-1">Catatan Tambahan</label>
            <textarea class="w-full rounded-lg p-2 text-sm border-none focus:ring-2 focus:ring-blue-400" rows="2"
            placeholder="Contoh: tanpa sambal, bungkus terpisah..."></textarea>
        </div>

        <!-- Pembayaran -->
        <div class="bg-blue-200 rounded-2xl p-4 flex justify-between items-center font-semibold">
            <span>Pilihan Pembayaran</span>
            <select class="bg-transparent font-semibold text-right focus:outline-none">
                <option>Cash</option>
                <option>Qris</option>
            </select>
        </div>
    </main>

    <!-- Footer Total -->
    <footer class="bg-blue-500 text-white px-6 py-4 flex justify-between items-center shadow-[0_-4px_10px_rgba(0,0,0,0.1)]">
        <div>
            <p class="text-sm">Total</p>
            {{-- Tampilkan total asli --}}
            <p class="text-lg font-bold">Rp{{ number_format($cartTotal, 0, ',', '.') }}</p>
        </div>
        <a href="{{ route('customer.qris') }}"
        class="bg-yellow-400 hover:bg-yellow-300 text-black font-bold px-6 py-2 rounded-full transition">
        Bayar
        </a>
    </footer>

</body>
</html>