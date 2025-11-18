@extends('layouts.kasir')

@section('title', 'History Pesanan')

@section('content')
    <div class="w-full max-w-5xl">
        <h2 class="text-xl font-bold text-blue-700 mb-6 text-center">History Pesanan Selesai</h2>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white/50 backdrop-blur-md">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50/50">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID Pesanan</th>
                        <th scope="col" class="px-6 py-3">Nama Pemesan</th>
                        <th scope="col" class="px-6 py-3">No. Meja</th>
                        <th scope="col" class="px-6 py-3">Total</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr class="bg-white/50 border-b hover:bg-gray-50/50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            #{{ $order->Id_Cart }}
                        </th>
                        
                        
                        <td class="px-6 py-4">{{ $order->Nama }}</td>
                        <td class="px-6 py-4">{{ $order->No_Meja }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($order->Subtotal, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('kasir.history.detail', $order->Id_Cart) }}" class="font-medium text-blue-600 hover:underline">Lihat Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Belum ada history pesanan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('layouts.nav')
@endsection