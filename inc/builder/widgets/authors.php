<?php
class Fox56_Builder_Authors extends Fox56_Builder_Widget_Base {

    public function get_name() {
		return 'authors';
	}

	public function get_title() {
		return 'Authors';
	}

	public function get_icon() {
		return 'user';
	}

	public function get_preview_image_url() {
		return get_template_directory_uri() . '/inc/builder/images/authors.jpg?v=' . FOX_VERSION;
	}

	function fields() {
		global $fox56_customize;
		$fields = [];

		$fields[ 'column' ] = [
			'type' => 'group',
			'title' => 'Column',
			'fields' => [
				'desktop' => [
					'name' => 'Desktop',
					'type' => 'number',
					'max' => 6,
					'min' => 1,
					'step' => 1,
					'col' => '1-3',
				],
				'tablet' => [
					'name' => 'Tablet',
					'type' => 'number',
					'max' => 4,
					'min' => 1,
					'step' => 1,
					'col' => '1-3',
				],
				'mobile' => [
					'name' => 'Mobile',
					'type' => 'number',
					'max' => 4,
					'min' => 1,
					'step' => 1,
					'col' => '1-3',
				],
			],
			'std' => [
				'desktop' => 3,
				'tablet' => 3,
				'mobile' => 1,
			],
		
			'section' => 'general',
			'section_name' => 'General',
		];

		$fields[ 'author_item_layout' ] = [
			'type' => 'radio',
			'std' => 'top',
			'options' => [
				'top' => 'Avatar top',
				'left' => 'Avatar left',
			],
			'name' => 'Author layout',
		];

		$fields[ 'align' ] = array(
			'type' => 'select',
			'title' => 'Text align',
			'std' => 'left',
			'options' => [
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right',
			],

			'css' => [
				[
					'property' => 'text-align',
					'selector' => "{{wrapper}} .author56",
				],
			],
		);
		
		$fields[ 'valign' ] = array(
			'type' => 'select',
			'title' => 'Vertical align',
			'std' => 'flex-start',
			'options' => [
				'flex-start' => 'Top',
				'center' => 'Middle',
				'flex-end' => 'Bottom',
			],

			'css' => [
				[
					'property' => 'align-items',
					'selector' => "{{wrapper}}.authors56--item--left .author56",
				],
			],
		);

		$fields[ 'description_displays' ] = array(
			'type' => 'radio',
			'title' => 'Description displays:',
			'std' => 'post',
			'options' => [
				'post' => 'Author post',
				'description' => 'Author bio',
			],
		);

		$fields[ 'description_post' ] = array(
			'type' => 'select',
			'title' => 'Author post',
			'std' => 'date',
			'options' => [
				'date' => 'Latest post',
				'feature' => 'Featured post',
				'comment_count' => 'Most commented post',
				'view' => 'Most viewed',
				'view_week' => 'Most viewed weekly',
				'view_month' => 'Most viewed monthly',
				'view_year' => 'Most viewed yearly',
				'rand' => 'Random post',
				'modified' => 'Latest edited',
			],
			'desc' => 'To display most viewed post, "Post Views Counter" plugin must be installed.',
		);

		/* Query
		-------------------------------------------------------------------------------- */
		$fields[ 'number' ] = [
			'type' => 'number',
			'title' => 'Number to display',
			'std' => '3',

			'section' => 'query',
			'section_name' => 'Query',
		];

		$fields[ 'orderby' ] = array(
			'type' => 'select',
			'options' => array(
				'display_name' => 'Name',
				'post_count' => 'Post count',
				'registered' => 'Registered Date',
			),
			'std' => 'post_count',
			'title' => 'Order by',
		);
		
		$fields[ 'order' ] = array(
			'type' => 'select',
			'options' => array(
				'asc' => 'Ascending',
				'desc' => 'Descending',
			),
			'std' => 'desc',
			'title' => 'Order',
		);

		$fields[ 'has_published_posts' ] = array(
			'type' => 'checkbox',
			'std' => true,
			'title' => 'Only display authors',
			'desc'  => 'Author means: user must have at least 1 published post',
		);
		
		$fields[ 'include' ] = array(
			'type' => 'text',
			'title' => 'Only show users with IDs:',
			'desc' => 'Separate ids by comma',
		);
		
		$fields[ 'exclude' ] = array(
			'type' => 'text',
			'title' => 'Exclude authors by IDs:',
			'desc' => 'Separate ids by comma',
		);

		/* Border/Spacing
		-------------------------------------------------------------------------------- */
		$fields[ 'h_spacing' ] = [
			'section' => 'style',
			'section_name' => 'Style',

			'type' => 'group',
			'title' => 'Gap between columns',
			'choices' => [
				'min' => 0,
				'max' => 100,
				'step' => 2,
			],
			'fields' => [
				'desktop' => [
					'type' => 'number',
					'name' => 'Desktop',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
				'tablet' => [
					'type' => 'number',
					'name' => 'Tablet',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
				'mobile' => [
					'type' => 'number',
					'name' => 'Mobile',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
			],
			'std' => [
				'desktop' => 32,
				'tablet' => 20,
				'mobile' => 10,
			],
			'css' => [
				
				[
					'property' => 'padding-left',
					'selector' => "{{wrapper}} .author56",
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'padding-left',
					'selector' => "{{wrapper}} .author56",
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'padding-left',
					'selector' => "{{wrapper}} .author56",
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],

				[
					'property' => 'padding-right',
					'selector' => "{{wrapper}} .author56",
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'padding-right',
					'selector' => "{{wrapper}} .author56",
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'padding-right',
					'selector' => "{{wrapper}} .author56",
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],

				[
					'property' => 'margin-left',
					'selector' => "{{wrapper}} .authors56__container",
					'unit' => 'px',
					'value_pattern' => '-$',
					'use' => 'desktop',
				],
				[
					'property' => 'margin-left',
					'selector' => "{{wrapper}} .authors56__container",
					'unit' => 'px',
					'value_pattern' => '-$',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'margin-left',
					'selector' => "{{wrapper}} .authors56__container",
					'unit' => 'px',
					'value_pattern' => '-$',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],

				[
					'property' => 'margin-right',
					'selector' => "{{wrapper}} .authors56__container",
					'unit' => 'px',
					'value_pattern' => '-$',
					'use' => 'desktop',
				],
				[
					'property' => 'margin-right',
					'selector' => "{{wrapper}} .authors56__container",
					'unit' => 'px',
					'value_pattern' => '-$',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'margin-right',
					'selector' => "{{wrapper}} .authors56__container",
					'unit' => 'px',
					'value_pattern' => '-$',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],

			],
		];

		$fields[ 'v_spacing' ] = [
			'type' => 'group',
			'title' => 'Gap between rows',
			'choices' => [
				'min' => 0,
				'max' => 100,
				'step' => 2,
			],
			'fields' => [
				'desktop' => [
					'type' => 'number',
					'name' => 'Desktop',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
				'tablet' => [
					'type' => 'number',
					'name' => 'Tablet',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
				'mobile' => [
					'type' => 'number',
					'name' => 'Mobile',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
			],
			'std' => [
				'desktop' => 32,
				'tablet' => 20,
				'mobile' => 10,
			],
			
			'css' => [
				
				[
					'property' => 'padding-top',
					'selector' => "{{wrapper}} .author56",
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'padding-top',
					'selector' => "{{wrapper}} .author56",
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'padding-top',
					'selector' => "{{wrapper}} .author56",
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],

				[
					'property' => 'padding-bottom',
					'selector' => "{{wrapper}} .author56",
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'padding-bottom',
					'selector' => "{{wrapper}} .author56",
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'padding-bottom',
					'selector' => "{{wrapper}} .author56",
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],

				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}} .authors56__container",
					'unit' => 'px',
					'value_pattern' => '-$',
					'use' => 'desktop',
				],
				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}} .authors56__container",
					'unit' => 'px',
					'value_pattern' => '-$',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}} .authors56__container",
					'unit' => 'px',
					'value_pattern' => '-$',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],

				[
					'property' => 'margin-bottom',
					'selector' => "{{wrapper}} .authors56__container",
					'unit' => 'px',
					'value_pattern' => '-$',
					'use' => 'desktop',
				],
				[
					'property' => 'margin-bottom',
					'selector' => "{{wrapper}} .authors56__container",
					'unit' => 'px',
					'value_pattern' => '-$',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'margin-bottom',
					'selector' => "{{wrapper}} .authors56__container",
					'unit' => 'px',
					'value_pattern' => '-$',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],

			],

		];

		$fields[ 'v_sep' ] = [
			'type' => 'radio',
			'title' => 'Vertical border between cols?',
			'options' => [
				'1px' => 'Yes',
				'0px' => 'No',
			],
			'std' => '0px',
			'css' => [
				[
					'property' => 'border-left-width',
					'selector' => "{{wrapper}} .author56",
				],
			],
		];
	
		$fields[ 'v_sep_color' ] = [
			'type' => 'color',
			'title' => 'Vertical border color',
			'css' => [
				[
					'property' => 'border-left-color',
					'selector' => "{{wrapper}} .author56",
				],
			],
		];
	
		// if group, it applies to sub-items
		$fields[ 'h_sep' ] = [
			'type' => 'radio',
			'title' => 'Horizontal border between items?',
			'options' => [
				'1px' => 'Yes',
				'0px' => 'No',
			],
			'std' => '0px',
			'css' => [
				[
					'property' => 'border-top-width',
					'selector' => "{{wrapper}} .author56",
				],
			],
			
		];
	
		$fields[ 'h_sep_color' ] = [
			'type' => 'color',
			'title' => 'Horizontal border color',
			'css' => [
				[
					'property' => 'border-top-color',
					'selector' => "{{wrapper}} .author56",
				],
			],
		];

		$fields[ 'avatar_text_gap' ] = [
			'type' => 'group',
			'title' => 'Avatar - text gap',

			'fields' => [
				'desktop' => [
					'type' => 'number',
					'name' => 'Desktop',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
				'tablet' => [
					'type' => 'number',
					'name' => 'Tablet',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
				'mobile' => [
					'type' => 'number',
					'name' => 'Mobile',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
			],
			'std' => [
				'desktop' => 20,
				'tablet' => 15,
				'mobile' => 10,
			],
			'css' => [
				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}}.authors56--item--top .author56__text",
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}}.authors56--item--top .author56__text",
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}}.authors56--item--top .author56__text",
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],


				[
					'property' => 'padding-left',
					'selector' => "{{wrapper}}.authors56--item--left .author56__text",
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'padding-left',
					'selector' => "{{wrapper}}.authors56--item--left .author56__text",
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'padding-left',
					'selector' => "{{wrapper}}.authors56--item--left .author56__text",
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
			]

		];

		$fields[ 'avatar_size' ] = [
			'type' => 'group',
			'title' => 'Avatar size',
			'fields' => [
				'desktop' => [
					'type' => 'number',
					'name' => 'Desktop',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
				'tablet' => [
					'type' => 'number',
					'name' => 'Tablet',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
				'mobile' => [
					'type' => 'number',
					'name' => 'Mobile',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
			],
			'std' => [
				'desktop' => 120,
				'tablet' => 90,
				'mobile' => 50,
			],
			'css' => [
				
				[
					'property' => 'width',
					'selector' => "{{wrapper}} .author56__avatar",
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'width',
					'selector' => "{{wrapper}}.authors56--item--left .author56__text",
					'value_pattern' => 'calc(100% - $)',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'width',
					'selector' => "{{wrapper}} .author56__avatar",
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'width',
					'selector' => "{{wrapper}}.authors56--item--left .author56__text",
					'value_pattern' => 'calc(100% - $)',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'width',
					'selector' => "{{wrapper}} .author56__avatar",
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
				[
					'property' => 'width',
					'selector' => "{{wrapper}}.authors56--item--left .author56__text",
					'value_pattern' => 'calc(100% - $)',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],

			],
		];

		$fields[ 'avatar_border_radius' ] = [
			'type' => 'number',
			'title' => 'Avatar roundness',
			'css' => [
				[
					'property' => 'border-radius',
					'selector' => "{{wrapper}} .author56__avatar img",
					'unit' => 'px',
				],
			],
			'std' => 150,
		];

		$fields[ 'name_description_gap' ] = [
			'type' => 'group',
			'title' => 'Name - description gap',

			'fields' => [
				'desktop' => [
					'type' => 'number',
					'name' => 'Desktop',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
				'tablet' => [
					'type' => 'number',
					'name' => 'Tablet',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
				'mobile' => [
					'type' => 'number',
					'name' => 'Mobile',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
			],
			'std' => [
				'desktop' => 6,
				'tablet' => 5,
				'mobile' => 4,
			],
			'css' => [
				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}} .author56__description",
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}} .author56__description",
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}} .author56__description",
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
			]

		];

		/* Typography
		-------------------------------------------------------------------------------- */
		$fields[ 'name_typography' ] = [
			'type' => 'group',
			'title' => "Author name typography",
			'fields' => $fox56_customize->typo_fields,
			'css' => fox56_builder_typo_css( '.author56__name' ),

			'section' => 'typography',
			'section_name' => 'Typography',			
		];

		$fields[ 'description_typography' ] = [
			'type' => 'group',
			'title' => "Author description typography",
			'fields' => $fox56_customize->typo_fields,
			'css' => fox56_builder_typo_css( '.author56__description' ),
		];

		/* Colors
		-------------------------------------------------------------------------------- */
		$fields[ 'color' ] = [
			'type' => 'color',
			'title' => 'Text color',

			'css' => [
				[
					'property' => 'color',
					'selector' => "{{wrapper}}",
				],
			],

			'section' => 'color',
			'section_name' => 'Color',			
		];

		$fields[ 'name_color' ] = [
			'type' => 'color',
			'title' => 'Author name color',
			
			'css' => [
				[
					'property' => 'color',
					'selector' => "{{wrapper}} .author56__name",
				],
			],	
		];

		$fields[ 'description_color' ] = [
			'type' => 'color',
			'title' => 'Description color',
			
			'css' => [
				[
					'property' => 'color',
					'selector' => "{{wrapper}} .author56__description",
				],
			],
		];

		$fields = array_merge( $fields, fox56_builder_widget_layout_options( $this->get_name().'_layout_', '{{wrapper}}', false ) );
		
		return $fields;

	}

	function render( $args ) {

		extract( wp_parse_args( $args, [

			'widget_id' => '',
    
			// query options
			'number' => '',
			'orderby' => '',
			'order' => '',
			'include' => '',
			'exclude' => '',
			'has_published_posts' => true,
		
			// layout
			'column' => [],
			'author_item_layout' => 'top',
			'align' => 'left',
			'valign' => 'top',

			'description_displays' => 'post',
			'description_post' => 'date',
		
		] ) );

		/* Query
		-------------------- */
		$query_args = [
			'number' => $number,
			'orderby' => $orderby,
			'order' => $order,
		];
		if ( $has_published_posts ) {
			$query_args[ 'capability' ] = 'edit_posts';
			$query_args[ 'has_published_posts' ] = 'post';
		}

		$include = trim( $include );
		if ( ! empty( $include ) ) {
			$include = explode( ',', $include );
			$include = array_map( 'absint', $include );
			$query_args = [ 'include' => $include ];
			$query_args[ 'orderby' ] = 'include';
		}
		$exclude = trim( $exclude );
		if ( ! empty( $exclude ) ) {
			$exclude = explode( ',', $exclude );
			$exclude = array_map( 'absint', $exclude );
			$query_args[ 'exclude' ] = $exclude;
		}

		$user_query = new WP_User_Query( $query_args );
		$result = $user_query->get_results();

		/**
		 * classes
		 */
		$cl = [ 'authors56', $widget_id ];

		if ( empty( $result ) ) {
			$cl[] = 'fox-error';
			?>
			<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>" data-id="<?php echo esc_attr( $widget_id ); ?>">
				<span><?php echo esc_html__( 'No users found', 'wi' ); ?>
			</div>
			<?php
			return;
		}

		/**
		 * column
		 */
		if ( ! is_array( $column ) ) { $column = []; }
		$column = wp_parse_args( $column, [ 'desktop' => 3, 'tablet' => 3, 'mobile' => 1 ]);
		$cl[] = 'authors56--desktop--' . $column['desktop'];
		$cl[] = 'authors56--tablet--' . $column['tablet'];
		$cl[] = 'authors56--mobile--' . $column['mobile'];

		/**
		 * layout
		 */
		if ( 'left' != $author_item_layout ) {
			$author_item_layout = 'top';
		}
		$cl[] = 'authors56--item--' . $author_item_layout;

		?>
		<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>" data-id="<?php echo esc_attr( $widget_id ); ?>">

			<div class="authors56__container">

			<?php foreach ( $result as $user ) {
				/**
				 * link
				 */
				$author_link = get_author_posts_url( $user->ID, $user->user_nicename );

				/**
				 * description
				 */
				if ( 'description' == $description_displays ) {
					$desc = wpautop( do_shortcode( $user->description ) );
				} else {
					$description_post;
					$post_query_args = [
						'author' => $user->ID,
						'posts_per_page' => 1,
						'ignore_sticky_posts' => true,
						'no_found_rows' => true,
						'order' => 'DESC',
					];
					if ( in_array( $description_post, [ 'date', 'rand', 'modified', 'comment_count' ]) ) {
						$post_query_args['orderby'] = $description_post;
					} elseif ( 'featured' == $description_post ) {
						$post_query_args['featured'] = true;
					} elseif ( 'view' == $description_post ) {
						$query_args[ 'orderby' ] = 'post_views';
						
					} elseif ( 'view_week' == $description_post ) {
						$query_args[ 'orderby' ] = 'post_views';
						$query_args[ 'views_query' ] = [
							'year' => date('Y'),
							'week' => date('W'),
						];
					} elseif ( 'view_month' == $description_post ) {
						$query_args[ 'orderby' ] = 'post_views';
						$query_args[ 'views_query' ] = [
							'year' => date('Y'),
							'month' => date('n'),
						];
					} elseif ( 'view_year' == $description_post ) {
						$query_args[ 'orderby' ] = 'post_views';
						$query_args[ 'views_query' ] = [
							'year' => date('Y'),
						];
					}
					$user_post_query = new WP_Query( $post_query_args );
					if ( $user_post_query->have_posts() ) {
						$user_post_query->the_post();
						$desc = '<a href="' . get_permalink() .  '">' . get_the_title() . '</a>';
					} else {
						$desc = wpautop( do_shortcode( $user->description ) );
					}
					wp_reset_query();
				}
				?>
				<div class="author56">
					<a href="<?php echo $author_link; ?>" class="author56__avatar">
						<?php echo get_avatar( $user->ID, 300, '', $user->display_name ); ?>
					</a>
					<div class="author56__text">
						<h3 class="author56__name">
							<a href="<?php echo $author_link; ?>"><?php echo $user->display_name; ?></a>
						</h3>
						<div class="author56__description">
							<?php echo $desc; ?>
						</div><!-- .author56__description -->
					</div><!-- .author56__text -->

					<div class="author56__sep"></div>
				</div><!-- .author56 -->

			<?php } // each user ?>

				<div class="authors56__sep"></div>
				<div class="authors56__sep"></div>
				<div class="authors56__sep"></div>
				<div class="authors56__sep"></div>
				<div class="authors56__sep"></div>

			</div><!-- .authors56__container -->

		</div>

		<?php

	}

}