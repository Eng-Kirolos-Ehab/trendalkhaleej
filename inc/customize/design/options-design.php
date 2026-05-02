<?php
$fox56_customize->add_panel( 'design', [
    'title' => 'DESIGN',
    'priority' => 174,
]);

// general colors
include_once(dirname( __FILE__ ) . '/options-design-general.php');

// site layout & background
include_once(dirname( __FILE__ ) . '/options-design-layout.php');

// elements
include_once(dirname( __FILE__ ) . '/options-design-form.php');
include_once(dirname( __FILE__ ) . '/options-design-widget.php');
include_once(dirname( __FILE__ ) . '/options-design-content-link.php');
include_once(dirname( __FILE__ ) . '/options-design-blockquote.php');
include_once(dirname( __FILE__ ) . '/options-design-caption.php');
include_once(dirname( __FILE__ ) . '/options-design-dropcap.php');

// dark mode
include_once(dirname( __FILE__ ) . '/options-design-darkmode.php');