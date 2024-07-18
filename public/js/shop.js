var currentPage = 1;
var loading = false;
var lastPage = false;
var scrollUpThreshold = 50; // Adjust threshold for faster triggering

function loadProducts(page) {
    $.ajax({
        url: "/api/products", // Use the correct API endpoint
        data: { page: page },
        success: function(response) {
            if (response) {
                $('#infinite-scroll-placeholder').append(response);
                loading = false;
            } else {
                lastPage = true;
            }
        },
        error: function(xhr) {
            console.error('Error loading products:', xhr);
            loading = false;
        }
    });
}

$(document).ready(function() {
    // Initial load with a small number of products
    loadProducts(currentPage);

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - scrollUpThreshold && !loading && !lastPage) {
            loading = true;
            currentPage++;
            loadProducts(currentPage);
        }
    });
});