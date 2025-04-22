<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" defer></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              biruBima: "#6FBcFF",
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
            <img
              alt="Logo"
              class="mr-3"
              src="images/logo-bima-laundry-svg.svg"
            />
          </div>
          <ul>
            @if(Auth::user()->role === 'Admin')
            <li class="mb-4">
              <a class="flex items-center gap-4 text-biruBima" href="{{ route('index') }}">
                <i class="fa-solid fa-table-columns fa-fw"></i>
                Dashboard
              </a>
            </li>
            @endif
            <li class="mb-4">
              <a
                class="flex items-center gap-4 text-gray-700"
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
              <a href="#" class="flex items-center gap-2 text-red-500" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
            <div class="bg-white text-biruBima p-10 rounded-full mr-6">
                <i class="fas fa-file-alt fa-fw"></i>
            </div>
            <div>
              <h2 class="text-2xl font-semibold mb-1">Data Pesanan</h2>
              <p class="text-lg">Total: 10 Pesanan</p>
            </div>
          </div>

          <div class="bg-biruBima text-white p-20 rounded-lg flex items-center">
            <div class="bg-white text-biruBima p-10 rounded-full mr-6">
                <i class="fas fa-users fa-fw"></i>
            </div>
            <div>
              <h2 class="text-2xl font-semibold mb-1">Data Pelanggan</h2>
              <p class="text-lg">Total: 14 Pelanggan</p>
            </div>
          </div>

          <div class="bg-biruBima text-white p-20 rounded-lg flex items-center">
            <div class="bg-white text-biruBima p-10 rounded-full mr-6">
                <i class="fas fa-user-shield fa-fw"></i>
            </div>
            <div>
              <h2 class="text-2xl font-semibold mb-1">Data Layanan</h2>
              <p class="text-lg">Total: 4 Layanan</p>
            </div>
          </div>

          <div class="bg-biruBima text-white p-20 rounded-lg flex items-center">
            <div class="bg-white text-biruBima p-10 rounded-full mr-6">
                <i class="fas fa-wallet fa-fw"></i>
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
