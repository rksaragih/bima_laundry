<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pesanan</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.0/cdn.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" defer></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        biruBima: '#6FBcFF',
                        biruBimaDark: '#3B82F6',
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    },
                    animation: {
                        'slide-in': 'slideIn 0.3s ease-out',
                        'fade-in': 'fadeIn 0.3s ease-out',
                    },
                    keyframes: {
                        slideIn: {
                            '0%': { transform: 'translateY(-10px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' }
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        }
                    }
                },
            },
        };
    </script>

    <style>
        [x-cloak] { display: none !important; }
        
        .select2-container--default .select2-selection--single {
            height: 48px !important;
            padding: 12px 16px !important;
            border: 2px solid #e5e7eb !important;
            border-radius: 12px !important;
            transition: all 0.2s ease !important;
        }
        
        .select2-container--default .select2-selection--single:focus-within {
            border-color: #6FBcFF !important;
            box-shadow: 0 0 0 3px rgba(111, 188, 255, 0.1) !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px !important;
            padding-left: 0 !important;
            color: #374151 !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px !important;
        }
        
        .flatpickr-input[readonly] {
            background-color: white !important;
            cursor: pointer !important;
        }

        .form-input {
            @apply w-full px-4 py-3 border-2 border-gray-200 rounded-xl transition-all duration-200 focus:border-biruBima focus:ring-4 focus:ring-blue-50 outline-none;
        }

        .btn-primary {
            @apply bg-gradient-to-r from-biruBima to-biruBimaDark text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200;
        }

        .btn-secondary {
            @apply bg-gray-100 text-gray-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-200;
        }

        .btn-danger {
            @apply bg-gradient-to-r from-red-400 to-red-500 text-white px-4 py-2 rounded-lg font-medium hover:from-red-500 hover:to-red-600 transition-all duration-200;
        }

        .card {
            @apply bg-white rounded-2xl shadow-lg border border-gray-100 p-6;
        }

        .card-header {
            @apply border-b border-gray-100 pb-4 mb-6;
        }

        .sidebar-link {
            @apply flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-50;
        }

        .sidebar-link.active {
            @apply bg-gradient-to-r from-biruBima to-biruBimaDark text-white shadow-lg;
        }

        .item-card {
            @apply bg-gradient-to-br from-gray-50 to-white border-2 border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-200;
        }
    </style>

