<?php
$fox56_customize->add_panel( 'single', [
    'title' => 'Single post',
    'priority' => 166,
]);

include_once(dirname( __FILE__ ).'/options-single-general.php'); // done

// areas
include_once(dirname( __FILE__ ).'/options-single-header.php'); // done
include_once(dirname( __FILE__ ).'/options-single-thumbnail.php'); // done
include_once(dirname( __FILE__ ).'/options-single-content.php'); // done
include_once(dirname( __FILE__ ).'/options-single-after-content.php');
include_once(dirname( __FILE__ ).'/options-single-bottom.php');

// components
include_once(dirname( __FILE__ ).'/options-single-authorbox.php'); // done
include_once(dirname( __FILE__ ).'/options-single-tags.php'); // done
// include_once(dirname( __FILE__ ).'/options-single-html.php'); // done deprecated since 6.8.2
include_once(dirname( __FILE__ ).'/options-single-nav.php'); // done
include_once(dirname( __FILE__ ).'/options-single-review.php'); // done
include_once(dirname( __FILE__ ).'/options-single-related.php'); // done
include_once(dirname( __FILE__ ).'/options-single-ads.php'); // done
include_once(dirname( __FILE__ ).'/options-single-share.php'); // done
include_once(dirname( __FILE__ ).'/options-single-comments.php'); // done
include_once(dirname( __FILE__ ).'/options-single-bottom-posts.php'); // done
include_once(dirname( __FILE__ ).'/options-single-sidedock.php' ); // done

// other options
include_once(dirname( __FILE__ ).'/options-single-progress.php'); // done
include_once(dirname( __FILE__ ).'/options-single-format.php' ); // done
include_once(dirname( __FILE__ ).'/options-single-hero.php'); // done
// include_once(dirname( __FILE__ ).'/options-single-autoload.php' );