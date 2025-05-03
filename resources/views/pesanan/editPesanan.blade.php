<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pesanan</title>

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

        input, select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            width: 100%;
            height: 42px;
            background-color: white;
        }

        /* Style for alamat and spesifikasi input */
        input[placeholder="Alamat"],
        input[placeholder="Spesifikasi Barang"] {
            height: 60px;
            margin-bottom: 14px;
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
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Edit Pesanan</h1>

        <div 
            class="card-body"
            x-data="formHandler('{{ $pesanan->details[0]->layanan->kategori }}', {{ $pelanggans }}, {{ $pesanan }})"
        >
            <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
                @csrf
                @method('PUT')

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
                </div>
            
                <div class="mb-2">
                    <label class="font-semibold">Pelanggan:</label>
                    <select name="pelanggan_id" class="form-select mb-2 w-full" x-model="pelanggan_id" required id="pelanggan_id">
                        <option value="">--Pilih Pelanggan--</option>
                        @foreach ($pelanggans as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
            
                <div class="mb-2">
                    <label class="font-semibold">Tanggal Terima:</label>
                    <input type="text" id="tanggal_terima" name="tanggal_terima" class="form-control mb-2" x-model="tanggal_terima" required>
                </div>
            
                <div class="mb-2">
                    <label class="font-semibold">Tanggal Selesai:</label>
                    <input type="text" id="tanggal_selesai" name="tanggal_selesai" class="form-control mb-2" x-model="tanggal_selesai" required>
                </div>
                
                <div class="mb-4">
                    <label class="font-semibold">Status Cucian:</label>
                    <select name="status_cucian" class="form-select mb-2 w-full" x-model="status_cucian" required>
                        <option value="Belum Dicuci">Belum Dicuci</option>
                        <option value="Dalam Proses">Dalam Proses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
            
                <template x-for="(item, index) in items" :key="index">
                    <div class="border p-4 mb-4 bg-gray-100 rounded-lg shadow-md">
                        <div class="grid grid-cols-1 gap-2 mb-3">
                            <label class="font-semibold">Layanan</label>
                            <select :name="`layanan_id[]`" x-model="item.layanan_id" class="form-select mb-2 w-full layanan-select">
                                <option value="">--Pilih Layanan--</option>
                                <template x-for="layanan in layananFiltered(item)" :key="layanan.id">
                                    <option :value="layanan.id" x-text="`${layanan.jenis_laundry}`" :selected="layanan.id == item.layanan_id"></option>
                                </template>
                            </select>
                            <input type="text" class="form-control mb-2 w-full" :name="`jenis_barang[]`" x-model="item.jenis_barang" placeholder="Jenis Barang">
                            <input type="text" class="form-control mb-2 w-full" :name="`spesifikasi_barang[]`" x-model="item.spesifikasi_barang" placeholder="Spesifikasi">
                            <input type="number" class="form-control mb-2 w-full" :name="`jumlah[]`" x-model="item.jumlah" placeholder="Berat (Kg)/Jumlah Pakaian">
                            <input type="number" class="form-control mb-2 w-full" :name="`harga_satuan[]`" x-model="item.harga_satuan" placeholder="Harga Per kg/Per Satuan">
                        </div>  
                        <button type="button" class="btn btn-danger w-full py-2 bg-red-400 text-white rounded hover:bg-red-500" @click="items.splice(index, 1)">Hapus</button>
                    </div>
                </template>
            
                <button type="button" class="btn btn-secondary py-2 px-4 bg-blue-400 text-white rounded hover:bg-blue-500" @click="items.push({ layanan_id: '', jenis_barang: '', spesifikasi_barang: '', jumlah: '', harga_satuan: '' })">
                    Tambah Layanan
                </button>
            
                <!-- Modal Trigger -->
                <button type="button" class="btn btn-primary py-2 px-6 mt-4 bg-blue-400 text-white rounded hover:bg-blue-500" @click="showModal = true">Update Pesanan</button>

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
                        <h2 class="text-2xl font-semibold mb-4 text-center">Konfirmasi Update Pesanan</h2>

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
                            <p><strong>Status Cucian:</strong><span x-text="status_cucian"></span></p>
                        </div>

                        <div class="mb-4">
                            <h3 class="font-bold">Detail Layanan:</h3>
                            <template x-for="(item, index) in items" :key="index">
                                <div class="border p-2 my-2 rounded bg-gray-50">
                                    <p><strong>Layanan:</strong> <span x-text="getNamaLayanan(item.layanan_id)"></span></p>
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

                        <div class="flex justify-end gap-4 mt-4">
                            <button type="submit" class="bg-blue-400 text-white px-6 py-2 rounded hover:bg-blue-500">Konfirmasi & Update</button>
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
                
                get layananFiltered() {
                    return (item) => {
                        return this.layananAll.filter(l =>
                            l.kategori === this.kategori || l.id === parseInt(item.layanan_id)
                        );
                    };
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
                    return this.items.reduce((sum, i) => sum + (parseInt(i.harga_satuan || 0) * parseInt(i.jumlah || 0)), 0);
                },

                formatTanggal(dateStr) {
                    if (!dateStr) return '-';
                    const options = { day: '2-digit', month: 'long', year: 'numeric' };
                    return new Date(dateStr).toLocaleDateString('id-ID', options);
                },
                
                init() {
                    const self = this;
                    

                    const details = @json($pesanan->details);

                    if (details.length > 0) {
                        const layanan = this.layananAll.find(l => l.id == details[0].layanan_id);
                        if (layanan) {
                            this.kategori = layanan.kategori;
                        }
                    }

                    this.items = details.map(detail => ({
                        id: detail.id,
                        layanan_id: detail.layanan_id.toString(),
                        jenis_barang: detail.jenis_barang,
                        spesifikasi_barang: detail.spesifikasi_barang,
                        jumlah: detail.jumlah,
                        harga_satuan: detail.harga_satuan
                    }));
                                    
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

                        this.items.forEach((item, index) => {
                            const layananId = item.layanan_id;
                            if (layananId) {
                                const selector = `.layanan-select:eq(${index})`;
                                if ($(selector).length) {
                                    $(selector).val(layananId);
                                }
                            }
                        });
                    });
                }
            }
        }
    </script>
</body>
</html>