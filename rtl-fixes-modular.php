<?php
/**
 * RTL Fixes - Modular Version
 * ===========================
 * Each fix is in its own function - enable/disable as needed
 * 
 * Add to functions.php:
 * require_once get_stylesheet_directory() . '/rtl-fixes-modular.php';
 */

if (!defined('ABSPATH')) exit;

// ╔═══════════════════════════════════════════════════════════════╗
// ║  MASTER SWITCH - Comment out any line to disable that fix     ║
// ╚═══════════════════════════════════════════════════════════════╝

add_action('wp_head', 'rtl_fix_1_big_column_center', 9999);      // العمود الكبير - وسط
add_action('wp_head', 'rtl_fix_2_medium_column_center', 9999);   // العمود المتوسط - وسط
add_action('wp_head', 'rtl_fix_3_image_caption_center', 9999);   // كابشن الصورة - وسط
add_action('wp_head', 'rtl_fix_4_image_spacing', 9999);          // مسافة بين الصورة والنص
add_action('wp_head', 'rtl_fix_5_list_column_container', 9999);  // العمود الـ list - داخل الـ container
add_action('wp_head', 'rtl_fix_6_small_posts_rtl', 9999);        // البوستات الصغيرة - RTL
add_action('wp_head', 'rtl_fix_9_meta_rtl', 9999);               // الـ meta (category, date) - RTL
add_action('wp_head', 'rtl_fix_10_global_rtl', 9999);            // كل الـ containers تكون RTL
add_action('wp_head', 'rtl_fix_11_carousel_fix', 9999);          // إصلاح الـ Carousel

add_filter('gettext', 'rtl_fix_7_translations', 10, 3);          // الترجمات
add_action('wp_footer', 'rtl_fix_8_js_translations', 9999);      // ترجمة الـ JS


// ╔═══════════════════════════════════════════════════════════════╗
// ║  FIX 1: Big Column - Title & Content Centered                 ║
// ║  العمود الكبير (في النص) - العنوان والمحتوى في الوسط          ║
// ╚═══════════════════════════════════════════════════════════════╝

function rtl_fix_1_big_column_center() {
    if (!is_rtl()) return;
    ?>
<style id="rtl-fix-1-big-column">
/* Big column - ALL content centered (high specificity) */
.row56__col--big .post56,
.row56__col--big .post56__text,
.row56__col--big .post56.align-left,
.row56__col--big .post56.align-right,
.blog56-group .row56__col--big .post56 {
    text-align: center !important;
}

/* Big column title - center */
.row56__col--big .title56,
.row56__col--big .post56__title,
.row56__col--big h2.title56,
.row56__col--big .title56 a {
    text-align: center !important;
}

/* Big column meta - center */
.row56__col--big .meta56 {
    justify-content: center !important;
    text-align: center !important;
}

/* Big column excerpt - center */
.row56__col--big .excerpt56 {
    text-align: center !important;
}

/* Big column read more - center */
.row56__col--big .readmore56 {
    text-align: center !important;
}

/* Big column - keep normal flex (not reversed) */
.row56__col--big .post56--list {
    flex-direction: row !important;
}
</style>
    <?php
}


// ╔═══════════════════════════════════════════════════════════════╗
// ║  FIX 2: Medium Column - RTL (Right to Left)                   ║
// ║  العمود المتوسط - من اليمين للشمال                            ║
// ╚═══════════════════════════════════════════════════════════════╝

function rtl_fix_2_medium_column_center() {
    if (!is_rtl()) return;
    ?>
<style id="rtl-fix-2-medium-column">
/* Medium column title - RIGHT aligned */
.row56__col--medium .title56,
.row56__col--medium .post56__title,
.row56__col--medium h2.title56 {
    text-align: right !important;
}

/* Medium column meta - RIGHT aligned */
.row56__col--medium .meta56 {
    justify-content: flex-start !important;
    text-align: right !important;
}

/* Medium column excerpt - RIGHT aligned */
.row56__col--medium .excerpt56 {
    text-align: right !important;
}
</style>
    <?php
}


