<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Data Pesanan</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            padding: 12px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 750px;
            margin: 12px auto;
            background-color: white;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 22px;
            margin-bottom: 22px;
            color: #333;
        }

        .form-section {
            margin-bottom: 22px;
        }

        h2 {
            font-size: 16px;
            margin-bottom: 14px;
            color: #333;
        }

        .form-row {
            display: flex;
            gap: 14px;
            margin-bottom: 14px;
        }

        input, select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            width: 100%;
            height: 42px;
            background-color: white;
        }

        /* Style for full-width inputs */
        .full-width {
            width: 100%;
            margin-bottom: 14px;
        }

        /* Style for alamat and spesifikasi input */
        input[placeholder="Alamat"],
        input[placeholder="Spesifikasi Barang"] {
            height: 60px;
            margin-bottom: 14px;
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 14px;
            padding-right: 35px;
            cursor: pointer;
        }

        button[type="submit"] {
            background-color: #1a73e8;
            color: white;
            padding: 8px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            height: 42px;
            min-width: 120px;
            transition: background-color 0.2s;
        }

        button[type="submit"]:hover {
            background-color: #1557b0;
        }

        /* Smartphone (portrait) */
        @media (max-width: 480px) {
            body {
                padding: 8px;
            }

            .container {
                padding: 16px;
                margin: 8px;
            }

            h1 {
                font-size: 20px;
                margin-bottom: 20px;
            }

            h2 {
                font-size: 15px;
                margin-bottom: 12px;
            }

            .form-section {
                margin-bottom: 20px;
            }

            .form-row {
                flex-direction: column;
                gap: 12px;
                margin-bottom: 12px;
            }

            input, select {
                height: 40px;
                font-size: 14px;
            }

            input[placeholder="Alamat"],
            input[placeholder="Spesifikasi Barang"] {
                height: 55px;
            }

            button[type="submit"] {
                width: 100%;
                height: 40px;
            }
        }

        /* Smartphone (landscape) dan tablet kecil */
        @media (min-width: 481px) and (max-width: 767px) {
            .container {
                padding: 20px;
                margin: 10px;
            }

            h1 {
                font-size: 21px;
                margin-bottom: 20px;
            }

            .form-row {
                flex-direction: column;
                gap: 12px;
            }

            input, select {
                height: 40px;
            }

            input[placeholder="Alamat"],
            input[placeholder="Spesifikasi Barang"] {
                height: 58px;
            }

            button[type="submit"] {
                width: 100%;
                height: 40px;
            }
        }

        /* Tablet (portrait) */
        @media (min-width: 768px) and (max-width: 1024px) {
            .container {
                max-width: 85%;
                padding: 22px;
            }

            h1 {
                font-size: 22px;
            }

            input, select {
                height: 42px;
            }

            input[placeholder="Alamat"],
            input[placeholder="Spesifikasi Barang"] {
                height: 60px;
            }

            button[type="submit"] {
                height: 42px;
                min-width: 130px;
            }
        }

        /* Laptop dan desktop */
        @media (min-width: 1025px) and (max-width: 2559px) {
            .container {
                max-width: 750px;
                padding: 24px;
            }

            input, select {
                height: 42px;
            }

            input[placeholder="Alamat"],
            input[placeholder="Spesifikasi Barang"] {
                height: 60px;
            }

            button[type="submit"] {
                height: 42px;
            }
        }

        /* 4K Display (2560px and above) */
        @media (min-width: 2560px) {
            .container {
                max-width: 900px;
                padding: 28px;
            }

            h1 {
                font-size: 24px;
                margin-bottom: 24px;
            }

            h2 {
                font-size: 17px;
                margin-bottom: 16px;
            }

            .form-section {
                margin-bottom: 24px;
            }

            .form-row {
                gap: 16px;
                margin-bottom: 16px;
            }

            input, select {
                padding: 10px 14px;
                font-size: 15px;
                height: 45px;
                border-radius: 6px;
            }

            input[placeholder="Alamat"],
            input[placeholder="Spesifikasi Barang"] {
                height: 65px;
            }

            select {
                background-size: 15px;
                background-position: right 14px center;
                padding-right: 40px;
            }

            button[type="submit"] {
                height: 45px;
                font-size: 15px;
                padding: 10px 28px;
                min-width: 140px;
            }
        }

        .modal-transition-enter {
            transition: opacity 0.3s ease-out;
            opacity: 0;
        }
        .modal-transition-enter-end {
            opacity: 1;
        }
        .modal-transition-leave {
            transition: opacity 0.3s ease-in;
            opacity: 1;
        }
        .modal-transition-leave-end {
            opacity: 0;
        }

        [x-cloak] {
            display: none !important;
        }

    </style>

