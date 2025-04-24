<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Edit Data Pesanan</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
      }

      body {
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
      }

      .container {
        width: 100%;
        max-width: 800px;
        padding: 20px;
      }

      .card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
      }

      h1 {
        font-size: 20px;
        margin-bottom: 30px;
        font-weight: bold;
        color: #333;
      }

      .form-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
      }

      .form-group {
        display: flex;
        flex-direction: column;
      }

      label {
        font-size: 14px;
        margin-bottom: 5px;
        color: #333;
      }

      .form-input {
        border: 1px solid #e0e0e0;
        padding: 10px;
        border-radius: 4px;
        font-size: 14px;
        color: #555;
        min-height: 40px;
        outline: none;
      }

      .form-input:focus {
        border-color: #999;
      }

      .button-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 40px;
      }

      button {
        padding: 10px 30px;
        border: none;
        border-radius: 20px;
        color: white;
        font-weight: bold;
        cursor: pointer;
        font-size: 14px;
      }

      .cancel-btn {
        background-color: #ff0000;
      }

      .print-btn {
        background-color: #00ff66;
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
          margin-bottom: 20px;
        }

        .form-input {
          padding: 8px;
          font-size: 13px;
          min-height: 36px;
        }

        label {
          font-size: 13px;
        }

        .button-container {
          flex-direction: column;
          gap: 10px;
          width: 100%;
        }

        button {
          width: 100%;
          padding: 8px 20px;
          font-size: 13px;
        }
      }

      /* Smartphone (landscape) dan tablet kecil */
      @media (min-width: 481px) and (max-width: 767px) {
        .container {
          padding: 15px;
        }

        .card {
          padding: 15px;
        }

        h1 {
          font-size: 19px;
          margin-bottom: 25px;
        }

        .button-container {
          gap: 15px;
        }

        button {
          padding: 8px 25px;
        }
      }

      /* Tablet (portrait) */
      @media (min-width: 768px) and (max-width: 1024px) {
        .container {
          max-width: 700px;
        }

        .form-container {
          gap: 12px;
        }

        .button-container {
          margin-top: 35px;
        }
      }

      /* Laptop dan desktop */
      @media (min-width: 1025px) and (max-width: 1439px) {
        .container {
          max-width: 800px;
        }

        .card {
          padding: 30px;
        }

        .form-container {
          gap: 15px;
        }

        .form-input {
          transition: border-color 0.2s ease;
        }

        button {
          transition: opacity 0.2s ease;
        }

        button:hover {
          opacity: 0.9;
        }
      }

      /* Large desktops and high-resolution displays */
      @media (min-width: 1440px) and (max-width: 2559px) {
        .container {
          max-width: 900px;
        }

        .card {
          padding: 40px;
        }

        h1 {
          font-size: 24px;
          margin-bottom: 35px;
        }

        .form-container {
          gap: 20px;
        }

        .form-group {
          margin-bottom: 5px;
        }

        label {
          font-size: 16px;
          margin-bottom: 6px;
        }

        .form-input {
          padding: 12px;
          font-size: 16px;
          min-height: 48px;
          border-radius: 6px;
        }

        .button-container {
          margin-top: 50px;
          gap: 30px;
        }

        button {
          padding: 12px 40px;
          font-size: 16px;
          border-radius: 25px;
          transition: transform 0.2s ease, opacity 0.2s ease;
        }

        button:hover {
          opacity: 0.9;
          transform: translateY(-2px);
        }
      }

      /* 4K and ultra-wide displays */
      @media (min-width: 2560px) {
        .container {
          max-width: 1200px;
        }

        .card {
          padding: 60px;
          border-radius: 12px;
          box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        h1 {
          font-size: 32px;
          margin-bottom: 50px;
        }

        .form-container {
          gap: 30px;
        }

        .form-group {
          margin-bottom: 10px;
        }

        label {
          font-size: 20px;
          margin-bottom: 10px;
        }

        .form-input {
          padding: 16px;
          font-size: 20px;
          min-height: 60px;
          border-radius: 8px;
        }

        .button-container {
          margin-top: 70px;
          gap: 50px;
        }

        button {
          padding: 16px 60px;
          font-size: 20px;
          border-radius: 30px;
          transition: transform 0.3s ease, opacity 0.2s ease,
            box-shadow 0.3s ease;
        }

        button:hover {
          opacity: 0.95;
          transform: translateY(-3px);
          box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="card">
        <h1>Edit Pesanan</h1>

        <form class="form-container">
          <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" class="form-input" />
          </div>

          <div class="form-group">
            <label for="telp">No Telp:</label>
            <input type="text" id="telp" class="form-input" />
          </div>

          <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" class="form-input" />
          </div>

          <div class="form-group">
            <label for="layanan">Jenis Layanan:</label>
            <input type="text" id="layanan" class="form-input" />
          </div>

          <div class="form-group">
            <label for="barang">Jenis Barang:</label>
            <input type="text" id="barang" class="form-input" />
          </div>

          <div class="form-group">
            <label for="kiloan">Kiloan:</label>
            <input type="text" id="kiloan" class="form-input" />
          </div>

          <div class="form-group">
            <label for="satuan">Satuan:</label>
            <input type="text" id="satuan" class="form-input" />
          </div>

          <div class="form-group">
            <label for="spesifikasi">Spesifikasi Barang:</label>
            <input type="text" id="spesifikasi" class="form-input" />
          </div>

          <div class="form-group">
            <label for="antar">Antar Jemput:</label>
            <input type="text" id="antar" class="form-input" />
          </div>

          <div class="form-group">
            <label for="tanggal">Tanggal Terima:</label>
            <input type="text" id="tanggal" class="form-input" />
          </div>

          <div class="form-group">
            <label for="estimasi">Estimasi Selesai:</label>
            <input type="text" id="estimasi" class="form-input" />
          </div>

          <div class="form-group">
            <label for="status">Status Pembayaran:</label>
            <input type="text" id="status" class="form-input" />
          </div>

          <div class="form-group">
            <label for="total">Total Harga:</label>
            <input type="text" id="total" class="form-input" />
          </div>

          <div class="button-container">
            <button type="button" class="cancel-btn">Cancel</button>
            <button type="button" class="print-btn">edit</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
