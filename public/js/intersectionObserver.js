document.addEventListener('DOMContentLoaded', () => {
    const reveals = document.querySelectorAll('.reveal');

    // Setup Observer
    const io = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          // Saat card muncul di viewport
          entry.target.classList.add('opacity-100', 'translate-y-0');
          entry.target.classList.remove('opacity-0', 'translate-y-6');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });

    // Inisialisasi tiap elemen
    reveals.forEach(el => {
      // state awal (hidden & turun)
      el.classList.add('opacity-0', 'translate-y-6', 'transition-all', 'duration-700', 'ease-out');
      io.observe(el);
    });
  });
