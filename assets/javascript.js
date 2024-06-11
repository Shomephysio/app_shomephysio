function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('hidden');
}

// Initially hide the sidebar on small screens
if (window.innerWidth <= 768) {
    document.querySelector('.sidebar').classList.add('hidden');
}

// Adjust sidebar visibility on window resize
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        document.querySelector('.sidebar').classList.remove('hidden');
    } else {
        document.querySelector('.sidebar').classList.add('hidden');
    }
});
