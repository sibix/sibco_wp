/**
 * SIBCO Theme Customizer Live Preview
 *
 * Real-time updates for Hero & Contact CTA overlay opacity sliders.
 */
(function($) {
    'use strict';

    // Live update for Hero Section overlay opacity
    if (typeof wp !== 'undefined' && wp.customize) {
        wp.customize('sibco_hero_overlay_opacity', function(value) {
            value.bind(function(newVal) {
                var alpha = Math.max(0, Math.min(100, parseInt(newVal, 10) || 0)) / 100;
                document.documentElement.style.setProperty('--sibco-hero-overlay-opacity', alpha);
                $('.hero-section .hero-overlay, #hero .hero-overlay').css('opacity', alpha);
            });
        });

        // Live update for Contact CTA overlay opacity
        wp.customize('sibco_contact_cta_overlay_opacity', function(value) {
            value.bind(function(newVal) {
                var alpha = Math.max(0, Math.min(100, parseInt(newVal, 10) || 0)) / 100;
                document.documentElement.style.setProperty('--sibco-contact-cta-overlay-opacity', alpha);
                $('#contact-cta .contact-cta-overlay, .contact-cta-overlay').css('opacity', alpha);
            });
        });
    }
})(jQuery);
