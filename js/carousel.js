let currentSet = 0;
let cardsPerSet = 3; // Default for desktop
const cards = document.querySelectorAll('.testimonial-card');
const dotsContainer = document.querySelector('.testimonial-controls');
let rotationInterval;

// Function to determine how many cards to show based on screen width
function getCardsPerSet() {
    if (window.innerWidth <= 768) {
        return 1; // Mobile: show 1 card at a time
    } else if (window.innerWidth <= 992) {
        return 2; // Tablet: show 2 cards at a time
    } else {
        return 3; // Desktop: show 3 cards at a time
    }
}

// Function to create dot indicators based on current number of sets
function updateDots() {
    cardsPerSet = getCardsPerSet();
    const totalSets = Math.ceil(cards.length / cardsPerSet);
    
    // Clear existing dots
    dotsContainer.innerHTML = '';
    
    // Create new dots
    for (let i = 0; i < totalSets; i++) {
        const dot = document.createElement('div');
        dot.className = 'control-dot';
        if (i === currentSet) {
            dot.classList.add('active');
        }
        dot.addEventListener('click', () => {
            showSet(i);
        });
        dotsContainer.appendChild(dot);
    }
}

function showSet(setIndex) {
    // Clear existing interval to reset timer on manual navigation
    clearInterval(rotationInterval);
    
    // Update current set
    currentSet = setIndex;
    
    // Update cards per set based on current screen size
    cardsPerSet = getCardsPerSet();
    
    // Add exiting class to current active cards for smooth exit animation
    document.querySelectorAll('.testimonial-card.active').forEach(card => {
        card.classList.add('exiting');
    });
    
    // Hide all cards after a delay to allow exit animation
    setTimeout(() => {
        cards.forEach(card => {
            card.classList.remove('active');
            card.classList.remove('exiting');
        });
        
        // Show cards for current set with delay for smooth appearance
        setTimeout(() => {
            for (let i = 0; i < cardsPerSet; i++) {
                const cardIndex = (currentSet * cardsPerSet) + i;
                if (cardIndex < cards.length) {
                    setTimeout(() => {
                        cards[cardIndex].classList.add('active');
                    }, i * 100); // Stagger the appearance of cards
                }
            }
        }, 50);
        
        // Update dot indicators
        updateDots();
        
        // Restart the auto-rotation
        startAutoRotation();
    }, 800); // Match this with the CSS transition time
}

function rotateCards() {
    // Move to next set
    cardsPerSet = getCardsPerSet();
    const maxSets = Math.ceil(cards.length / cardsPerSet);
    currentSet = (currentSet + 1) % maxSets;
    showSet(currentSet);
}

function startAutoRotation() {
    // Clear any existing interval
    clearInterval(rotationInterval);
    
    // Set up new interval for auto-rotation
    rotationInterval = setInterval(() => {
        rotateCards();
    }, 5000); // Rotate every 5 seconds
}

// Initialize with first set visible and start auto-rotation
window.addEventListener('DOMContentLoaded', function() {
    // Set initial cards per set based on screen size
    cardsPerSet = getCardsPerSet();
    
    // Create initial dot indicators
    updateDots();
    
    showSet(0);
    startAutoRotation();
    
    // Add click event listeners to cards
    cards.forEach(card => {
        card.addEventListener('click', function() {
            rotateCards();
        });
    });
    
    // Update on window resize
    window.addEventListener('resize', function() {
        // Recalculate cards per set and update display
        const newCardsPerSet = getCardsPerSet();
        if (newCardsPerSet !== cardsPerSet) {
            cardsPerSet = newCardsPerSet;
            updateDots(); // Update dots first
            showSet(0); // Reset to first set on resize
        }
    });
});