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

  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>
</head>

<body class="bg-gray-100">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-1/5 min-w-[240px] bg-white shadow-lg sticky top-0 h-screen overflow-y-auto">
      <div class="p-6">
        <div class="flex items-center mb-8">
          <a href="{{ Auth::user()->role === 'Admin' ? route('index') : route('pesanan.index') }}">
            <img src="/images/logo-bima-laundry-svg.svg" alt="Logo" class="mr-3" />
          </a>
        </div>

        <ul>
          @if(Auth::user()->role === 'Admin')
            <li class="mb-4">
              <a href="{{ route('index') }}" class="flex items-center gap-4 text-gray-700">
                <i class="fa-solid fa-table-columns fa-fw"></i>
                Dashboard
              </a>
            </li>
          @endif
          <li class="mb-4">
            <a href="{{ route('pesanan.index') }}" class="flex items-center gap-4 text-gray-700">
              <i class="fas fa-file-alt fa-fw"></i>
              Pesanan
            </a>
          </li>
          <li class="mb-4">
            <a href="{{ route('pelanggan.index') }}" class="flex items-center gap-4 text-gray-700">
              <i class="fas fa-users fa-fw"></i>
              Pelanggan
            </a>
          </li>
          <li class="mb-4">
            <a href="{{ route('layanan.index') }}" class="flex items-center gap-4 text-gray-700">
              <i class="fas fa-user-shield fa-fw"></i>
              Layanan
            </a>
          </li>
          <li class="mb-4">
            <a href="{{ route('layananpengiriman.index') }}" class="flex items-center gap-4 text-biruBima">
              <i class="fas fa-shipping-fast fa-fw"></i>
              Layanan Pengiriman
            </a>
          </li>
          <li class="mb-4">
            @if (Auth::user()->role === 'Kasir')
              <a href="#" class="flex items-center gap-4 text-gray-700" onclick="openModal(); return false;">
                <i class="fas fa-wallet fa-fw"></i>
                Tambah Pengeluaran
              </a>
            @else
              <a href="{{ route('pengeluaran.index') }}" class="flex items-center gap-4 text-gray-700">
                <i class="fas fa-wallet fa-fw"></i>
                Pengeluaran
              </a>
            @endif
          </li>
          <li class="mt-8">
            <a href="#" class="flex items-center gap-2 text-red-500" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6" x-data="mapWidget()" x-init="init()" x-cloak>
  <h2 class="text-2xl font-bold mb-4">Layanan Pengiriman</h2>

  <div class="flex gap-4">
    <!-- MAP -->
    <div class="w-3/4">
      <div id="map" x-ref="map" class="h-[500px] rounded-lg shadow-lg overflow-hidden"></div>
    </div>

    <!-- SEARCH -->
    <div class="w-1/4 bg-white rounded-lg shadow-lg p-4">
      <h3 class="text-lg font-semibold mb-2">Cari Lokasi</h3>
      <input
        type="text"
        placeholder="Nama kelurahan / kecamatan"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        x-model="searchQuery"
        @input="searchLocation"
      >
      <ul class="mt-4 space-y-2 max-h-96 overflow-y-auto text-sm">
        <template x-for="loc in filteredLocations" :key="loc.index">
          <li class="p-2 border rounded hover:bg-blue-50 cursor-pointer" @click="zoomTo(loc)">
            <div><strong x-text="loc.area"></strong></div>
            <!-- <div class="text-gray-500 text-xs" x-text="'Lat: ' + loc.lat + ', Lon: ' + loc.lon"></div> -->
            <div class="text-gray-500 text-xs" ></div>
          </li>
        </template>
      </ul>
    </div>
  </div>
