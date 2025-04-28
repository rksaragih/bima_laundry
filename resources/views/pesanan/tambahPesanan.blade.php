<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Data Pesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
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
        document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi flatpickr untuk tanggal terima
        const fpTerimaOptions = {
            dateFormat: "d F Y",
            locale: "id",
            minDate: "today",
            onChange: function(selectedDates, dateStr) {
                // Update hidden input dengan format tanggal untuk backend (YYYY-MM-DD)
                document.getElementById('tanggal_terima').value = formatDateForBackend(selectedDates[0]);
                
                // Set min date untuk estimasi selesai menjadi tanggal terima + 1 hari
                let minSelesaiDate = new Date(selectedDates[0]);
                minSelesaiDate.setDate(minSelesaiDate.getDate() + 1);
                fpSelesai.set('minDate', minSelesaiDate);
                
                // Reset tanggal selesai jika lebih awal dari min date
                const tanggalSelesaiDate = fpSelesai.selectedDates[0];
                if (tanggalSelesaiDate && tanggalSelesaiDate < minSelesaiDate) {
                    fpSelesai.clear();
                }
            }
        };
        
        const fpSelesaiOptions = {
            dateFormat: "d F Y",
            locale: "id",
            minDate: "today",
            onChange: function(selectedDates, dateStr) {
                // Update hidden input dengan format tanggal untuk backend (YYYY-MM-DD)
                document.getElementById('tanggal_selesai').value = formatDateForBackend(selectedDates[0]);
            }
        };
        
        const fpTerima = flatpickr("#tanggal_terima_display", fpTerimaOptions);
        const fpSelesai = flatpickr("#tanggal_selesai_display", fpSelesaiOptions);
        
        // Set tanggal default untuk tanggal terima (hari ini)
        const today = new Date();
        fpTerima.setDate(today);
        document.getElementById('tanggal_terima').value = formatDateForBackend(today);
        
        // Set tanggal default untuk estimasi selesai (hari ini + 1 hari)
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        fpSelesai.setDate(tomorrow);
        document.getElementById('tanggal_selesai').value = formatDateForBackend(tomorrow);
        });

        const radioButtons = document.querySelectorAll('input[name="konfirmasi_status_pembayaran"]');
        radioButtons.forEach(function(radio) {
            radio.addEventListener('change', function() {
                // Update nilai status pembayaran di form
                document.getElementById('status_pembayaran').value = this.value;
            });
        });
        
        function formatDateForBackend(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
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

        [x-cloak] {
            display: none !important;
        }

    </style>

</head>
<body>
    <div class="container"  x-data="{ openModalTambahPelanggan: false }">
        <h1><b>Tambah Pesanan</b></h1>

        <form action="{{ route('pesanan.store') }}" method="POST" id="pesananForm">
            @csrf

            <input type="hidden" name="tipe_pesanan" value="{{ $tipe }}">

            <input type="hidden" name="status_pembayaran" id="status_pembayaran" value="Belum Lunas">

            <!-- Pelanggan -->
            <div>
                <label>Pelanggan</label>
                <select name="id_pelanggan" x-model="id_pelanggan" id="id_pelanggan" class="w-full border rounded p-2">
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id }}"
                            data-nama ="{{ $pelanggan->nama }}"
                            data-alamat="{{ $pelanggan->alamat }}"
                            data-telepon="{{ $pelanggan->nomor_telepon }}"
                            >
                            {{ $pelanggan->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button x-on:click="openModalTambahPelanggan = true" class="mt-2 text-blue-500 text-sm hover:underline">
                + Tambah Pelanggan Baru
            </button>

            <!-- Layanan -->
            <div class="mb-4">
                <label>Layanan</label>
                <select name="id_layanan" id="id_layanan" class="w-full border rounded p-2" required>
                    <option value="">-- Pilih Layanan --</option>
                    @foreach($layanans as $layanan)
                        <option value="{{ $layanan->id }}"
                            data-layanan="{{ $layanan->jenis_layanan }}"
                            data-harga="{{ $layanan->harga }}"
                            >
                            {{ $layanan->jenis_layanan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Informasi Barang -->
            <div class="mb-4">
                <label>Spesifikasi Barang</label>
                <input type="text" name="spesifikasi_barang" id="spesifikasi_barang" class="w-full border rounded p-2" required>
            </div>
        
            <!-- Jenis Barang -->
            <div class="mb-4">
                <label>Jenis Barang</label>
                <input type="text" name="jenis_barang" id="jenis_barang" class="w-full border rounded p-2" required>
            </div>

            @if($tipe == 'kiloan')
                <div class="mb-4">
                    <label>Berat Pakaian</label>
                    <input type="number" step="0.01" id="berat_pakaian" name="berat_pakaian" placeholder="Berat Pakaian (Kg)" required>
                </div>
            @elseif($tipe == 'satuan')
                <div class="mb-4">
                    <label>Jumlah Pakaian</label>
                    <input type="number" step="0.01" id="jumlah_pakaian" name="jumlah_pakaian" placeholder="Jumlah Pakaian" required>
                </div>
            @endif

            <input type="hidden" name="total_harga" id="total_harga">

            <div class="mb-4">
                <label>Tanggal Terima</label>
                <div class="relative">
                    <input type="text" name="tanggal_terima_display" id="tanggal_terima_display" class="w-full border rounded p-2 cursor-pointer bg-white" readonly required>
                    <input type="hidden" name="tanggal_terima" id="tanggal_terima">
                    <div class="absolute top-0 right-0 px-3 py-2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                        </svg>
                    </div>
                </div>
            </div>
        
            <div class="mb-4">
                <label>Estimasi Selesai</label>
                <div class="relative">
                    <input type="text" name="tanggal_selesai_display" id="tanggal_selesai_display" class="w-full border rounded p-2 cursor-pointer bg-white" readonly required>
                    <input type="hidden" name="tanggal_selesai" id="tanggal_selesai">
                    <div class="absolute top-0 right-0 px-3 py-2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <button type="button" onclick="konfirmasiSimpan()" class="bg-blue-400 h-9 w-20 text-white px-4 py-2 hover:bg-blue-500 rounded text-sm">Simpan</button>
            <button type="button" onclick="window.location.href='{{ route('pesanan.index') }}'" class="bg-gray-500 h-9 w-20 text-white px-4 py-2 hover:bg-gray-600 rounded text-sm">Batal</button>
                
        </form>

        <div id="modalKonfirmasi" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center" x-on:click.outside="modalKonfirmasi = false" >
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
                <h3 class="text-lg font-semibold mb-4">Konfirmasi Data Pesanan</h3>
                
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    <div class="border-b pb-2">
                        <h4 class="font-medium text-blue-500">Detail Pelanggan</h4>
                        <div class="grid grid-cols-1 gap-1 mt-1">
                            <div><span class="font-medium">Nama:</span> <span id="konfirmasi_nama_pelanggan">-</span></div>
                            <div><span class="font-medium">Alamat:</span> <span id="konfirmasi_alamat_pelanggan">-</span></div>
                            <div><span class="font-medium">Telepon:</span> <span id="konfirmasi_telepon_pelanggan">-</span></div>
                        </div>
                    </div>
                    
                    <div class="border-b pb-2">
                        <h4 class="font-medium text-blue-500">Detail Layanan</h4>
                        <div class="grid grid-cols-1 gap-1 mt-1">
                            <div><span class="font-medium">Jenis Layanan:</span> <span id="konfirmasi_jenis_layanan">-</span></div>
                            <div><span class="font-medium">Harga per Unit:</span> Rp <span id="konfirmasi_harga_layanan">-</span></div>
                        </div>
                    </div>
                    
                    <div class="border-b pb-2">
                        <h4 class="font-medium text-blue-500">Detail Barang</h4>
                        <div class="grid grid-cols-1 gap-1 mt-1">
                            <div><span class="font-medium">Spesifikasi:</span> <span id="konfirmasi_spesifikasi_barang">-</span></div>
                            <div><span class="font-medium">Jenis Barang:</span> <span id="konfirmasi_jenis_barang">-</span></div>
                            @if($tipe == 'kiloan')
                                <div><span class="font-medium">Berat Pakaian:</span> <span id="konfirmasi_berat_pakaian">-</span> Kg</div>
                            @elseif($tipe == 'satuan')
                                <div><span class="font-medium">Jumlah Pakaian:</span> <span id="konfirmasi_jumlah_pakaian">-</span></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="border-b pb-2">
                        <h4 class="font-medium text-blue-500">Jadwal</h4>
                        <div class="grid grid-cols-1 gap-1 mt-1">
                            <div><span class="font-medium">Tanggal Terima:</span> <span id="konfirmasi_tanggal_terima">-</span></div>
                            <div><span class="font-medium">Estimasi Selesai:</span> <span id="konfirmasi_tanggal_selesai">-</span></div>
                        </div>
                    </div>
                    
                    <div class="bg-blue-50 p-3 rounded-md">
                        <h4 class="font-semibold text-blue-600">Total Harga</h4>
                        <div class="text-xl font-bold mt-1">Rp <span id="konfirmasi_total_harga">0</span></div>
                    </div>

                    <div class="bg-gray-50 p-3 rounded-md">
                        <h4 class="font-semibold text-gray-800">Status Pembayaran</h4>
                        <div class="flex items-center space-x-4 mt-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="konfirmasi_status_pembayaran" value="Belum Lunas" class="form-radio h-5 w-5 text-red-600" checked>
                                <span class="ml-2 text-gray-700">Belum Lunas</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="konfirmasi_status_pembayaran" value="Lunas" class="form-radio h-5 w-5 text-green-600">
                                <span class="ml-2 text-gray-700">Lunas</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end space-x-3">
                    <button onclick="tutupModal()" class="px-4 py-2 text-white bg-gray-300 hover:bg-gray-400 rounded text-sm">
                        Batal
                    </button>
                    <button onclick="submitForm()" class="px-4 py-2 bg-blue-400 hover:bg-blue-500 text-white rounded text-sm">
                        Ya, Simpan
                    </button>
                </div>
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
            function konfirmasiSimpan() {
                // Validasi form terlebih dahulu
                const form = document.getElementById('pesananForm');
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }
                
                // Ambil nilai-nilai untuk ditampilkan di modal
                const pelangganSelect = document.getElementById('id_pelanggan');
                const pelangganOption = pelangganSelect.options[pelangganSelect.selectedIndex];
                const layananSelect = document.getElementById('id_layanan');
                const layananOption = layananSelect.options[layananSelect.selectedIndex];
                
                // Isi modal dengan data formulir
                // Data Pelanggan
                document.getElementById('konfirmasi_nama_pelanggan').textContent = pelangganOption ? pelangganOption.getAttribute('data-nama') : '-';
                document.getElementById('konfirmasi_alamat_pelanggan').textContent = pelangganOption ? pelangganOption.getAttribute('data-alamat') : '-';
                document.getElementById('konfirmasi_telepon_pelanggan').textContent = pelangganOption ? pelangganOption.getAttribute('data-telepon') : '-';
                
                // Data Layanan
                const namaLayanan = layananOption ? layananOption.getAttribute('data-layanan') : '-';
                const hargaLayanan = layananOption ? parseFloat(layananOption.getAttribute('data-harga')) : 0;
                
                document.getElementById('konfirmasi_jenis_layanan').textContent = namaLayanan;
                document.getElementById('konfirmasi_harga_layanan').textContent = formatRupiah(hargaLayanan);
                
                // Data Barang
                document.getElementById('konfirmasi_spesifikasi_barang').textContent = document.getElementById('spesifikasi_barang').value;
                document.getElementById('konfirmasi_jenis_barang').textContent = document.getElementById('jenis_barang').value;
                
                // Hitung total harga berdasarkan tipe pesanan
                let totalHarga = 0;
                @if($tipe == 'kiloan')
                    const beratPakaian = parseFloat(document.getElementById('berat_pakaian').value) || 0;
                    document.getElementById('konfirmasi_berat_pakaian').textContent = beratPakaian;
                    totalHarga = hargaLayanan * beratPakaian;
                @elseif($tipe == 'satuan')
                    const jumlahPakaian = parseFloat(document.getElementById('jumlah_pakaian').value) || 0;
                    document.getElementById('konfirmasi_jumlah_pakaian').textContent = jumlahPakaian;
                    totalHarga = hargaLayanan * jumlahPakaian;
                @endif
                
                // Simpan total harga ke form (untuk dikirim ke server) dan tampilkan di modal
                document.getElementById('total_harga').value = totalHarga;
                document.getElementById('konfirmasi_total_harga').textContent = formatRupiah(totalHarga);
                
                // Data Jadwal
                const tanggalTerima = document.getElementById('tanggal_terima').value;
                const tanggalSelesai = document.getElementById('tanggal_selesai').value;
                
                document.getElementById('konfirmasi_tanggal_terima').textContent = formatDate(tanggalTerima);
                document.getElementById('konfirmasi_tanggal_selesai').textContent = formatDate(tanggalSelesai);

                document.querySelectorAll('input[name="konfirmasi_status_pembayaran"]').forEach(function(radio) {
                    if (radio.value === "Belum Lunas") {
                        radio.checked = true;
                    }
                });
                
                document.getElementById('status_pembayaran').value = "Belum Lunas";
                
                // Tampilkan modal konfirmasi
                document.getElementById('modalKonfirmasi').classList.remove('hidden');
            }
            
            function formatRupiah(angka) {
                return new Intl.NumberFormat('id-ID').format(angka);
            }
            
            function formatDate(dateString) {
                if (!dateString) return '-';
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                return new Date(dateString).toLocaleDateString('id-ID', options);
            }
            
            function tutupModal() {
                document.getElementById('modalKonfirmasi').classList.add('hidden');
            }
            
            function submitForm() {
                const statusPembayaran = document.querySelector('input[name="konfirmasi_status_pembayaran"]:checked').value;
                document.getElementById('status_pembayaran').value = statusPembayaran;
                // Submit form
                document.getElementById('pesananForm').submit();
                tutupModal();
            }
            
            // Tutup modal jika user klik di luar modal
            window.onclick = function(event) {
                const modal = document.getElementById('modalKonfirmasi');
                if (event.target === modal) {
                    tutupModal();
                }
            }
        </script>

    </div>
</body>
</html>