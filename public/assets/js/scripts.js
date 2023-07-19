// public/assets/js/scripts.js
// Chercher les boutons next
// Initialize the carousel when the page is loaded
document.addEventListener('DOMContentLoaded', function() {
    new bootstrap.Carousel(document.getElementById('carouselExampleIndicators'), {
        interval: 5000 // Set the interval time between slide transitions (in milliseconds)
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const scrollUpBtn = document.getElementById('scroll-up');
    // Scroll to the top of the page when the up arrow is clicked
    scrollUpBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });    
    // Show/hide the scroll-up arrow based on the scroll position
    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            scrollUpBtn.style.display = 'block';
        } else {
            scrollUpBtn.style.display = 'none';
        }
    });    
});



