// public/assets/js/scripts.js
// Chercher les boutons next
// Initialize the carousel when the page is loaded
document.addEventListener('DOMContentLoaded', function() {
    new bootstrap.Carousel(document.getElementById('carouselExampleIndicators'), {
        interval: 5000 // Set the interval time between slide transitions (in milliseconds)
    });
});
