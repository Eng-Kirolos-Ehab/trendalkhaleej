<?php
class Fox56_Builder_Separator extends Fox56_Builder_Widget_Base {

    public function get_name() {
		return 'separator';
	}

	public function get_title() {
		return 'Separator';
	}

	public function get_icon() {
		return 'image-flip-vertical';
	}

	public function get_preview_image_url() {
		return get_template_directory_uri() . '/inc/builder/images/separator.jpg?v=' . FOX_VERSION;
	}

	function fields() {
		global $fox56_customize;
		$fields = [];

		$fields[ 'style' ] = [
			'type' => 'select',
			'title' => 'Style',
			'options' => [
                'solid' => 'Solid',
                'dashed' => 'Dashed',
                'dotted' => 'Dotted',
                'double' => 'Double',
            ],
            'std' => 'solid',
            'css' => [
			    [
			        'selector' => '{{wrapper}} .separator56__line',
			        'property' => 'border-top-style',
			        'value_pattern' => '$',
			    ],
			],
		];


		$fields[ 'color' ] = [
			'type' => 'color',
			'title' => 'Color',
            'std' => '#c0c1c0',
            'css' => [
			    [
			        'selector' => '{{wrapper}} .separator56__line',
			        'property' => 'border-top-color',
			        'value_pattern' => '$',
			    ],
			],
		];

		$fields[ 'weight' ] = [
			'type' => 'number',
			'title' => 'Weight',
            'std' => '1',
            'step' => 1,
            'min' => 1,
            'max' => 30,
            'css' => [
			    [
			        'selector' => '{{wrapper}} .separator56__line',
			        'property' => 'border-top-width',
			        'unit' => 'px',
			        'value_pattern' => '$',
			    ],
			],
		];

		$fields[ 'width' ] = [
			'type' => 'group',
			'title' => 'Width (%)',
			'fields' => [
				'desktop' => [
					'type' => 'number',
					'col' => '1-3',
					'name' => 'Desktop',
				],
				'tablet' => [
					'type' => 'number',
					'col' => '1-3',
					'name' => 'Tablet',
				],
				'mobile' => [
					'type' => 'number',
					'col' => '1-3',
					'name' => 'Mobile',
				],
			],
			'css' => [
				[
					'use' => 'desktop',
					'property' => 'width',
					'selector' => '{{wrapper}} .separator56__line',
					'unit' => '%',
				],
				[
					'use' => 'tablet',
					'property' => 'width',
					'unit' => '%',
					'selector' => '{{wrapper}} .separator56__line',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'use' => 'mobile',
					'property' => 'width',
					'unit' => '%',
					'selector' => '{{wrapper}} .separator56__line',
					'media_query' => $fox56_customize->mobile,
				],
			],
			// 'std' => [
			// 	'desktop' => 100,
			// 	'tablet' => 100,
			// 	'mobile' => 100,
			// ]
		];

		$fields[ 'alignment' ] = [
			'type' => 'select',
			'title' => 'Alignment',
			'options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
            'std' => 'left',
            'css' => [
			    [
			        'selector' => '{{wrapper}}',
			        'property' => 'justify-content',
			        'value_pattern' => '$',
			    ],
			],
		];

		$fields[ 'gap' ] = [
			'type' => 'group',
			'title' => 'Gap',
			'fields' => [
				'desktop' => [
					'type' => 'number',
					'col' => '1-3',
					'name' => 'Desktop',
				],
				'tablet' => [
					'type' => 'number',
					'col' => '1-3',
					'name' => 'Tablet',
				],
				'mobile' => [
					'type' => 'number',
					'col' => '1-3',
					'name' => 'Mobile',
				],
			],
			'css' => [
				[
					'use' => 'desktop',
					'property' => 'padding-block',
					'selector' => '{{wrapper}}',
					'unit' => 'px',
				],
				[
					'use' => 'tablet',
					'property' => 'padding-block',
					'unit' => 'px',
					'selector' => '{{wrapper}}',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'use' => 'mobile',
					'property' => 'padding-block',
					'unit' => 'px',
					'selector' => '{{wrapper}}',
					'media_query' => $fox56_customize->mobile,
				],
			],
			'std' => [
				'desktop' => 30,
				'tablet' => 20,
				'mobile' => 20,
			]
		];

		$fields = array_merge( $fields, fox56_builder_widget_layout_options( $this->get_name().'_layout_', '{{wrapper}}', false ) );
		
		return $fields;
	}

	function render( $args ) {
		extract( wp_parse_args( $args, [
			'widget_id' => '',
		]));

		$cl = [ 'separator56', $widget_id ];
		?>
		<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>" data-id="<?php echo esc_attr( $widget_id ); ?>">
			<div class="separator56__line"></div>
		</div>
		<?php
	}

}