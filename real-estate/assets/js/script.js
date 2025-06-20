document.addEventListener('DOMContentLoaded', function() {
    const burger = document.getElementById('burger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const overlay = document.getElementById('mobile-menu-overlay');
    const closeBtn = document.getElementById('close-mobile-menu');

    function openMenu() {
        mobileMenu.classList.add('open');
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeMenu() {
        mobileMenu.classList.remove('open');
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    burger.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);
    overlay.addEventListener('click', closeMenu);
});