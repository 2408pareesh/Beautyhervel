document.addEventListener("click", (e) => {
    const leafCount = 5 + Math.floor(Math.random() * 2); // 10–15 leaves

    for (let i = 0; i < leafCount; i++) {
      const leaf = document.createElement("img");
      leaf.src = "OIP-removebg-preview.png"; 
      leaf.classList.add("leaf");

      // Random scatter around click point
      const offsetX = Math.random() * 120 - 60; // -60 to +60px
      const offsetY = Math.random() * 120 - 60;
      leaf.style.left = (e.pageX + offsetX - 50) + "px";
      leaf.style.top = (e.pageY + offsetY - 50) + "px";

      // Random animation speed (2–3s)
      const duration = 2 + Math.random();
      leaf.style.animationDuration = duration + "s";

      document.body.appendChild(leaf);

      // Remove after animation
      setTimeout(() => {
        leaf.remove();
      }, duration * 1000);
    }
  });


  let lastMoveTime = 0;

  function createLeaves(x, y) {
    const leafCount = 2 + Math.floor(Math.random() * 2); // 10–15 leaves

    for (let i = 0; i < leafCount; i++) {
      const leaf = document.createElement("img");
      leaf.src = "OIP-removebg-preview.png"; 
      leaf.classList.add("leaf");

      // Random scatter around point
      const offsetX = Math.random() * 60 - 30;
      const offsetY = Math.random() * 60 - 30;
      leaf.style.left = (x + offsetX - 50) + "px";
      leaf.style.top = (y + offsetY - 50) + "px";

      // Random animation speed (2–3s)
      const duration = 2 + Math.random();
      leaf.style.animationDuration = duration + "s";

      document.body.appendChild(leaf);

      // Remove after animation
      setTimeout(() => {
        leaf.remove();
      }, duration * 1000);
    }
  }

  // On click → burst
  document.addEventListener("click", (e) => {
    createLeaves(e.pageX, e.pageY);
  });

  // On mouse move → controlled burst
  document.addEventListener("mousemove", (e) => {
    const now = Date.now();
    if (now - lastMoveTime > 500) { // throttle (1 burst every 0.5s)
      createLeaves(e.pageX, e.pageY);
      lastMoveTime = now;
    }
  });



document.addEventListener("DOMContentLoaded", function () {
  const track = document.querySelector(".carousel-track");
  const prevButton = document.querySelector(".carousel-control.prev");
  const nextButton = document.querySelector(".carousel-control.next");
  let cards = Array.from(track.children);

  let cardWidth, visibleCards, currentIndex = 0;

  function updateMeasurements() {
    cardWidth = cards[0].getBoundingClientRect().width + 20; // include margin
    const containerWidth = document.querySelector(".carousel-track-container").offsetWidth;
    visibleCards = Math.floor(containerWidth / cardWidth);

    // reset clones on resize
    track.innerHTML = "";
    cards.forEach(c => track.appendChild(c));

    // clone first `visibleCards` items to the end
    for (let i = 0; i < visibleCards; i++) {
      let clone = cards[i].cloneNode(true);
      track.appendChild(clone);
    }

    updateSlide(false); // no animation
  }

  function updateSlide(animate = true) {
    if (!animate) {
      track.style.transition = "none";
    } else {
      track.style.transition = "transform 0.5s ease-in-out";
    }
    track.style.transform = "translateX(-" + currentIndex * cardWidth + "px)";
  }

  function nextSlide() {
    currentIndex++;
    updateSlide(true);

    // when transition ends, check if we reached clone section
    track.addEventListener("transitionend", function handler() {
      if (currentIndex >= cards.length) {
        track.style.transition = "none";
        currentIndex = 0; // reset to start
        updateSlide(false);
      }
      track.removeEventListener("transitionend", handler);
    });
  }

  function prevSlide() {
    currentIndex--;
    if (currentIndex < 0) {
      currentIndex = 0; // stop at start (no backward infinite)
    }
    updateSlide(true);
  }

  nextButton.addEventListener("click", nextSlide);
  prevButton.addEventListener("click", prevSlide);

  // autoplay every 4s
  let autoPlay = setInterval(nextSlide, 4000);

  // pause on hover
  track.addEventListener("mouseenter", () => clearInterval(autoPlay));
  track.addEventListener("mouseleave", () => autoPlay = setInterval(nextSlide, 4000));

  window.addEventListener("resize", () => {
    updateMeasurements();
  });

  // initial
  updateMeasurements();
});