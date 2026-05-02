<?php
class Fox56_Builder_Row extends Fox56_Builder_Widget_Base {

    public function get_name() {
		return 'row';
	}

	public function get_title() {
		return 'Row';
	}

	public function get_icon() {
		return 'columns';
	}

	public function get_preview_image_url() {
		return get_template_directory_uri() . '/inc/builder/images/row.jpg?v=' . FOX_VERSION;
	}

	function fields() {
		global $fox56_customize;
		$fields = [];

		$fields[ 'columns_spacing' ] = [
			'type' => 'group',
			'title' => 'Columns spacing',
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
				'desktop' => 10,
				'tablet' => 10,
				'mobile' => 10,
			],
			'css' => [
				
				[
					'property' => 'margin',
					'selector' => "{{wrapper}} .row",
					'value_pattern' => '0 -$',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'margin',
					'selector' => "{{wrapper}} .row",
					'value_pattern' => '0 -$',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'margin',
					'selector' => "{{wrapper}} .row",
					'value_pattern' => '0 -$',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],


				[
					'property' => 'padding',
					'selector' => "{{wrapper}} .col",
					'value_pattern' => '0 $',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'padding',
					'selector' => "{{wrapper}} .col",
					'value_pattern' => '0 $',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'padding',
					'selector' => "{{wrapper}} .col",
					'value_pattern' => '0 $',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
			]
		];

		$fields[ 'columns_v_spacing' ] = [
			'type' => 'group',
			'title' => 'Columns vertical spacing',
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
				'tablet' => 20,
				'mobile' => 20,
			],
			'css' => [
				
				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}} .row",
					'value_pattern' => '-$',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}} .row",
					'value_pattern' => '-$',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}} .row",
					'value_pattern' => '-$',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],


				[
					'property' => 'padding-top',
					'selector' => "{{wrapper}} .col",
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'padding-top',
					'selector' => "{{wrapper}} .col",
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'padding-top',
					'selector' => "{{wrapper}} .col",
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
			]
		];

		$fields[ 'columns_border' ] = [
			'type' => 'radio',
			'options' => [
				'0px' => 'No border',
				'1px' => 'Has border',
			],
			'std' => '0px',
			'title' => 'Separator between cols',
			'css' => [
				[
					'property' => 'border-left-width',
					'selector' => "{{wrapper}} .col + .col",
				]
			]
		];

		$fields[ 'columns_border_color' ] = [
			'type' => 'color',
			'title' => 'Separator color',
			'css' => [
				[
					'property' => 'border-left-color',
					'selector' => "{{wrapper}} .col + .col",
				]
			]
		];

		$sidebar_list = [ '' => '--- NONE ---' ];
        foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
            $sidebar_list[ $sidebar['id'] ] = $sidebar['name'];
        }
		
		$fields[ 'sidebar' ] = [
			'type' => 'select',
			'std' => '',
			'options' => $sidebar_list,
			'title' => 'Sidebar',
			'refresh' => 'secondary',
		];
		
		$fields[ 'sidebar_position' ] = [
			'type' => 'radio',
			'std' => 'right',
			'options' => [
				'left' => 'Left',
				'right' => 'Right',
			],
			'title' => 'Sidebar position',
		];
		
		$fields[ 'sidebar_sticky' ] = [
			'type' => 'checkbox',
			'std' => false,
			'title' => 'Sidebar sticky?',
			'desc' => 'You will see "Sticky sidebar" takes action when close the Customizer',
		];
		
		$fields[ 'sidebar_width'] = [
			'type' => 'text',
			'std' => '260px',
			'title' => 'Sidebar width',
		
			'css' => [
				[
					'property' => 'width',
					'unit' => 'px',
					'selector' => "{{wrapper}} .secondary56",
					'media_query' => '@media only screen and (min-width: 840px)',
				],
				[
					'property' => 'width',
					'unit' => 'px',
					'selector' => "{{wrapper}}.widget56__row--hassidebar > .primary56",
					'value_pattern' => 'calc(100% - $)',
					'media_query' => '@media only screen and (min-width: 840px)'
				]
			],
		];
		
		$fields[ 'sidebar_main_sep' ] = [
			'type' => 'radio',
			'std' => '0px',
			'options' => [
				'0px' => 'No',
				'1px' => 'Yes',
			],
			'title' => 'Sidebar - Content separator border',
			'css' => [
				[
					'property' => 'border-left-width',
					'selector' => "{{wrapper}} .secondary56__sep",
				]
			],
		];
		
		$fields[ 'sidebar_main_sep_color' ] = [
			'type' => 'color',
			'title' => 'Sep color',
			'css' => [
				[
					'property' => 'border-color',
					'selector' => "{{wrapper}} .secondary56__sep",
				]
			],
		];

		$fields = array_merge( $fields, fox56_builder_widget_layout_options( $this->get_name().'_layout_', '{{wrapper}}', false ) );

		return $fields;
	}

	function render( $args ) {
		$content = isset( $args['content'] ) ? $args['content'] : [];
		$widget_id = isset( $args['widget_id'] ) ? $args['widget_id'] : '';
		$cl = [ 'widget56__row', 'widget56', $widget_id ];
		extract( wp_parse_args( $args,[
			'sidebar' => false,
			'sidebar_position' => 'right',
			'sidebar_sticky' => false,
		]));

		if ( $sidebar ) {
			$cl[] = 'widget56__row--hassidebar';
			$cl[] = 'hassidebar--' . $sidebar_position;

			if (  $sidebar_sticky ) {
				$cl[] = 'hassidebar--sticky';
			}
		}

		if ( empty( $content ) ) {
			$cl[] = 'nocontent';
		}
		?>
		<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>" data-id="<?php echo esc_attr( $widget_id ); ?>">
			<?php if ( $sidebar ) { echo '<div class="primary56">'; } ?>
				<div class="row">
					<?php fox56_builder_render_widget_content( $content ); ?>
				</div><!-- .row -->
			<?php if ( $sidebar ) { echo '</div>'; } ?>
			<?php if ( $sidebar ) { ?>
			<div class="secondary56">

				<?php if ( is_active_sidebar( $sidebar ) ) { dynamic_sidebar( $sidebar ); } else { ?>
				
				<?php if ( current_user_can( 'manage_options' ) ) { ?>
					<p class="fox-error">Your sidebar is currently empty. Please go to your <a href="<?php echo get_admin_url( '','widgets.php' ); ?>" target="_blank">Dashboard &raquo; Appearance &raquo; Widgets</a> to drop your widgets into the sidebar.</p>
				
				<?php } ?>
				
				<?php } ?>
				
				<div class="secondary56__sep"></div>
				
			</div>
			<?php } ?>
		</div><!-- .widget56__row -->
		<?php
	}

}