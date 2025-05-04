<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bima Laundry - Data Pelanggan</title>

  <!-- Tailwind & FontAwesome -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

  <!-- AlpineJS -->
  <script src="//unpkg.com/alpinejs" defer></script>

  <!-- Leaflet & Cluster -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

  <!-- Tailwind Config -->
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

  <!-- Style -->
  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>
</head>

<body class="bg-gray-100">
  <div class="flex">
    <!-- Sidebar -->
    <div class="w-1/5 bg-white h-screen shadow-lg">
      <div class="p-6" x-data="{ openModalPengeluaran: false }">
        <!-- Logo -->
        <div class="flex items-center mb-8">
          <a href="{{ Auth::user()->role === 'Admin' ? route('index') : route('pesanan.index') }}">
            <img src="images/logo-bima-laundry-svg.svg" alt="Logo" class="mr-3" />
          </a>
        </div>

        <!-- Menu -->
        <ul>
          @if(Auth::user()->role === 'Admin')
          <li class="mb-4">
            <a href="{{ route('index') }}" class="flex items-center gap-4 text-gray-700">
              <i class="fa-solid fa-table-columns fa-fw"></i> Dashboard
            </a>
          </li>
          @endif
          <li class="mb-4">
            <a href="{{ route('pesanan.index') }}" class="flex items-center gap-4 text-gray-700">
              <i class="fas fa-file-alt fa-fw"></i> Pesanan
            </a>
          </li>
          <li class="mb-4">
            <a href="{{ route('pelanggan.index') }}" class="flex items-center gap-4 text-gray-700">
              <i class="fas fa-users fa-fw"></i> Pelanggan
            </a>
          </li>
          <li class="mb-4">
            <a href="{{ route('layanan.index') }}" class="flex items-center gap-4 text-gray-700">
              <i class="fas fa-user-shield fa-fw"></i> Layanan
            </a>
          </li>
          <li class="mb-4">
            <a href="{{ route('layananpengiriman.index') }}" class="flex items-center gap-4 text-biruBima">
              <i class="fas fa-shipping-fast fa-fw"></i> Layanan Pengiriman
            </a>
          </li>

          <!-- Tombol Tambah Pengeluaran -->
          <li class="mb-4">
            @if (Auth::user()->role === 'Kasir')
            <button
              class="flex items-center text-gray-700"
              @click.prevent="openModalPengeluaran = true"
            >
              <img src="images/icon-pengeluaran.png" alt="" class="mr-2" />
              Tambah Pengeluaran
            </button>
            @endif
          </li>

          <li class="mt-8">
            <a href="{{ route('login') }}" class="flex items-center gap-2 text-red-500">
              <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </a>
          </li>
        </ul>

        <!-- Modal Tambah Pengeluaran -->
        <div
          x-show="openModalPengeluaran"
          x-cloak
          x-transition:enter="transition ease-out duration-300 transform"
          x-transition:enter-start="opacity-0 translate-y-5 scale-95"
          x-transition:enter-end="opacity-100 translate-y-0 scale-100"
          x-transition:leave="transition ease-in duration-200 transform"
          x-transition:leave-start="opacity-100 translate-y-0 scale-100"
          x-transition:leave-end="opacity-0 translate-y-5 scale-95"
          class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-30"
        >
          <div class="bg-white p-6 rounded w-96 shadow-xl" @click.away="openModalPengeluaran = false">
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
                <button type="button" @click="openModalPengeluaran = false" class="mr-2 text-gray-500">
                  Batal
                </button>
                <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded">
                  Simpan
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Konten Utama -->
    <div class="flex-1 p-6" x-data="mapWidget()" x-init="init()" x-cloak>
      <h2 class="text-2xl font-bold mb-4">Layanan Pengiriman</h2>
      <div id="map" x-ref="map" class="h-[500px] rounded-lg shadow-lg overflow-hidden"></div>
    </div>
  </div>

  <!-- Script Map Leaflet -->
  <script>
    function mapWidget() {
      return {
        map: null,
        init() {
          delete L.Icon.Default.prototype._getIconUrl;
          L.Icon.Default.mergeOptions({
            iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
          });

          this.map = L.map(this.$refs.map, {
            minZoom: 10,
            maxZoom: 35,
            zoomControl: true
          }).setView([-6.2, 106.8], 12);

          this.map.invalidateSize();

          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
          }).addTo(this.map);

          this.loadCSVFromURL('/data/lokasi_pengiriman.csv');
        },

        async loadCSVFromURL(url) {
          try {
            const res = await fetch(url);
            const text = await res.text();
            const rows = text.trim().split('\n').map(r => r.split(',').map(c => c.trim()));
            const hdr = rows[0].map(h => h.toLowerCase());

            const latI = hdr.findIndex(h => ['lintang', 'lat'].includes(h));
            const lonI = hdr.findIndex(h => ['bujur', 'lon', 'lng'].includes(h));
            const areaI = hdr.findIndex(h => ['kelurahan', 'kecamatan'].includes(h));

            if (latI < 0 || lonI < 0) {
              return alert('CSV harus memiliki kolom lintang & bujur.');
            }

            const redIcon = new L.Icon({
              iconUrl: 'https://maps.gstatic.com/mapfiles/ms2/micons/red-dot.png',
              iconSize: [32, 32],
              iconAnchor: [16, 32],
              popupAnchor: [0, -32],
            });

            const cluster = L.markerClusterGroup({
              disableClusteringAtZoom: 12,
            });

            for (let i = 1; i < rows.length; i++) {
              const cols = rows[i];
              const lat = parseFloat(cols[latI]);
              const lon = parseFloat(cols[lonI]);
              if (isNaN(lat) || isNaN(lon)) continue;

              let popup = '';
              if (areaI >= 0) popup += `<strong>Kelurahan:</strong> ${cols[areaI]}`;

              const marker = L.marker([lat, lon], { icon: redIcon })
                .bindPopup(popup, { autoClose: false, closeOnClick: false });

              cluster.addLayer(marker);
            }

            this.map.addLayer(cluster);

            if (cluster.getLayers().length) {
              this.map.fitBounds(cluster.getBounds(), { padding: [20, 20] });
              setTimeout(() => this.map.invalidateSize(), 200);
            }

            this.map.on('zoomend', () => {
              this.map.fitBounds(cluster.getBounds(), { padding: [20, 20] });
            });

          } catch (err) {
            console.error('Gagal memuat CSV:', err);
            alert('Terjadi kesalahan saat memuat data CSV.');
          }
        }
      }
    }
  </script>
</body>
</html>
