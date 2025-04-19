<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Bima Laundry - Data Pelanggan</title>
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
                class="flex items-center text-biruBima"
                href="{{ route('dataPelanggan') }}"
              >
                <img src="images/icon-data-pelanggan.png" alt="" class="mr-2" />
                Data Pelanggan
              </a>
            </li>
            <li class="mb-4">
              <a class="flex items-center text-gray-700" href="#">
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
                <h1 class="text-2xl font-bold">Data Pelanggan</h1>
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
                    <th class="py-2 px-4 border-b">ID Pelanggan</th>
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">No. Telepon</th>
                    <th class="py-2 px-4 border-b">Alamat</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="py-2 px-4 border-b">1</td>
                    <td class="py-2 px-4 border-b">C001</td>
                    <td class="py-2 px-4 border-b">John Doe</td>
                    <td class="py-2 px-4 border-b">08123456789</td>
                    <td class="py-2 px-4 border-b">Jl. Merdeka No. 1</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editData('C001')">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>

                    </td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">2</td>
                    <td class="py-2 px-4 border-b">C002</td>
                    <td class="py-2 px-4 border-b">Jane Smith</td>
                    <td class="py-2 px-4 border-b">08234567890</td>
                    <td class="py-2 px-4 border-b">Jl. Sudirman No. 2</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editData('C002')">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>

                    </td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">3</td>
                    <td class="py-2 px-4 border-b">C003</td>
                    <td class="py-2 px-4 border-b">Alice Johnson</td>
                    <td class="py-2 px-4 border-b">08345678901</td>
                    <td class="py-2 px-4 border-b">Jl. Thamrin No. 3</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editData('C003')">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>

                    </td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">4</td>
                    <td class="py-2 px-4 border-b">C004</td>
                    <td class="py-2 px-4 border-b">Bob Brown</td>
                    <td class="py-2 px-4 border-b">08456789012</td>
                    <td class="py-2 px-4 border-b">Jl. Gatot Subroto No. 4</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editData('C004')">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg">Delete</button>

                    </td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">5</td>
                    <td class="py-2 px-4 border-b">C005</td>
                    <td class="py-2 px-4 border-b">Charlie Davis</td>
                    <td class="py-2 px-4 border-b">08567890123</td>
                    <td class="py-2 px-4 border-b">Jl. Kebon Jeruk No. 5</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editData('C005')">Edit</button>
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