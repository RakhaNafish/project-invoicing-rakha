<!-- Footer -->
<footer class="app-footer">
    <strong>Copyright © 2026</strong>
</footer>

<script>
    // Auto-close sidebar di HP setelah klik menu
    document.querySelectorAll('.app-sidebar .nav-link').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 992) {
                document.documentElement.classList.remove('sidebar-open');
                document.body.classList.remove('sidebar-open');
            }
        });
    });
</script>