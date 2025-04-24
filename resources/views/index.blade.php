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
        <div class="p-6" x-data="{ openModalPengeluaran: false }">
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
              <a class="flex items-center text-biruBima" href="{{ route('index') }}">
                <img src="images/icon-dashboard.png" alt="" class="mr-2" />
                Dashboard
              </a>
            </li>
            @endif
            <li class="mb-4">
              <a
                class="flex items-center text-gray-700"
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
                  class="flex items-center text-gray-700"
                >
                <img src="images/icon-pengeluaran.png" alt="" class="mr-2" />
                Pengeluaran
                </a>
              @endif
            </li>
            <li class="mt-8">
              <a href="#" class="flex items-center text-red-500" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
              </a>
            
              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
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