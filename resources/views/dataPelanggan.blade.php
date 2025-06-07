<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Bima Laundry - Data Pelanggan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

      .select2-container--default .select2-selection--single {
          background-color: #f9fafb;
          border: 1px solid #d1d5db;
          border-radius: 6px;
          height: 28px;
          font-size: 0.75rem;
          padding-left: 6px;
          padding-right: 6px;
          display: flex;
          align-items: center;
        }

      .select2-container--default .select2-selection--single .select2-selection__rendered {
          color: #374151;
          line-height: 28px;
        }

      .select2-container--default .select2-selection--single .select2-selection__arrow {
          height: 100%;
          right: 6px;
        }

      .select2-container--open .select2-dropdown {
          border-radius: 6px;
          box-shadow: 0 4px 6px rgba(0,0,0,0.1);
          border: 1px solid #d1d5db;
        }

      [x-cloak] {
          display: none !important;
      }

    </style>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        $('.select2').select2({
          placeholder: "Pilih alamat...",
          width: 'style'
        });
      });
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>

<body class="bg-gray-100">
  <div class="flex min-h-screen">

    <!-- sidebar -->
    <div class="w-1/5 min-w-[240px] bg-white shadow-lg sticky top-0 h-screen overflow-y-auto">
      <div class="p-6" x-data="{ openModalPengeluaran: false }">
        <div class="flex items-center mb-8">
          <a href="{{ Auth::user()->role === 'Admin' ? route('index') : route('pesanan.index') }}">
            <img
              alt="Logo"
              class="mr-3"
              src="/images/logo-bima-laundry-svg.svg"
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
              href="{{ route('pesanan.index') }}"
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
            <a class="flex items-center gap-4 text-gray-700" href="{{ route('layananpengiriman.index') }}">
              <i class="fas fa-shipping-fast fa-fw"></i>
              Layanan Pengiriman
            </a>
          </li>
          <li class="mb-4">
            @if (Auth::user()->role === 'Kasir')
            <a
            href="#"
            class="flex items-center gap-4 text-gray-700"
            x-on:click.prevent="openModalPengeluaran = true"
          >
            <i class="fas fa-wallet fa-fw"></i>
            Tambah Pengeluaran
          </a>

              <div
                x-show="openModalPengeluaran"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black bg-opacity-50 z-40"
                x-cloak
                >
              </div>

              <div
                x-show="openModalPengeluaran"
                x-cloak
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-5 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-5 scale-95"
                class="fixed inset-0 flex items-center justify-center z-50"
              >
              <div class="bg-white p-6 rounded w-96" @click.away="openModalPengeluaran = false">
                    <h2 class="text-lg font-bold mb-4">Tambah Data Pengeluaran</h2>
                    <form action="{{ route('pengeluaran.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block mb-1">Jenis Pengeluaran</label>
                            <input type="text" name="jenis_pengeluaran" class="w-full border rounded p-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-1">Biaya</label>
                            <input type="number" onkeydown="return !['e','E','+','-'].includes(event.key)" name="biaya" class="w-full border rounded p-2" required>
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
                            <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded">
                                Tambah
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
              <i class="fas fa-sign-out-alt mr-3"></i> Keluar
            </a>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </div>
    </div>

    <!-- main -->
    <div class="flex-1 p-10">
        <header class="bg-biruBima rounded-xl text-white px-6 py-3 shadow">
          <div class="flex justify-between items-center">
            <div class="text-2xl font-semibold">Data Pelanggan</div>               
            <div class="text-2xl font-semibold ml-auto">{{ Auth::user()->role }}</div>
          </div>
        </header>

      <div class="bg-white p-6 rounded-lg shadow-lg" x-data="{ openEditModal: false, selectedPelanggan: {} }">
        <!-- Modal -->
          <div class="flex justify-between items-center mb-4" x-data="{ openModal: false }">
            <div class="flex space-x-4">
              @if(Auth::user()->role === 'Admin')
              <button x-on:click="openModal = true" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-plus mr-2"></i>Tambah Data
              </button>
              @endif

              <button class="bg-red-400 hover:bg-red-500 text-white px-4 py-2 rounded-lg" onclick="window.location.href='{{ route('pelanggan.index') }}'">
                <i class="fas fa-filter-circle-xmark mr-2"></i>Hapus Filter
              </button>

              @if(Auth::user()->role === 'Admin')
                <button onclick="window.location.href='{{ route('pelanggan.export') }}'" class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded-lg">
                  <i class="fas fa-file-export mr-2"></i>Ekspor Data
                </button>
              @endif
            </div>

            <form action="{{ route('pelanggan.search') }}" method="GET" class="flex items-center space-x-2">
              <input class="border rounded-lg px-4 py-2" name="search_nama" placeholder="Cari Nama..." type="text"/>
            </form>

            <div
              x-show="openModal"
              x-transition:enter="transition ease-out duration-300"
              x-transition:enter-start="opacity-0"
              x-transition:enter-end="opacity-100"
              x-transition:leave="transition ease-in duration-200"
              x-transition:leave-start="opacity-100"
              x-transition:leave-end="opacity-0"
              class="fixed inset-0 bg-black bg-opacity-50 z-40"
              x-cloak
              >
            </div>

            <div
                x-show="openModal"
                x-cloak
                class="fixed inset-0 flex items-center justify-center z-50"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-5 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-5 scale-95"
            >
                <div class="bg-white p-6 rounded w-96" @click.away="openModal = false">
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
                            <input type="number" onkeydown="return !['e','E','+','-'].includes(event.key)" name="nomor_telepon" class="w-full border rounded p-2" required>
                        </div>
                        <div class="flex justify-end">
                            <button
                                type="button"
                                x-on:click="openModal = false"
                                class="mr-2 text-gray-500"
                            >
                                Batal
                            </button>
                            <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded">
                                Tambah
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
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex items-center gap-2">
                      <span>Alamat</span>
                      <form action="{{ route('pelanggan.index') }}" id="filter-alamat-form" method="GET" class="mt-3">
                        <select 
                          name="alamat" id="alamat" 
                          onchange="document.getElementById('filter-alamat-form').submit();"
                          class="select2 text-xs"
                        >
                          <option value="">-- Semua Alamat --</option>
                            @foreach($alamatList as $alamat)
                              <option value="{{ $alamat }}" {{ request('alamat') == $alamat ? 'selected' : '' }}>{{ $alamat }}</option>
                            @endforeach
                        </select>
                      </form>
                    </div>
                  </th>
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
                  <td class="px-6 py-4 whitespace-nowrap">+{{ $pelanggan->nomor_telepon }}</td>
                  <td class="px-6 py-4 whitespace-nowrap flex gap-2">

                    <button
                      class="bg-blue-400 hover:bg-blue-500 h-9 w-20 text-white px-4 py-2 hover:bg-blue-600 rounded text-sm"
                      x-on:click="openEditModal = true; selectedPelanggan = {{ $pelanggan }}"
                    >
                      Edit
                    </button>

                    @if (auth()->user()->role === 'Admin')
                    <div x-data="{ showDeleteModal: false }">
                        <!-- Tombol Hapus -->
                        <button
                            type="button"
                            @click="showDeleteModal = true"
                            class="bg-red-400 h-9 w-20 text-white px-4 py-2 hover:bg-red-500 rounded text-sm">
                            Hapus
                        </button>

                        <!-- Modal Konfirmasi -->
                        <div 
                            x-show="showDeleteModal" x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="fixed inset-0 bg-black bg-opacity-50 z-40 flex items-center justify-center"
                        >
                            <div 
                                class="bg-white w-full max-w-md p-6 rounded-lg shadow-xl"
                                x-transition:enter="transition ease-out duration-300" 
                                x-transition:enter-start="opacity-0 scale-90" 
                                x-transition:enter-end="opacity-100 scale-100" 
                                x-transition:leave="transition ease-in duration-200" 
                                x-transition:leave-start="opacity-100 scale-100" 
                                x-transition:leave-end="opacity-0 scale-90"
                                @click.outside="showDeleteModal = false"
                            >
                                <div class="text-center mb-4">
                                    <svg class="mx-auto h-12 w-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    <h2 class="text-xl font-semibold mt-2">Konfirmasi Hapus</h2>
                                </div>
                                
                                <div class="text-center mb-4">
                                    <p class="text-gray-700 mb-2">
                                        Yakin ingin menghapus pelanggan <strong>{{ $pelanggan->nama }}</strong>?
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Pesanan yang terkait dengan pelanggan ini akan tetap tersimpan.
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Tindakan ini tidak dapat dibatalkan.
                                    </p>
                                </div>
                                
                                <div class="flex justify-center">                                   
                                    <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" class="inline-flex space-x-4">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                          type="button"
                                          @click="showDeleteModal = false"
                                          class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition w-24 text-sm">
                                          Batal
                                        </button>

                                        <button
                                            type="submit"
                                            class="bg-red-400 text-white px-4 py-2 hover:bg-red-500 rounded transition w-24 text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                  </td>
                </tr>
                @endforeach
              </tbody>
          </table>

          <div
            x-show="openEditModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-50 z-40"
            x-cloak
          >
          </div>

          <div
            x-show="openEditModal"
            class="fixed inset-0 flex items-center justify-center z-50"
            x-cloak
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-5 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-5 scale-95"
          >

            <div class="bg-white p-6 rounded w-96" @click.away="openEditModal = false">
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
                            type="number"
                            onkeydown="return !['e','E','+','-'].includes(event.key)"
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
                        <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded">
                            Perbarui
                        </button>
                    </div>
                </form>
            </div>
          </div>

          <div class="mt-4">
            {{ $pelanggans->links() }}
          </div>

      </div>
    </div>
  </div>
</body>
</html>
