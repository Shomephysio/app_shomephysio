document.addEventListener('DOMContentLoaded', function() {
    var dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            var dropdownMenu = this.nextElementSibling;
            var isOpen = dropdownMenu.classList.contains('open');

            // Close all open dropdowns
            document.querySelectorAll('.dropdown-menu.open').forEach(function(menu) {
                menu.classList.remove('open');
            });

            // Toggle current dropdown
            if (!isOpen) {
                dropdownMenu.classList.add('open');
            } else {
                dropdownMenu.classList.remove('open');
            }
        });
    });
});
