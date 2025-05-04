<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Bima Laundry - Data Pengeluaran</title>
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
      $(document).ready(function () {
        $('.select2').select2({
          placeholder: "Pilih user...",
          width: 'style'
        });
      });
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>

<!-- Sidebar -->
<body class="bg-gray-100">
<div class="flex min-h-screen">
    <div class="w-1/5 bg-white shadow-lg sticky top-0 h-screen overflow-y-auto">
      <div class="p-6">
        <div class="flex items-center mb-8">
          <a href="{{ route('index') }}">
            <img
              alt="Logo"
              class="mr-3"
              src="/images/logo-bima-laundry-svg.svg"
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
              href="{{ route('pesanan.index') }}"
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
    <div class="flex-1 p-10">
        <header class="bg-biruBima text-white px-6 py-3 shadow">
            <div class="flex justify-between items-center">
              <div class="text-2xl font-semibold ml-auto">{{ Auth::user()->role }}</div>
            </div>
          </header>
        <div class="bg-white p-6 rounded-lg shadow-lg" x-data="{ openEditModal: false, selectedPengeluaran: {} }">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Data Pengeluaran</h1>
            </div>

            <!-- Modal -->
            <div x-data="{ openModal: false, showExportModal: false }">

              <div class="flex space-x-4 mb-4">
                <button x-on:click="openModal = true" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg">
                  Tambah Data
                </button>

                <button class="bg-red-400 hover:bg-red-500 text-white px-4 py-2 rounded-lg" onclick="window.location.href='{{ route('pengeluaran.index') }}'">
                  Reset Filter
                </button>

                <button @click="showExportModal = true" class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded-lg">
                  Export Excel
              </button>
       
              </div>

              <div 
                x-show="showExportModal"
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
                x-show="showExportModal" 
                class="fixed inset-0 flex items-center justify-center z-50"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-5 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-5 scale-95"
                x-cloak
              >
                <div @click.away="showExportModal = false" class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
                    <h2 class="text-lg font-semibold mb-4">Export Pengeluaran</h2>
        
                    <form action="{{ route('pengeluaran.export') }}" method="GET">
                        <div class="mb-3">
                            <label for="bulan" class="block text-sm font-medium">Bulan</label>
                            <select name="bulan" id="bulan" class="w-full border-gray-300 rounded mt-1">
                                <option value="">Pilih Bulan</option>
                                @foreach(range(1, 12) as $bulan)
                                    <option value="{{ $bulan }}">{{ DateTime::createFromFormat('!m', $bulan)->format('F') }}</option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="mb-4">
                            <label for="tahun" class="block text-sm font-medium">Tahun</label>
                            <select name="tahun" id="tahun" class="w-full border-gray-300 rounded mt-1">
                                <option value="">Pilih Tahun</option>
                                @foreach ($tahunList as $tahun)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="flex justify-end gap-2">
                            <button type="button" @click="showExportModal = false" class="px-3 py-1 bg-gray-400 hover:bg-gray-500 rounded text-white">Batal</button>
                            <button type="submit" class="px-3 py-1 bg-blue-400 hover:bg-blue-500 text-white rounded text-sm">Export</button>
                        </div>
                    </form>
                </div>
              </div>

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
                              <input 
                                type="date" name="tanggal" required 
                                class="w-full border rounded-lg focus:ring-blue-400 focus:border-blue-400 p-3" 
                                onfocus="this.showPicker && this.showPicker()"
                            >            
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Pengeluaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      <div class="flex flex-col items-center gap-1">
                        <span>Tanggal</span>
                        <form action="{{ route('pengeluaran.index') }}" id="filter-tanggal-form" method="GET" class="flex gap-1 items-center">

                          <select name="bulan" onchange="document.getElementById('filter-tanggal-form').submit()" class="text-xs rounded border-gray-300">
                            <option value="">Bulan</option>
                            @foreach(range(1, 12) as $bulan)
                              <option value="{{ $bulan }}" {{ request('bulan') == $bulan ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $bulan)->format('F') }}
                              </option>
                            @endforeach
                          </select>
                    
                          <select name="tahun" onchange="document.getElementById('filter-tanggal-form').submit()" class="text-xs rounded border-gray-300">
                            <option value="">Tahun</option>
                            @foreach ($tahunList as $tahun)
                              <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                            @endforeach
                          </select>

                          <input type="hidden" name="pencatat" value="{{ request('pencatat') }}">

                        </form>
                      </div>
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      <div class="flex items-center gap-2">
                        <span>Dicatat Oleh</span>
                        <form action="{{ route('pengeluaran.index') }}" id="filter-user-form" method="GET" class="mt-3">
                          <select 
                            name="pencatat" id="pencatat" 
                            onchange="document.getElementById('filter-user-form').submit();"
                            class="select2 text-xs"
                          >
                            <option value="">-- Semua User --</option>
                            @foreach ($pencatatList as $user)
                              <option value="{{ $user->id }}" {{ request('pencatat') == $user->id ? 'selected' : '' }}>
                                {{ $user->role }}
                              </option>
                            @endforeach
                          </select>
                        </form>
                      </div>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
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
                          class="bg-blue-400 h-9 w-20 text-white px-4 py-2 hover:bg-blue-500 rounded text-sm"
                          x-on:click= "openEditModal = true; selectedPengeluaran = {{ $pengeluaran }}"
                        >
                          Edit
                        </button>

                        <form action="{{ route('pengeluaran.destroy', $pengeluaran->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengeluaran ini?');">
                          @csrf
                          @method('DELETE')
                          <button
                            type="submit"
                            class="bg-red-400 h-9 w-20 text-white px-4 py-2 rounded hover:bg-red-500 text-sm">
                            Hapus
                          </button>
                        </form>

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
              x-transition:enter="transition ease-out duration-300 transform"
              x-transition:enter-start="opacity-0 translate-y-5 scale-95"
              x-transition:enter-end="opacity-100 translate-y-0 scale-100"
              x-transition:leave="transition ease-in duration-200 transform"
              x-transition:leave-start="opacity-100 translate-y-0 scale-100"
              x-transition:leave-end="opacity-0 translate-y-5 scale-95"
              x-cloak
            >
              <div 
                @click.away="openEditModal = false"
                class="bg-white p-6 rounded w-96"
              >
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
                          <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                          <input
                              type="date"
                              name="tanggal"
                              class="w-full border rounded-lg focus:ring-blue-400 focus:border-blue-400 p-3"
                              x-model="selectedPengeluaran.tanggal"
                              required
                              onfocus="this.showPicker && this.showPicker()"
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
                              Update
                          </button>
                      </div>
                  </form>
              </div>
            </div>

            <div class="mt-4">
              {{ $pengeluarans->links() }}
            </div>

        </div>
    </div>
</div>
</body>
</html>
