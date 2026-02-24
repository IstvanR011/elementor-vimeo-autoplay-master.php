<?php
/**
 * Plugin Name: Elementor Vimeo Autoplay Fix (Desktop & Mobile)
 * Description: Ensures Vimeo videos autoplay immediately after clicking overlays or lightbox links.
 * Author: IstvanR011 (Rtechapp)
 * Version: 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * FIX 1: Desktop Overlay Autoplay
 */
add_action('wp_footer', 'rtechapp_video_overlay_autoplay', 999);
function rtechapp_video_overlay_autoplay() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        $(document).on('click', '.elementor-custom-embed-image-overlay, .elementor-custom-embed-play', function() {
            $('iframe.elementor-video-iframe').each(function() {
                var $iframe = $(this);
                var src = $iframe.attr('src');
                if (src && src.indexOf('vimeo.com') > -1 && src.indexOf('autoplay=1') === -1) {
                    var newSrc = src.replace('muted=0', 'muted=0&autoplay=1');
                    $iframe.attr('src', newSrc);
                }
            });
        });
    });
    </script>
    <?php
}

/**
 * FIX 2: Mobile/Tablet Lightbox Autoplay (Optimized MutationObserver)
 */
add_action('wp_footer', 'rtechapp_lightbox_video_autoplay_mobile', 1001);
function rtechapp_lightbox_video_autoplay_mobile() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        if (window.innerWidth < 1180) {
            function modifyLightboxVideo() {
                var $lightboxIframe = $('.elementor-lightbox iframe, .dialog-lightbox-widget iframe');
                if ($lightboxIframe.length) {
                    $lightboxIframe.each(function() {
                        var $iframe = $(this);
                        var src = $iframe.attr('src');
                        if (src && src.indexOf('vimeo.com') > -1 && src.indexOf('autoplay=1') === -1) {
                            var newSrc = src.replace('muted=0', 'muted=0&autoplay=1');
                            $iframe.attr('src', newSrc);
                        }
                    });
                }
            }

            var lightboxObserver = new MutationObserver(function(mutations) {
                for (var i = 0; i < mutations.length; i++) {
                    var addedNodes = mutations[i].addedNodes;
                    for (var j = 0; j < addedNodes.length; j++) {
                        if (addedNodes[j].classList && addedNodes[j].classList.contains('elementor-lightbox')) {
                            setTimeout(modifyLightboxVideo, 800);
                        }
                    }
                }
            });
            
            lightboxObserver.observe(document.body, { childList: true, subtree: true });
        }
    });
    </script>
    <?php
}
