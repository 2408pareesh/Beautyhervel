// Animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.animate');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('animated');
                        }, 100 * parseInt(entry.target.dataset.delay || 0));
                    }
                });
            }, {
                threshold: 0.1
            });
            
            animateElements.forEach((el, index) => {
                el.dataset.delay = index % 6;
                observer.observe(el);
            });
            
            // Add to cart animation
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.innerHTML = '<i class="fas fa-check"></i> Added to Cart';
                    this.style.backgroundColor = '#3d8b40';
                    
                    setTimeout(() => {
                        this.innerHTML = 'Add to Cart';
                        this.style.backgroundColor = '#4caf50';
                    }, 2000);
                });
            });
        });