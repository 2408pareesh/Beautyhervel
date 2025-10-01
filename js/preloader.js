// Preloader
    window.addEventListener("load", function() {
      const preloader = document.getElementById("preloader");
      const mainSite = document.getElementById("mainSite");
      setTimeout(() => {
        preloader.classList.add("fade-out");
        mainSite.classList.remove("hidden");
      }, 7000);
    });

    // Slider functionality
    document.addEventListener('DOMContentLoaded', function() {
      const slides = document.querySelectorAll('.hero-slider .slide');
      let currentSlide = 0;
      
      function showSlide(n) {
        slides.forEach(slide => slide.classList.remove('active'));
        slides[n].classList.add('active');
        currentSlide = n;
      }
      
      function nextSlide() {
        let next = (currentSlide + 1) % slides.length;
        showSlide(next);
      }
      
      // Auto-advance slides every 5 seconds
      setInterval(nextSlide, 5000);
      
      // Initialize the first slide
      showSlide(currentSlide);
    });

    // Animation on scroll
    document.addEventListener('DOMContentLoaded', function() {
      const animateElements = document.querySelectorAll('.animate');
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('animated');
          }
        });
      }, { threshold: 0.1 });
      
      animateElements.forEach(el => observer.observe(el));
    });

    // Check if this is the first visit to the index page
if (!sessionStorage.getItem('preloaderShown') && window.location.pathname.endsWith('index.html')) {
    document.addEventListener('DOMContentLoaded', function() {
        const preloader = document.getElementById('preloader');
        const mainSite = document.getElementById('mainSite');
        
        // Show preloader and hide main site initially
        if (preloader && mainSite) {
            preloader.classList.remove('hidden');
            mainSite.classList.add('hidden');
            
            // Set timeout to hide preloader and show main site
            setTimeout(function() {
                preloader.classList.add('hidden');
                mainSite.classList.remove('hidden');
                
                // Mark that preloader has been shown
                sessionStorage.setItem('preloaderShown', 'true');
            }, 15000); // Match this with your preloader duration
        }
    });
} else {
    // If preloader has already been shown or this is not index.html
    // Just ensure main site is visible
    document.addEventListener('DOMContentLoaded', function() {
        const preloader = document.getElementById('preloader');
        const mainSite = document.getElementById('mainSite');
        
        if (preloader && mainSite) {
            preloader.classList.add('hidden');
            mainSite.classList.remove('hidden');
        }
    });
}