<?php
/**
 * RTL Translations - Complete Arabic Translation
 * ==============================================
 * Translates all theme strings to Arabic
 * 
 * Add to functions.php:
 * require_once get_stylesheet_directory() . '/rtl-translations.php';
 */

if (!defined('ABSPATH')) exit;

// ═══════════════════════════════════════════════════════════════
// 1. GETTEXT FILTER - Main translations
// ═══════════════════════════════════════════════════════════════

add_filter('gettext', 'kyro_arabic_translations', 1, 3);
add_filter('gettext_with_context', 'kyro_arabic_translations_ctx', 1, 4);
add_filter('ngettext', 'kyro_arabic_ngettext', 1, 5);

function kyro_arabic_translations($translated, $text, $domain) {
    if (!is_rtl()) return $translated;
    
    // Complete translation array
    $translations = array(
        // Author
        'by' => 'بواسطة',
        'By' => 'بواسطة',
        'by %s' => 'بواسطة %s',
        'By %s' => 'بواسطة %s',
        'and' => 'و',
        'Author' => 'الكاتب',
        
        // Time - AGO
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
        
        // Time patterns
        '1 second ago' => 'منذ ثانية',
        '%s seconds ago' => 'منذ %s ثواني',
        '1 minute ago' => 'منذ دقيقة',
        '%s minutes ago' => 'منذ %s دقائق',
        '1 hour ago' => 'منذ ساعة',
        '%s hours ago' => 'منذ %s ساعات',
        '1 day ago' => 'منذ يوم',
        '%s days ago' => 'منذ %s أيام',
        '1 week ago' => 'منذ أسبوع',
        '%s weeks ago' => 'منذ %s أسابيع',
        '1 month ago' => 'منذ شهر',
        '%s months ago' => 'منذ %s أشهر',
        '1 year ago' => 'منذ سنة',
        '%s years ago' => 'منذ %s سنوات',
        
        // Reading time
        '%s mins read' => '%s دقائق قراءة',
        '%s min read' => '%s دقيقة قراءة',
        '1 min read' => 'دقيقة قراءة',
        'min read' => 'دقيقة قراءة',
        'mins read' => 'دقائق قراءة',
        
        // Views
        '%s views' => '%s مشاهدة',
        '%s view' => '%s مشاهدة',
        'views' => 'مشاهدات',
        'view' => 'مشاهدة',
        
        // Read More
        'Read More' => 'اقرأ المزيد',
        'Read more' => 'اقرأ المزيد',
        'read more' => 'اقرأ المزيد',
        'READ MORE' => 'اقرأ المزيد',
        'Keep Reading' => 'متابعة القراءة',
        'Continue Reading' => 'متابعة القراءة',
        'More' => 'المزيد',
        'View all' => 'عرض الكل',
        'View All' => 'عرض الكل',
        'See all' => 'عرض الكل',
        'See All' => 'عرض الكل',
        'Load More' => 'تحميل المزيد',
        'Load more' => 'تحميل المزيد',
        
        // Live
        'Live' => 'مباشر',
        'LIVE' => 'مباشر',
        'live' => 'مباشر',
        
        // Navigation
        'Previous' => 'السابق',
        'Next' => 'التالي',
        'Prev' => 'السابق',
        'Next Story' => 'المقال التالي',
        'Previous Story' => 'المقال السابق',
        'Older posts' => 'مقالات أقدم',
        'Newer posts' => 'مقالات أحدث',
        
        // Search
        'Search' => 'بحث',
        'Search...' => 'بحث...',
        'Search Results' => 'نتائج البحث',
        'Search result' => 'نتائج البحث',
        'No results found' => 'لم يتم العثور على نتائج',
        'Type & hit enter' => 'اكتب واضغط Enter',
        '%s result(s) found.' => 'تم العثور على %s نتيجة.',
        
        // Categories
        'Category' => 'التصنيف',
        'Categories' => 'التصنيفات',
        'Browse Category' => 'تصفح التصنيف',
        'Browse Tag' => 'تصفح الوسم',
        'Tag' => 'وسم',
        'Tags' => 'الوسوم',
        'Tags:' => 'الوسوم:',
        
        // Posts
        'Latest posts' => 'أحدث المقالات',
        'Latest Posts' => 'أحدث المقالات',
        'Latest from %s' => 'آخر مقالات %s',
        'Related Posts' => 'مقالات ذات صلة',
        'Related' => 'ذات صلة',
        'You might be interested in' => 'قد يهمك أيضاً',
        'Popular Posts' => 'المقالات الشائعة',
        'Popular' => 'شائع',
        'Trending' => 'رائج',
        'Featured' => 'مميز',
        
        // Share
        'Share' => 'مشاركة',
        'Share this' => 'شارك هذا',
        'Share on' => 'شارك على',
        
        // Comments
        'Comment' => 'تعليق',
        'Comments' => 'تعليقات',
        'Leave a comment' => 'اترك تعليقاً',
        'Leave a Reply' => 'اترك رداً',
        'Post Comment' => 'إرسال التعليق',
        'Name' => 'الاسم',
        'Email' => 'البريد الإلكتروني',
        'Website' => 'الموقع',
        'Cancel reply' => 'إلغاء الرد',
        
        // Misc
        'Home' => 'الرئيسية',
        'Sponsored' => 'إعلان',
        'Advertisement' => 'إعلان',
        'Ad' => 'إعلان',
        'Menu' => 'القائمة',
        'Close' => 'إغلاق',
        'Open' => 'فتح',
        'Top' => 'الأعلى',
        'Back to top' => 'العودة للأعلى',
    );
    
    // Exact match
    if (isset($translations[$text])) {
        return $translations[$text];
    }
    
    return $translated;
}