// ╔═══════════════════════════════════════════════════════════════╗
// ║  FIX 3: Image Caption - Centered                              ║
// ║  كابشن الصورة - في الوسط                                      ║
// ╚═══════════════════════════════════════════════════════════════╝

function rtl_fix_3_image_caption_center() {
    if (!is_rtl()) return;
    ?>
<style id="rtl-fix-3-caption">
/* All caption types - center */
.thumbnail56 figcaption,
.wp-caption-text,
figure figcaption,
.post56__caption,
.image-caption,
.caption {
    text-align: center !important;
    display: block !important;
    width: 100% !important;
}
</style>
    <?php
}


// ╔═══════════════════════════════════════════════════════════════╗
// ║  FIX 4: Image Spacing - Space between image and text          ║
// ║  مسافة بين الصورة والنص                                       ║
// ╚═══════════════════════════════════════════════════════════════╝

function rtl_fix_4_image_spacing() {
    if (!is_rtl()) return;
    ?>
<style id="rtl-fix-4-spacing">
/* Thumbnail spacing */
.thumbnail56,
figure.thumbnail56 {
    margin-bottom: 15px;
}

/* Grid/Big posts - more spacing */
.row56__col--big .thumbnail56,
.row56__col--medium .thumbnail56 {
    margin-bottom: 18px;
}
</style>
    <?php
}


// ╔═══════════════════════════════════════════════════════════════╗
// ║  FIX 5: List Column - Stay inside container                   ║
// ║  العمود الـ list/small - يبقى داخل الـ container              ║
// ╚═══════════════════════════════════════════════════════════════╝

function rtl_fix_5_list_column_container() {
    if (!is_rtl()) return;
    ?>
<style id="rtl-fix-5-list-container">
/* List container - proper width without clipping */
.row56__col--small .blog56--list,
.blog56--list {
    width: 100% !important;
    max-width: 100% !important;
}

/* List posts - stay inside */
.blog56--list .post56 {
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
}
</style>
    <?php
}


// ╔═══════════════════════════════════════════════════════════════╗
// ║  FIX 6: Small Posts - RTL Direction (thumbnail left)          ║
// ║  البوستات الصغيرة - الصورة على اليسار والنص على اليمين        ║
// ╚═══════════════════════════════════════════════════════════════╝

function rtl_fix_6_small_posts_rtl() {
    if (!is_rtl()) return;
    ?>
<style id="rtl-fix-6-small-rtl">
/* List posts RTL - EXCEPT big column */
.row56__col--small .post56--list,
.row56__col--small .post56--list--thumb-left,
.row56__col--small .post56--list--thumb-right,
.row56__col--medium .post56--list,
.blog56--list:not(.row56__col--big *) .post56--list {
    display: flex !important;
    flex-direction: row-reverse !important;
}

/* Thumbnail margin - EXCEPT big column */
.row56__col--small .post56--list .thumbnail56,
.row56__col--small .post56--list--thumb-left .thumbnail56,
.row56__col--medium .post56--list .thumbnail56 {
    margin-left: 15px !important;
    margin-right: 0 !important;
    margin-bottom: 0 !important;
    flex-shrink: 0 !important;
}

/* Text alignment - EXCEPT big column */
.row56__col--small .post56__text,
.row56__col--medium .post56__text {
    text-align: right !important;
    flex: 1 !important;
}

/* Override align-left - EXCEPT big column */
.row56__col--small .post56.align-left,
.row56__col--medium .post56.align-left {
    text-align: right !important;
}

/* Number badge position (1, 2, 3...) */
.post56 .number56 {
    margin-left: 10px !important;
    margin-right: 0 !important;
}
</style>
    <?php
}


// ╔═══════════════════════════════════════════════════════════════╗
// ║  FIX 11: Carousel Fix - Make sure carousels are visible       ║
// ║  إصلاح الـ Carousel - يظهر بشكل صحيح                          ║
// ╚═══════════════════════════════════════════════════════════════╝

