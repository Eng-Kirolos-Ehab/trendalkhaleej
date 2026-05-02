<?php
class Fox56_Builder_Ad extends Fox56_Builder_Widget_Base {

	public function get_name() {
		return 'ad';
	}

    public function get_title() {
		return 'Ad/Banner';
	}

	public function get_icon() {
		return 'cover-image';
	}

	public function get_preview_image_url() {
		return get_template_directory_uri() . '/inc/builder/images/ad.jpg?v=' . FOX_VERSION;
	}

	public function translation_fields() {
		return [
			'ad_code' => 1,
			'banner_link' => [ 'url' => 1 ],
			'banner_image' => 1,
			'banner_image_tablet' => 1,
			'banner_image_mobile' => 1,
		];
	}

	function fields() {
		global $fox56_customize;
		$fields = [];
		$fields[ 'ad_code' ] = [
			'type' => 'textarea',
			'name' => 'Ad Code',
			'tab' => 'ad',
		];
		
		$fields[ 'banner_image' ] = [
			'tab' => 'ad',
			'type' => 'image',
			'name' => 'Image banner',
		];
		
		$fields[ 'banner_image_tablet' ] = [
			'type' => 'image',
			'name' => 'Tablet image',
		];
		
		$fields[ 'banner_image_mobile' ] = [
			'type' => 'image',
			'name' => 'Mobile image',
		];
		
		$fields[ 'banner_width' ] = [
			'type' => 'group',
			'name' => 'Banner width',
			'fields' => [
				'desktop' => [
					'name' => 'Width',
					'type' => 'text',
					'placeholder' => 'Eg. 728',
					'col' => '2-5',
				],
				'tablet' => [
					'name' => 'Tablet',
					'type' => 'text',
					'col' => '2-5',
				],
				'mobile' => [
					'name' => 'Mobile',
					'type' => 'text',
					'col' => '1-5',
				],
			],
			'css' => [
				[
					'selector' => '{{wrapper}}.banner56',
					'property' => 'width',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'selector' => '{{wrapper}}.banner56',
					'property' => 'width',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'selector' => '{{wrapper}}.banner56',
					'property' => 'width',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
			]
		];
		
		$fields[ 'banner_link' ] = [
			'type' => 'group',
			'name' => 'Banner URL',
			'fields' => [
				'url' => [
					'name' => 'Link',
					'type' => 'text',
					'placeholder' => 'https://',
					'col' => '2-3',
				],
				'target' => [
					'name' => 'Target',
					'type' => 'select',
					'options' => [
						'_self' => 'Same tab',
						'_blank' => 'New tab',
					],
					'std' => '_blank',
					'col' => '1-3',
				],
			],
			'std' => [
				'url' => '',
				'target' => '_self',
			],
		];
		
		$fields[ 'ad_visibility' ] = [
			'type' => 'multicheckbox',
			'name' => 'Shown on:',
			'options' => [
				'desktop' => 'Desktop',
				'tablet' => 'Tablet',
				'mobile' => 'Mobile',
			],
			'std' => 'desktop,tablet,mobile',
		];
		
		/*
		$fields[ 'ad_area_padding' ] = [
			'type' => 'group',
			'fields' => [
				'desktop' => [
					'name' => 'Padding',
					'type' => 'number',
					'col' => '2-5',
				],
				'tablet' => [
					'name' => 'Tablet',
					'type' => 'number',
					'col' => '2-5',
				],
				'mobile' => [
					'name' => 'Mobile',
					'type' => 'number',
					'col' => '1-5',
				],
			],
			'css' => [
				[
					'selector' => '{{wrapper}} .ad56__container',
					'property' => 'padding',
					'unit' => 'px',
					'value_pattern' => '$ 0',
					'use' => 'desktop',
				],
				[
					'selector' => '{{wrapper}} .ad56__container',
					'property' => 'padding',
					'unit' => 'px',
					'value_pattern' => '$ 0',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'selector' => '{{wrapper}} .ad56__container',
					'property' => 'padding',
					'unit' => 'px',
					'value_pattern' => '$ 0',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
			],
			'std' => [
				'desktop' => 0,
				'tablet' => 0,
				'mobile' => 0,
			],
			'name' => 'Ad area padding',
		];
		$fields[ 'ad_area_background' ] = [
			'type' => 'color',
			'name' => 'Ad area background',
			'css' => [
				[
					'selector' => '{{wrapper}} .ad56__container',
					'property' => 'background-color',
				]
			] 
		];
		*/
		$fields = array_merge( $fields, fox56_builder_widget_layout_options( $this->get_name().'_layout_', '{{wrapper}}', false ) );
		
		return $fields;
	}

	function render( $args ) {
		extract( wp_parse_args( $args, [
			'widget_id' => '',
			'ad_code' => '',
			'banner_image' => 0,
			'banner_image_tablet' => 0,
			'banner_image_mobile' => 0,
			'banner_link' => [],
			'ad_visibility' => 'desktop,tablet,mobile',
		] ) );
		
		// in is_customize_preview, we must show it to make sure It's less confused
		if ( ! $ad_code && ! $banner_image && ! is_customize_preview() ) {
			return;
		}
		$cl = [ 'section56__ad', 'ad56', $widget_id ];
		if ( $ad_code ) {
			$ad_code = $this->translate_string( 'ad_code', $args );
			$cl[] = 'ad56--code';
			?>
			<div class="ad56__container">
				<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
					<?php echo $ad_code ; ?>
				</div>
			</div>
			<?php
			return;
		}
	
		$cl[] = 'ad56--banner';
		$cl[] = 'banner56';
	
		/**
		 * LINK
		 */
		extract( wp_parse_args( $banner_link, [ 'url' => '', 'target' => '_self' ] ) );
		$a = ''; $a_close = '';
		if ( $url ) {
			$url = $this->translate_string( [ 'banner_link' => 'url' ], $args );
			$a = '<a href="' . esc_url( $url ). '" target="' . esc_attr( $target ). '">';
			$a_close = '</a>';
		}
	
		/**
		 * VISIBILITY
		 */
		if ( ! is_array( $ad_visibility ) ) {
			$ad_visibility = explode( ',', $ad_visibility );
		}
		if ( ! is_customize_preview() ) {
			$cl[] = in_array( 'desktop', $ad_visibility ) ? 'show--desktop' : 'hide--desktop';
			$cl[] = in_array( 'tablet', $ad_visibility ) ? 'show--tablet' : 'hide--tablet';
			$cl[] = in_array( 'mobile', $ad_visibility ) ? 'show--mobile' : 'hide--mobile';
		} else {
			$cl[] = in_array( 'desktop', $ad_visibility ) ? 'show--desktop' : 'disable--desktop';
			$cl[] = in_array( 'tablet', $ad_visibility ) ? 'show--tablet' : 'disable--tablet';
			$cl[] = in_array( 'mobile', $ad_visibility ) ? 'show--mobile' : 'disable--mobile';
		}
	
		$imgs = [];
		if ( $banner_image_mobile ) {
			$banner_image_mobile = $this->translate_string( 'banner_image_mobile', $args );
			$imgs[] = wp_get_attachment_image( $banner_image_mobile, 'full', false, [ 'class' => 'banner56--mobile' ]);
		}
		if ( $banner_image_tablet ) {
			$banner_image_tablet = $this->translate_string( 'banner_image_tablet', $args );
			$imgs[] = wp_get_attachment_image( $banner_image_tablet, 'full', false, [ 'class' => 'banner56--tablet' ]);
		}
		if ( $banner_image ) {
			$banner_image = $this->translate_string( 'banner_image', $args );
			$imgs[] = wp_get_attachment_image( $banner_image, 'full', false, [ 'class' => 'banner56--desktop' ]);
		}
		?>
	<div class="ad56__container">
		<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>" data-id="<?php echo esc_attr( $widget_id ); ?>">
			<?php echo $a; ?>
			<?php echo join( "\n", $imgs ); ?>
			<?php echo $a_close; ?>
		</div>
	</div>
		<?php
	}

}