<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bima Laundry - Home</title>
  <link href="https://unpkg.com/tabler-icons@latest/iconfont/tabler-icons.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


  <script>
    tailwind.config = {
      theme: {
        extend: {
          // Override default sans dengan Poppins
          fontFamily: {
            sans: ['Poppins', 'sans-serif'],
          },
        },
      },
    }
  </script>

<script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Poppins', 'sans-serif'],
          },
          colors: {
            primary: '#5DA9E9',
            accent: '#FFDFAA',
          },
          keyframes: {
            rise: {
              '0%': { transform: 'translateY(0) scale(0.5)', opacity: '1' },
              '100%': { transform: 'translateY(-200px) scale(1.5)', opacity: '0' },
            },
          },
          animation: {
            rise: 'rise 3s ease-in-out forwards',
          },
        }
      }
    };
  </script>


</head>
<!-- Tombol WhatsApp -->
<a href="https://wa.me/6283822345976" target="_blank" class="fixed bottom-5 right-5 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-700 hover:scale-110 transition-all z-50">
    <i class="fab fa-whatsapp text-5xl "></i> <!-- Ikon WhatsApp -->
  </a>

<body class="flex flex-col min-h-screen font-sans antialiased text-gray-800">

  <!-- Splash screen -->
  {{-- <div
    id="splash"
    class="fixed inset-0 bg-white flex items-center justify-center z-50 transition-opacity duration-700"
  >
    <!-- Bisa logo, animasi CSS, atau teks -->
    <img src="images/logo-bima-laundry-svg.svg" alt="Bima Laundry" class="w-120  h-120 animate-pulse">
  </div> --}}

  <!-- Header / Navbar -->
  <header class="flex-shrink-0 bg-[#5DA9E9] sticky top-0 z-50 hidden lg:block">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <nav class="bg-white rounded-full shadow flex justify-between items-center px-8 py-3">
          <!-- Logo -->
          <a href="#" class="flex items-center space-x-2">
            <img src="images/logo-bima-laundry-svg.svg" class="h-12" alt="logo" />
          </a>
          <!-- Links -->
          <ul class="flex space-x-6">
            <li><a href="#" class="hover:text-[#5DA9E9]">Home</a></li>
            <li><a href="#proses" class="hover:text-[#5DA9E9]">Proses</a></li>
            <li><a href="#layanan" class="hover:text-[#5DA9E9]">Layanan</a></li>
            <li><a href="#tentang" class="hover:text-[#5DA9E9]">Tentang Kami</a></li>
          </ul>
          <!-- CTA -->
<a href="https://wa.me/+6283822345976" target="_blank">
    <button class="bg-[#5DA9E9] text-white py-2 px-6 rounded-full hover:bg-gray-700">
        Hubungi Kami
    </button>
</a>
        </nav>
      </div>
  </header>

  <main class="flex-1 flex flex-col overflow-auto">
<!-- Hero Section -->
<section id="hero" class="bg-[#5DA9E9] flex items-center justify-center px-6 relative overflow-hidden h-[calc(100vh-4rem)]">
    <div class="w-full max-w-6xl flex flex-col lg:flex-row items-center justify-center gap-10">
      <!-- Text & CTA -->
      <div class="text-white space-y-4 text-center lg:text-left">
        <h1 class="text-5xl font-bold">{{ $hero->title }}</h1>
        <p class="text-2xl font-semibold">{{ $hero->subtitle }}</p>
        <p class="max-w-md mx-auto lg:mx-0">
          {{ $hero->description }}
        </p>
        <a href="{{ $hero->cta_link }}"
          class="inline-block bg-white text-black px-6 py-3 rounded-full font-medium transition-all duration-300 ease-in-out border-2 border-transparent hover:border-black hover:bg-[#5DA9E9] hover:text-white">
          {{ $hero->cta_text }}
        </a>
      </div>
      <!-- Hero Image -->
      <div class="w-full max-w-xl">
        <img src="{{ $hero->image_path }}" alt="Hero Image" class="w-full h-auto mx-auto" />
      </div>
    </div>
  </section>
  </main>

<!-- Proses Section -->
<section id="proses" class="bg-[#F1F9FF] py-16">
    <div class="max-w-3xl mx-auto text-center mb-12">
        <span class="inline-block text-sm text-[#5DA9E9] font-medium uppercase tracking-wider border border-[#5DA9E9] px-4 py-1 rounded-full">Proses</span>
        <h2 class="text-3xl font-bold mt-2">Bagaimana Cara Kerja Bima Laundry?</h2>
    </div>
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($proses as $item)
            <div class="reveal bg-white p-6 rounded-xl shadow flex flex-col items-center text-center hover:text-[#5DA9E9] hover:border-3 hover:bg-[#F1F9FF]">
                <img src="{{ asset($item->image) }}" alt="Proses Image" class="w-10% h-auto mx-auto" />
                <h3 class="mt-4 font-semibold text-lg">{{ $item->title }}</h3>
                <p class="mt-2 text-gray-600">{{ $item->description }}</p>
            </div>
        @endforeach
    </div>
 </section>

  <!-- Layanan Section -->
  <section id="layanan" class="bg-[#5DA9E9] py-16">
    <div class="max-w-3xl mx-auto text-center mb-12 text-white">
      <span class="inline-block text-sm font-medium uppercase tracking-wider border border-white px-3 py-1 rounded-full">
        Layanan
      </span>
      <h2 class="text-3xl font-bold mt-2">Layanan yang Tersedia</h2>
    </div>

