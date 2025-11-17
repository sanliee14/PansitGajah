{{-- Ini adalah komponen navigasi bawah --}}
<nav class="fixed bottom-0 left-0 w-full bg-white/90 backdrop-blur-md shadow-[0_-4px_10px_rgba(0,0,0,0.1)] py-3 px-8 flex justify-around items-center z-50">

    <!-- menu -->
    <a href="{{ route('kasir.menu') }}"
       class="flex flex-col items-center transition w-16 h-16 justify-center 
       {{-- Logika untuk highlight link aktif --}}
       {{ request()->routeIs('kasir.menu') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
        <i class="fas fa-utensils text-xl"></i>
        <span class="text-xs font-semibold mt-1">Menu</span>
    </a>

    <!-- acc pesanan -->
    <a href="{{ route('kasir.accpesanan') }}"
       class="flex flex-col items-center transition w-16 h-16 justify-center
       {{ request()->routeIs('kasir.accpesanan') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
        <i class="fas fa-check-circle text-xl"></i>
        <span class="text-xs font-semibold mt-1">Acc</span>
    </a>

    <!-- history -->
    <a href="{{ route('kasir.history') }}"
       class="flex flex-col items-center transition w-16 h-16 justify-center
       {{ request()->routeIs('kasir.history*') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
        <i class="fas fa-history text-xl"></i>
        <span class="text-xs font-semibold mt-1">History</span>
    </a>

    <!-- Logout -->
    <form action="{{ route('kasir.logout') }}" method="POST" class="flex items-center justify-center w-16 h-16">
        @csrf
        <button type="submit" class="flex flex-col items-center text-gray-600 hover:text-red-600 transition">
            <i class="fas fa-sign-out-alt text-xl"></i>
            <span class="text-xs font-semibold mt-1">Logout</span>
        </button>
    </form>
</nav>