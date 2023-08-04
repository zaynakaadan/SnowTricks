// public/assets/js/scripts.js
// Chercher les boutons next
// Initialize the carousel when the page is loaded
document.addEventListener('DOMContentLoaded', function() {
    new bootstrap.Carousel(document.getElementById('carouselExampleIndicators'), {
        interval: 5000 // Set the interval time between slide transitions (in milliseconds)
    });
});


document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('button-start').addEventListener('click', function() {
        document.getElementById('button-start').style.display = 'none';
    })
    document.getElementById('load-button').addEventListener('click', function() {
        if (isLoading) return
        fetchNextPage()
    })
})


document.addEventListener('DOMContentLoaded', function() {
    const scrollUpBtn = document.getElementById('scroll-up');
    // Scroll to the top of the page when the up arrow is clicked
    scrollUpBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Show/hide the scroll-up arrow based on the scroll position
    window.addEventListener('scroll', () => {

        console.log(isLoading)
        if (isLoading) return

        if (window.scrollY > 100 && scrollUpBtn.style.display != 'block') {
            scrollUpBtn.style.display = 'block';
        } else {
            scrollUpBtn.style.display = 'none';
        }

        // Fetch next page when reaching the bottom of the page
        //const threshold = 100; // Adjust this value to your preference
        //const contentHeight = document.getElementById('content-container').offsetHeight;
        //const yOffset = window.pageYOffset + window.innerHeight;

        //if (yOffset + threshold > contentHeight && !isLoading) {
         //   fetchNextPage();
        //}
    });
});

let isLoading = false;
let currentPage = 1;

function showLoading() {
    const loader = document.getElementById('loader');
    loader.style.display = 'block';
}

function hideLoading() {
    const loader = document.getElementById('loader');
    loader.style.display = 'none';
}

function fetchNextPage() {
    if (isLoading) {
        return;
    }

    isLoading = true;
    showLoading();

    const nextPage = currentPage + 1;
    // const url = "{{ path('categories_list', {'slug': category.getslug()}) }}?page=" + nextPage;
    const url = '/tricks/load?page=' + nextPage

    fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(data => {

        // alert(data)
        if (data) {
        // Insert the fetched data into your content container
            const container = document.getElementById('tricks-list-container');
            container.innerHTML += data;
        }

        let trickCount = document.getElementById('tricks-list-container').querySelectorAll('.card-body');
        if (trickCount.length < nextPage * 15) {
            document.getElementById('load-action').style.display = 'none'
        }

        // Hide the loader and mark loading as complete
        hideLoading();
        isLoading = false;

        // Update the current page number
        currentPage = nextPage;

        // If there are no more pages, remove the scroll event listener
        /* if (!data.hasNextPage) {
            window.removeEventListener('scroll', fetchNextPage);
        } */
    })
    .catch(error => {
        // alert(error)
        console.log(error)
        // Handle error if needed
        // Hide the loader and mark loading as complete
        hideLoading();
        isLoading = false;
    });
}

