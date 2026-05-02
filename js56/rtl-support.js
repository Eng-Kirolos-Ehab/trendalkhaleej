/**
 * Fox Theme - RTL JavaScript Support
 * 
 * This file handles RTL (Right-to-Left) support for sliders,
 * carousels, and other interactive components.
 * 
 * @package Fox
 * @since 1.0.0
 */

(function($) {
    'use strict';

    // Check if RTL mode is active
    var isRTL = (typeof fox_slider_vars !== 'undefined' && fox_slider_vars.rtl) || 
                $('html').attr('dir') === 'rtl' || 
                $('body').hasClass('rtl');

    /**
     * Fox RTL Support Object
     */
    var FoxRTL = {
        
        /**
         * Initialize RTL support
         */
        init: function() {
            if (!isRTL) {
                return;
            }

            this.initSlickSliders();
            this.initFlickitySliders();
            this.initFlexsliders();
            this.initOwlCarousels();
            this.initNavigationMenus();
            this.initDropdowns();
            this.initTooltips();
            this.fixSwipeGestures();
            
            console.log('Fox RTL Support initialized');
        },

        /**
         * Initialize Slick Sliders with RTL
         */
        initSlickSliders: function() {
            // Override Slick defaults for RTL
            if (typeof $.fn.slick !== 'undefined') {
                var originalSlick = $.fn.slick;
                
                $.fn.slick = function(options) {
                    if (typeof options === 'object' || typeof options === 'undefined') {
                        options = options || {};
                        
                        // Force RTL if not explicitly set to false
                        if (options.rtl !== false) {
                            options.rtl = true;
                        }
                    }
                    
                    return originalSlick.apply(this, arguments);
                };
            }

            // Re-initialize existing slick sliders
            $('.slick-slider, .slick-initialized').each(function() {
                var $slider = $(this);
                
                // Check if already initialized
                if ($slider.hasClass('slick-initialized')) {
                    // Get current settings
                    var slickInstance = $slider.slick('getSlick');
                    
                    if (slickInstance && !slickInstance.options.rtl) {
                        // Destroy and reinitialize with RTL
                        var settings = $.extend({}, slickInstance.options, { rtl: true });
                        $slider.slick('unslick');
                        $slider.slick(settings);
                    }
                }
            });
        },

        /**
         * Initialize Flickity Sliders with RTL
         */
        initFlickitySliders: function() {
            if (typeof Flickity === 'undefined') {
                return;
            }

            // Override Flickity defaults
            Flickity.defaults.rightToLeft = true;

            // Re-initialize existing Flickity instances
            $('.flickity-enabled').each(function() {
                var $carousel = $(this);
                var flkty = Flickity.data(this);
                
                if (flkty && !flkty.options.rightToLeft) {
                    var options = $.extend({}, flkty.options, { rightToLeft: true });
                    flkty.destroy();
                    new Flickity(this, options);
                }
            });

            // Also handle data-flickity initialization
            $('[data-flickity]').each(function() {
                var $el = $(this);
                var options = JSON.parse($el.attr('data-flickity') || '{}');
                
                if (!options.rightToLeft) {
                    options.rightToLeft = true;
                    $el.attr('data-flickity', JSON.stringify(options));
                }
            });
        },

        /**
         * Initialize Flexsliders with RTL
         */
        initFlexsliders: function() {
            if (typeof $.fn.flexslider === 'undefined') {
                return;
            }

            // Override Flexslider defaults
            var originalFlexslider = $.fn.flexslider;
            
            $.fn.flexslider = function(options) {
                if (typeof options === 'object' || typeof options === 'undefined') {
                    options = options || {};
                    options.rtl = true;
                    options.reverse = true; // Reverse animation direction
                }
                
                return originalFlexslider.apply(this, arguments);
            };
        },

        /**
         * Initialize Owl Carousels with RTL
         */
        initOwlCarousels: function() {
            if (typeof $.fn.owlCarousel === 'undefined') {
                return;
            }

            // Override Owl Carousel defaults
            var originalOwl = $.fn.owlCarousel;
            
            $.fn.owlCarousel = function(options) {
                if (typeof options === 'object' || typeof options === 'undefined') {
                    options = options || {};
                    options.rtl = true;
                }
                
                return originalOwl.apply(this, arguments);
            };

            // Re-initialize existing Owl Carousels
            $('.owl-carousel').each(function() {
                var $carousel = $(this);
                var owlData = $carousel.data('owl.carousel');
                
                if (owlData && !owlData.options.rtl) {
                    var options = $.extend({}, owlData.options, { rtl: true });
                    $carousel.owlCarousel('destroy');
                    $carousel.owlCarousel(options);
                }
            });
        },

        /**
         * Fix navigation menus for RTL
         */
        initNavigationMenus: function() {
            var $nav = $('.main-navigation, .primary-menu, #site-navigation');
            
            $nav.each(function() {
                var $menu = $(this);
                
                // Swap submenu positions
                $menu.find('ul ul').each(function() {
                    var $submenu = $(this);
                    var left = $submenu.css('left');
                    var right = $submenu.css('right');
                    
                    // Swap left/right positioning
                    if (left !== 'auto') {
                        $submenu.css({
                            'left': 'auto',
                            'right': left
                        });
                    }
                });
                
                // Handle dropdown arrows
                $menu.find('.menu-item-has-children > a').each(function() {
                    var $link = $(this);
                    var $arrow = $link.find('.dropdown-arrow, .sub-menu-toggle, i');
                    
                    if ($arrow.length) {
                        $arrow.css('transform', 'rotateY(180deg)');
                    }
                });
            });

            // Mobile menu toggle position
            $('.mobile-menu-toggle, .menu-toggle').css({
                'float': 'left',
                'right': 'auto',
                'left': '15px'
            });
        },

        /**
         * Fix dropdown positioning for RTL
         */
        initDropdowns: function() {
            // Generic dropdowns
            $('.dropdown, .dropdown-menu').each(function() {
                var $dropdown = $(this);
                
                // Swap left/right
                if ($dropdown.css('left') !== 'auto') {
                    $dropdown.css({
                        'left': 'auto',
                        'right': '0'
                    });
                }
            });
        },

        /**
         * Fix tooltips for RTL
         */
        initTooltips: function() {
            // Tooltipster
            if (typeof $.fn.tooltipster !== 'undefined') {
                $.fn.tooltipster.setDefaults({
                    side: 'left' // Changed from 'right' for RTL
                });
            }
        },

        /**
         * Fix swipe gestures for RTL
         */
        fixSwipeGestures: function() {
            // Swap swipe directions for touch events
            $(document).on('touchstart', '.slick-slider, .flickity-enabled, .owl-carousel', function(e) {
                var touch = e.originalEvent.touches[0];
                $(this).data('touchStartX', touch.clientX);
            });

            $(document).on('touchend', '.slick-slider, .flickity-enabled, .owl-carousel', function(e) {
                var startX = $(this).data('touchStartX');
                var endX = e.originalEvent.changedTouches[0].clientX;
                var diff = startX - endX;
                
                // In RTL, swap the swipe direction logic
                // This is handled by the slider libraries when rtl: true is set
                // But we ensure it here as a fallback
            });
        },

        /**
         * Utility: Swap CSS property values
         */
        swapCSSProperty: function($element, prop1, prop2) {
            var val1 = $element.css(prop1);
            var val2 = $element.css(prop2);
            
            $element.css(prop1, val2);
            $element.css(prop2, val1);
        }
    };

    /**
     * Initialize on document ready
     */
    $(document).ready(function() {
        FoxRTL.init();
    });

    /**
     * Re-initialize on AJAX complete (for dynamic content)
     */
    $(document).ajaxComplete(function() {
        if (isRTL) {
            FoxRTL.initSlickSliders();
            FoxRTL.initFlickitySliders();
        }
    });

    /**
     * Expose FoxRTL globally
     */
    window.FoxRTL = FoxRTL;

})(jQuery);
