// Animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.animate');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('animated');
                        }, 100);
                    }
                });
            }, {
                threshold: 0.1
            });
            
            animateElements.forEach((el) => {
                observer.observe(el);
            });
            
            // Form submission
            // Removed JS form submit override so normal HTML form submit/redirect will work
        });