function kyro_arabic_translations_ctx($translated, $text, $context, $domain) {
    return kyro_arabic_translations($translated, $text, $domain);
}

function kyro_arabic_ngettext($translated, $single, $plural, $number, $domain) {
    if (!is_rtl()) return $translated;
    return kyro_arabic_translations($translated, $translated, $domain);
}

// ═══════════════════════════════════════════════════════════════
// 2. HUMAN TIME DIFF FILTER - For "ago" strings
// ═══════════════════════════════════════════════════════════════

add_filter('human_time_diff', 'kyro_arabic_time_diff', 10, 3);

function kyro_arabic_time_diff($since, $diff, $from) {
    if (!is_rtl()) return $since;
    
    // Replace English time units with Arabic
    $replacements = array(
        'second' => 'ثانية',
        'seconds' => 'ثواني',
        'sec' => 'ثانية',
        'secs' => 'ثواني',
        'minute' => 'دقيقة',
        'minutes' => 'دقائق',
        'min' => 'دقيقة',
        'mins' => 'دقائق',
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
    );
    
    foreach ($replacements as $en => $ar) {
        $since = preg_replace('/\b' . $en . '\b/i', $ar, $since);
    }
    
    return $since;
}

// ═══════════════════════════════════════════════════════════════
// 3. OUTPUT BUFFER - Last resort for "ago" and "by"
// ═══════════════════════════════════════════════════════════════

add_action('wp_loaded', 'kyro_start_buffer');
add_action('shutdown', 'kyro_end_buffer', 0);

function kyro_start_buffer() {
    if (!is_rtl() || is_admin()) return;
    ob_start('kyro_translate_buffer');
}

function kyro_end_buffer() {
    if (!is_rtl() || is_admin()) return;
    if (ob_get_level() > 0) {
        ob_end_flush();
    }
}

function kyro_translate_buffer($html) {
    // Replace "ago" pattern
    $html = preg_replace('/(\d+)\s*(second|seconds|minute|minutes|hour|hours|day|days|week|weeks|month|months|year|years)\s+ago/i', 'منذ $1 $2', $html);
    
    // Replace standalone "ago" 
    $html = preg_replace('/\bago\b/i', 'مضت', $html);
    
    // Replace "by " before author name (careful not to replace in URLs)
    $html = preg_replace('/(<[^>]*class="[^"]*(?:meta|author|byline)[^"]*"[^>]*>.*?)by\s+/si', '$1بواسطة ', $html);
    
    // Time units in Arabic context
    $time_units = array(
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
    );
    
    foreach ($time_units as $en => $ar) {
        $html = preg_replace('/منذ\s+(\d+)\s+' . $en . '/i', 'منذ $1 ' . $ar, $html);
    }
    
    return $html;
}

// ═══════════════════════════════════════════════════════════════
// 4. JAVASCRIPT FALLBACK
// ═══════════════════════════════════════════════════════════════

add_action('wp_footer', 'kyro_arabic_js', 99999);

function kyro_arabic_js() {
    if (!is_rtl()) return;
    ?>
<script id="kyro-arabic-translations">
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
        // Fix "X unit ago" patterns
        document.querySelectorAll('.meta56, .post-meta, .entry-meta, .wi-meta, [class*="date"], [class*="time"]').forEach(function(el) {
            var html = el.innerHTML;
            
            // Replace "X unit ago" with "منذ X unit"
            html = html.replace(/(\d+)\s*(second|seconds|minute|minutes|hour|hours|day|days|week|weeks|month|months|year|years)\s+ago/gi, function(match, num, unit) {
                var arUnit = timeUnits[unit.toLowerCase()] || unit;
                return 'منذ ' + num + ' ' + arUnit;
            });
            
            // Replace standalone "ago"
            html = html.replace(/\bago\b/gi, 'مضت');
            
            // Replace "by "
            html = html.replace(/\bby\s+/gi, 'بواسطة ');
            
            if (el.innerHTML !== html) {
                el.innerHTML = html;
            }
        });
        
        // Fix Read More buttons
        document.querySelectorAll('.read-more, .more-link, [class*="readmore"]').forEach(function(el) {
            if (el.textContent.trim().toLowerCase() === 'read more') {
                el.textContent = 'اقرأ المزيد';
            }
        });
        
        // Fix Live badge
        document.querySelectorAll('.wi-live, [class*="live"]').forEach(function(el) {
            if (el.textContent.trim().toLowerCase() === 'live') {
                el.textContent = 'مباشر';
            }
        });
    }
    
    // Run on load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', translate);
    } else {
        translate();
    }
    
    // Watch for dynamic content
    var observer = new MutationObserver(translate);
    observer.observe(document.body, {childList: true, subtree: true});
    
    // Run again after short delay (for lazy loaded content)
    setTimeout(translate, 1000);
    setTimeout(translate, 3000);
})();
</script>
    <?php
}
