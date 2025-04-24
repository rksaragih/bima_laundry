<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Bima Laundry - Data Pengeluaran</title>
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

<!-- Sidebar -->
<body class="bg-gray-100">
<div class="flex">
    <div class="w-1/5 bg-white h-screen shadow-lg">
      <div class="p-6">
        <div class="flex items-center mb-8">
          <a href="{{ route('index') }}">
            <img
              alt="Logo"
              class="mr-3"
              src="images/logo-bima-laundry-hitam.png"
            />
          </a>
        </div>
        <ul>
          <li class="mb-4">
            <a class="flex items-center gap-4 text-gray-700" href="{{ route('index') }}">
                <i class="fa-solid fa-table-columns fa-fw"></i>
              Dashboard
            </a>
          </li>
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
            <a
              class="flex items-center gap-4 text-biruBima"
              href="{{ route('pengeluaran.index') }}"
            >
            <i class="fas fa-wallet fa-fw"></i>
            Pengeluaran
            </a>
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

    <!-- Main -->
    <div class="flex-1 p-10">
        <header class="bg-biruBima text-white px-6 py-3 shadow">
            <div class="flex justify-between items-center">
              <div class="text-2xl font-semibold ml-auto">Kasir</div>
            </div>
          </header>
        <div class="bg-white p-6 rounded-lg shadow-lg" x-data="{ openEditModal: false, selectedPengeluaran: {} }">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Data Pengeluaran</h1>
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
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b">No.</th>
                    <th class="py-2 px-4 border-b">Jenis Pengeluaran</th>
                    <th class="py-2 px-4 border-b">Biaya</th>
                    <th class="py-2 px-4 border-b">Tanggal</th>
                    <th class="py-2 px-4 border-b">Dicatat Oleh</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($pengeluarans as $index => $pengeluaran)
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap">{{ $pengeluarans->firstItem() + $index }}</td>
                      <td class="px-6 py-4 whitespace-nowrap">{{ $pengeluaran->jenis_pengeluaran }}</td>
                      <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($pengeluaran->biaya, 0, ',', '.') }}</td>
                      <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d M Y') }}</td>
                      <td class="px-6 py-4 whitespace-nowrap">{{ $pengeluaran->user->role ?? '-' }}</td>
                      <td class="px-6 py-4 whitespace-nowrap flex gap-2">

                        @php
                            $pengeluaranJson = [
                                'id' => $pengeluaran->id,
                                'jenis_pengeluaran' => $pengeluaran->jenis_pengeluaran,
                                'biaya' => $pengeluaran->biaya,
                                'tanggal' => \Carbon\Carbon::parse($pengeluaran->tanggal)->format('Y-m-d'),
                            ];
                        @endphp

                        <button
                          class="bg-blue-500 h-9 w-20 text-white px-4 py-2 hover:bg-blue-600 rounded text-sm"
                          x-on:click= "openEditModal = true; selectedPengeluaran = {{ $pengeluaran }}"
                        >
                          Edit
                        </button>

                        <div
                          x-show="openEditModal"
                          class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                          x-cloak
                        >
                          <div class="bg-white p-6 rounded w-96">
                              <h2 class="text-lg font-bold mb-4">Edit Data pengeluaran</h2>
                              <form
                                  x-bind:action="'/pengeluaran/' + selectedPengeluaran.id"
                                  method="POST"
                              >
                                  @csrf
                                  @method('PUT')

                                  <div class="mb-4">
                                      <label class="block mb-1">Jenis Pengeluaran</label>
                                      <input
                                          type="text"
                                          name="jenis_pengeluaran"
                                          class="w-full border rounded p-2"
                                          x-model="selectedPengeluaran.jenis_pengeluaran"
                                          required
                                      >
                                  </div>
                                  <div class="mb-4">
                                      <label class="block mb-1">Biaya</label>
                                      <input
                                          type="text"
                                          name="biaya"
                                          class="w-full border rounded p-2"
                                          x-model="selectedPengeluaran.biaya"
                                          required
                                      >
                                  </div>
                                  <div class="mb-4">
                                      <label class="block mb-1">Tanggal</label>
                                      <input
                                          type="date"
                                          name="tanggal"
                                          class="w-full border rounded p-2"
                                          x-model="selectedPengeluaran.tanggal"
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
                
                        <form action="{{ route('pengeluaran.destroy', $pengeluaran->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengeluaran ini?');">
                          @csrf
                          @method('DELETE')
                          <button
                            type="submit"
                            class="bg-red-500 h-9 w-20 text-white px-4 py-2 rounded hover:bg-red-600 text-sm">
                            Hapus
                          </button>
                        </form>

                      </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>

            <div class="mt-4">
              {{ $pengeluarans->links() }}
            </div>

        </div>
    </div>
</div>
</body>
</html>
