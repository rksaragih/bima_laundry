// document.addEventListener('DOMContentLoaded', () => {
//     const splash = document.getElementById('splash');

//     // Cek apakah sudah pernah visit
//     if (!localStorage.getItem('hasVisited')) {
//       // Tampilkan splash selama 1.5 detik, lalu fade out
//       setTimeout(() => {
//         splash.classList.add('opacity-0');
//         // Setelah transisi selesai, hapus elemen dari DOM
//         splash.addEventListener('transitionend', () => splash.remove());
//       }, 1500);

//       // Tandai sudah visit
//       localStorage.setItem('hasVisited', 'true');
//     } else {
//       // Langsung buang splash jika bukan first-visit
//       splash.remove();
//     }
//   });
