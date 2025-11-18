@extends('layouts.kasir')

@section('title', 'Detail History')

@section('content')
    <div class="w-full max-w-2xl bg-white/50 backdrop-blur-md p-6 rounded-2xl shadow-lg">

        <a href="{{ route('kasir.history') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke History
        </a>

        <h2 class="text-2xl font-bold text-blue-700 mb-4">Detail History #{{ $order->Id_Cart }}</h2>

        <!-- Info Pesanan -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Informasi Pemesan</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <dt class="font-medium text-gray-500">Nama</dt>
                    <dd class="text-lg font-semibold text-gray-900">{{ $order->Nama }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-gray-500">Nomor Meja</dt>
                    <dd class="text-lg font-semibold text-gray-900">{{ $order->No_Meja }}</dd>
                </div>
                 <div>
                    <dt class="font-medium text-gray-500">Status</dt>
                    <dd class="text-lg font-semibold text-green-600">{{ ucfirst($order->Status) }}</dd>
                </div>
                 <div>
                    <dt class="font-medium text-gray-500">Tgl Selesai</dt>
                    <dd class="text-lg font-semibold text-gray-900">
                         {{ $order->updated_at ? \Carbon\Carbon::parse($order->updated_at)->format('d M Y, H:i') : 'N/A' }}
                    </dd>
                </div>
            </div>
        </div>

        <!-- Daftar Item Pesanan -->
        <h3 class="text-xl font-semibold mb-2">Item Pesanan</h3>
        <div class="flow-root mb-6">
            <ul role="list" class="-my-6 divide-y divide-gray-200">
                @forelse($items as $item)
                <li class="flex py-6">
                    <div class="ml-4 flex flex-1 flex-col">
                        <div>
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <h3>{{ $item->nama }}</h3>
                                <p class="ml-4">Rp {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Jumlah: {{ $item->jumlah }}</p>
                    </div>
                </li>
                @empty
                <p class="text-gray-500">Item untuk pesanan ini tidak ditemukan.</p>
                @endforelse
            </ul>
        </div>

        <!-- Total -->
        <div class="border-t border-gray-200 pt-6">
            <div class="flex justify-between text-xl font-medium text-gray-900 mb-4">
                <p>Subtotal</p>
                <p>Rp {{ number_format($order->Subtotal, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
@endsection