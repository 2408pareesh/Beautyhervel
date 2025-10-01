// Add a subtle animation to the social icons
        document.querySelectorAll('.social-icons a').forEach(icon => {
            icon.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            icon.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Add click effect to links
        document.querySelectorAll('.links-list a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                this.style.color = '#4caf50';
                
                setTimeout(() => {
                    this.style.color = '';
                }, 300);
            });
        });
        
// Simple script to handle service card hover effects
        document.addEventListener('DOMContentLoaded', function() {
            const serviceCards = document.querySelectorAll('.service-card');
            
            serviceCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                    this.style.borderLeft = '4px solid var(--accent-color)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                    this.style.borderLeft = '4px solid transparent';
                });
            });
        });