function rtl_fix_11_carousel_fix() {
    if (!is_rtl()) return;
    ?>
<style id="rtl-fix-11-carousel">
/* Carousel containers - reset problematic styles */
.blog56--carousel,
.carousel56,
.flickity-enabled,
.slick-slider,
[class*="carousel"],
[class*="slider"] {
    direction: ltr !important;
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    overflow: visible !important;
}

/* Carousel wrapper */
.blog56--carousel .blog56,
.carousel56 .flickity-viewport,
.flickity-slider {
    direction: ltr !important;
    display: block !important;
}

/* Carousel items - RTL text but LTR layout */
.blog56--carousel .post56,
.carousel56 .post56,
[class*="carousel"] .post56 {
    direction: rtl !important;
    text-align: right !important;
    display: inline-block !important;
    visibility: visible !important;
}

/* Carousel navigation arrows */
.carousel56__nav,
.flickity-prev-next-button,
.slick-arrow {
    direction: ltr !important;
}

/* Fix carousel width */
.blog56--carousel,
.carousel56 {
    width: 100% !important;
    max-width: 100% !important;
}
</style>
    <?php
}


// ╔═══════════════════════════════════════════════════════════════╗
// ║  FIX 9: Meta Section RTL - Category & Date order              ║
// ║  الـ meta (التصنيف والتاريخ) - ترتيب RTL                      ║
// ╚═══════════════════════════════════════════════════════════════╝

function rtl_fix_9_meta_rtl() {
    if (!is_rtl()) return;
    ?>
<style id="rtl-fix-9-meta-rtl">
/* Meta container - RTL direction */
.meta56 {
    direction: rtl !important;
    display: flex !important;
    flex-wrap: wrap !important;
    gap: 8px !important;
}

/* Date comes first (right side in RTL) */
.meta56__date {
    order: 1 !important;
}

/* Category comes second (left side in RTL) */
.meta56__category--fancy {
    order: 2 !important;
}

/* Author comes third */
.meta56__author {
    order: 3 !important;
}

/* Fix the dot separator - RTL */
.meta56__item::before {
    margin-left: 8px !important;
    margin-right: 0 !important;
}

/* Make sure items are RTL */
.meta56__item {
    direction: rtl !important;
}
</style>
    <?php
}


// ╔═══════════════════════════════════════════════════════════════╗
// ║  FIX 10: Global RTL - All containers                          ║
// ║  كل الـ containers والـ widgets تكون RTL                      ║
// ╚═══════════════════════════════════════════════════════════════╝

function rtl_fix_10_global_rtl() {
    if (!is_rtl()) return;
    ?>
<style id="rtl-fix-10-global">
/* Main containers - RTL */
.container,
.container--main,
.blog56-wrapper,
.widget56,
.fox-builder-section,
.section-inner,
.builder56__section,
.section56 {
    direction: rtl !important;
}

/* Blog containers - RTL */
.blog56,
.blog56--group,
.blog56--grid,
.blog56--list {
    direction: rtl !important;
}

/* Row/Col containers - RTL */
.row,
.row56,
.row56__col,
.col,
[class*="col-"] {
    direction: rtl !important;
}

/* Widget row - flex reverse */
.widget56__row > .row {
    display: flex !important;
    flex-direction: row-reverse !important;
}

/* Post content - RTL (except big column which is centered) */
.post56,
.post56__text,
.post56__body {
    direction: rtl !important;
}

/* Text align right - except big column */
.row56__col--small .post56__text,
.row56__col--medium .post56__text,
.row56__col:not(.row56__col--big) .post56__text {
    text-align: right !important;
}

/* Title - RTL */
.title56,
.title56 a {
    direction: rtl !important;
    text-align: right !important;
}

/* Excerpt - RTL */
.excerpt56 {
    direction: rtl !important;
    text-align: right !important;
}

/* Compact titles - RTL */
.compact-titles {
    direction: rtl !important;
    text-align: right !important;
}

/* Prevent text clipping */
.post56,
.post56__text,
.excerpt56,
.title56 {
    overflow: visible !important;
    text-overflow: unset !important;
    word-wrap: break-word !important;
}

/* Caption center */
.thumbnail56__caption,
figcaption.wp-caption-text {
    text-align: center !important;
}
</style>
    <?php
}