<!-- Tentang Kami -->
<section id="layanan" class="bg-[#5DA9E9] py-6">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($layanan as $index => $service)
      <div class="service-card bg-gradient-to-b from-[#0099FF] to-[#0066CC] p-5 rounded-lg shadow-lg flex flex-col items-center text-center relative overflow-hidden card-{{ $index }}">
        <div class="water-effect absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/diagonal-stripes-light.png')] opacity-30"></div>
        <h1 class="mt-4 font-bold text-xl text-blue-900">{{ $service->jenis_laundry }}</h1>
        <p class="mt-2 text-gray-800 text-sm">{{ $service->kategori }}</p>
        <div class="bubbles">
          <div class="bubble bubble-1"></div>
          <div class="bubble bubble-2"></div>
          <div class="bubble bubble-3"></div>
          <div class="bubble bubble-4"></div>
          <div class="bubble bubble-5"></div>
        </div>
      </div>
      @endforeach
    </div>
</section>

<!-- Style -->
<style>
/* Card Styles */
.service-card {
  position: relative;
  border-radius: 15px;
  background: linear-gradient(to bottom, #A6C8FF, #B6E1FF);
  overflow: hidden;
  box-shadow: 0 0 20px rgba(2, 242, 255, 0.4); /* Glow dengan warna biru */
  transition: transform 0.3s ease-in-out;

}

.service-card:hover {
  transform: scale(1.05);
}

.service-card .water-effect {
  background-size: 50px 50px;
  animation: wave-animation 4s infinite;
  background-color: rgba(255, 255, 255, 0.8);  /* Ubah opacity */

}

@keyframes wave-animation {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 50px 50px;
  }
}

/* Bubble Effect */
.bubbles {
  position: absolute;
  bottom: 10px;
  left: 10px;
  right: 10px;
  display: flex;
  justify-content: space-between;
  pointer-events: none;
}

.bubble {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: rgba(255, 255, 255, 0.5);
  box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
  animation: bubble-animation 6s ease-in-out infinite;
}

.card-0 .bubble-1 {
  position: absolute;
  top: 10%;
  left: 10%;
  animation-delay: 0s;
}

.card-0 .bubble-2 {
  position: absolute;
  bottom: 20%;
  right: 20%;
  animation-delay: 1s;
}

.card-1 .bubble-1 {
  position: absolute;
  top: 15%;
  left: 15%;
  animation-delay: 0.5s;
}

.card-1 .bubble-2 {
  position: absolute;
  bottom: 10%;
  left: 30%;
  animation-delay: 2s;
}

.card-2 .bubble-1 {
  position: absolute;
  top: 20%;
  right: 10%;
  animation-delay: 0s;
}

.card-2 .bubble-2 {
  position: absolute;
  bottom: 25%;
  left: 20%;
  animation-delay: 1.5s;
}

.card-3 .bubble-1 {
  position: absolute;
  bottom: 25%;
  left: 20%;
  animation-delay: 1.5s;
}
.card-3 .bubble-2 {
  position: absolute;
  bottom: 10%;
  right: 30%;
  animation-delay: 2.5s;
}

.card-4 .bubble-1 {
  position: absolute;
  top: 10%;
  left: 10%;
  animation-delay: 0.5s;
}

.card-4 .bubble-2 {
  position: absolute;
  bottom: 20%;
  right: 20%;
  animation-delay: 3s;
}

.card-5 .bubble-1 {
  position: absolute;
  top: 15%;
  left: 15%;
  animation-delay: 0.5s;
}

.card-5 .bubble-2 {
  position: absolute;
  bottom: 10%;
  left: 30%;
  animation-delay: 4s;
}

.card-6 .bubble-1 {
  position: absolute;
  top: 20%;
  right: 10%;
  animation-delay: 0s;
}

.card-6 .bubble-2 {
  position: absolute;
  bottom: 25%;
  left: 20%;
  animation-delay: 5s;
}

