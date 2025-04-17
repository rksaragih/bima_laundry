<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              biruBima: "#3A51D5",
            },
          },
        },
      };
      
    </script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <style></style>
  </head>
  <body class="bg-gray-100">
    <div class="flex">
      <!-- sidebar -->
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
            <li class="mb-4">
              <a class="flex items-center text-yellow-500" href="{{ route('index') }}">
                <img src="images/icon-dashboard.png" alt="" class="mr-2" />
                Dashboard
              </a>
            </li>
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
                Data Pengeluaran
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

      <!-- Main -->
      <div class="w-4/5 p-6">
        <div class="flex justify-between items-center mb-8">
          <h1 class="text-2xl font-bold">Dashboard</h1>
          <span class="text-blue-500"> Kasir </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="bg-biruBima text-white p-20 rounded-lg flex items-center">
            <div class="bg-white text-biruBima p-8 rounded-full mr-6">
              <img src="images/icon-data-pesanan.png" alt="" />
            </div>
            <div>
              <h2 class="text-2xl font-semibold mb-1">Data Pesanan</h2>
              <p class="text-lg">Total: 10 Pesanan</p>
            </div>
          </div>

          <div class="bg-biruBima text-white p-20 rounded-lg flex items-center">
            <div class="bg-white text-biruBima p-8 rounded-full mr-6">
              <img src="images/icon-data-pelanggan.png" alt="" />
            </div>
            <div>
              <h2 class="text-2xl font-semibold mb-1">Data Pelanggan</h2>
              <p class="text-lg">Total: 14 Pelanggan</p>
            </div>
          </div>

          <div class="bg-biruBima text-white p-20 rounded-lg flex items-center">
            <div class="bg-white text-biruBima p-8 rounded-full mr-6">
              <img src="images/icon-data-layanan.png" alt="" />
            </div>
            <div>
              <h2 class="text-2xl font-semibold mb-1">Data Layanan</h2>
              <p class="text-lg">Total: 4 Layanan</p>
            </div>
          </div>

          <div class="bg-biruBima text-white p-20 rounded-lg flex items-center">
            <div class="bg-white text-biruBima p-8 rounded-full mr-6">
              <img src="images/icon-pengeluaran.png" alt="" />
            </div>
            <div>
              <h2 class="text-2xl font-semibold mb-1">Data Pengeluaran</h2>
              <p class="text-lg">Total: 12.000</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>