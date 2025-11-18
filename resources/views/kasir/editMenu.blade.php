@extends('layouts.kasir')

@section('title', 'Edit Menu')

@section('content')
<div class="w-full max-w-2xl mx-auto">
    <a href="{{ route('kasir.menu') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Menu
    </a>

    <div class="bg-white/50 backdrop-blur-md p-6 rounded-2xl shadow-lg">
        <h3 class="text-xl font-semibold mb-4 text-blue-700">Edit Menu</h3>

        <form action="{{ route('kasir.updateMenu', $menu->Id_Product) }}" method="POST">
            @csrf
            @method('PUT') {{-- Penting untuk Update data --}}

            <div class="mb-4">
                <label for="nama_menu" class="block text-sm font-medium text-gray-700">Nama Menu</label>
                <input type="text" name="nama_menu" id="nama_menu" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                    value="{{ old('nama_menu', $menu->Nama_Product) }}" required>
            </div>

            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="harga" id="harga" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                    value="{{ old('harga', $menu->Harga) }}" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection