import './bootstrap';
import '@fortawesome/fontawesome-free/css/all.min.css';

// Navigation toggle
$(document).ready(function() {
    // Mobile menu toggle
    $('.mobile-menu-button').click(function() {
        $('.mobile-menu').toggleClass('hidden');
    });

    // Dropdown toggle
    $('.dropdown-toggle').click(function(e) {
        e.preventDefault();
        $(this).next('.dropdown-menu').toggleClass('hidden');
    });

    // Close dropdowns when clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown-menu').addClass('hidden');
        }
    });
});
