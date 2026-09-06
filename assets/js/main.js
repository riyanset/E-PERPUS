/**
 * E-Perpus Mas Riy — Main Scripts & Handphone Reader Controls
 */
document.addEventListener('DOMContentLoaded', () => {

    // ─── 1. Sidebar Toggle (AdminLTE style) ───
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', (e) => {
            e.preventDefault();
            document.body.classList.toggle('sidebar-collapse');
            document.body.classList.toggle('sidebar-open');
        });
    }

    // Close sidebar on mobile overlay click
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 767 && document.body.classList.contains('sidebar-open')) {
            if (!e.target.closest('.main-sidebar') && !e.target.closest('#sidebarToggle')) {
                document.body.classList.remove('sidebar-open');
            }
        }
    });

    // ─── 2. Widget Action Controls (Collapse / Remove Box) ───
    document.querySelectorAll('[data-widget="collapse"]').forEach(btn => {
        btn.addEventListener('click', () => {
            const box = btn.closest('.box');
            if (box) {
                const boxBody = box.querySelector('.box-body');
                if (boxBody) {
                    if (boxBody.style.display === 'none') {
                        boxBody.style.display = 'block';
                        btn.classList.remove('collapsed');
                    } else {
                        boxBody.style.display = 'none';
                        btn.classList.add('collapsed');
                    }
                }
            }
        });
    });

    document.querySelectorAll('[data-widget="remove"]').forEach(btn => {
        btn.addEventListener('click', () => {
            const box = btn.closest('.box');
            if (box) {
                box.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                box.style.opacity = '0';
                box.style.transform = 'scale(0.95)';
                setTimeout(() => box.remove(), 300);
            }
        });
    });

    // ─── 3. Handphone Reader Modes (Full Screen Smartphone View) ───
    const btnPhoneView = document.getElementById('btnPhoneView');
    const btnDesktopView = document.getElementById('btnDesktopView');
    const phoneReaderWrapper = document.getElementById('phoneReaderWrapper');
    const btnClosePhoneFullscreen = document.getElementById('btnClosePhoneFullscreen');
    const phoneClock = document.getElementById('phoneClock');

    // Live clock for Smartphone status bar
    function updatePhoneClock() {
        if (!phoneClock) return;
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        phoneClock.textContent = `${hours}:${minutes}`;
    }
    updatePhoneClock();
    setInterval(updatePhoneClock, 30000);

    if (phoneReaderWrapper) {
        // Function to enter Full Screen Handphone mode
        function enterPhoneFullscreen() {
            phoneReaderWrapper.classList.add('is-phone-fullscreen');
            if (btnPhoneView) btnPhoneView.classList.add('active');
            if (btnDesktopView) btnDesktopView.classList.remove('active');
            document.body.style.overflow = 'hidden';

            // Optional HTML5 Browser Fullscreen Request
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen().catch(() => {});
            }
        }

        // Function to exit Full Screen Handphone mode
        function exitPhoneFullscreen() {
            phoneReaderWrapper.classList.remove('is-phone-fullscreen');
            if (btnDesktopView) btnDesktopView.classList.add('active');
            if (btnPhoneView) btnPhoneView.classList.remove('active');
            document.body.style.overflow = '';

            if (document.fullscreenElement) {
                document.exitFullscreen().catch(() => {});
            }
        }

        if (btnPhoneView) {
            btnPhoneView.addEventListener('click', enterPhoneFullscreen);
        }

        if (btnDesktopView) {
            btnDesktopView.addEventListener('click', exitPhoneFullscreen);
        }

        if (btnClosePhoneFullscreen) {
            btnClosePhoneFullscreen.addEventListener('click', exitPhoneFullscreen);
        }

        // ESC key to exit phone fullscreen
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && phoneReaderWrapper.classList.contains('is-phone-fullscreen')) {
                exitPhoneFullscreen();
            }
        });
    }

});
