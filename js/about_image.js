(function(){
  document.addEventListener('DOMContentLoaded', () => {
    const els = document.querySelectorAll('.about-image');

    els.forEach(el => {
      if (!el.classList.contains('reveal')) el.classList.add('reveal');
      if (![...el.classList].some(c => c.startsWith('reveal--'))) {
        el.classList.add('reveal--from-right');
      }
    });

    const revealVisible = (target) => {
      target.classList.add('is-visible');
    };

    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            revealVisible(entry.target);
            obs.unobserve(entry.target);
          }
        });
      }, { threshold: 0.18 });

      els.forEach(el => observer.observe(el));
    } else {
      const check = () => {
        els.forEach(el => {
          const rect = el.getBoundingClientRect();
          if (rect.top < window.innerHeight * 0.82) {
            revealVisible(el);
          }
        });
      };
      window.addEventListener('scroll', check, { passive: true });
      check();
    }
  });
})();