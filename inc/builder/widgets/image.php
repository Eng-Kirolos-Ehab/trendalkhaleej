<?php
class Fox56_Builder_Image extends Fox56_Builder_Widget_Base {

	public function get_name() {
		return 'image';
	}

    public function get_title() {
		return 'Image';
	}

	public function translation_fields() {
		return [
			'image' => 1,
			'link' => [ 'url' => 1 ],
		];
	}

	function fields() {
		global $fox56_customize;
		$fields = [];
		$fields[ 'image' ] = [
			'type' => 'image',
			'name' => 'Image',
		];
		
		$fields[ 'link' ] = [
			'type' => 'group',
			'name' => 'URL',
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

		$fields = array_merge( $fields, fox56_builder_widget_layout_options( $this->get_name().'_layout_', '{{wrapper}}', false ) );
		
		return $fields;
	}

	function render( $args ) {
		extract( wp_parse_args( $args, [
			'widget_id' => '',
			'image' => 0,
			'link' => [],
		] ) );
		
		// in is_customize_preview, we must show it to make sure It's less confused
		if ( ! $image && ! is_customize_preview() ) {
			return;
		}
		$cl = [ 'section56__image', 'image56', $widget_id ];
		
		/**
		 * LINK
		 */
		extract( wp_parse_args( $link, [ 'url' => '', 'target' => '_self' ] ) );
		$a = ''; $a_close = '';
		if ( $url ) {
			$url = $this->translate_string( [ 'link' => 'url' ], $args );
			$a = '<a href="' . esc_url( $url ). '" target="' . esc_attr( $target ). '">';
			$a_close = '</a>';
		}
		$img_html = '<em class="fox-error">Please upload your image</em>';
		if ( $image ) {
			$image = $this->translate_string( 'image', $args );
			$img_html = wp_get_attachment_image( $image, 'full', false );
		}
		?>
	<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>" data-id="<?php echo esc_attr( $widget_id ); ?>">
		<?php echo $a; ?>
		<?php echo $img_html; ?>
		<?php echo $a_close; ?>
	</div>
		<?php
	}

}