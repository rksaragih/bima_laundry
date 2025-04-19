<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Bima Laundry - Data Layanan</title>
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

<!-- sidebar -->
<body class="bg-gray-100">
<div class="flex">
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
                Grafik Bisnis
              </a>
            </li>
            @endif
            <li class="mb-4">
              <a
                class="flex items-center text-gray-700"
                href="{{ route('dataPesanan') }}"
              >
                <img src="images/icon-data-pesanan.png" alt="" class="mr-1" />
                Data Pesanan
              </a>
            </li>
            <li class="mb-4">
              <a
                class="flex items-center text-gray-700"
                href="{{ route('dataPelanggan') }}"
              >
                <img src="images/icon-data-pelanggan.png" alt="" class="mr-2" />
                Data Pelanggan
              </a>
            </li>
            <li class="mb-4">
              <a 
                class="flex items-center text-biruBima"
                href="{{ route('dataLayanan') }}">
                <img src="images/icon-data-layanan.png" alt="" class="mr-2" />
                Data Layanan
              </a>
            </li>
            <li class="mb-4">
              <a
                class="flex items-center text-gray-700"
                href="{{ route('dataPengeluaran') }}"
              >
                <img src="images/icon-pengeluaran.png" alt="" class="mr-2" />
                {{ Auth::user()->role === 'Kasir' ? 'Tambah Pengeluaran' : 'Data Pengeluaran' }}
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
                <h1 class="text-2xl font-bold">Data Layanan</h1>
                <input class="border rounded-lg px-4 py-2" placeholder="Search..." type="text"/>
            </div>
            <div class="flex space-x-4 mb-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg" onclick="tambahData()">Tambah Data</button>
                <button class="bg-green-500 text-white px-4 py-2 rounded-lg" onclick="refreshData()">Refresh Data</button>
            </div>
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b">No.</th>
                    <th class="py-2 px-4 border-b">Jenis Layanan</th>
                    <th class="py-2 px-4 border-b">Harga</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="py-2 px-4 border-b">1</td>
                    <td class="py-2 px-4 border-b">Cuci Kering</td>
                    <td class="py-2 px-4 border-b">Rp 7.000</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editData('C001')">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>

                    </td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">2</td>
                    <td class="py-2 px-4 border-b">Cuci Kering + Setrika 1</td>
                    <td class="py-2 px-4 border-b">Rp 10.000</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editData('C002')">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">3</td>
                    <td class="py-2 px-4 border-b">Cuci Kering + Setrika 2</td>
                    <td class="py-2 px-4 border-b">Rp. 9.000</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editData('C003')">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>

                    </td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">4</td>
                    <td class="py-2 px-4 border-b">Cuci Kering + Setrika 3</td>
                    <td class="py-2 px-4 border-b">Rp. 8.000</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editData('C004')">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>

                    </td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">5</td>
                    <td class="py-2 px-4 border-b">Express (3 Jam)</td>
                    <td class="py-2 px-4 border-b">Rp. 20.000</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editData('C005')">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>

                    </td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">6</td>
                    <td class="py-2 px-4 border-b">Express (8 Jam)</td>
                    <td class="py-2 px-4 border-b">Rp. 18.000</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editData('C006')">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>

                    </td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">7</td>
                    <td class="py-2 px-4 border-b">Express (12 Jam)</td>
                    <td class="py-2 px-4 border-b">Rp. 12.000</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editData('C007')">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>

                    </td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">8</td>
                    <td class="py-2 px-4 border-b">Setrika Express</td>
                    <td class="py-2 px-4 border-b">Rp. 7.000</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editData('C008')">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>

                    </td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">9</td>
                    <td class="py-2 px-4 border-b">Setrika</td>
                    <td class="py-2 px-4 border-b">Rp. 6.000</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editData('C009')">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>

                    </td>
                </tr>
                </tbody>
            </table>
            <div class="flex justify-between items-center mt-4">
                <span>Showing 1-5 of 50</span>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border rounded-lg" onclick="previousPage()">Previous</button>
                    <button class="px-3 py-1 border rounded-lg" onclick="goToPage(1)">1</button>
                    <button class="px-3 py-1 border rounded-lg" onclick="goToPage(2)">2</button>
                    <button class="px-3 py-1 border rounded-lg" onclick="nextPage()">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>