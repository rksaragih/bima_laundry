    <html lang="en">
    <head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>
    Bima Laundry - Data Pesanan
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
        theme: {
            extend: {
            colors: {
                biruBima: '#3A51D5',
            },
            },
        },
        };
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    </head>

    <body class="bg-gray-100">
    <div class="flex">

    <!-- ini sidebar -->
    <div class="w-1/5 bg-white h-screen shadow-lg">
        <div class="p-6">
          <div class="flex items-center mb-8">
            <img
              alt="Logo"
              class="mr-3"
              src="images/logo-bima-laundry-hitam.png"
            />
          </div>
          <ul>
            @if(Auth::user()->role === 'Admin')
            <li class="mb-4">
              <a class="flex items-center text-gray-700" href="{{ route('index') }}">
                <img src="images/icon-dashboard.png" alt="" class="mr-2" />
                Dashboard
              </a>
            </li>
            @endif
            <li class="mb-4">
              <a
                class="flex items-center text-biruBima"
                href="{{ route('dataPesanan') }}"
              >
                <img src="images/icon-data-pesanan.png" alt="" class="mr-1" />
                Pesanan
              </a>
            </li>
            <li class="mb-4">
              <a
                class="flex items-center text-gray-700"
                href="{{ route('pelanggan.index') }}"
              >
                <img src="images/icon-data-pelanggan.png" alt="" class="mr-2" />
                Pelanggan
              </a>
            </li>
            <li class="mb-4">
              <a class="flex items-center text-gray-700" href="{{ route('layanan.index') }}">
                <img src="images/icon-data-layanan.png" alt="" class="mr-2" />
                Layanan
              </a>
            </li>
            <li class="mb-4">
              <a
                class="flex items-center text-gray-700"
                href="{{ route('dataPengeluaran') }}"
              >
                <img src="images/icon-pengeluaran.png" alt="" class="mr-2" />
                {{ Auth::user()->role === 'Kasir' ? 'Tambah Pengeluaran' : 'Pengeluaran' }}
              </a>
            </li>
            <li class="mt-8">
              <a class="flex items-center text-red-500" href="{{ route('login') }}">
                <i class="fas fa-sign-out-alt mr-3"> </i>
                Logout
              </a>
            </li>
          </ul>
        </div>
    </div>

    <!-- main -->
    <div class="flex-1 p-10">
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
            <td class="py-2 px-4 border-b">
                <button class="bg-blue-500 text-white px-2 py-1 rounded-lg mb-1" onclick="window.location.href='forms/detail.html'">
                    Details
                </button>
                <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="window.location.href='forms/edit.html'">
                    Edit
                </button>
                <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>
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
    </body>
    </html>
