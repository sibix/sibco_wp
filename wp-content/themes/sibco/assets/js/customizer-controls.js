/**
 * SIBCO Theme Customizer Control Enhancements
 *
 * Shows dynamic percentage number indicator next to range sliders.
 */
(function($) {
    'use strict';

    wp.customize.bind('ready', function() {
        const sliderControls = [
            'sibco_hero_overlay_opacity',
            'sibco_contact_cta_overlay_opacity'
        ];

        sliderControls.forEach(function(controlId) {
            wp.customize.control(controlId, function(control) {
                const container = control.container;
                const input = container.find('input[type="range"]');

                if (input.length) {
                    const badge = $('<span class="sibco-slider-value" style="display:inline-block; margin-left:10px; font-weight:700; color:#1C1917; background:#FAF8F4; border:1px solid #D4C8B8; padding:2px 8px; border-radius:4px; font-size:12px; min-width:44px; text-align:center;">' + input.val() + '%</span>');
                    container.find('.customize-control-title').append(badge);

                    input.on('input change', function() {
                        badge.text($(this).val() + '%');
                    });
                }
            });
        });
    });
})(jQuery);
