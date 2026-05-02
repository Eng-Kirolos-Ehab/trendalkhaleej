<?php
class Fox56_Builder_Subscribe_Form extends Fox56_Builder_Widget_Base {

    public function get_name() {
		return 'subscribe-form';
	}

	public function get_title() {
		return 'Subscribe Form';
	}

	public function get_icon() {
		return 'email';
	}

	public function get_preview_image_url() {
		return ''; // get_template_directory_uri() . '/inc/builder/images/post-list.jpg?v=' . FOX_VERSION;
	}

	function fields() {
		global $fox56_customize;
		$fields = [];

		$fields[ 'form_shortcode' ] = [
			'type' => 'textarea',
			'title' => 'Subscribe form shortcode',
			'desc' => 'Each newsletter plugin always has a shortcode. Please copy the shortcode of the form and paste it here',
			
			'section' => 'general',
			'section_name' => 'General',
		];

		$fields[ 'form_layout' ] = [
			'type' => 'radio',
			'std' => 'inline',
			'options' => [
				'inline' => 'Inline - same row',
				'stack' => 'Stack - many rows',
			],
			'name' => 'Form layout',
		];

		$selector = '{{wrapper}} input[type="text"], {{wrapper}} input[type="email"], {{wrapper}} input[type="number"], {{wrapper}} input[type="url"], {{wrapper}} select';

		$selector_focus = '{{wrapper}} input[type="text"]:focus, {{wrapper}} input[type="email"]:focus, {{wrapper}} input[type="number"]:focus, {{wrapper}} input[type="url"]:focus, {{wrapper}} select:focus';

		$selector_height = '{{wrapper}} input[type="text"], {{wrapper}} input[type="email"], {{wrapper}} input[type="number"], {{wrapper}} input[type="url"], {{wrapper}} select, {{wrapper}} button, {{wrapper}} input[type="submit"]';

		$fields[ 'form_input_height' ] = [
			'type' => 'number',
			'name' => 'Input height',
			'css' => [
				[
					'selector' => $selector_height,
					'property' => 'height',
					'unit' => 'px',
				],
				[
					'selector' => $selector_height,
					'property' => 'line-height',
					'unit' => 'px',
				],
			]
		];

		$fields[ 'form_input_text_color' ] = [
			'type' => 'color',
			'name' => 'Input text color',
			'css' => [
				[
					'selector' => $selector,
					'property' => 'color',
				],
			]
		];

		$fields[ 'form_input_background_color' ] = [
			'type' => 'color',
			'name' => 'Input background color',
			'css' => [
				[
					'selector' => $selector,
					'property' => 'background',
				],
			]
		];

		$fields[ 'form_input_border_color' ] = [
			'type' => 'color',
			'name' => 'Input border color',
			'css' => [
				[
					'selector' => $selector,
					'property' => 'border-color',
				],
			]
		];

		$fields[ 'form_input_focus_text_color' ] = [
			'type' => 'color',
			'name' => 'Input focus text color',
			'css' => [
				[
					'selector' => $selector_focus,
					'property' => 'color',
				],
			]
		];

		$fields[ 'form_input_focus_background_color' ] = [
			'type' => 'color',
			'name' => 'Input focus background color',
			'css' => [
				[
					'selector' => $selector_focus,
					'property' => 'background',
				],
			]
		];

		$fields[ 'form_input_focus_border_color' ] = [
			'type' => 'color',
			'name' => 'Input focus border color',
			'css' => [
				[
					'selector' => $selector_focus,
					'property' => 'border-color',
				],
			]
		];

		$fields[ 'form_input_border_width' ] = [
			'type' => 'number',
			'name' => 'Input border width',
			'css' => [
				[
					'selector' => $selector,
					'property' => 'border-width',
					'unit' => 'px',
				],
			]
		];
		
		$fields[ 'form_input_border_radius' ] = [
			'type' => 'number',
			'name' => 'Input border radius',
			'css' => [
				[
					'selector' => $selector_height,
					'property' => 'border-radius',
					'unit' => 'px',
				],
			]
		];

		$fields = array_merge( $fields, fox56_builder_widget_layout_options( $this->get_name().'_layout_', '{{wrapper}}', false ) );
		
		return $fields;

	}

	function render( $args ) {
		
		extract( wp_parse_args( $args, [
			'widget_id' => '',
			'form_shortcode' => '',
			'form_layout' => 'inline',
		] ) );

		/* layout
		----------------------- */
		if ( 'stack' != $form_layout ) {
			$form_layout = 'inline';
		}

		$cl = [ $widget_id, 'newsletter56', 'newsletter56--' . $form_layout ];
		?>
		<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>" data-id="<?php echo esc_attr( $widget_id ); ?>">
			<div class="newsletter56__inner">
				<?php echo do_shortcode( $form_shortcode ); ?>
			</div>
		</div>
		<?php
	}

}