// ╔═══════════════════════════════════════════════════════════════╗
// ║  FIX 7: Translations - Arabic text                            ║
// ║  الترجمات - النصوص بالعربي                                    ║
// ╚═══════════════════════════════════════════════════════════════╝

function rtl_fix_7_translations($translated, $text, $domain) {
    if (!is_rtl()) return $translated;
    
    $ar = array(
        // Author
        'by' => 'بواسطة',
        'By' => 'بواسطة',
        'by %s' => 'بواسطة %s',
        'By %s' => 'بواسطة %s',
        
        // Time
        'ago' => 'مضت',
        '%s ago' => 'منذ %s',
        'just now' => 'الآن',
        'Just now' => 'الآن',
        
        // Time units
        'second' => 'ثانية',
        'seconds' => 'ثواني',
        'minute' => 'دقيقة',
        'minutes' => 'دقائق',
        'hour' => 'ساعة',
        'hours' => 'ساعات',
        'day' => 'يوم',
        'days' => 'أيام',
        'week' => 'أسبوع',
        'weeks' => 'أسابيع',
        'month' => 'شهر',
        'months' => 'أشهر',
        'year' => 'سنة',
        'years' => 'سنوات',
        
        // Read more
        'Read More' => 'اقرأ المزيد',
        'Read more' => 'اقرأ المزيد',
        'More' => 'المزيد',
        
        // Live
        'Live' => 'مباشر',
        'LIVE' => 'مباشر',
        
        // Navigation
        'Previous' => 'السابق',
        'Next' => 'التالي',
        
        // Search
        'Search' => 'بحث',
    );
    
    return isset($ar[$text]) ? $ar[$text] : $translated;
}


// ╔═══════════════════════════════════════════════════════════════╗
// ║  FIX 8: JavaScript Translations - Dynamic content             ║
// ║  ترجمة المحتوى الديناميكي بالـ JavaScript                     ║
// ╚═══════════════════════════════════════════════════════════════╝

function rtl_fix_8_js_translations() {
    if (!is_rtl()) return;
    ?>
<script id="rtl-fix-8-js">
(function(){
    var timeUnits = {
        'second': 'ثانية', 'seconds': 'ثواني',
        'minute': 'دقيقة', 'minutes': 'دقائق',
        'hour': 'ساعة', 'hours': 'ساعات',
        'day': 'يوم', 'days': 'أيام',
        'week': 'أسبوع', 'weeks': 'أسابيع',
        'month': 'شهر', 'months': 'أشهر',
        'year': 'سنة', 'years': 'سنوات'
    };
    
    function translate() {
        // Fix "X unit ago" → "منذ X unit"
        document.querySelectorAll('.meta56, .post-meta, [class*="date"], [class*="time"]').forEach(function(el) {
            var html = el.innerHTML;
            var changed = false;
            
            // Pattern: "5 minutes ago" → "منذ 5 دقائق"
            var newHtml = html.replace(/(\d+)\s*(second|seconds|minute|minutes|hour|hours|day|days|week|weeks|month|months|year|years)\s+ago/gi, function(match, num, unit) {
                changed = true;
                var arUnit = timeUnits[unit.toLowerCase()] || unit;
                return 'منذ ' + num + ' ' + arUnit;
            });
            
            // Standalone "ago"
            newHtml = newHtml.replace(/\bago\b/gi, function() {
                changed = true;
                return 'مضت';
            });
            
            // "by " → "بواسطة "
            newHtml = newHtml.replace(/\bby\s+/gi, function() {
                changed = true;
                return 'بواسطة ';
            });
            
            if (changed) {
                el.innerHTML = newHtml;
            }
        });
    }
    
    // Run on load
    document.addEventListener('DOMContentLoaded', translate);
    
    // Watch for dynamic content
    new MutationObserver(translate).observe(document.body, {childList: true, subtree: true});
    
    // Run after delays for lazy content
    setTimeout(translate, 500);
    setTimeout(translate, 2000);
})();
</script>
    <?php
}