</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="flex min-h-screen" x-data="{ openModalTambahPelanggan: false }">

        <!-- ini sidebar -->
        <div class="w-1/5 min-w-[240px] bg-white shadow-lg sticky top-0 h-screen overflow-y-auto">
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
                            <i class="fas fa-sign-out-alt mr-3"></i> Keluar
                        </a>
        
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex-1 p-10">

            <header class="bg-biruBima rounded-xl text-white px-6 py-4 shadow-sm">
                <div class="flex justify-between items-center">
                <div class="text-2xl font-semibold">Edit Pesanan</div>
                <div class="text-2xl font-semibold ml-auto">{{ Auth::user()->role }}</div>
                </div>
            </header>

            <div 
                class="space-y-6 grid grid-cols-1 gap-4 p-4 bg-white rounded-xl shadow-lg"
                x-data="formHandler('{{ $pesanan->details[0]->layanan?->kategori ?? 'Reguler' }}', {{ $pelanggans }}, {{ $pesanan }})"
            >

                <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="kategori" :value="kategori">

                    <div class="card-header">
                        <label class="text-xl font-bold text-gray-800">Kategori</label>
                        <div class="flex gap-6 mt-2">
                            <label class="flex items-center cursor-pointer group">
                                <input type="radio" name="kategori" value="Reguler" x-model="kategori" class="sr-only">
                                <div class="flex items-center space-x-3 px-6 py-3 rounded-xl border-2 transition-all duration-200"
                                     :class="kategori === 'Reguler' ? 'border-biruBima bg-blue-50 text-biruBimaDark' : 'border-gray-200 hover:border-gray-300'">
                                    <i class="fas fa-clock text-lg"></i>
                                    <span class="font-semibold">Reguler</span>
                                </div>
                            </label>
                            <label class="flex items-center cursor-pointer group">
                                <input type="radio" name="kategori" value="Express" x-model="kategori" class="sr-only">
                                <div class="flex items-center space-x-3 px-6 py-3 rounded-xl border-2 transition-all duration-200"
                                     :class="kategori === 'Express' ? 'border-biruBima bg-blue-50 text-biruBimaDark' : 'border-gray-200 hover:border-gray-300'">
                                    <i class="fas fa-bolt text-lg"></i>
                                    <span class="font-semibold">Express</span>
                                </div>
                            </label>
                        </div>
                    </div>
                
                    <div class="my-6">

                        <label class="block text-sm mb-2 font-semibold text-gray-700">
                            <i class="fas fa-user mr-2 text-biruBima"></i>Pilih Pelanggan
                        </label>

                        <select name="pelanggan_id" class="form-select mb-2 w-full" x-model="pelanggan_id" required id="pelanggan_id">
                            <option value="">--Pilih Pelanggan--</option>
                            @foreach ($pelanggans as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }} (+{{ $p->nomor_telepon }})</option>
                            @endforeach
                        </select>

                        <button 
                            type="button" 
                            x-on:click.stop="openModalTambahPelanggan = true"  
                            class="mt-3 text-biruBima hover:text-biruBimaDark font-semibold text-sm flex items-center">
                            <i class="fas fa-plus mr-2"></i> Tambah Pelanggan Baru
                        </button>
                    
                    </div>
                
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <i class="fas fa-calendar-alt mr-2 text-biruBima"></i> Tanggal Terima
                            </label>
                            <input type="text" id="tanggal_terima" name="tanggal_terima" class="form-input w-full border rounded p-2" x-model="tanggal_terima" required>
                        </div>
                    
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                <i class="fas fa-calendar-alt mr-2 text-biruBima"></i> Tanggal Selesai
                            </label>
                            <input type="text" id="tanggal_selesai" name="tanggal_selesai" class="form-input w-full mb-4 border rounded p-2" x-model="tanggal_selesai" required>
                        </div>

                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">
                            <i class="fas fa-gears mr-2 text-biruBima"></i>Status Cucian
                        </label>
                        <select name="status_cucian" class="form-select border rounded p-2 mb-4 w-full" x-model="status_cucian" required>
                            <option value="Belum Dicuci">Belum Dicuci</option>
                            <option value="Dalam Proses">Dalam Proses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                
                    <template x-for="(item, index) in items" :key="`item-${index}`">
                        <div class="border p-4 mb-4 bg-gray-100 rounded-lg shadow-md">
                            <div class="grid grid-cols-1 gap-2 mb-3">
                                <label class="font-semibold">Layanan</label>

                                <select :name="`layanan_id[]`" 
                                        x-model="item.layanan_id" 
                                        class="form-select mb-2 p-2 w-full border rounded"
                                        :id="`layanan_select_${index}`">
                                    <option value="">--Pilih Layanan--</option>

                                    <template x-for="layanan in layananFiltered(item)" :key="`layanan-${layanan.id}`">
                                        <option :value="layanan.id" 
                                                x-text="layanan.jenis_laundry" 
                                                :selected="layanan.id == item.layanan_id">
                                        </option>
                                    </template>
                                    
                                    <template x-if="item.layanan_id && !layananExists(item.layanan_id)">
                                        <option :value="item.layanan_id" 
                                                x-text="`⚠️ Layanan tidak tersedia (ID: ${item.layanan_id})`" 
                                                selected 
                                                style="color: #dc2626; background-color: #fef2f2;">
                                        </option>
                                    </template>
                                </select>

                                <template x-if="item.layanan_id && !layananExists(item.layanan_id)">
                                    <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded text-sm mb-2">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <strong>Peringatan:</strong> Layanan ini sudah tidak tersedia. 
                                        Pilih layanan lain atau biarkan untuk mempertahankan data historis.
                                    </div>
                                </template>

                                <input type="text" 
                                    class="form-input mb-4 w-full border rounded p-2" 
                                    :name="`jenis_barang[]`" 
                                    x-model="item.jenis_barang" 
                                    placeholder="Jenis Barang">
                                    
                                <input type="text" 
                                    class="form-input mb-4 w-full border rounded p-2" 
                                    :name="`spesifikasi_barang[]`" 
                                    x-model="item.spesifikasi_barang" 
                                    placeholder="Spesifikasi">
                                    
                                <input type="number" 
                                    onkeydown="return !['e','E','+','-'].includes(event.key)" 
                                    class="form-input mb-4 w-full border rounded p-2" 
                                    :name="`jumlah[]`" 
                                    x-model="item.jumlah" 
                                    placeholder="Berat (Kg)/Jumlah Pakaian">
                                    
                                <input type="number" 
                                    onkeydown="return !['e','E','+','-'].includes(event.key)" 
                                    class="form-input mb-4 w-full border rounded p-2" 
                                    :name="`harga_satuan[]`" 
                                    x-model="item.harga_satuan" 
                                    placeholder="Harga Per kg/Per Satuan">
                            </div>  
                            
                            <button type="button" 
                                    class="btn btn-danger w-full py-2 bg-red-400 text-white rounded hover:bg-red-500" 
                                    @click="items.splice(index, 1)"
                                    :disabled="items.length <= 1">
                                <i class="fas fa-trash mr-2"></i>Hapus Item
                            </button>
                        </div>
                    </template>

                    <button type="button" 
                            class="btn btn-secondary py-2 px-4 bg-blue-400 text-white rounded hover:bg-blue-500 mb-4" 
                            @click="items.push({ layanan_id: '', jenis_barang: '', spesifikasi_barang: '', jumlah: '', harga_satuan: '' })">
                        <i class="fas fa-plus mr-2"></i>Tambah Layanan
                    </button>
                
                    <button type="button" class="btn btn-primary py-2 px-6 mt-4 bg-blue-400 text-white rounded hover:bg-blue-500" @click="showModal = true">
                        <i class="fas fa-edit mr-2"></i>Perbarui Pesanan
                    </button>

                    <div 
                        x-show="showModal" x-cloak
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 bg-black bg-opacity-50 z-40"
                    >
                    </div>
                    <div 
                        class="fixed inset-0 flex items-center justify-center z-50 p-4" 
                        x-show="showModal" x-cloak
                        x-transition:enter="transition ease-out duration-300" 
                        x-transition:enter-start="opacity-0 translate-y-5" 
                        x-transition:enter-end="opacity-100 translate-y-0" 
                        x-transition:leave="transition ease-in duration-200" 
                        x-transition:leave-start="opacity-100 translate-y-0" 
                        x-transition:leave-end="opacity-0 translate-y-5"
                    >
                        <div class="bg-white w-full max-w-lg rounded-lg shadow-xl flex flex-col max-h-[90vh]">
                            <div class="p-6 border-b">
                                <h2 class="text-2xl font-semibold text-center">Konfirmasi Pesanan</h2>
                            </div>

                            <div class="overflow-y-auto p-6 flex-grow">
                                <div class="mb-4">
                                    <p><strong>Kategori:</strong> <span x-text="kategori"></span></p>
                                    <p><strong>Pelanggan: </strong>
                                        <template x-if="pelanggan_id">
                                            <span x-text="getNamaPelanggan(pelanggan_id)"></span>
                                        </template>
                                    </p>
                                    <p><strong>Nomor Telepon: </strong>
                                        <template x-if="pelanggan_id">
                                            <span x-text="getTeleponPelanggan(pelanggan_id)"></span>
                                        </template>
                                    </p>
                                    <p><strong>Alamat: </strong>
                                        <template x-if="pelanggan_id">
                                            <span x-text="getAlamatPelanggan(pelanggan_id)"></span>
                                        </template>
                                    </p>
                                    <p><strong>Tanggal Terima: </strong><span x-text="formatTanggal(tanggal_terima)"></span></p>
                                    <p><strong>Tanggal Selesai: </strong><span x-text="formatTanggal(tanggal_selesai)"></span></p>
                                    <p><strong>Status Cucian: </strong><span x-text="status_cucian"></span></p>
                                </div>

                                <div class="mb-4">
                                    <h3 class="font-bold">Detail Layanan:</h3>
                                    <template x-for="(item, index) in items" :key="index">
                                        <div class="border p-2 my-2 rounded bg-gray-50">
                                            <p><strong>Layanan: </strong> <span x-text="getNamaLayanan(item.layanan_id)"></span></p>
                                            <p><strong>Jenis Barang:</strong> <span x-text="item.jenis_barang"></span></p>
                                            <p><strong>Spesifikasi:</strong> <span x-text="item.spesifikasi_barang"></span></p>
                                            <p><strong>Jumlah/Berat (Kg):</strong> <span x-text="item.jumlah + ' ' + getSatuan(item.layanan_id)""></span></p>
                                            <p><strong>Harga Satuan:</strong> Rp<span x-text="item.harga_satuan"></span></p>
                                            <p><strong>Subtotal:</strong> Rp<span x-text="item.jumlah * item.harga_satuan"></span></p>
                                        </div>
                                    </template>
                                </div>

                                <div class="mb-4 font-bold text-right">
                                    Total: Rp.<span x-text="getTotalHarga()"></span>
                                </div>

                                <div class="mt-4">
                                    <p class="font-semibold mb-2">Status Pembayaran</p>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer text-gray-700">
                                            <input 
                                                type="radio" name="status_pembayaran" 
                                                value="Lunas" x-model="status_pembayaran" 
                                                class="text-blue-500 focus:ring-blue-400 border-gray-300 rounded"
                                            > 
                                            <span class="whitespace-nowrap">Lunas</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer text-gray-700">
                                            <input 
                                                type="radio" name="status_pembayaran" 
                                                value="Belum Lunas" x-model="status_pembayaran" 
                                                class="text-blue-500 focus:ring-blue-400 border-gray-300 rounded"
                                            > 
                                            <span class="whitespace-nowrap">Belum Lunas</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 border-t flex justify-end gap-4 bg-white">
                                <button type="submit" class="bg-blue-400 text-white px-6 py-2 rounded hover:bg-blue-500">Konfirmasi & Perbarui</button>
                                <button type="button" @click="showModal = false" class="bg-red-400 text-white px-6 py-2 rounded hover:bg-red-500">Batal</button>
                            </div>
                        </div>
                    </div>

                    <button 
                        type="button" 
                        class="btn btn-primary py-2 px-6 mt-4 bg-gray-400 text-white rounded hover:bg-gray-500" 
                        onclick="window.location.href='{{ route('pesanan.index') }}'"
                    >
                        Kembali
                    </button>

                </form>

            </div>
        </div>

        <div 
            x-show="openModalTambahPelanggan"
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
            x-show="openModalTambahPelanggan" 
            class="fixed inset-0 flex items-center justify-center z-50 p4" 
            x-cloak
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-5 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-5 scale-95"
        >
            <div class="bg-white p-6 rounded shadow-lg w-80" @click.away="openModalTambahPelanggan = false">
                <h2 class="text-lg font-bold mb-4">Tambah Pelanggan</h2>
                <form action="{{ route('pelanggan.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-1">Nama</label>
                        <input type="text" name="nama" class="w-full border rounded p-2" required autocomplete="off">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1">Alamat</label>
                        <input type="text" name="alamat" class="w-full border rounded p-2" required autocomplete="off">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1">Nomor Telepon</label>
                        <input type="number" onkeydown="return !['e','E','+','-'].includes(event.key)" name="nomor_telepon" class="w-full border rounded p-2" required autocomplete="off">
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" x-on:click="openModalTambahPelanggan = false" class="text-gray-500">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>    
        function formHandler(kategoriAwal, pelangganData, pesananData) {
            return {
                kategori: kategoriAwal,
                pelanggan_id: pesananData.pelanggan_id,
                tanggal_terima: pesananData.tanggal_terima,
                tanggal_selesai: pesananData.tanggal_selesai,
                status_cucian: pesananData.status_cucian,
                status_pembayaran: pesananData.status_pembayaran,
                showModal: false,
                pelangganList: pelangganData,
                items: [],
                
                layananAll: @json($layanans),
                
                layananExists(layananId) {
                    return this.layananAll.some(l => l.id == layananId);
                },
                
                layananFiltered(item) {
                    return this.layananAll.filter(l => l.kategori === this.kategori);
                },
                
                getNamaLayanan(id) {
                    const l = this.layananAll.find(l => l.id == id);
                    if (l) {
                        return `${l.jenis_laundry} (${l.kategori})`;
                    } else if (id) {
                        return `⚠️ Layanan tidak tersedia (ID: ${id})`;
                    }
                    return '—';
                },
                
                getSatuan(layanan_id) {
                    const layanan = this.layananAll.find(l => l.id == layanan_id);
                    if (layanan) {
                        return layanan.jenis_laundry === 'Satuan' ? 'potong' : 'Kg';
                    }
                    return 'unit';
                },
                
                getNamaPelanggan(id) {
                    const p = this.pelangganList.find(p => p.id == id);
                    return p ? p.nama : '-';
                },
                
                getTeleponPelanggan(id) {
                    const p = this.pelangganList.find(p => p.id == id);
                    return p ? p.nomor_telepon : '-';
                },

                getAlamatPelanggan(id) {
                    const p = this.pelangganList.find(p => p.id == id);
                    return p ? p.alamat : '-';
                },
                
                getTotalHarga() {
                    return this.items.reduce((sum, i) => sum + (parseInt(i.harga_satuan || 0) * parseInt(i.jumlah || 0)), 0);
                },

                formatTanggal(dateStr) {
                    if (!dateStr) return '-';
                    const options = { day: '2-digit', month: 'long', year: 'numeric' };
                    return new Date(dateStr).toLocaleDateString('id-ID', options);
                },

                handleKategoriChange() {
                    this.items.forEach(item => {
                        if (item.layanan_id) {
                            const layanan = this.layananAll.find(l => l.id == item.layanan_id);
                            if (layanan && layanan.kategori !== this.kategori) {
                                item.layanan_id = '';
                            }
                        }
                    });
                },
                
                init() {
                    const self = this;
                    const details = @json($pesanan->details);

                    this.items = details.map(detail => ({
                        id: detail.id,
                        layanan_id: detail.layanan_id ? detail.layanan_id.toString() : '',
                        jenis_barang: detail.jenis_barang || '',
                        spesifikasi_barang: detail.spesifikasi_barang || '',
                        jumlah: detail.jumlah || '',
                        harga_satuan: detail.harga_satuan || ''
                    }));

                    if (this.items.length === 0) {
                        this.items.push({
                            layanan_id: '',
                            jenis_barang: '',
                            spesifikasi_barang: '',
                            jumlah: '',
                            harga_satuan: ''
                        });
                    }

                    if (details.length > 0) {
                        let foundKategori = null;
                        
                        for (let detail of details) {
                            const layanan = this.layananAll.find(l => l.id == detail.layanan_id);
                            if (layanan) {
                                foundKategori = layanan.kategori;
                                break;
                            }
                        }
                        
                        this.kategori = foundKategori || kategoriAwal || 'Reguler';
                    }

                    this.$watch('kategori', () => {
                        this.handleKategoriChange();
                    });
                                    
                    this.$nextTick(() => {
                        flatpickr("#tanggal_terima", {
                            altInput: true,
                            altFormat: "d F Y",
                            dateFormat: "Y-m-d",
                            locale: "id",
                            defaultDate: this.tanggal_terima,
                            onChange: function(selectedDates, dateStr) {
                                self.tanggal_terima = dateStr;
                            }
                        });
                        
                        flatpickr("#tanggal_selesai", {
                            altInput: true,
                            altFormat: "d F Y",
                            dateFormat: "Y-m-d",
                            locale: "id",
                            defaultDate: this.tanggal_selesai,
                            onChange: function(selectedDates, dateStr) {
                                self.tanggal_selesai = dateStr;
                            }
                        });
                        
                        $('#pelanggan_id').select2({
                            placeholder: "Cari Pelanggan...",
                            allowClear: true,
                            width: '100%'
                        }).val(this.pelanggan_id).trigger('change').on('change', function() {
                            self.pelanggan_id = $(this).val();
                        });
                    });
                }
            }
        }
    </script>

    @if(session('kirim_wa'))
        <div id="whatsappModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-xl">
                <div class="text-center mb-4">
                    <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <h2 class="text-xl font-semibold mt-2">Kirim WhatsApp</h2>
                </div>
                
                <p class="text-center text-gray-700 mb-5">
                    Kirim notifikasi WhatsApp ke <strong>{{ session('kirim_wa.nama') }}</strong>?<br>
                    <span class="text-sm text-gray-600">Cucian sudah selesai dan siap diambil.</span>
                </p>
                
                <div class="flex justify-center space-x-4">
                    <button
                        type="button"
                        onclick="closeWhatsAppModal()"
                        class="bg-gray-300 text-gray-900 px-4 py-2 rounded hover:bg-gray-400 transition w-24 text-sm">
                        Batal
                    </button>

                    <button
                        type="button"
                        onclick="sendWhatsApp()"
                        class="bg-green-500 text-white px-4 py-2 hover:bg-green-600 rounded transition w-24 text-sm">
                        Kirim
                    </button>
                </div>
            </div>
        </div>

        <script>
            function closeWhatsAppModal() {
                document.getElementById('whatsappModal').remove();
            }

            function sendWhatsApp() {
                const nama = @json(session('kirim_wa.nama'));
                const alamat = @json(session('kirim_wa.alamat'));
                const no_hp = @json(session('kirim_wa.no_hp'));
                const msg = encodeURIComponent(`Halo ${nama}, cucian Anda telah selesai. Silakan datang untuk mengambilnya.\nYes`);
                
                if (no_hp) {
                    window.open(`https://wa.me/${no_hp}?text=${msg}`, '_blank');
                }
                closeWhatsAppModal();
            }

            document.addEventListener('DOMContentLoaded', function() {
            });
        </script>
    @endif
    
</body>
</html>