</head>
<body>
    <div class="container mx-auto p-6" x-data="openModalTambahPelanggan: false">
        <h1 class="text-3xl font-bold mb-6">Tambah Pesanan</h1>

        <form 
            action="{{ route('pesanan.store') }}" method="POST" 
            x-data="formHandler( '{{ $kategori }}', {{ $pelanggan->toJson() }} )"
            >
            @csrf

            <input type="hidden" name="kategori" :value="kategori">

            <div>
                <label class="font-semibold text-lg">Kategori</label>
                <div class="flex gap-4 mb-4">
                    <label class="flex items-center">
                        <input type="radio" name="kategori" value="Reguler" x-model="kategori" class="mr-2"> Reguler
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="kategori" value="Express" x-model="kategori" class="mr-2"> Express
                    </label>
                </div>
        
            <div class="mb-2">
                <label class="font-semibold">Pelanggan:</label>
                <select name="pelanggan_id" class="form-select mb-2 w-full" x-model="pelanggan_id" required id="pelanggan_id">
                    <option value="">--Pilih Pelanggan--</option>
                    @foreach ($pelanggan as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <button 
                type="button" 
                x-on:click.stop="openModalTambahPelanggan = true"  
                class="mb-4 text-blue-500 text-sm hover:underline">
                + Tambah Pelanggan Baru
            </button>
        
            <div class="mb-2">
                <label class="font-semibold">Tanggal Terima:</label>
                <input type="text" id="tanggal_terima" name="tanggal_terima" class="form-control mb-2" x-model="tanggal_terima" required>
            </div>
        
            <div class="mb-4">
                <label class="font-semibold">Tanggal Selesai:</label>
                <input type="text" id="tanggal_selesai" name="tanggal_selesai" class="form-control mb-2" x-model="tanggal_selesai" required>
            </div>
        
            <template x-for="(item, index) in items" :key="index">
                <div class="border p-4 mb-4 bg-gray-100 rounded-lg shadow-md">
                    <div class="grid grid-cols-1 gap-2 mb-3">
                        <label class="font-semibold">Layanan</label>
                        <select :name="`layanan_id[]`" x-model="item.layanan_id" class="form-select mb-2 w-full">
                            <option value="">--Pilih Layanan--</option>
                            <template x-for="layanan in layananFiltered" :key="layanan.id">
                                <option :value="layanan.id" x-text="`${layanan.jenis_laundry}`"></option>
                            </template>
                        </select>
                        <input type="text" class="form-control mb-2 w-full" :name="`jenis_barang[]`" x-model="item.jenis_barang" placeholder="Jenis Barang">
                        <input type="text" class="form-control mb-2 w-full" :name="`spesifikasi_barang[]`" x-model="item.spesifikasi_barang" placeholder="Spesifikasi">
                        <input type="number" step="0.01" class="form-control mb-2 w-full" :name="`jumlah[]`" x-model="item.jumlah" placeholder="Berat (Kg)/Jumlah Pakaian">
                        <input type="number" step="0.01" class="form-control mb-2 w-full" :name="`harga_satuan[]`" x-model="item.harga_satuan" placeholder="Harga Per kg/Per Satuan">
                    </div>  
                    <button type="button" class="btn btn-danger w-full py-2 bg-red-400 text-white rounded hover:bg-red-500" @click="items.splice(index, 1)">Hapus</button>
                </div>
            </template>
        
            <button type="button" class="btn btn-secondary py-2 px-4 bg-blue-400 text-white rounded hover:bg-blue-500" @click="items.push({ layanan_id: '', jenis_barang: '', spesifikasi_barang: '', jumlah: '', harga_satuan: '' })">
                Tambah Layanan
            </button>
        
            <!-- Modal Trigger -->
            <button type="button" class="btn btn-primary py-2 px-6 mt-4 bg-blue-400 text-white rounded hover:bg-blue-500" @click="showModal = true">Simpan Pesanan</button>

            <!-- Modal Konfirmasi -->
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
                class="fixed inset-0 flex items-center justify-center z-50" 
                x-show="showModal" x-cloak
                x-transition:enter="transition ease-out duration-300" 
                x-transition:enter-start="opacity-0 translate-y-5" 
                x-transition:enter-end="opacity-100 translate-y-0" 
                x-transition:leave="transition ease-in duration-200" 
                x-transition:leave-start="opacity-100 translate-y-0" 
                x-transition:leave-end="opacity-0 translate-y-5"
            >
                <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-xl">
                    <h2 class="text-2xl font-semibold mb-4 text-center">Konfirmasi Pesanan</h2>

                    <div class="mb-4">
                        <p><strong>Kategori:</strong> <span x-text="kategori"></span></p>
                        <p><strong>Pelanggan:</strong>
                            <template x-if="pelanggan_id">
                                <span x-text="getNamaPelanggan(pelanggan_id)"></span>
                            </template>
                        </p>
                        <p><strong>Nomor Telepon:</strong>
                            <template x-if="pelanggan_id">
                                <span x-text="getTeleponPelanggan(pelanggan_id)"></span>
                            </template>
                        </p>
                        <p><strong>Alamat:</strong>
                            <template x-if="pelanggan_id">
                                <span x-text="getAlamatPelanggan(pelanggan_id)"></span>
                            </template>
                        </p>
                        <p><strong>Tanggal Terima:</strong><span x-text="formatTanggal(tanggal_terima)"></span></p>
                        <p><strong>Tanggal Selesai:</strong><span x-text="formatTanggal(tanggal_selesai)"></span></p>
                    </div>

                    <div class="mb-4">
                        <h3 class="font-bold">Detail Layanan:</h3>
                        <template x-for="(item, index) in items" :key="index">
                            <div class="border p-2 my-2 rounded bg-gray-50">
                                <p><strong>Layanan:</strong> <span x-text="getNamaLayanan(item.layanan_id)"></span></p>
                                <p><strong>Jenis Barang:</strong> <span x-text="item.jenis_barang"></span></p>
                                <p><strong>Spesifikasi:</strong> <span x-text="item.spesifikasi_barang"></span></p>
                                <p><strong>Jumlah/Berat (Kg):</strong> <span x-text="item.jumlah + ' ' + getSatuan(item.layanan_id)"></span></p>
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

                    <div class="flex justify-end gap-4">
                        <button type="submit" class="bg-blue-400 text-white px-6 py-2 rounded hover:bg-blue-500">Konfirmasi & Simpan</button>
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
            class="fixed inset-0 flex items-center justify-center z-50" 
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
                        <input type="text" name="nomor_telepon" class="w-full border rounded p-2" required autocomplete="off">
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
        

    <script>
        function formHandler(kategoriAwal, pelangganData) {
            return {
                kategori: kategoriAwal,
                pelanggan_id: '',
                tanggal_terima: '',
                tanggal_selesai: '',
                status_cucian: '',
                status_pembayaran: '',
                showModal: false,
                openModalTambahPelanggan: false,
                pelangganList: pelangganData,
                items: [{ layanan_id: '', jenis_barang: '', spesifikasi_barang: '', jumlah: '', harga_satuan: '' }],
                
                layananAll: @json($layanan),
                
                get layananFiltered() {
                    return this.layananAll.filter(l => l.kategori === this.kategori);
                },
                
                addItem() {
                    this.items.push({ layanan_id: '', jenis_barang: '', spesifikasi_barang: '', jumlah: '', harga_satuan: '' });
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
                
                getNamaLayanan(id) {
                    const l = this.layananAll.find(l => l.id == id);
                    return l ? `${l.jenis_laundry} (${l.kategori})` : '—';
                },

                getSatuan(layanan_id) {
                    const layanan = this.layananAll.find(l => l.id == layanan_id);
                    return layanan && layanan.jenis_laundry === 'Satuan' ? 'potong' : 'Kg';
                },
                
                getTotalHarga() {
                    return this.items.reduce((sum, i) => 
                    {
                        const harga = parseFloat(i.harga_satuan || 0);
                        const jumlah = parseFloat(i.jumlah || 0);
                        return sum + (harga * jumlah);
                    }, 0);
                },

                formatTanggal(dateStr) {
                    if (!dateStr) return '-';
                    const options = { day: '2-digit', month: 'long', year: 'numeric' };
                    return new Date(dateStr).toLocaleDateString('id-ID', options);
                },
                
                init() {
                    this.$nextTick(() => {
                        const today = new Date();
                        const self = this;

                        const formattedDate = today.toISOString().split('T')[0];

                        this.tanggal_terima = formattedDate;
                        this.tanggal_selesai = formattedDate;
                        
                        flatpickr("#tanggal_terima", {
                            altInput: true,
                            altFormat: "d F Y",
                            dateFormat: "Y-m-d",
                            locale: "id",
                            minDate: "today",
                            defaultDate: formattedDate,
                            onChange: function(selectedDates, dateStr) {
                                self.tanggal_terima = dateStr;
                            }
                        });
                        
                        flatpickr("#tanggal_selesai", {
                            altInput: true,
                            altFormat: "d F Y",
                            dateFormat: "Y-m-d",
                            locale: "id",
                            minDate: "today",
                            defaultDate: formattedDate,
                            onChange: function(selectedDates, dateStr) {
                                self.tanggal_selesai = dateStr;
                            }
                        });
                        
                        $('#pelanggan_id').select2({
                            placeholder: "Cari Pelanggan...",
                            allowClear: true,
                            width: '100%'
                        }).on('change', function() {
                            self.pelanggan_id = $(this).val();
                        });
                        
                        // const tanggalTerimaFmt = flatpickr.formatDate(today, "d F Y", 'id');
                        // const tanggalSelesaiFmt = flatpickr.formatDate(today, "d F Y", 'id');
                        // this.tanggal_terima = tanggalTerimaFmt;
                        // this.tanggal_selesai = tanggalSelesaiFmt;
                        
                        this.status_pembayaran = 'Belum Lunas';
                    });
                }
            }
        }
    </script>

    </div>
</body>
</html>