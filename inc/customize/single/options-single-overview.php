<?php
$fox56_customize->add_section( 'single_overview',[
    'title' => 'Overview (check me first)',
    'panel' => 'single',
]);



$fox56_customize->add_field([
    'type' => 'html',
    'id' => 'single_overview_img',
    'html' => '<img src="' . get_template_directory_uri() . '/inc/customize/images/single_overview.jpg?v=' . FOX_VERSION . '" />',

    'section' => 'single_overview',
]);

// breadcrumb - deprecated56

/*
$fox56_customize->add_field([
    'type' => 'html',
    'id' => 'single_overview_placeholder_thumbnail',
    'html' => '<h3 class="sortable56__custom_title">
                <a href="javascript:wp.customize.section(\'single_thumbnail\').focus()" class="sortable56__custom_title__edit"><i class="dashicons dashicons-edit"></i></a>
                <span>Thumbnail</span>
            </h3>',
]);
*/

/*
$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'single_before_content_elements',
    'options' => [
        'ad' => [
            'name' => 'Ad',
            'section_edit' => 'single_ads',
        ],
        'share' => [
            'name' => 'Share',
            'section_edit' => 'single_share',
        ],
        'review' => [
            'name' => 'Review',
            'section_edit' => 'single_review',
        ],
        'sponsor' => [
            'name' => 'Sponsor',
            'section_edit' => 'single_header',
        ],
        'sponsor' => [
            'name' => 'Subtitle',
            'section_edit' => 'single_header',
        ],
        'date' => [
            'name' => 'Date',
            'section_edit' => 'blog_meta',
        ],
        'author' => [
            'name' => 'Author',
            'section_edit' => 'blog_meta',
        ],
    ],
    'std' => [ 'ad', 'sponsor', 'review' ],
    'title' => '',
    'refresh' => 'single',

    'additional' => [
        'title' => 'Before post content',
    ],

    'hint' => 'single before post content',
]);
*/

/*
$fox56_customize->add_field([
    'type' => 'html',
    'id' => 'single_overview_placeholder_content',
    'html' => '<h3 class="sortable56__custom_title">
                <a href="javascript:wp.customize.section(\'single_body\').focus()" class="sortable56__custom_title__edit"><i class="dashicons dashicons-edit"></i></a>
                <span>Post content</span>
            </h3>',
]);

*/

/*
$fox56_customize->add_field([
    'type' => 'html',
    'id' => 'single_overview_placeholder_sidebar',
    'html' => '<h3 class="sortable56__custom_title">
                <a href="javascript:wp.customize.section(\'single_general\').focus()" class="sortable56__custom_title__edit"><i class="dashicons dashicons-edit"></i></a>
                <span>Optional sidebar</span>
            </h3>',
]);
*/

/*
$fox56_customize->add_field([
    'type' => 'html',
    'id' => 'single_overview_placeholder_sidedock',
    'html' => '<h3 class="sortable56__custom_title">
                <a href="javascript:wp.customize.section(\'single_sidedock\').focus()" class="sortable56__custom_title__edit"><i class="dashicons dashicons-edit"></i></a>
                <span>Footer side-dock</span>
            </h3>',
]);
*/