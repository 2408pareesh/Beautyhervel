document.addEventListener("DOMContentLoaded", () => {
  const leftCards = document.querySelectorAll(".services-column:first-child .service-card");
  const centerImg = document.querySelector(".herbal-solutions-container");
  const rightCards = document.querySelectorAll(".services-column:last-child .service-card");

  // Assign reveal classes + stagger delays
  leftCards.forEach((card, i) => {
    card.classList.add("services-reveal", "services-reveal--from-left");
    card.setAttribute("data-delay", i + 1);
  });

  if (centerImg) {
    centerImg.classList.add("services-reveal", "services-reveal--from-top");
    centerImg.setAttribute("data-delay", "1");
  }

  rightCards.forEach((card, i) => {
    card.classList.add("services-reveal", "services-reveal--from-right");
    card.setAttribute("data-delay", i + 1);
  });

  // Observer function
  const revealGroup = (els) => {
    els.forEach(el => el.classList.add("is-visible"));
  };

  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const target = entry.target;

        if (target.classList.contains("service-card")) {
          // Left column cards appear together
          if (target.closest(".services-column:first-child")) {
            revealGroup(leftCards);
            obs.unobserve(target);
          }
          // Right column cards appear after center
          if (target.closest(".services-column:last-child")) {
            // Reveal right cards only after center is visible
            if (centerImg.classList.contains("is-visible")) {
              revealGroup(rightCards);
              obs.unobserve(target);
            }
          }
        }

        // Center image
        if (target === centerImg) {
          target.classList.add("is-visible");
        }
      }
    });
  }, { threshold: 0.2 });

  [...leftCards, centerImg, ...rightCards].forEach(el => observer.observe(el));
});