</div>

  <!-- Modal Tambah Pengeluaran -->
  <div id="pengeluaranModal" class="fixed inset-0 hidden items-center justify-center" style="z-index: 99999;">
    <div id="modalOverlay" class="fixed inset-0 bg-black opacity-0 transition-opacity duration-300"></div>
    <div id="modalContent" class="bg-white p-6 rounded-lg shadow-2xl w-96 relative opacity-0 transform scale-95 transition-all duration-300">
      <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
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
          <button type="button" onclick="closeModal()" class="mr-2 text-gray-500 hover:text-gray-700">Batal</button>
          <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Script Modal -->
  <script>
    function openModal() {
      document.querySelectorAll('.leaflet-container, .leaflet-pane').forEach(el => el.style.zIndex = '999');
      document.getElementById('pengeluaranModal').style.display = 'flex';
      setTimeout(() => {
        document.getElementById('modalOverlay').classList.add('opacity-50');
        document.getElementById('modalContent').classList.add('opacity-100', 'scale-100');
        document.getElementById('modalContent').classList.remove('scale-95');
      }, 10);
      document.getElementById('modalOverlay').onclick = closeModal;
    }

    function closeModal() {
      document.getElementById('modalOverlay').classList.remove('opacity-50');
      document.getElementById('modalOverlay').classList.add('opacity-0');
      document.getElementById('modalContent').classList.remove('opacity-100', 'scale-100');
      document.getElementById('modalContent').classList.add('opacity-0', 'scale-95');
      setTimeout(() => {
        document.getElementById('pengeluaranModal').style.display = 'none';
      }, 300);
    }
  </script>

  <!-- Script Map -->
  <script>
    function mapWidget() {
  return {
    map: null,
    searchQuery: '',
    locations: [],
    filteredLocations: [],

    init() {
      delete L.Icon.Default.prototype._getIconUrl;
      L.Icon.Default.mergeOptions({
        iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
        iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
        shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
      });

      this.map = L.map(this.$refs.map, {
        minZoom: 10,
        maxZoom: 14,
        zoomControl: true
      }).setView([-6.5928, 106.8016], 15);

      this.map.invalidateSize();

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
      }).addTo(this.map);

      this.loadCSVFromURL('/data/lokasi_pengiriman.csv');
      this.loadGeoJSONFromURL('/data/Desa-Bogor.geojson'); // tambahan GeoJSON
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
        const hargaI = hdr.findIndex(h => h === 'harga');

        if (latI < 0 || lonI < 0 || areaI < 0) {
          return alert('CSV harus memiliki kolom lintang, bujur, dan kelurahan.');
        }

        const redIcon = new L.Icon({
          iconUrl: 'https://maps.gstatic.com/mapfiles/ms2/micons/red-dot.png',
          iconSize: [32, 32],
          iconAnchor: [16, 32],
          popupAnchor: [0, -32],
        });

        const cluster = L.markerClusterGroup({ disableClusteringAtZoom: 12 });

        for (let i = 1; i < rows.length; i++) {
          const cols = rows[i];
          const lat = parseFloat(cols[latI]);
          const lon = parseFloat(cols[lonI]);
          const area = cols[areaI];

          if (isNaN(lat) || isNaN(lon)) continue;

          let popup = `<strong>Kelurahan:</strong> ${area}<br>`;
          if (hargaI >= 0) popup += `<strong>Harga:</strong> ${cols[hargaI]}`;

          const marker = L.marker([lat, lon], { icon: redIcon }).bindPopup(popup, {
            autoClose: false,
            closeOnClick: false
          });

          cluster.addLayer(marker);

          this.locations.push({
            index: i,
            lat,
            lon,
            area,
            marker
          });
        }

        this.map.addLayer(cluster);
        if (cluster.getLayers().length) {
          this.map.fitBounds(cluster.getBounds(), { padding: [20, 20] });
          setTimeout(() => this.map.invalidateSize(), 200);
        }
      } catch (err) {
        console.error('Gagal memuat CSV:', err);
        alert('Terjadi kesalahan saat memuat data CSV.');
      }
    },

    async loadGeoJSONFromURL(url) {
      try {
        const res = await fetch(url);
        const geojson = await res.json();

        const geojsonLayer = L.geoJSON(geojson, {
          onEachFeature: (feature, layer) => {
            if (feature.properties) {
              let popupContent = '';
              for (const key in feature.properties) {
                popupContent += `<strong>${key}:</strong> ${feature.properties[key]}<br>`;
              }
              layer.bindPopup(popupContent);
            }
          }
        });

        geojsonLayer.addTo(this.map);

        const bounds = geojsonLayer.getBounds();
        if (bounds.isValid()) {
          this.map.fitBounds(bounds, { padding: [20, 20] });
          setTimeout(() => this.map.invalidateSize(), 200);
        }
      } catch (err) {
        console.error('Gagal memuat GeoJSON:', err);
        alert('Terjadi kesalahan saat memuat data GeoJSON.');
      }
    },

    searchLocation() {
      const q = this.searchQuery.toLowerCase();
      this.filteredLocations = this.locations.filter(loc => loc.area.toLowerCase().includes(q));
    },

    zoomTo(loc) {
      this.map.setView([loc.lat, loc.lon], 17);
      loc.marker.openPopup();
    }
  };
}


  </script>
</body>

</html>
