<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    
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
            background-color: #f6f6f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 600px;
            padding: 20px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .detail-item {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }

        .detail-text {
            padding: 12px 15px;
            font-size: 14px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .cancel-btn, .print-btn {
            border: none;
            border-radius: 30px;
            padding: 10px 0;
            width: 120px;
            font-weight: bold;
            color: white;
            cursor: pointer;
        }

        .cancel-btn {
            background-color: #ff3a3a;
        }

        .print-btn {
            background-color: #00e676;
        }

        /* Smartphone (portrait) */
        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }

            .card {
                padding: 15px;
            }

            h1 {
                font-size: 18px;
                margin-bottom: 15px;
            }

            .detail-text {
                padding: 10px 12px;
                font-size: 13px;
            }

            .button-container {
                gap: 15px;
            }

            .cancel-btn, .print-btn {
                width: 100px;
                padding: 8px 0;
                font-size: 13px;
            }
        }

        /* Smartphone (landscape) dan tablet kecil */
        @media (min-width: 481px) and (max-width: 767px) {
            .container {
                max-width: 500px;
            }

            .card {
                padding: 18px;
            }
        }

        /* Tablet (portrait) */
        @media (min-width: 768px) and (max-width: 1024px) {
            .container {
                max-width: 550px;
            }

            .card {
                padding: 20px;
            }

            .detail-text {
                padding: 12px 15px;
                font-size: 15px;
            }

            .button-container {
                gap: 25px;
            }

            .cancel-btn, .print-btn {
                width: 130px;
            }
        }

        /* Laptop dan desktop */
        @media (min-width: 1025px) and (max-width: 1439px) {
            .container {
                max-width: 600px;
            }

            .card {
                padding: 25px;
            }

            .detail-text {
                padding: 14px 18px;
                font-size: 15px;
            }

            .cancel-btn, .print-btn {
                transition: opacity 0.2s ease;
            }

            .cancel-btn:hover, .print-btn:hover {
                opacity: 0.9;
            }
        }

        /* Large desktops and high-resolution displays */
        @media (min-width: 1440px) and (max-width: 2559px) {
            .container {
                max-width: 650px;
            }

            .card {
                padding: 30px;
            }

            h1 {
                font-size: 22px;
                margin-bottom: 25px;
            }

            .detail-text {
                padding: 15px 20px;
                font-size: 16px;
            }

            .button-container {
                margin-top: 35px;
                gap: 30px;
            }

            .cancel-btn, .print-btn {
                width: 140px;
                padding: 12px 0;
                font-size: 15px;
                transition: transform 0.2s ease, opacity 0.2s ease;
            }

            .cancel-btn:hover, .print-btn:hover {
                opacity: 0.9;
                transform: translateY(-2px);
            }
        }

        /* 4K and ultra-wide displays */
        @media (min-width: 2560px) {
            .container {
                max-width: 800px;
            }

            .card {
                padding: 40px;
                border-radius: 15px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            }

            h1 {
                font-size: 28px;
                margin-bottom: 30px;
            }

            .detail-container {
                gap: 15px;
            }

            .detail-item {
                border-radius: 8px;
            }

            .detail-text {
                padding: 18px 25px;
                font-size: 18px;
            }

            .button-container {
                margin-top: 50px;
                gap: 40px;
            }

            .cancel-btn, .print-btn {
                width: 160px;
                padding: 15px 0;
                font-size: 17px;
                border-radius: 40px;
                transition: transform 0.3s ease, opacity 0.2s ease, box-shadow 0.3s ease;
            }

            .cancel-btn:hover, .print-btn:hover {
                opacity: 0.95;
                transform: translateY(-3px);
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            }
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="card">
            <h1 class="text-2xl font-bold mb-6">Detail Pesanan</h1>

            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <h2 class="text-lg font-semibold mb-4 border-b pb-2">Data Pelanggan</h2>
                <div class="space-y-2">
                    <p><strong>Nama: </strong> {{ $pesanan->pelanggan->nama }} </p>
                    <p><strong>Alamat: </strong> {{ $pesanan->pelanggan->alamat }} </p>
                    <p><strong>No Hp.: </strong> {{ $pesanan->pelanggan->nomor_telepon }} </p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4 border-b pb-2">Data Pesanan</h2>
                <div class="space-y-2">
                    <p><strong>Kategori Pesanan: </strong>{{ $pesanan->details->first()?->layanan?->kategori ?? '-' }}</p>

                    <div class="bg-gray-50 rounded-lg p-5 shadow mb-8">
                        <h2 class="text-xl font-semibold mb-4 text-gray-700 border-b pb-2">Detail Layanan</h2>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr>
                                        <th class="py-3 px-4 border-b text-left bg-gray-100 text-sm font-medium text-gray-600">No</th>
                                        <th class="py-3 px-4 border-b text-left bg-gray-100 text-sm font-medium text-gray-600">Layanan</th>
                                        <th class="py-3 px-4 border-b text-left bg-gray-100 text-sm font-medium text-gray-600">Jenis Barang</th>
                                        <th class="py-3 px-4 border-b text-left bg-gray-100 text-sm font-medium text-gray-600">Spesifikasi</th>
                                        <th class="py-3 px-4 border-b text-left bg-gray-100 text-sm font-medium text-gray-600">Jumlah/Berat</th>
                                        <th class="py-3 px-4 border-b text-left bg-gray-100 text-sm font-medium text-gray-600">Harga Satuan</th>
                                        <th class="py-3 px-4 border-b text-left bg-gray-100 text-sm font-medium text-gray-600">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pesanan->details as $index => $item)
                                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                                        <td class="py-3 px-4 border-b">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4 border-b">{{ $item->layanan->jenis_laundry }}</td>
                                        <td class="py-3 px-4 border-b">{{ $item->jenis_barang }}</td>
                                        <td class="py-3 px-4 border-b">{{ $item->spesifikasi_barang }}</td>
                                        <td class="py-3 px-4 border-b">{{ $item->jumlah }}</td>
                                        <td class="py-3 px-4 border-b">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                        <td class="py-3 px-4 border-b font-medium">Rp {{ number_format($item->jumlah * $item->harga_satuan, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray-100">
                                        <td colspan="6" class="py-3 px-4 border-b text-right font-bold">Total:</td>
                                        <td class="py-3 px-4 border-b font-bold text-blue-600">
                                            Rp {{ number_format($pesanan->details->sum(function($item) { return $item->jumlah * $item->harga_satuan; }), 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <p><strong>Tanggal Terima: </strong>{{ \Carbon\Carbon::parse($pesanan->tanggal_terima)->format('d M Y') }}</p>
                    <p><strong>Estimasi Selesai: </strong>{{ \Carbon\Carbon::parse($pesanan->tanggal_selesai)->format('d M Y') }}</p>

                    <p><strong>Status Cucian: </strong> {{ $pesanan->status_cucian }} </p>
                    <p><strong>Status Pembayaran: </strong> {{ $pesanan->status_pembayaran }} </p>

                    <p><strong>Total Harga: </strong> {{ $pesanan->total_harga }} </p>
                </div>
            </div>

            <div class="button-container mt-6 flex justify-end gap-4">
                <button 
                    class="cancel-btn bg-red-400 text-white px-4 py-2 rounded hover:bg-red-500"
                    onclick="window.location.href='{{ route('pesanan.index') }}'"
                >
                    Cancel
                </button>

                <button 
                    class="print-btn bg-blue-400 text-white px-4 py-2 rounded hover:bg-blue-500"
                    onclick="window.print()"
                >
                    Print
                </button>
            </div>
        </div>
    </div>
</body>
</html>
