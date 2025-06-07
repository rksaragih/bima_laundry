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
      <div class="w-1/5 min-w-[240px] bg-white shadow-lg sticky top-0 h-screen overflow-y-auto">
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
                              <input type="number" onkeydown="return !['e','E','+','-'].includes(event.key)" name="biaya" class="w-full border rounded p-2" required>
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
                <i class="fas fa-sign-out-alt mr-3"></i> Keluar
              </a>

              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          </ul>
        </div>
      </div>

      <!-- Main -->
      <div class="flex-1 p-10">

        <header class="bg-biruBima rounded-xl text-white px-6 py-4 shadow-sm">
            <div class="flex justify-between items-center">
              <div class="text-2xl font-semibold">Dashboard</div>
              <div class="text-2xl font-semibold ml-auto">{{ Auth::user()->role }}</div>
            </div>
        </header>

        <div class="grid grid-cols-1 gap-4 p-4 bg-white rounded-xl shadow-lg">

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
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
              <!-- Total Pendapatan -->
              <div class="bg-white p-6 rounded-2xl shadow-lg border border-blue-100 hover:shadow-xl transition duration-300">
                  <div class="flex items-center space-x-4">
                      <div class="bg-blue-100 p-3 rounded-full">
                          <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                              viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                          </svg>
                      </div>
                      <div>
                          <h3 class="text-sm text-gray-500">Total Pendapatan ({{ $selectedTahun }})</h3>
                          <p class="text-xl font-bold text-blue-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                      </div>
                  </div>
              </div>

              <!-- Total Pengeluaran -->
              <div class="bg-white p-6 rounded-2xl shadow-lg border border-red-100 hover:shadow-xl transition duration-300">
                  <div class="flex items-center space-x-4">
                      <div class="bg-red-100 p-3 rounded-full">
                          <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                              viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                          </svg>
                      </div>
                      <div>
                          <h3 class="text-sm text-gray-500">Total Pengeluaran ({{ $selectedTahun }})</h3>
                          <p class="text-xl font-bold text-red-600">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                      </div>
                  </div>
              </div>

              <!-- Total Keuntungan -->
              <div class="bg-white p-6 rounded-2xl shadow-lg border border-green-100 hover:shadow-xl transition duration-300">
                  <div class="flex items-center space-x-4">
                      <div class="bg-green-100 p-3 rounded-full">
                          <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                              viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                          </svg>
                      </div>
                      <div>
                          <h3 class="text-sm text-gray-500">Total Keuntungan ({{ $selectedTahun }})</h3>
                          <p class="text-xl font-bold text-green-600">Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}</p>
                      </div>
                  </div>
              </div>
          </div>

          <canvas id="pendapatanChart" class="mb-8" height="100"></canvas>

          <canvas id="pengeluaranChart" class="mb-8" height="100"></canvas>

          <canvas id="keuntunganChart" class="mb-8" height="100"></canvas>

          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          
          <script>
            const pendapatanData = @json(array_values($pendapatan));
            const pengeluaranData = @json(array_values($pengeluaran));
            const keuntunganData = @json(array_values($keuntungan));
            const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

            // Chart Pendapatan
            new Chart(document.getElementById('pendapatanChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Pendapatan (Rp)',
                        data: pendapatanData,
                        borderColor: '#6FBcFF',
                        backgroundColor: 'rgba(111, 188, 255, 0.2)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        borderRadius: 6,
                        pointBackgroundColor: '#6FBcFF',
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
    </div>
  </body>
</html>
