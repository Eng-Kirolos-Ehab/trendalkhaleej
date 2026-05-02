<?php
$fox56_customize->add_panel( 'footer', [
    'title' => 'Footer',
    'priority' => 170,
]);

include_once(dirname( __FILE__ ).'/options-footer-overview.php');
include_once(dirname( __FILE__ ).'/options-footer-general.php');

// areas
include_once(dirname( __FILE__ ).'/options-footer-top.php');
include_once(dirname( __FILE__ ).'/options-footer-sidebar.php');
include_once(dirname( __FILE__ ).'/options-footer-bottom.php');

// elements
include_once(dirname( __FILE__ ).'/options-footer-logo.php');
include_once(dirname( __FILE__ ).'/options-footer-social.php');
include_once(dirname( __FILE__ ).'/options-footer-copyright.php');
include_once(dirname( __FILE__ ).'/options-footer-nav.php');
include_once(dirname( __FILE__ ).'/options-footer-html.php');
include_once(dirname( __FILE__ ).'/options-footer-scrollup.php');