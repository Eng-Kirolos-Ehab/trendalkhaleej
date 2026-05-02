<?php
class Fox56_Builder_Text extends Fox56_Builder_Widget_Base {

	public function get_name() {
		return 'text';
	}
    
	public function get_title() {
		return 'Text/Paragraph';
	}

	public function translation_fields() {
		return [
			'text' => 1,
		];
	}

	function fields() {

		global $fox56_customize;
		$fields = [];
		$fields[ 'text' ] = [
			'type' => 'textarea',
			'rich' => true,
			'name' => 'Enter content',
		];

		$fields = array_merge( $fields, fox56_builder_widget_layout_options( $this->get_name().'_layout_', '{{wrapper}}', false ) );
		
		return $fields;

	}

	function render( $args ) {

		extract( wp_parse_args( $args, [
			'text' => '',
			'widget_id' => '',
		]));

		$html = $this->translate_string( 'text', $args );
		$cl = [ 'section-text', $widget_id ];

		echo '<div class="' . esc_attr( join( ' ', $cl ) ). '" data-id="' . esc_attr( $widget_id ) . '">';
		echo wpautop( $text );
		echo '</div>';

	}

}