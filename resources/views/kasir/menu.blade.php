@extends('layouts.kasir')

@section('title', 'Manajemen Menu')

@section('content')
    <div class="w-full max-w-5xl">
        <!-- Form Tambah Menu -->
        <form action="{{ route('kasir.menu.store') }}" method="POST" class="mb-6 bg-white/50 backdrop-blur-md p-6 rounded-2xl shadow-lg">
            @csrf 
            
            <h3 class="text-xl font-semibold mb-4 text-blue-700">Tambah Menu Baru</h3>
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                    <strong class="font-bold">Oops! Ada kesalahan:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nama_menu" class="block text-sm font-medium text-gray-700">Nama Menu</label>
                    <input type="text" name="nama_menu" id="nama_menu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('nama_menu') }}" required>
                </div>
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" name="harga" id="harga" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('harga') }}" required>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    + Tambah Menu
                </button>
            </div>
        </form>

        <!-- Tabel Daftar Menu -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white/50 backdrop-blur-md">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50/50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Menu</th>
                        <th scope="col" class="px-6 py-3">Harga</th>
                        <th scope="col" class="px-6 py-3">Deskripsi</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($menus as $menu)
                    <tr class="bg-white/50 border-b hover:bg-gray-50/50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $menu->Nama_Product }}
                        </th>
                        <td class="px-6 py-4">Rp {{ number_format($menu->Harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ $menu->Deskripsi }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                            <form action="#" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Belum ada data menu.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('layouts.nav')
@endsection