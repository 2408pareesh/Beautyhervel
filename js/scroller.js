// ✅ Smooth scroll to top (works desktop & mobile)
document.getElementById('scrollTopBtn').addEventListener('click', function(e) {
    e.preventDefault();

    // Add click animation
    this.classList.add('clicked');
    setTimeout(() => this.classList.remove('clicked'), 400);

    // Smooth scroll to top
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});


// ✅ Scroll progress bar (desktop + mobile)
window.addEventListener("scroll", updateProgressBar);

function updateProgressBar() {
    const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (winScroll / height) * 100;
    const bar = document.getElementById("myBar");
    if (bar) bar.style.width = scrolled + "%";
}


// ✅ Smooth scroll for in-page links (anchors) (desktop + mobile)
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});


// ✅ Redirect to contact section in buynow.html (works on all devices)
function redirectToBuyNow() {
    window.location.href = 'buynow.html#contact-content';
}


// ✅ Attach event listeners to Book Now buttons
document.addEventListener('DOMContentLoaded', function() {
    const bookNowButtons = document.querySelectorAll('.add-to-cart');
    bookNowButtons.forEach(button => {
        button.addEventListener('click', redirectToBuyNow);
    });

    // ✅ Smooth scroll to contact section if URL has hash
    if (window.location.hash === '#contact-content') {
        const contactSection = document.getElementById('contact-content');
        if (contactSection) {
            setTimeout(() => {
                contactSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 300); // small delay for mobile load
        }
    }
});


// ✅ Extra: handle touch scrolling better on mobile
// (prevents jumpy behavior when anchors are used quickly)
if ('ontouchstart' in window) {
    document.addEventListener("touchstart", () => {}, {passive: true});
}



// When the user scrolls the page, execute myFunction (Nav Loader Bar)
window.onscroll = function() {updateProgressBar()};

function updateProgressBar() {
    const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (winScroll / height) * 100;
    document.getElementById("myBar").style.width = scrolled + "%";
}

// Optional: Smooth scroll for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});



// Function to redirect to contact section in buynow.html (index.html)
function redirectToBuyNow() {
    // Redirect to buynow.html with hash for contact section
    window.location.href = 'buynow.html#contact-content';
}

// Add event listeners to all Book Now buttons when page loads
document.addEventListener('DOMContentLoaded', function() {
    const bookNowButtons = document.querySelectorAll('.add-to-cart');
    
    bookNowButtons.forEach(button => {
        button.addEventListener('click', redirectToBuyNow);
    });
});

// Smooth scroll to contact section if URL has hash (buynow.html)
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.hash === '#contact-content') {
        const contactSection = document.getElementById('contact-content');
        if (contactSection) {
            // Smooth scroll to the contact section
            contactSection.scrollIntoView({ behavior: 'smooth' });
        }
    }
});





