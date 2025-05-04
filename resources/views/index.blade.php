<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" defer></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              biruBima: "#6FBcFF",
            },
          },
        },
      };

    </script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <style></style>
  </head>
  <body class="bg-gray-100">
    <div class="flex min-h-screen">
      <!-- sidebar -->
      <div class="w-1/5 bg-white shadow-lg sticky top-0 h-screen overflow-y-auto">
        <div class="p-6" x-data="{ openModalPengeluaran: false }">
          <div class="flex items-center mb-8">
            <a href="{{ Auth::user()->role === 'Admin' ? route('index') : route('pesanan.index') }}">
              <img
                alt="Logo"
                class="mr-3"
                src="/images/logo-bima-laundry-svg.svg"
              />
            </a>
          </div>
          <ul>
            @if(Auth::user()->role === 'Admin')
            <li class="mb-4">
              <a class="flex items-center gap-4 text-biruBima" href="{{ route('index') }}">
                <i class="fa-solid fa-table-columns fa-fw"></i>
                Dashboard
              </a>
            </li>
            @endif
            <li class="mb-4">
              <a
                class="flex items-center gap-4 text-gray-700"
                href="{{ route('pesanan.index') }}"
              >
              <i class="fas fa-file-alt fa-fw"></i>
              Pesanan
              </a>
            </li>
            <li class="mb-4">
              <a
                class="flex items-center gap-4 text-gray-700"
                href="{{ route('pelanggan.index') }}"
              >
              <i class="fas fa-users fa-fw"></i>
              Pelanggan
              </a>
            </li>
            <li class="mb-4">
              <a class="flex items-center gap-4 text-gray-700" href="{{ route('layanan.index') }}">
                <i class="fas fa-user-shield fa-fw"></i>
                Layanan
              </a>
            </li>
            <li class="mb-4">
              <a class="flex items-center gap-4 text-gray-700" href="{{ route('layananpengiriman.index') }}">
                <i class="fas fa-shipping-fast fa-fw"></i>
                Layanan Pengiriman
              </a>
            </li>
            <li class="mb-4">
              @if (Auth::user()->role === 'Kasir')
                <a
                  href="#"
                  class="flex items-center text-gray-700"
                  x-on:click.prevent="openModalPengeluaran = true"
                >

                  <img src="images/icon-pengeluaran.png" alt="" class="mr-2" />
                  Tambah Pengeluaran
                </a>

                <div
                x-show="openModalPengeluaran"
                x-cloak
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                >
                  <div class="bg-white p-6 rounded w-96">
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
                              <button
                                  type="button"
                                  x-on:click="openModalPengeluaran = false"
                                  class="mr-2 text-gray-500"
                              >
                                  Batal
                              </button>
                              <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                                  Simpan
                              </button>
                          </div>
                      </form>
                  </div>
                </div>

              @else
                <a
                  href="{{ route('pengeluaran.index') }}"
                  class="flex items-center gap-4 text-gray-700"
                >
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

      <!-- Main -->
      <div class="w-4/5 p-6">

        <div class="flex justify-between items-center mb-8">
          <h1 class="text-2xl font-bold">Dashboard</h1>
          <span class="text-blue-500 font-bold"> {{ Auth::user()->role }} </span>
        </div>

        <form method="GET" action="{{ route('index') }}" class="mb-6">
          <label for="tahun" class="mr-2 font-semibold">Pilih Tahun:</label>
          <select name="tahun" id="tahun" class="border rounded p-2">
              @foreach($tahunList as $tahun)
                  <option value="{{ $tahun }}" {{ $selectedTahun == $tahun ? 'selected' : '' }}>
                      {{ $tahun }}
                  </option>
              @endforeach
          </select>
          <button type="submit" class="ml-2 bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded">
            <i class="fas fa-rotate-right mr-2"></i>Tampilkan
          </button>
        </form>

        <!-- Summary Cards -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-blue-600 mb-2">Total Pendapatan ({{ $selectedTahun }})</h3>
                <p class="text-2xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-red-600 mb-2">Total Pengeluaran ({{ $selectedTahun }})</h3>
                <p class="text-2xl font-bold">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-green-600 mb-2">Total Keuntungan ({{ $selectedTahun }})</h3>
                <p class="text-2xl font-bold">Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}</p>
            </div>
        </div>

        <canvas id="pendapatanChart" class="mb-8" height="100"></canvas>

        <canvas id="pengeluaranChart" class="mb-8" height="100"></canvas>

        <canvas id="keuntunganChart" height="100"></canvas>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <script>
          const pendapatanData = @json(array_values($pendapatan));
          const pengeluaranData = @json(array_values($pengeluaran));
          const keuntunganData = @json(array_values($keuntungan));
          const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

          // Chart Pendapatan
          new Chart(document.getElementById('pendapatanChart').getContext('2d'), {
              type: 'bar',
              data: {
                  labels: labels,
                  datasets: [{
                      label: 'Total Pendapatan (Rp)',
                      data: pendapatanData,
                      backgroundColor: '#6FBcFF',
                      borderRadius: 6
                  }]
              },
              options: {
                  responsive: true,
                  plugins: {
                      title: {
                          display: true,
                          text: 'Grafik Pendapatan Bulanan',
                          font: { size: 18 }
                      }
                  },
                  scales: {
                      y: {
                          beginAtZero: true,
                          ticks: {
                              callback: value => 'Rp ' + value.toLocaleString('id-ID')
                          }
                      }
                  }
              }
          });

          // Chart Pengeluaran
          new Chart(document.getElementById('pengeluaranChart').getContext('2d'), {
              type: 'line',
              data: {
                  labels: labels,
                  datasets: [{
                      label: 'Total Pengeluaran (Rp)',
                      data: pengeluaranData,
                      borderColor: '#EF4444',
                      backgroundColor: 'rgba(239, 68, 68, 0.2)',
                      borderWidth: 2,
                      tension: 0.4,
                      fill: true,
                      pointBackgroundColor: '#EF4444',
                  }]
                },
                options: {
                  responsive: true,
                  plugins: {
                      title: {
                          display: true,
                          text: 'Grafik Pengeluaran Bulanan',
                          font: { size: 18 }
                      }
                  },
                  scales: {
                      y: {
                          beginAtZero: true,
                          ticks: {
                              callback: value => 'Rp ' + value.toLocaleString('id-ID')
                          }
                      }
                  }
                }
            });

          // Chart Keuntungan
          new Chart(document.getElementById('keuntunganChart').getContext('2d'), {
              type: 'bar',
              data: {
                  labels: labels,
                  datasets: [{
                      label: 'Keuntungan (Rp)',
                      data: keuntunganData,
                      backgroundColor: keuntunganData.map(value => value >= 0 ? '#10B981' : '#EF4444'),
                      borderRadius: 6
                  }]
              },
              options: {
                  responsive: true,
                  plugins: {
                      title: {
                          display: true,
                          text: 'Grafik Keuntungan Bulanan',
                          font: { size: 18 }
                      }
                  },
                  scales: {
                      y: {
                          beginAtZero: false,
                          ticks: {
                              callback: value => 'Rp ' + value.toLocaleString('id-ID')
                          }
                      }
                  }
              }
          });
        </script>
      </div>
    </div>
  </body>
</html>
