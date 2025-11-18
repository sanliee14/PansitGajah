@php
    $cart = Session::get('cart', []);
    $cartCount = 0;
    $cartTotal = 0;
    foreach ($cart as $id => $details) {
        $cartCount += $details['jumlah'];
        $cartTotal += $details['harga'] * $details['jumlah'];
    }
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Makanan | Mie Pansit Gajah Siantar</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="https://kit.fontawesome.com/a2e0a6c5f6.js" crossorigin="anonymous"></script>
</head>
<body class="bg-blue-200 font-sans text-gray-800 relative min-h-screen">

    <!-- Header -->
    <header class="relative w-full">
        <img src="{{ asset('image/5.jpeg') }}" alt="Background" class="w-full h-52 object-cover">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
            <img src="{{ asset('image/fix.png') }}" alt="Logo"
                class="w-20 h-20 rounded-full ring-4 ring-white shadow-lg mb-2 object-cover">
            <h1 class="text-2xl font-extrabold text-white tracking-wide drop-shadow-lg">Mie Pansit Gajah Siantar</h1>

            <!-- Search bar -->
            <div class="mt-4 flex items-center bg-white/90 rounded-full shadow-lg overflow-hidden w-80 sm:w-96">
                <input type="text" placeholder="Cari menu..."
                    class="flex-1 px-4 py-2 focus:outline-none bg-transparent text-gray-700">
                <button class="px-4 bg-blue-500 text-white hover:bg-blue-400 transition">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Bar Menu -->
    <nav class="relative z-30 flex justify-center mt-6">
    <div class="bg-blue-100/70 backdrop-blur-md p-4 px-6 rounded-3xl shadow-lg flex gap-10 justify-center items-center w-fit">
    
    <a href="{{ route('customer.fav') }}" class="flex flex-col items-center text-blue-600 hover:text-white hover:bg-blue-500 transition rounded-full w-16 h-16 bg-white shadow-md justify-center">
        <i class="fas fa-thumbs-up text-xl"></i>
        <span class="text-xs font-semibold mt-1">Favorit</span>
    </a>
    <a href="{{ route('customer.makanan') }}" class="flex flex-col items-center text-blue-600 hover:text-white hover:bg-blue-500 transition rounded-full w-16 h-16 bg-white shadow-md justify-center">
        <i class="fas fa-utensils text-xl"></i>
        <span class="text-xs font-semibold mt-1">Makanan</span>
    </a>
    <a href="{{ route('customer.minuman') }}" class="flex flex-col items-center text-blue-600 hover:text-white hover:bg-blue-500 transition rounded-full w-16 h-16 bg-white shadow-md justify-center">
        <i class="fas fa-coffee text-xl"></i>
        <span class="text-xs font-semibold mt-1">Minuman</span>
    </a>
</div>
</nav>

    <!-- Konten Menu -->
    <main class="flex mt-6 px-8 justify-center gap-8 pb-32"> 
        <section class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 max-w-6xl">
            
            @forelse ($products as $product)
            <div class="backdrop-blur-xl bg-white rounded-2xl p-3 shadow hover:shadow-blue-200 hover:scale-105 transition text-center">
                <img src="{{ asset('image/4.jpeg') }}" class="w-full h-36 object-cover rounded-xl mb-2">
                <h2 class="font-semibold text-gray-800 text-sm">{{ $product->Nama_Product }}</h2>
                <p class="text-gray-500 text-xs mb-2">Rp{{ number_format($product->Harga, 0, ',', '.') }}</p>
                <form action="{{ route('customer.cart.add', $product->Id_Product) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-blue-500 text-white text-sm py-1.5 rounded-lg hover:bg-blue-400 transition">
                        <i class="fas fa-cart-plus mr-1"></i>Pesan
                    </button>
                </form>
            </div>
            @empty
            <p class="col-span-full text-center text-gray-500">Belum ada menu.</p>
            @endforelse

        </section>
    </main>

    <div class="fixed bottom-0 left-0 w-full bg-white/95 backdrop-blur-md shadow-[0_-4px_10px_rgba(0,0,0,0.1)] px-6 py-3 flex items-center justify-between z-40">
        <div class="flex items-center gap-4">
            <div class="relative">
                <i class="fas fa-shopping-cart text-2xl text-blue-600"></i>
                <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold px-1.5 rounded-full">{{ $cartCount }}</span>
            </div>
            <div>
                <p class="text-gray-600 text-xs leading-tight">Total</p>
                <p id="cart-total" class="text-lg font-bold text-gray-800">Rp{{ number_format($cartTotal, 0, ',', '.') }}</p>
            </div>
        </div>

        <a href="{{ route('customer.checkout') }}" 
        class="bg-blue-500 hover:bg-blue-400 text-white font-semibold px-6 py-2 rounded-full shadow transition">
        Checkout
        </a>
    </div>
</body>
</html>