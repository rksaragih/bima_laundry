<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>
Bima Laundry - Data Pesanan
</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
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

<script>
    document.querySelector('tr').addEventListener('click', function(e) {
        if (!e.target.closest('button')) {
            window.location.href = 'url-detail';
        }
    });

    function tutupModal() {
            document.getElementById('openSelectionModal').classList.add('hidden');
        }

    window.onclick = function(event) {
            const modal = document.getElementById('openSelectionModal');
            if (event.target === modal) {
                tutupModal();
            }
        }
</script>

<style>
  [x-cloak] {
      display: none !important;
  }
</style>

</head>

<body class="bg-gray-100">
<div class="flex">

    <!-- ini sidebar -->
    <div class="w-1/5 bg-white h-screen shadow-lg">
        <div class="p-6" x-data="{ openModalPengeluaran : false }">
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
                class="flex items-center gap-4 text-biruBima"
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
                                <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded">
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

        <!-- main -->
        <div class="flex-1 p-10" x-data="{ openJenisPesananModal : false, openFilterModal : false, openExportModal : false }">
            <header class="bg-biruBima text-white px-6 py-3 shadow">
                <div class="flex justify-between items-center">
                <div class="text-2xl font-semibold ml-auto">{{ Auth::user()->role }}</div>
                </div>
            </header>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <form action="{{ route('pesanan.search') }}" method="GET">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold">Data Pesanan</h1>
                        <input class="border rounded-lg px-4 py-2" name="search_nama" placeholder="Search..." type="text"/>
                    </div>
                </form>
                <div class="flex space-x-4 mb-4">
                    <button
                        class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg"
                        x-on:click="openJenisPesananModal = true"
                    >
                        Tambah Data
                    </button>

                    <!-- Filter Button -->
                    <button
                        class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg"
                        x-on:click="openFilterModal = true"
                    >
                        <i class="fas fa-filter mr-2"></i>Filter Data
                    </button>

                    <button class="bg-red-400 hover:bg-red-500 text-white px-4 py-2 rounded-lg" onclick="window.location.href='{{ route('pesanan.index') }}'">
                        Reset Filter
                    </button>

                    @if (Auth::user()->role === 'Admin')
                        <button
                            class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded-lg"
                            x-on:click="openExportModal = true"
                        >
                            <i class="fas fa-file-export mr-2"></i>Export Data
                        </button>
                    @endif
                </div>

                <div
                    x-show="openExportModal"
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
                    x-show="openExportModal"
                    class="fixed inset-0 flex items-center justify-center z-50"
                    x-cloak
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-5 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-5 scale-95"
                >
                    <div class="bg-white p-6 rounded w-96" @click.away="openExportModal = false">
                        <h2 class="text-lg font-bold mb-4">Export Data Pesanan</h2>
                        <form action="{{ route('pesanan.export') }}" method="GET">
                            <div class="mb-4">
                                <label class="block mb-1 font-medium">Bulan</label>
                                <select name="bulan" class="w-full border rounded p-2">
                                    <option value="">-- Semua Bulan --</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block mb-1 font-medium">Tahun</label>
                                <select name="tahun" class="w-full border rounded p-2">
                                    <option value="">-- Semua Tahun --</option>
                                    @if(isset($tahunList) && $tahunList->count() > 0)
                                        @foreach ($tahunList as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach
                                    @else
                                        @for ($i = date('Y'); $i >= date('Y')-3; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    @endif
                                </select>
                            </div>
                            
                            <div class="flex justify-end mt-6">
                                <button
                                    type="button"
                                    x-on:click="openExportModal = false"
                                    class="mr-2 text-gray-500 hover:underline"
                                >
                                    Batal
                                </button>
                                <button type="submit" class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded">
                                    Export Excel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Filter Modal -->
                <div
                    x-show="openFilterModal"
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
                    x-show="openFilterModal"
                    class="fixed inset-0 flex items-center justify-center z-50"
                    x-cloak
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-5 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-5 scale-95"
                >
                    <div class="bg-white p-6 rounded w-96" @click.away="openFilterModal = false">
                        <h2 class="text-lg font-bold mb-4">Filter Data Pesanan</h2>
                        <form action="{{ route('pesanan.filter') }}" method="GET">
                            <!-- Kategori Filter -->
                            <div class="mb-4">
                                <label class="block mb-1 font-medium">Kategori</label>
                                <select name="kategori" class="w-full border rounded p-2">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Reguler">Reguler</option>
                                    <option value="Express">Express</option>
                                </select>
                            </div>
                            
                            <!-- Tanggal Terima Filter -->
                            <div class="mb-4">
                                <label class="block mb-1 font-medium">Tanggal Terima</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <select name="tanggal_hari" class="border rounded p-2">
                                        <option value="">Hari</option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select name="tanggal_bulan" class="border rounded p-2">
                                        <option value="">Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                    <select name="tanggal_tahun" class="border rounded p-2">
                                        <option value="">Tahun</option>
                                        @if(isset($tahunList) && $tahunList->count() > 0)
                                            @foreach ($tahunList as $tahun)
                                                <option value="{{ $tahun }}" {{ request('tanggal_tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                            @endforeach
                                        @else
                                            @for ($i = date('Y'); $i >= date('Y')-3; $i--)
                                                <option value="{{ $i }}" {{ request('tanggal_tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Status Pembayaran Filter -->
                            <div class="mb-4">
                                <label class="block mb-1 font-medium">Status Pembayaran</label>
                                <select name="status_pembayaran" class="w-full border rounded p-2">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Belum Lunas">Belum Lunas</option>
                                    <option value="Lunas">Lunas</option>
                                </select>
                            </div>
                            
                            <!-- Status Cucian Filter -->
                            <div class="mb-4">
                                <label class="block mb-1 font-medium">Status Cucian</label>
                                <select name="status_cucian" class="w-full border rounded p-2">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Belum Dicuci">Belum Dicuci</option>
                                    <option value="Dalam Proses">Dalam Proses</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                            
                            <div class="flex justify-end mt-6">
                                <button
                                    type="button"
                                    x-on:click="openFilterModal = false"
                                    class="mr-2 text-gray-500 hover:underline"
                                >
                                    Batal
                                </button>
                                <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded">
                                    Terapkan Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div
                    x-show="openJenisPesananModal"
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
                    x-show="openJenisPesananModal"
                    class="fixed inset-0 flex items-center justify-center z-50"
                    x-cloak
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-5 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-5 scale-95"
                >
                    <div class="bg-white p-6 rounded w-80 text-center" @click.away="openJenisPesananModal = false">
                        <h2 class="text-lg font-bold mb-4">Pilih Kategori Layanan</h2>

                        <div class="flex flex-col gap-4">

                        <a 
                            href="{{ route('pesanan.create', ['tipe' => 'Reguler']) }}" 
                            class="bg-blue-400 hover:bg-blue-500 text-white py-2 rounded"
                        >
                            Reguler
                        </a>

                        <a 
                            href="{{ route('pesanan.create', ['tipe' => 'Express']) }}" 
                            class="bg-blue-400 hover:bg-blue-500 text-white py-2 rounded"
                        >
                            Express
                        </a>

                        <a 
                            href="#"
                            x-on:click="openJenisPesananModal = false"
                            class="mr-2 text-gray-500"
                        >
                            Batal
                        </a>
                        </div>
                    </div>
                </div>

                <table class="min-w-full bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Pelanggan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nomor Telepon
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Terima
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estimasi Selesai
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status Pembayaran
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status Cucian
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total Harga
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanans as $index => $pesanan)
                            <tr
                                class="cursor-pointer hover:bg-gray-200"
                                onclick="window.location.href='{{ route('pesanan.detail', ['id' => $pesanan->id]) }}'"
                                >
                            <td class="px-6 py-4 whitespace-nowrap">{{ $pesanans->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $pesanan->pelanggan->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $pesanan->pelanggan->nomor_telepon }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $pesanan->details->first()?->layanan?->kategori ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($pesanan->tanggal_terima)->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($pesanan->tanggal_selesai)->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $pesanan->status_pembayaran }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $pesanan->status_cucian }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                <td class="py-2 px-4 border-b relative"
                                    x-data="{ openSelectionModal: false, selectedPesanan: {} }">
                                    <!-- dropdown -->
                                    <button
                                        class="text-gray-500 p-2 rounded-full focus:outline-none hover:text-gray-700"
                                        x-on:click.stop="openSelectionModal = true; selectedPesanan = {{ $pesanan }};"
                                    >
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>

                                    <div
                                        x-show="openSelectionModal"
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
                                        x-show="openSelectionModal"
                                        class="fixed inset-0 flex items-center justify-center z-50"
                                        x-cloak
                                        x-transition:enter="transition ease-out duration-300 transform"
                                        x-transition:enter-start="opacity-0 translate-y-5 scale-95"
                                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                        x-transition:leave="transition ease-in duration-200 transform"
                                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-5 scale-95"
                                        x-on:click="openSelectionModal = false; event.stopPropagation();"
                                    >
                                        <div
                                            id="openSelectionModal"
                                            class="bg-white p-6 rounded w-96"
                                            x-on:click.stop
                                        >
                                            <form
                                                action="{{ route('pesanan.updateStatus', ['id' => $pesanan->id]) }}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('PUT')
                                                <label>Status Cucian</label>
                                                <select name="status_cucian" id="status_cucian" class="w-full border rounded p-2">
                                                    <option value="Belum Dicuci" :selected="selectedPesanan.status_cucian === 'Belum Dicuci'">Belum Dicuci</option>
                                                    <option value="Dalam Proses" :selected="selectedPesanan.status_cucian === 'Dalam Proses'">Dalam Proses</option>
                                                    <option value="Selesai" :selected="selectedPesanan.status_cucian === 'Selesai'">Selesai</option>
                                                </select>
                                                <div class="bg-gray-50 p-3 rounded-md">
                                                    <h4 class="font-semibold text-gray-800">Status Pembayaran</h4>
                                                    <div class="flex items-center space-x-4 mt-2">
                                                        <label class="inline-flex items-center">
                                                            <input type="radio" name="status_pembayaran"
                                                                value="Belum Lunas"
                                                                :checked="selectedPesanan.status_pembayaran === 'Belum Lunas'"
                                                                class="form-radio h-5 w-5 text-red-600"
                                                            >
                                                            <span class="ml-2 text-gray-700">Belum Lunas</span>
                                                        </label>
                                                        <label class="inline-flex items-center">
                                                            <input type="radio" name="status_pembayaran"
                                                                value="Lunas"
                                                                :checked="selectedPesanan.status_pembayaran === 'Lunas'"
                                                                class="form-radio h-5 w-5 text-blue-600"
                                                            >
                                                            <span class="ml-2 text-gray-700">Lunas</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col gap-4">
                                                    <button type="submit" class="bg-blue-400 text-white px-4 py-2 rounded hover:bg-blue-500">
                                                        Simpan
                                                    </button>
                                                    @if (auth()->user()->role === 'Admin')
                                                    <button type="button"
                                                        class="bg-green-400 text-white px-4 py-2 rounded hover:bg-green-500"
                                                        x-on:click="window.location.href = '{{ route('pesanan.edit', $pesanan->id) }}'"
                                                    >
                                                        Edit Data Keseluruhan
                                                    </button>
                                                    @endif
                                                </div>
                                            </form>
                                            <form
                                                action="{{ route('pesanan.destroy', $pesanan->id ) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <div class="flex flex-col gap-4">
                                                    @if (auth()->user()->role === 'Admin')
                                                    <button type="submit" class="bg-red-400 text-white px-4 py-2 rounded hover:bg-red-500">
                                                        Hapus Data
                                                    </button>
                                                    @endif
                                                    <button
                                                    type="button"
                                                    class="bg-transparent text-dark shadow-none hover:underline border-none"
                                                    x-on:click=" openSelectionModal = !openSelectionModal;"
                                                    >
                                                        Batal
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if(request()->has('filter') && count(array_filter(request()->only(['kategori', 'tanggal_hari', 'tanggal_bulan', 'tanggal_tahun', 'status_pembayaran', 'status_cucian']))) > 0)
                <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                    <h3 class="font-medium text-blue-800">Filter Aktif:</h3>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @if(request('kategori'))
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                            Kategori: {{ request('kategori') }}
                        </span>
                        @endif
                        
                        @if(request('tanggal_hari') || request('tanggal_bulan') || request('tanggal_tahun'))
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                            Tanggal: 
                            {{ request('tanggal_hari') ? request('tanggal_hari') : '' }}
                            {{ request('tanggal_bulan') ? '/' . request('tanggal_bulan') : '' }}
                            {{ request('tanggal_tahun') ? '/' . request('tanggal_tahun') : '' }}
                        </span>
                        @endif
                        
                        @if(request('status_pembayaran'))
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                            Status Pembayaran: {{ request('status_pembayaran') }}
                        </span>
                        @endif
                        
                        @if(request('status_cucian'))
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                            Status Cucian: {{ request('status_cucian') }}
                        </span>
                        @endif
                    </div>
                </div>
                @endif

                <div class="mt-4">
                    {{ $pesanans->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>