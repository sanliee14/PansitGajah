<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Produk | Mie Pansit Gajah Siantar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-blue-100 via-blue-200 to-white min-h-screen flex items-center justify-center font-sans text-gray-800">

  <div class="bg-white shadow-lg rounded-3xl w-full max-w-lg p-8">
    <div class="text-center mb-6">
      <img src="{{ asset('image/fix.png') }}" alt="Logo" class="w-20 h-20 mx-auto mb-3 rounded-full ring-4 ring-blue-200">
      <h2 class="text-2xl font-bold text-blue-600">Edit Produk</h2>
    </div>

    <form action="{{ url('/owner/update-produk/'.$product->Id_Product) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
      @csrf
      @method('PUT')

      <div>
        <label class="font-semibold text-gray-700">Nama Produk</label>
        <input type="text" name="Nama_Product" value="{{ $product->Nama_Product }}" required
               class="w-full px-4 py-2 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-400 outline-none">
      </div>

      <div>
        <label class="font-semibold text-gray-700">Harga</label>
        <input type="number" name="Harga" value="{{ $product->Harga }}" required
               class="w-full px-4 py-2 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-400 outline-none">
      </div>

      <div>
        <label class="font-semibold text-gray-700">Deskripsi</label>
        <textarea name="Deskripsi" rows="3"
                  class="w-full px-4 py-2 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-400 outline-none">{{ $product->Deskripsi }}</textarea>
      </div>

      <div>
        <label class="font-semibold text-gray-700">Gambar Produk</label>
        <div class="flex items-center gap-3 mt-2">
          @if($product->Image)
            <img src="{{ asset($product->Image) }}" class="w-20 h-20 object-cover rounded-lg border border-blue-200">
          @endif
          <input type="file" name="Image" accept="image/*"
                 class="w-full px-3 py-2 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-400 outline-none">
        </div>
      </div>

      <div class="flex justify-between mt-6">
        <a href="{{ route('owner.produk') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-5 py-2 rounded-full shadow">
          Batal
        </a>
        <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white px-6 py-2 rounded-full shadow">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>

</body>
</html>
