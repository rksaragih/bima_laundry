<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Data Pesanan</title>

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
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Pesanan</h1>

        <form>
            <div class="form-section">
                <h2>Informasi Pelanggan</h2>
                <div class="form-row">
                    <input type="text" placeholder="Nama Pelanggan">
                    <input type="text" placeholder="Nomor Telepon">
                </div>
                <input type="text" placeholder="Alamat" class="full-width">
            </div>

            <div class="form-section">
                <h2>Informasi Pemesanan</h2>
                <div class="form-row">
                    <input type="text" placeholder="Jenis Barang">
                    <input type="text" placeholder="Jenis Layanan">
                </div>
                <div class="form-row">
                    <input type="text" placeholder="Kiloan">
                    <input type="text" placeholder="Satuan">
                </div>
                <input type="text" placeholder="Spesifikasi Barang" class="full-width">
                <div class="form-row">
                    <input type="text" placeholder="Tanggal Terima">
                    <input type="text" placeholder="Estimasi selesai">
                </div>
            </div>

            <div class="form-section">
                <h2>Antar Jemput</h2>
                <select class="full-width" name="antar_jemput" aria-label="Pilihan Antar Jemput">
                    <option value="" disabled selected>Pilih Ya/Tidak</option>
                    <option value="ya">Ya</option>
                    <option value="tidak">Tidak</option>
                </select>
            </div>

            <div class="form-section">
                <h2>Status Pembayaran</h2>
                <select class="full-width" name="status_pembayaran" aria-label="Status Pembayaran">
                    <option value="" disabled selected>Pilih Status Pembayaran</option>
                    <option value="lunas">Lunas</option>
                    <option value="tidak_lunas">Tidak Lunas</option>
                </select>
            </div>

            <div class="form-section">
                <h2>Total Harga</h2>
                <input type="text" placeholder="Total Harga" class="full-width">
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
