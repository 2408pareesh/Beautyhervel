document.addEventListener('DOMContentLoaded', function() {
            // Get all sections that should animate
            const sections = document.querySelectorAll('section');
            
            // Options for the Intersection Observer
            const options = {
                root: null, // Use the viewport as the container
                threshold: 0.1, // Trigger when 10% of the section is visible
                rootMargin: '0px 0px -50px 0px' // Adjust trigger point slightly upward
            };
            
            // Create the observer
            const observer = new IntersectionObserver(function(entries, observer) {
                entries.forEach(entry => {
                    // If the section is intersecting (visible)
                    if (entry.isIntersecting) {
                        // Add the visible class to trigger the animation
                        entry.target.classList.add('visible');
                        // Stop observing this section (optional)
                        // observer.unobserve(entry.target);
                    } else {
                        // Remove the visible class when section is out of view (optional)
                        // entry.target.classList.remove('visible');
                    }
                });
            }, options);
            
            // Observe each section
            sections.forEach(section => {
                observer.observe(section);
            });
        });