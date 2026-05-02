<?php
class Fox56_Builder_Widget_Base {

    const PACKAGE_WPML = [ 'kind' => 'Fox Theme', 'name' => 'builder', 'title' => 'Fox Builder' ];

    public function get_name() {
		return 'slug';
	}

	public function get_title() {
		return 'title';
	}

	public function get_icon() {
		return 'icon';
	}

    public function get_preview_image_url() {
        return '';
    }

    public function translation_fields() {
        return [];
    }

    public function translate_string( $field_name, $args, $default_value = '' ) {
        $value = $this->field_value_from_array( $args, $field_name, $default_value );
        if( $this->is_translation_field( $field_name ) && isset( $args['widget_id'] ) ) {
            // wpml
            $value = apply_filters( 'wpml_translate_string', $value, $this->translation_field_id( $args['widget_id'], $field_name ), $this::PACKAGE_WPML );
            // polylang
            if ( function_exists( 'pll__' ) ) { $value = pll__( $value ); }
        }
        return $value;
    }

    public function translation_field_id( $prefix, $field_name ) {
        
        if( is_array( $field_name ) ) {
            $name = [];
            foreach( $field_name as $key => $sub_key ) {
                if( $sub_key == '0' || intval($sub_key) == $sub_key ) {
                    $sub_key = '';
                } elseif( is_array( $sub_key ) ) {
                    foreach( $sub_key as $key2 => $sub_key2 ) {
                        $sub_key = $key2;
                    }
                }
                $name[] = $sub_key ? $key . '_' . $sub_key : $key;
            }
            $name = implode( '_', $name );
            return $prefix . '__' . $name;
        }
        return $prefix . '__' . strval( $field_name );
    }

    public function is_translation_field( $field_name ) {
        $trans_fields = $this->translation_fields();
        if( is_string( $field_name ) && isset( $trans_fields[$field_name] ) && $trans_fields[$field_name] ) {
            return true;
        }
        if( is_array( $field_name ) ) {
            foreach( $field_name as $key => $sub_key ) {
                if( !isset( $trans_fields[$key] ) || !$trans_fields[$key] ) { return false; }
                if( is_array( $sub_key ) ) {
                    foreach( $sub_key as $key2 => $subkey2 ) {
                        $sub_key = $key2;
                    }
                }
                $sub_key = strval( $sub_key );
                if( $trans_fields[$key] == 1 || isset( $trans_fields[$key][$sub_key] ) ) { return true; }
            }
        }
        return false;
    }

    public function field_value_from_array( $array, $field_name, $default_value = '' ) {

        if( is_string( $field_name ) && isset( $array[$field_name] ) ) {
            return $array[$field_name];
        }

        if( is_array( $field_name ) ) {
            foreach ( $field_name as $key => $sub_key ) {
                if ( isset( $array[$key] ) ) {
                    
                    if( is_array( $sub_key ) ) {
                        foreach( $sub_key as $key2 => $subkey2 ) {
                            $sub_key = $key2;
                        }
                    }
                    $sub_key = strval( $sub_key );
                    
                    if (is_array( $array[$key] ) && isset( $array[$key][$sub_key] ) ) {
                        return $array[$key][$sub_key];
                    } elseif (!is_array($array[$key])) {
                        return $array[$key];
                    }
                }
            }
        }

        // Return $default_value if the key doesn't exist
        return $default_value;
    }

	protected function register_controls() {
	}

    private function get_settings_for_display() {
    }

    /**
     * RETURN $args filled with std
     */
    function process( $args ) {
        $args[ 'in_builder' ] = true; 
        $fields = $this->fields();
        $std_arr = [];
        foreach ( $fields as $field_id => $field ) {
            if ( ! isset( $field[ 'std' ] ) ) {
                continue;
            }
            if ( ! isset( $args[ $field_id ] ) ) {
                $args[ $field_id ] = $field[ 'std' ];
            } elseif ( is_array( $field[ 'std' ] ) && is_array( $args[ $field_id ] ) && ! array_is_list( $args[ $field_id ] ) ) {
                $args[ $field_id ] = wp_parse_args( $args[ $field_id ], $field[ 'std' ] );
            }
        }

        /*
        $args['container_class'] = isset( $args['widget_id'] ) ? $args['widget_id'] : ''; */
        if ( ! isset( $args['attrs'] ) || ! is_array( $args['attrs'] ) ) {
            $args[ 'attrs' ] = [];
        }
        $args['attrs'][ 'data-id' ] = isset( $args['widget_id'] ) ? $args['widget_id'] : '';
        
        return $args;
    }

	public function render( $args ) {
        return;
	}

    public function final_render( $args ) {
        $args = $this->process( $args );
        $this->render( $args );
    }

}