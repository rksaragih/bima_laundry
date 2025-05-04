<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Laundry</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" defer></script>
    
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 30px 0;
        }
        
        .nota-container {
            width: 100%;
            max-width: 500px;
            padding: 30px 20px;
            background-color: white;
        }
        
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        
        .logo-container {
            margin-bottom: 5px;
            display: flex;
            justify-content: center;
        }
        
        .company-name {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 2px;
            margin-top: 4px;
        }
        
        .company-tagline {
            font-size: 12px;
            margin-bottom: 5px;
            font-style: italic;
        }
        
        .nota-title {
            font-weight: bold;
            font-size: 16px;
            margin: 15px 0;
            text-align: center;
            text-decoration: underline;
        }
        
        .info-table {
            width: 100%;
            font-size: 12px;
            margin-bottom: 10px;
            border-collapse: collapse;
        }
        
        .info-table td {
            padding: 3px 0;
        }
        
        .info-label {
            width: 80px;
        }
        
        .info-separator {
            width: 15px;
        }
        
        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        
        .items-table {
            width: 100%;
            font-size: 12px;
            border-collapse: collapse;
        }
        
        .items-table th, .items-table td {
            padding: 5px 0;
            text-align: left;
        }
        
        .items-table th {
            border-bottom: 1px solid #000;
        }
        
        .right-align {
            text-align: right;
        }
        
        .total-row {
            font-weight: bold;
        }
        
        .footer {
            text-align: center;
            font-size: 11px;
            margin-top: 25px;
        }
        
        .footer-address {
            margin-bottom: 3px;
        }
        
        .footer-contact {
            margin-bottom: 5px;
        }
        
        .thank-you {
            font-weight: bold;
            margin-top: 10px;
            font-size: 12px;
        }
        
        /* Hide elements when printing */
        @media print {
            @page {
                size: 80mm auto;
                margin: 5mm;
            }

            body {
                padding: 0;     
                zoom: 1;         
                min-height: auto;
            }

            .nota-container {
                width: 100%;     
                max-width: 100%;
                padding: 10px; 
            }

            .no-print {
                display: none;
            }
        }
    </style>
    
    <script>
        function formatTanggalIndonesia(dateString) {
            if (!dateString) return '';
            
            const bulan = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            
            const date = new Date(dateString);
            const tanggal = date.getDate();
            const namaBulan = bulan[date.getMonth()];
            const tahun = date.getFullYear();
            
            return `${tanggal} ${namaBulan} ${tahun}`;
        }
        
        window.onload = function() {
            const elemenTanggal = document.querySelectorAll('.tanggal-indonesia');
            elemenTanggal.forEach(el => {
                if (el.dataset.tanggal) {
                    el.textContent = formatTanggalIndonesia(el.dataset.tanggal);
                }
            });
            
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</head>
<body style="zoom: 150%;">
    <div class="nota-container">
        <!-- Header with timestamp -->
        <div style="text-align: left; font-size: 12px; color: #666; margin-bottom: 10px;">
            {{ date('d/m/Y, g:i A') }}
        </div>
        
        <!-- Header with Logo -->
        <div class="header">
            <div class="logo-container">
                <!-- Logo T-shirt icon -->
                <div style="width: 40px; height: 40px; display: flex; justify-content: center; align-items: center;">
                    <img
                        alt="Logo"
                        class="mr-3"
                        src="/images/logo-bima-laundry-svg.svg"
                    />
                </div>
            </div>
            <div class="company-tagline">Bersih, Wangi, Tepat Waktu</div>
        </div>
        
        <!-- Nota Title -->
        <div class="nota-title">NOTA LAUNDRY</div>
        
        <!-- Customer Info -->
        <table class="info-table">
            <tr>
                <td class="info-label">No. Nota</td>
                <td class="info-separator">:</td>
                <td>{{ $pesanan->id }}</td>
            </tr>
            <tr>
                <td class="info-label">Tanggal</td>
                <td class="info-separator">:</td>
                <td class="tanggal-indonesia" data-tanggal="{{ $pesanan->tanggal_terima ?? now() }}"></td>
            </tr>
            <tr>
                <td class="info-label">Pelanggan</td>
                <td class="info-separator">:</td>
                <td>{{ $pesanan->pelanggan->nama }}</td>
            </tr>
            <tr>
                <td class="info-label">No HP</td>
                <td class="info-separator">:</td>
                <td>{{ $pesanan->pelanggan->nomor_telepon }}</td>
            </tr>
        </table>
        
        <div class="divider"></div>
        
        <!-- Order Details -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 40%">Item</th>
                    <th style="width: 15%">Qty</th>
                    <th style="width: 20%">Harga</th>
                    <th style="width: 25%" class="right-align">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanan->details ?? [] as $item)
                <tr>
                    <td>{{ $item->layanan->jenis_laundry }} - {{ $item->jenis_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td class="right-align">{{ number_format($item->jumlah * $item->harga_satuan, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="divider"></div>
        
        <table class="info-table" style="margin-bottom: 0;">
            <tr class="total-row">
                <td style="text-align: right; padding-right: 10px;">Total</td>
                <td class="right-align">
                    Rp {{ number_format($pesanan->details->sum(function($item) { return $item->jumlah * $item->harga_satuan; }) ?? 0, 0, ',', '.') }}
                </td>
            </tr>
        </table>
        
        <!-- Order Info -->
        <table class="info-table" style="margin-top: 15px;">
            <tr>
                <td class="info-label">Status Cucian</td>
                <td class="info-separator">:</td>
                <td>{{ $pesanan->status_cucian }}</td>
            </tr>
            <tr>
                <td class="info-label">Status Bayar</td>
                <td class="info-separator">:</td>
                <td>{{ $pesanan->status_pembayaran }}</td>
            </tr>
            <tr>
                <td class="info-label">Tgl. Terima</td>
                <td class="info-separator">:</td>
                <td class="tanggal-indonesia" data-tanggal="{{ $pesanan->tanggal_terima }}"></td>
            </tr>
            <tr>
                <td class="info-label">Tgl. Selesai</td>
                <td class="info-separator">:</td>
                <td class="tanggal-indonesia" data-tanggal="{{ $pesanan->tanggal_selesai }}"></td>
            </tr>
        </table>
        
        <div class="divider"></div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="footer-address">
                Jl. Kol. Edy Yoso Martadipura No.172, Pakansari, Kec. Cibinong,<br>
                Kabupaten Bogor, Jawa Barat 16915
            </div>
            <div class="footer-contact">
                Telp: +6282903458743
            </div>
            <div class="thank-you">
                *** Terima Kasih Telah Menggunakan Layanan Kami ***
            </div>
        </div>
    </div>
</body>
</html>