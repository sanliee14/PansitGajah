<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk & Riwayat Harga | Mie Pansit Gajah Siantar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-gradient-to-b from-blue-100 via-blue-200 to-white min-h-screen text-gray-800 flex flex-col">

  <!-- Navbar -->
  <nav class="bg-blue-500 text-white flex justify-between items-center px-6 py-3 shadow-lg">
    <div class="flex items-center space-x-3">
      <div class="relative w-10 h-10">
        <div class="absolute inset-0 bg-blue-400 blur-xl opacity-40 rounded-full"></div>
        <img src="{{ asset('image/fix.png') }}" alt="Logo" class="relative w-10 h-10 rounded-full ring-2 ring-white/70">
      </div>
      <h1 class="text-xl font-bold uppercase tracking-wide">Mie Pansit Gajah Siantar</h1>
    </div>
    <button class="bg-yellow-400 text-blue-900 font-semibold px-4 py-2 rounded-full shadow-md hover:bg-yellow-500 transition">
      Logout
    </button>
  </nav>

  <!-- Konten Utama -->
  <div class="flex flex-1">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-400 text-white min-h-screen p-6 shadow-xl">
      <h2 class="text-lg font-bold mb-6 text-white/90 uppercase tracking-wide">Menu Owner</h2>
      <ul class="space-y-4">
        <li><a href="{{ url('/owner/dashboard') }}" class="block py-2 px-3 rounded-full hover:bg-blue-300 hover:text-blue-900 transition"> Dashboard</a></li>
        <li><a href="{{ url('/owner/transaksi') }}" class="block py-2 px-3 rounded-full hover:bg-blue-300 hover:text-blue-900 transition"> Data Transaksi</a></li>
        <li><a href="{{ url('/owner/produk') }}" class="block bg-blue-500 py-2 px-3 rounded-full font-semibold text-center shadow hover:bg-blue-600 transition"> Produk & Harga</a></li>
        <li><a href="{{ url('/owner/laporan') }}" class="block py-2 px-3 rounded-full hover:bg-blue-300 hover:text-blue-900 transition"> Laporan Harian</a></li>
        <li><a href="{{ url('/owner/tambah-produk') }}" class="block py-2 px-3 rounded-full hover:bg-blue-300 hover:text-blue-900 transition"> Tambah Produk</a></li>
      </ul>
    </aside>

    <!-- Konten Produk -->
    <main class="flex-1 p-8">

      <!-- Judul -->
      <h2 class="text-3xl font-extrabold bg-gradient-to-r from-blue-600 to-blue-400 text-transparent bg-clip-text mb-8">
        Produk & Riwayat Harga
      </h2>

      <!-- Tombol Tambah -->
      <div class="mb-6 flex justify-end">
        <a href="{{ url('/owner/tambah-produk') }}" 
          class="bg-blue-500 text-white px-5 py-2 rounded-full shadow-md hover:bg-blue-400 transition font-semibold">
           Tambah Produk
        </a>
      </div>

      <!-- Tabel Produk -->
      <div class="overflow-x-auto rounded-2xl shadow-lg border border-blue-100 bg-white">
        <table class="min-w-full rounded-lg">
          <thead class="bg-blue-500 text-white">
            <tr>
              <th class="py-3 px-4 text-left">Gambar</th>
              <th class="py-3 px-4 text-left">ID Produk</th>
              <th class="py-3 px-4 text-left">Nama Produk</th>
              <th class="py-3 px-4 text-left">Harga</th>
              <th class="py-3 px-4 text-left">Deskripsi</th>
              <th class="py-3 px-4 text-left">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($products as $item)
              <tr class="border-b hover:bg-blue-50">
                <td class="py-3 px-4">
                  @if($item->Image)
                    <img src="{{ asset($item->Image) }}" alt="Produk" class="w-16 h-16 object-cover rounded-lg shadow-sm border border-blue-100">
                  @else
                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-sm italic">No Img</div>
                  @endif
                </td>
                <td class="py-3 px-4">{{ $item->Id_Product }}</td>
                <td class="py-3 px-4 font-semibold text-gray-700">{{ $item->Nama_Product }}</td>
                <td class="py-3 px-4 text-blue-600 font-bold">Rp {{ number_format($item->Harga, 2, ',', '.') }}</td>
                <td class="py-3 px-4 text-gray-600">{{ Str::limit($item->Deskripsi, 40, '...') }}</td>
                <td class="py-3 px-4 flex space-x-2">
                  <button class="bg-yellow-400 text-white px-3 py-1 rounded-full hover:bg-yellow-500 transition">Edit</button>
                  <button class="bg-blue-400 text-white px-3 py-1 rounded-full hover:bg-blue-500 transition">Riwayat</button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="py-6 text-center text-gray-500">Belum ada produk ditambahkan.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pesan sukses -->
      @if (session('success'))
        <div class="mt-6 bg-green-100 text-green-700 px-4 py-2 rounded-lg shadow-sm border border-green-200">
          {{ session('success') }}
        </div>
      @endif

    </main>
  </div>

  <!-- Footer -->
  <footer class="py-4 text-center text-gray-500 text-sm mt-auto">
    © {{ date('Y') }} Mie Pansit Gajah Siantar. Semua hak dilindungi.
  </footer>

</body>
</html>