.card-7 .bubble-1 {
  position: absolute;
  bottom: 25%;
  left: 20%;
  animation-delay: 1.5s;
}
.card-7 .bubble-2 {
  position: absolute;
  bottom: 10%;
  right: 30%;
  animation-delay: 6s;
}
.card-8 .bubble-1 {
  position: absolute;
  top: 10%;
  left: 10%;
  animation-delay: 0.5s;
}
.card-8 .bubble-2 {
  position: absolute;
  bottom: 20%;
  right: 20%;
  animation-delay: 7s;
}
.card-9 .bubble-1 {
  position: absolute;
  top: 15%;
  left: 15%;
  animation-delay: 0.5s;
}
.card-9 .bubble-2 {
  position: absolute;
  bottom: 10%;
  left: 30%;
  animation-delay: 8s;
}
.card-10 .bubble-1 {
  position: absolute;
  top: 20%;
  right: 10%;
  animation-delay: 0s;
}
.card-10 .bubble-2 {
  position: absolute;
  bottom: 25%;
  left: 20%;
  animation-delay: 9s;
}
.card-11 .bubble-1 {
  position: absolute;
  bottom: 25%;
  left: 20%;
  animation-delay: 1.5s;
}
.card-11 .bubble-2 {
  position: absolute;
  bottom: 10%;
  right: 30%;
  animation-delay: 10s;
}
.card-12 .bubble-1 {
  position: absolute;
  top: 10%;
  left: 10%;
  animation-delay: 0.5s;
}
.card-12 .bubble-2 {
  position: absolute;
  bottom: 20%;
  right: 20%;
  animation-delay: 11s;
}

/* More bubbles for other cards */
.bubble-3, .bubble-4, .bubble-5 {
  display: none;
}


/* Bubble Animation */
@keyframes bubble-animation {
  0% {
    transform: translateY(0);
    opacity: 1;
  }
  50% {
    transform: translateY(-10px);
    opacity: 0.5;
  }
  100% {
    transform: translateY(0);
    opacity: 1;
  }
}
</style>
  </section>

  <!-- Tentang Kami -->
  <section id="tentang" class="bg-[#F1F9FF] py-16">
    <div class="max-w-3xl mx-auto text-center mb-12">
      <span class="inline-block text-sm text-[#5DA9E9] font-medium uppercase tracking-wider border border-[#5DA9E9] px-4 py-1 rounded-full">Tentang Kami</span>
      <h2 class="text-3xl font-bold mt-2">Kenal Bima Laundry Lebih Dekat</h2>
    </div>
    <div class="max-w-6xl mx-auto px-6 flex flex-col lg:flex-row items-stretch gap-10">
      <div class="w-full lg:w-1/2">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7928.537304582484!2d106.8322979!3d-6.4876249!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c193efcc93b1%3A0x6ccf05b9b1c9e9c9!2sJl.%20Kol.%20Edy%20Yoso%20Martadipura%20No.172%2C%20Pakansari%2C%20Kec.%20Cibinong%2C%20Kabupaten%20Bogor%2C%20Jawa%20Barat%2016915!5e0!3m2!1sid!2sid!4v1745804091033!5m2!1sid!2sid"     class="w-full h-full border-0"
        allowfullscreen
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>      </div>
      <div class="w-full lg:w-1/2 space-y-4 text-gray-700">
        <p>Bima Laundry adalah layanan laundry terpercaya yang berlokasi di Cibinong – Bogor, menawarkan berbagai jenis layanan seperti cuci kering, cuci setrika, hingga layanan express (3–12 jam).</p>
        <p>Kami mengutamakan kualitas, ketepatan waktu, dan kenyamanan pelanggan. Dengan tim profesional dan sistem pelayanan yang rapi, kami siap merawat pakaian Anda dengan teliti.</p>
        <p>Kami juga menjunjung tinggi transparansi melalui nota dan syarat layanan yang jelas.</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-[#CBD5E1] py-10">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-gray-700">
      <!-- Brand -->
      <div class="space-y-2">
        <div class="flex items-center space-x-2">
          <img src="images/logo-bima-laundry-svg.svg" alt="Bima Laundry" class="h-12 w-auto" />
        </div>
        <p class="text-sm text-gray-600">Clean. Fresh. Fast.</p>
      </div>
      <!-- Links -->
      <div>
        <h4 class="font-semibold mb-2">Navigasi</h4>
        <ul class="space-y-1 text-sm">
          <li><a href="#" class="hover:underline">Home</a></li>
          <li><a href="#proses" class="hover:underline">Proses</a></li>
          <li><a href="#layanan" class="hover:underline">Layanan</a></li>
          <li><a href="#tentang" class="hover:underline">Tentang Kami</a></li>
        </ul>
      </div>
      <!-- Contact -->
      <div class="space-y-2 text-sm">
        <h4 class="font-semibold">Hubungi Kami</h4>
        <p>Jl. Koi, Edy Yoso Martadipura No.172, Pakansari, Cibinong, Kabupaten Bogor, Jawa Barat 16119</p>
        <p>Telp: +6282903458743</p>
      </div>
    </div>
    <div class="mt-8 border-t border-gray-300 pt-4 text-center text-sm text-gray-600">
      © 2025 Bima Laundry. All rights reserved.
    </div>
  </footer>

  <script src="splash.js"></script>
  <script src="bubble.js"></script>
  <script src="intersectionObserver.js"></script>

</body>
</html>
