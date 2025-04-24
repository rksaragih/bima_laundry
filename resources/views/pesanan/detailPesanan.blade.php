<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
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
            <h1>Detail Pesanan</h1>

            <div class="detail-container">
                <div class="detail-item">
                    <div class="detail-text">Nama: JohnDoe</div>
                </div>

                <div class="detail-item">
                    <div class="detail-text">No Telp: 08123456789</div>
                </div>

                <div class="detail-item">
                    <div class="detail-text">Alamat: Jl. Merdeka No.1</div>
                </div>

                <div class="detail-item">
                    <div class="detail-text">Jenis Layanan: Cuci Kering</div>
                </div>

                <div class="detail-item">
                    <div class="detail-text">Jenis Barang: Baju</div>
                </div>

                <div class="detail-item">
                    <div class="detail-text">Kiloan: 2kg</div>
                </div>

                <div class="detail-item">
                    <div class="detail-text">Satuan: 2</div>
                </div>

                <div class="detail-item">
                    <div class="detail-text">Spesifikasi Barang:</div>
                </div>

                <div class="detail-item">
                    <div class="detail-text">Antar Jemput: YA</div>
                </div>

                <div class="detail-item">
                    <div class="detail-text">Tanggal Terima:</div>
                </div>

                <div class="detail-item">
                    <div class="detail-text">Estimasi Selesai:</div>
                </div>

                <div class="detail-item">
                    <div class="detail-text">Status Pembayaran:</div>
                </div>

                <div class="detail-item">
                    <div class="detail-text">Total Harga: 100000</div>
                </div>
            </div>

            <div class="button-container">
                <button class="cancel-btn">Cancel</button>
                <button class="print-btn">Print</button>
            </div>
        </div>
    </div>
</body>
</html>
