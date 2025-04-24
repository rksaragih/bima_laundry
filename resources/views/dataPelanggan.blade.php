<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Bima Laundry - Data Pelanggan</title>
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

<!-- sidebar -->
<body class="bg-gray-100">
  <div class="flex">
    <div class="w-1/5 bg-white h-screen shadow-lg">
      <div class="p-6" x-data="{ openModalPengeluaran: false }">
        <div class="flex items-center mb-8">
          <a href="{{ Auth::user()->role === 'Admin' ? route('index') : route('dataPesanan') }}">
            <img
              alt="Logo"
              class="mr-3"
              src="images/logo-bima-laundry-svg.svg"
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
              class="flex items-center gap-4 text-gray-700"
              href="{{ route('dataPesanan') }}"
            >
            <i class="fas fa-file-alt fa-fw"></i>
            Pesanan
            </a>
          </li>
          <li class="mb-4">
            <a
              class="flex items-center gap-4 text-biruBima"
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
      <div class="bg-white p-6 rounded-lg shadow-lg" x-data="{ openEditModal: false, selectedPelanggan: {} }">
          <div class="flex justify-between items-center mb-4">
              <h1 class="text-2xl font-bold">Data Pelanggan</h1>
              <input class="border rounded-lg px-4 py-2" placeholder="Search..." type="text"/>
          </div>

        <!-- Modal -->
        <div x-data="{ openModal: false }">

          <div class="flex space-x-4 mb-4">
            <button x-on:click="openModal = true" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
              Tambah Data
            </button>
          </div>

          <div
              x-show="openModal"
              x-cloak
              class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
          >
              <div class="bg-white p-6 rounded w-96">
                  <h2 class="text-lg font-bold mb-4">Tambah Data Pelanggan</h2>
                  <form action="{{ route('pelanggan.store') }}" method="POST">
                      @csrf
                      <div class="mb-4">
                          <label class="block mb-1">Nama</label>
                          <input type="text" name="nama" class="w-full border rounded p-2" required>
                      </div>
                      <div class="mb-4">
                          <label class="block mb-1">Alamat</label>
                          <input type="text" name="alamat" class="w-full border rounded p-2" required>
                      </div>
                      <div class="mb-4">
                          <label class="block mb-1">Nomor Telepon</label>
                          <input type="text" name="nomor_telepon" class="w-full border rounded p-2" required>
                      </div>
                      <div class="flex justify-end">
                          <button
                              type="button"
                              x-on:click="openModal = false"
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
        </div>

          <table class="min-w-full bg-white">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Telepon</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($pelanggans as $index => $pelanggan)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $pelanggans->firstItem() + $index }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $pelanggan->nama }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $pelanggan->alamat }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $pelanggan->nomor_telepon }}</td>
                  <td class="px-6 py-4 whitespace-nowrap flex gap-2">

                    <button
                      class="bg-blue-500 h-9 w-20 text-white px-4 py-2 hover:bg-blue-600 rounded text-sm"
                      x-on:click="openEditModal = true; selectedPelanggan = {{ $pelanggan }}"
                    >
                      Edit
                    </button>

                    <div
                      x-show="openEditModal"
                      class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                      x-cloak
                    >
                      <div class="bg-white p-6 rounded w-96">
                          <h2 class="text-lg font-bold mb-4">Edit Data Pelanggan</h2>
                          <form
                              x-bind:action="'/pelanggan/' + selectedPelanggan.id"
                              method="POST"
                          >
                              @csrf
                              @method('PUT')

                              <div class="mb-4">
                                  <label class="block mb-1">Nama</label>
                                  <input
                                      type="text"
                                      name="nama"
                                      class="w-full border rounded p-2"
                                      x-model="selectedPelanggan.nama"
                                      required
                                  >
                              </div>
                              <div class="mb-4">
                                  <label class="block mb-1">Alamat</label>
                                  <input
                                      type="text"
                                      name="alamat"
                                      class="w-full border rounded p-2"
                                      x-model="selectedPelanggan.alamat"
                                      required
                                  >
                              </div>
                              <div class="mb-4">
                                  <label class="block mb-1">Nomor Telepon</label>
                                  <input
                                      type="text"
                                      name="nomor_telepon"
                                      class="w-full border rounded p-2"
                                      x-model="selectedPelanggan.nomor_telepon"
                                      required
                                  >
                              </div>
                              <div class="flex justify-end">
                                  <button
                                      type="button"
                                      x-on:click="openEditModal = false"
                                      class="mr-2 text-gray-500"
                                  >
                                      Batal
                                  </button>
                                  <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                      Update
                                  </button>
                              </div>
                          </form>
                      </div>
                    </div>

                    @if (auth()->user()->role === 'Admin')
                    <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?');">
                      @csrf
                      @method('DELETE')
                      <button
                        type="submit"
                        class="bg-red-500 h-9 w-20 text-white px-4 py-2 hover:bg-red-600 rounded text-sm">
                        Hapus
                      </button>
                    </form>
                    @endif

                  </td>
                </tr>
                @endforeach
              </tbody>
          </table>

          <div class="mt-4">
            {{ $pelanggans->links() }}
          </div>

      </div>
    </div>
  </div>

  <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
