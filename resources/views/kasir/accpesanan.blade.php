@extends('layouts.kasir')

@section('title', 'Akses Pesanan')

@section('content')
    <h2 class="text-xl font-bold text-blue-700">Selamat Datang, Kasir!</h2>
    <p class="text-gray-600 mt-2 text-sm text-center">Berikut adalah daftar pesanan yang perlu diproses.</p>

    <div class="mt-8 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5 max-w-5xl">
        
        @forelse ($semuaPesanan as $pesanan)
        <div class="bg-white rounded-2xl p-4 shadow hover:shadow-blue-200 hover:scale-105 transition text-center backdrop-blur-md">
            
            <img src="{{ asset('image/4.jpeg') }}" class="w-full h-32 object-cover rounded-xl mb-2">
            
            <h3 class="font-semibold text-gray-800 text-sm">Meja #{{ $pesanan->No_Meja }}</h3>
            <p class="text-gray-500 text-xs mb-1">Pemesan: {{ $pesanan->Nama }}</p>
            <p class="text-gray-500 text-xs mb-2">Total: Rp {{ number_format($pesanan->Subtotal, 0, ',', '.') }}</p>

            {{-- Link ini akan ke halaman 'prosespesanan' --}}
            <a href="{{ route('kasir.prosespesanan', $pesanan->Id_Cart) }}" 
               class="inline-block bg-blue-500 text-white text-sm py-1.5 px-4 rounded-lg hover:bg-blue-400 transition">
                Lihat Detail
            </a>
        </div>

        @empty
        <div class="col-span-full text-center py-10">
            <p class="text-gray-500 text-lg">Tidak ada pesanan baru.</p>
        </div>
        @endforelse
        
    </div>

    @include('layouts.nav')
@endsection