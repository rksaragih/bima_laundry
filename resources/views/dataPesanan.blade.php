    <html lang="en">
    <head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>
    Bima Laundry - Data Pesanan
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
        theme: {
            extend: {
            colors: {
                biruBima: '#6FBcFF',
            },
            },
        },
        };
    </script>

    <style>
      [x-cloak] {
          display: none !important;
      }
    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    </head>

    <body class="bg-gray-100">
    <div class="flex">

    <!-- ini sidebar -->
    <div class="w-1/5 bg-white h-screen shadow-lg">
        <div class="p-6" x-data="{ openModalPengeluaran : false }">
          <div class="flex items-center mb-8">
            <a href="{{ Auth::user()->role === 'Admin' ? route('index') : route('dataPesanan') }}">
              <img
                alt="Logo"
                class="mr-3"
                src="images/logo-bima-laundry-hitam.png"
              />
            </a>
          </div>
          <ul>
            @if(Auth::user()->role === 'Admin')
            <li class="mb-4">
              <a class="flex items-center gap-4 text-gray-700" href="{{ route('index') }}">
                <i class="fa-solid fa-table-columns fa-fw"></i>
                Dashboard
              </a>
            </li>
            @endif
            <li class="mb-4">
              <a
                class="flex items-center gap-4 text-biruBima"
                href="{{ route('dataPesanan') }}"
              >
                <i class="fas fa-file-alt fa-fw"></i>
                Pesanan
              </a>
            </li>
            <li class="mb-4">
              <a
                class="flex items-center gap-4 text-gray-700"
                href="{{ route('pelanggan.index') }}"
              >
               <i class="fas fa-users fa-fw"></i>
                Pelanggan
              </a>
            </li>
            <li class="mb-4">
              <a class="flex items-center gap-4 text-gray-700" href="{{ route('layanan.index') }}">
                <i class="fas fa-user-shield fa-fw"></i>
                Layanan
              </a>
            </li>
            <li class="mb-4">
                <a class="flex items-center gap-4 text-gray-700" href="#">
                <i class="fas fa-shipping-fast fa-fw"></i>
                Layanan Pengiriman
                </a>
            </li>
                
            <li class="mb-4">
                @if (Auth::user()->role === 'Kasir')
                    <a
                    href="#"
                    class="flex items-center text-gray-700"
                    x-on:click.prevent="openModalPengeluaran = true"
                    >

                    <img src="images/icon-pengeluaran.png" alt="" class="mr-2" />
                    Tambah Pengeluaran
                    </a>

                    <div
                    x-show="openModalPengeluaran"
                    x-cloak
                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                    >
                    <div class="bg-white p-6 rounded w-96">
                        <h2 class="text-lg font-bold mb-4">Tambah Data Pengeluaran</h2>
                        <form action="{{ route('pengeluaran.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block mb-1">Jenis Pengeluaran</label>
                                <input type="text" name="jenis_pengeluaran" class="w-full border rounded p-2" required>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1">Biaya</label>
                                <input type="text" name="biaya" class="w-full border rounded p-2" required>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1">Tanggal</label>
                                <input type="date" name="tanggal" class="w-full border rounded p-2" required>
                            </div>
                            <div class="flex justify-end">
                                <button
                                    type="button"
                                    x-on:click="openModalPengeluaran = false"
                                    class="mr-2 text-gray-500"
                                >
                                    Batal
                                </button>
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                    </div>

                @else
                    <a
                    href="{{ route('pengeluaran.index') }}"
                    class="flex items-center gap-4 text-gray-700"
                    >
                    <i class="fas fa-wallet fa-fw"></i>
                    Pengeluaran
                    </a>
                @endif
                </li>
                <li class="mt-8">
                <a class="flex items-center gap-2 text-red-500" href="{{ route('login') }}">
                    <i class="fas fa-sign-out-alt mr-3"> </i>
                    Logout
                </a>
                </li>
            </ul>
            </div>
        </div>

        <!-- main -->
        <div class="flex-1 p-10">
            <header class="bg-biruBima text-white px-6 py-3 shadow">
                <div class="flex justify-between items-center">
                <div class="text-2xl font-semibold ml-auto">Kasir</div>
                </div>
            </header>
            <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">
            Data Pesanan
            </h1>
            <input class="border rounded-lg px-4 py-2" placeholder="Search..." type="text"/>
            </div>
            <div class="flex space-x-4 mb-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg" onclick="window.location.href='forms/tambah_data.html'">
            Tambah Data
            </button>
            <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg">
            Sortir Status Belum Bayar
            </button>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg">
            Refresh Data
            </button>
            </div>
            <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">
                ID Pesanan
                </th>
                <th class="py-2 px-4 border-b">
                Nama Pelanggan
                </th>
                <th class="py-2 px-4 border-b">
                Nomor Telepon
                </th>
                <th class="py-2 px-4 border-b">
                Alamat
                </th>
                <th class="py-2 px-4 border-b">
                Jenis Barang
                </th>
                <th class="py-2 px-4 border-b">
                Status Pembayaran
                </th>
                <th class="py-2 px-4 border-b">
                Spesifikasi Barang
                </th>
                <th class="py-2 px-4 border-b">
                Jenis Layanan
                </th>
                <th class="py-2 px-4 border-b">
                Kiloan
                </th>
                <th class="py-2 px-4 border-b">
                Satuan
                </th>
                <th class="py-2 px-4 border-b">
                Tanggal Terima
                </th>
                <th class="py-2 px-4 border-b">
                Estimasi Selesai
                </th>
                <th class="py-2 px-4 border-b">
                Antarjemput
                </th>
                <th class="py-2 px-4 border-b">
                Aksi
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="py-2 px-4 border-b">
                1
                </td>
                <td class="py-2 px-4 border-b">
                Ujang
                </td>
                <td class="py-2 px-4 border-b">
                08129128129
                </td>
                <td class="py-2 px-4 border-b">
                Lodaya
                </td>
                <td class="py-2 px-4 border-b">
                Baju
                </td>
                <td class="py-2 px-4 border-b">
                Lunas
                </td>
                <td class="py-2 px-4 border-b">
                Wol
                </td>
                <td class="py-2 px-4 border-b">
                Cuci Kering
                </td>
                <td class="py-2 px-4 border-b">
                2kg
                </td>
                <td class="py-2 px-4 border-b">
                3
                </td>
                <td class="py-2 px-4 border-b">
                2025-11-04
                </td>
                <td class="py-2 px-4 border-b">
                2025-11-06
                </td>
                <td class="py-2 px-4 border-b">
                YA
                </td>
                <td class="py-2 px-4 border-b relative" x-data="{ open: false }">
                    <!-- dropdown -->
                    <button
                        class="text-gray-500 p-2 rounded-full focus:outline-none hover:text-gray-700"
                        @click="open = !open"
                    >
                        <i class="fas fa-ellipsis-v"></i>
                    </button>

                    <div
                        x-show="open"
                        @click.away="open = false"
                        class="dropdown-menu absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50"
                    >
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="window.location.href='forms/detail.html'">Details</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="window.location.href='forms/edit.html'">Edit</a>
                        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Delete</a>
                    </div>
                </td>
            </tr>
            </tr>
            </tbody>
            </table>
            <div class="flex justify-between items-center mt-4">
            <span>
            Showing 1-5 of 50
            </span>
            <div class="flex space-x-2">
            <button class="px-3 py-1 border rounded-lg">
                Previous
            </button>
            <button class="px-3 py-1 border rounded-lg">
                1
            </button>
            <button class="px-3 py-1 border rounded-lg">
                2
            </button>
            <button class="px-3 py-1 border rounded-lg">
                Next
            </button>
            </div>
            </div>
            </div>
        </div>
    </div>

    </div>

</body>
</html>
