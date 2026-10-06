/**
 * SIBCO Theme Main JavaScript
 */
document.addEventListener('DOMContentLoaded', () => {

    // ---- Scroll-based animations (IntersectionObserver) ----
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -60px 0px'
    };

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll, .animate-left, .animate-right, .animate-scale').forEach(el => {
            observer.observe(el);
        });
    } else {
        // Fallback if IntersectionObserver not supported
        document.querySelectorAll('.animate-on-scroll, .animate-left, .animate-right, .animate-scale').forEach(el => {
            el.classList.add('visible');
        });
    }

    // ---- Navigation scroll effect ----
    const nav = document.getElementById('mainNav');
    if (nav) {
        const handleScroll = () => {
            const scrollY = window.scrollY;
            if (scrollY > 80) {
                nav.classList.add('nav-scrolled');
            } else {
                nav.classList.remove('nav-scrolled');
            }
        };

        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll(); // Trigger once on load in case page is refreshed while scrolled
    }

    // ---- Mobile menu ----
    const mobileToggle = document.getElementById('mobileToggle');
    const mobileClose = document.getElementById('mobileClose');
    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', () => {
            mobileMenu.classList.add('open');
            document.body.style.overflow = 'hidden';
        });
    }

    if (mobileClose && mobileMenu) {
        mobileClose.addEventListener('click', () => {
            mobileMenu.classList.remove('open');
            document.body.style.overflow = '';
        });
    }

    if (mobileMenu) {
        document.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('open');
                document.body.style.overflow = '';
            });
        });
    }

    // ---- Smooth scroll for anchor links on same page ----
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (!targetId || targetId === '#') return;
            const targetEl = document.querySelector(targetId);
            if (targetEl) {
                e.preventDefault();
                const offset = 90;
                const top = targetEl.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            }
        });
    });

    // ---- Hero loaded animation trigger ----
    const heroSection = document.getElementById('hero') || document.querySelector('.hero-section');
    if (heroSection) {
        // Trigger immediately or on window load
        setTimeout(() => {
            heroSection.classList.add('hero-loaded');
        }, 100);
    }

    // ---- Contact Form AJAX Handling (if present) ----
    const contactForm = document.getElementById('sibcoContactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const formStatus = document.getElementById('formStatus');
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn ? submitBtn.innerHTML : 'Submit';

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="inline-flex items-center gap-2"><svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Sending Enquiry...</span>';
            }

            const formData = new FormData(contactForm);
            formData.append('action', 'sibco_contact_form');

            try {
                const response = await fetch(sibco_vars.ajax_url || '/wp-admin/admin-ajax.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (formStatus) {
                    formStatus.classList.remove('hidden');
                    if (result.success) {
                        formStatus.className = 'p-4 rounded-xl text-sm font-medium bg-emerald-50 text-emerald-800 border border-emerald-200 mb-6';
                        formStatus.innerHTML = result.data.message || 'Thank you for your enquiry. Our export team will respond within 24 hours.';
                        contactForm.reset();
                    } else {
                        formStatus.className = 'p-4 rounded-xl text-sm font-medium bg-red-50 text-red-800 border border-red-200 mb-6';
                        formStatus.innerHTML = result.data.message || 'An error occurred. Please try again or email us directly.';
                    }
                }
            } catch (error) {
                if (formStatus) {
                    formStatus.classList.remove('hidden');
                    formStatus.className = 'p-4 rounded-xl text-sm font-medium bg-red-50 text-red-800 border border-red-200 mb-6';
                    formStatus.innerHTML = 'Thank you! For immediate export assistance, please email us directly at export@sibco.in.';
                }
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }
            }
        });
    }

});
