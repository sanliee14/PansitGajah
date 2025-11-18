<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Transaksi | Mie Pansit Gajah Siantar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="bg-gradient-to-b from-blue-100 via-blue-200 to-white min-h-screen text-gray-800 flex flex-col">

  <!-- Navbar -->
  <nav class="bg-blue-500 text-white flex justify-between items-center px-6 py-3 shadow-lg">
    <div class="flex items-center space-x-3">
      <img src="{{ asset('image/fix.png') }}" alt="Logo" class="w-10 h-10 rounded-full ring-2 ring-white/70">
      <h1 class="text-xl font-bold uppercase tracking-wide">Mie Pansit Gajah Siantar</h1>
    </div>
    <button class="bg-yellow-400 text-blue-900 font-semibold px-4 py-2 rounded-full shadow-md hover:bg-yellow-500 transition">Logout</button>
  </nav>

  <!-- Konten Utama -->
  <div class="flex flex-1">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-400 text-white min-h-screen p-6 shadow-xl">
      <h2 class="text-lg font-bold mb-6 text-white/90 uppercase tracking-wide">Menu Owner</h2>
      <ul class="space-y-4">
        <li><a href="{{ url('/owner/dashboard') }}" class="block py-2 px-3 rounded-full hover:bg-blue-300 hover:text-blue-900 transition"> Dashboard</a></li>
        <li><a href="{{ url('/owner/transaksi') }}" class="block bg-blue-500 py-2 px-3 rounded-full font-semibold text-center shadow hover:bg-blue-600 transition"> Data Transaksi</a></li>
        <li><a href="{{ url('/owner/product') }}" class="block py-2 px-3 rounded-full hover:bg-blue-300 hover:text-blue-900 transition"> Product & Harga</a></li>
        <li><a href="{{ url('/owner/laporan') }}" class="block py-2 px-3 rounded-full hover:bg-blue-300 hover:text-blue-900 transition"> Laporan Harian</a></li>
        <li><a href="{{ url('/owner/tambahproduct') }}" class="block py-2 px-3 rounded-full hover:bg-blue-300 hover:text-blue-900 transition"> Tambah Produk</a></li>
      </ul>
    </aside>

    <!-- Konten -->
    <main class="flex-1 p-8">
      <h2 class="text-3xl font-extrabold bg-gradient-to-r from-blue-600 to-blue-400 text-transparent bg-clip-text mb-8">
        Data Transaksi
      </h2>

      <div class="overflow-x-auto bg-white rounded-3xl shadow-lg border border-blue-100">
        <table class="min-w-full rounded-lg">
     <thead class="bg-blue-500 text-white">
  <tr>
    <th class="py-3 px-4 text-left">ID Transaksi</th>
    <th class="py-3 px-4 text-left">Tanggal Transaksi</th>
    <th class="py-3 px-4 text-left">Total</th>
    <th class="py-3 px-4 text-left">Harga Lama</th>
    <th class="py-3 px-4 text-left">Harga Baru</th>
    <th class="py-3 px-4 text-left">Jumlah Transaksi</th>
  </tr>
     </thead>
     <tbody>
      @forelse ($transaksi as $trx)
       <tr class="border-b hover:bg-blue-50">
       <td class="py-3 px-4">{{ $trx->Id_Transaction_Log }}</td>
      <td class="py-3 px-4">{{ $trx->Tanggal_Transaksi }}</td>
      <td class="py-3 px-4 text-blue-600 font-bold">Rp {{ number_format($trx->Total, 2, ',', '.') }}</td>
      <td class="py-3 px-4 text-gray-600">
        {{ $trx->Harga_Lama ? 'Rp ' . number_format($trx->Harga_Lama, 2, ',', '.') : '-' }}
      </td>
      <td class="py-3 px-4 text-gray-600">
        {{ $trx->Harga_Baru ? 'Rp ' . number_format($trx->Harga_Baru, 2, ',', '.') : '-' }}
      </td>
      <td class="py-3 px-4">{{ $trx->Jumlah_Transaksi }}</td>
    </tr>
     @empty
     <tr>
      <td colspan="6" class="py-6 text-center text-gray-500">Belum ada data transaksi</td>
     </tr>
     @endforelse
     </tbody>
        </table>
      </div>
    </main>
  </div>

  <footer class="py-4 text-center text-gray-500 text-sm mt-auto">
    © {{ date('Y') }} Mie Pansit Gajah Siantar. Semua hak dilindungi.
  </footer>
</body>
</html>