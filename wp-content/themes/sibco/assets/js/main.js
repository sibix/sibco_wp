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

    // ---- Hero Slider Logic ----
    const heroSlider = document.getElementById('hero');
    if (heroSlider) {
        const bgSlides = heroSlider.querySelectorAll('.hero-bg-slide');
        const textSlides = heroSlider.querySelectorAll('.hero-text-slide');
        const dots = heroSlider.querySelectorAll('.hero-slider-dot');
        const prevBtn = document.getElementById('hero-slider-prev');
        const nextBtn = document.getElementById('hero-slider-next');

        if (textSlides.length > 1) {
            let currentIndex = 0;
            const totalSlides = textSlides.length;
            const slideDuration = 6000; // 6 seconds per slide
            let animStartTime = null;
            let progressAnimFrame = null;
            let isPaused = false;

            function goToSlide(newIndex) {
                if (newIndex === currentIndex) return;

                // Old slide
                const oldBg = bgSlides[currentIndex];
                const oldText = textSlides[currentIndex];
                const oldDot = dots[currentIndex];

                if (oldBg) {
                    oldBg.classList.remove('is-active', 'opacity-100');
                    oldBg.classList.add('opacity-0');
                }
                if (oldText) {
                    oldText.classList.remove('is-active', 'relative', 'opacity-100', 'translate-y-0', 'pointer-events-auto', 'z-20');
                    oldText.classList.add('absolute', 'top-0', 'left-0', 'w-full', 'opacity-0', 'translate-y-6', 'pointer-events-none', 'z-10');
                }
                if (oldDot) {
                    oldDot.classList.remove('bg-white/20', 'border-white/40', 'text-white');
                    oldDot.classList.add('bg-white/5', 'border-white/10', 'text-white/60');
                    oldDot.setAttribute('aria-selected', 'false');
                    const fill = oldDot.querySelector('.dot-fill');
                    if (fill) fill.style.width = '0%';
                }

                // New slide
                currentIndex = newIndex;
                const newBg = bgSlides[currentIndex];
                const newText = textSlides[currentIndex];
                const newDot = dots[currentIndex];

                if (newBg) {
                    newBg.classList.add('is-active', 'opacity-100');
                    newBg.classList.remove('opacity-0');
                }
                if (newText) {
                    newText.classList.add('is-active', 'relative', 'opacity-100', 'translate-y-0', 'pointer-events-auto', 'z-20');
                    newText.classList.remove('absolute', 'top-0', 'left-0', 'w-full', 'opacity-0', 'translate-y-6', 'pointer-events-none', 'z-10');
                }
                if (newDot) {
                    newDot.classList.add('bg-white/20', 'border-white/40', 'text-white');
                    newDot.classList.remove('bg-white/5', 'border-white/10', 'text-white/60');
                    newDot.setAttribute('aria-selected', 'true');
                }

                startSlideTimer();
            }

            function nextSlide() {
                const nextIndex = (currentIndex + 1) % totalSlides;
                goToSlide(nextIndex);
            }

            function prevSlide() {
                const prevIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                goToSlide(prevIndex);
            }

            function animateProgress(timestamp) {
                if (!animStartTime) animStartTime = timestamp;
                const elapsed = timestamp - animStartTime;
                const progress = Math.min((elapsed / slideDuration) * 100, 100);

                const currentDot = dots[currentIndex];
                if (currentDot) {
                    const fill = currentDot.querySelector('.dot-fill');
                    if (fill) fill.style.width = progress + '%';
                }

                if (elapsed < slideDuration) {
                    if (!isPaused) {
                        progressAnimFrame = requestAnimationFrame(animateProgress);
                    }
                } else {
                    nextSlide();
                }
            }

            function startSlideTimer() {
                cancelAnimationFrame(progressAnimFrame);
                animStartTime = null;
                const currentDot = dots[currentIndex];
                if (currentDot) {
                    const fill = currentDot.querySelector('.dot-fill');
                    if (fill) fill.style.width = '0%';
                }
                if (!isPaused) {
                    progressAnimFrame = requestAnimationFrame(animateProgress);
                }
            }

            // Arrow button events
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    nextSlide();
                });
            }
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    prevSlide();
                });
            }

            // Dot button events
            dots.forEach((dot) => {
                dot.addEventListener('click', function() {
                    const idx = parseInt(this.getAttribute('data-slide-index'), 10);
                    if (!isNaN(idx)) {
                        goToSlide(idx);
                    }
                });
            });

            // Pause on hover
            heroSlider.addEventListener('mouseenter', () => {
                isPaused = true;
                cancelAnimationFrame(progressAnimFrame);
            });
            heroSlider.addEventListener('mouseleave', () => {
                isPaused = false;
                startSlideTimer();
            });

            // Touch Swipe Support
            let touchStartX = 0;
            let touchEndX = 0;
            heroSlider.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            heroSlider.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                const diff = touchEndX - touchStartX;
                if (Math.abs(diff) > 40) {
                    if (diff < 0) {
                        nextSlide(); // Swiped left -> next
                    } else {
                        prevSlide(); // Swiped right -> prev
                    }
                }
            }, { passive: true });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                const rect = heroSlider.getBoundingClientRect();
                if (rect.top <= window.innerHeight && rect.bottom >= 0) {
                    if (e.key === 'ArrowRight') {
                        nextSlide();
                    } else if (e.key === 'ArrowLeft') {
                        prevSlide();
                    }
                }
            });

            // Initialize progress animation for first slide
            startSlideTimer();
        }
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
            if (!formData.has('action')) {
                formData.append('action', 'sibco_contact_form');
            }
            if (!formData.has('nonce') && typeof sibco_vars !== 'undefined' && sibco_vars.nonce) {
                formData.append('nonce', sibco_vars.nonce);
            }

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
