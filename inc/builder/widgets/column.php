<?php
class Fox56_Builder_Column extends Fox56_Builder_Widget_Base {

    public function get_name() {
		return 'column';
	}

	public function get_title() {
		return 'Column';
	}

	public function get_icon() {
		return 'menu-alt';
	}

	function fields() {
		$fields = [];
		$fields[ 'size'] = [
			'type' => 'radio',
			'options' => [
				'1-1' => 'Size 1/1',
				'1-2' => 'Size 1/2',
				'1-3' => 'Size 1/3',
				'2-3' => 'Size 2/3',
				'1-4' => 'Size 1/4',
				'3-4' => 'Size 3/4',
				'1-5' => 'Size 1/5',
				'2-5' => 'Size 2/5',
				'3-5' => 'Size 3/5',
				'4-5' => 'Size 4/5',
				'1-6' => 'Size 1/6',
				'5-6' => 'Size 5/6',
			],
			'std' => '1-1',
			'title' => 'Column Size',
		];

		$fields = array_merge( $fields, fox56_builder_widget_layout_options( $this->get_name().'_layout_', '{{wrapper}}', false ) );
		
		return $fields;
	}

	function render( $args ) {
		$widget_id = isset( $args['widget_id'] ) ? $args['widget_id'] : '';
		$content = isset( $args['content'] ) ? $args['content'] : [];
		$cl = [ 'col', 'widget56', $widget_id ];
		extract( wp_parse_args( $args,[
			'size' => '1-1',
		]));

		$cl[] = 'col-' . $size;

		if ( empty( $content ) ) {
			$cl[] = 'nocontent';
		}

		?>
		<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>" data-id="<?php echo esc_attr( $widget_id ); ?>">
			<?php fox56_builder_render_widget_content( $content ); ?>
		</div><!-- .col -->
		<?php
	}

}