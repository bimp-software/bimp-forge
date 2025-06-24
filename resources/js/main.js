  AOS.init();

  // Smooth scroll con Lenis
  const lenis = new Lenis({ duration: 1.2, smooth: true });
  function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
  }
  requestAnimationFrame(raf);
