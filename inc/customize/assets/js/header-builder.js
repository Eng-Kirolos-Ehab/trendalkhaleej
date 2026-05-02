/**
 * @since 1.0
 * https://jscolor.com/docs/#doc-install-add-data-jscolor
 */
( function( $, api ) {

    /* HEADER BUILDER
    ================================================================================ */
    api.bind( 'ready', function() {

        var init_headerbuilder = function() {
            var parts_refresh = function( container ) {
                container.find( '.hb56__part' ).each(function() {
                    var part = $( this ),
                        currentElements = []
                    if ( undefined === part.data( 'elements' ) ) {
                        part.data( 'elements', [] )
                    }
                        
                    part.find( '.hb56__element' ).each(function(){
                        currentElements.push( $( this ).data('element') )
                    })

                    // trigger changes when it's being changed
                    if ( currentElements !== part.data('elements') ) {
                        part.data( 'elements', currentElements )
                        data_part = part.data( 'part' )
                        api( data_part + '_elements' ).set( currentElements ) // this trigger changes
                    }

                })
            }

            /* ------------------------     layout adjustments */
            var sections = [ 'topbar', 'main_header', 'header_bottom', 'header_mobile' ]
            for ( var section of sections ) {
                if ( 'header_mobile' == section ) {
                    container = $( '.hb56--mobile' )
                } else {
                    container = $( '.hb56--desktop' )
                }

                /**
                 * on init
                 */
                var newval = api( section + '_layout' )()

                /* ----------------------       set the col correctly */
                var cols = newval.split('-'),
                    cols_num = cols.length
                if ( 1 == cols_num ) {
                    cols = [ '01' ].concat( cols ).concat( ['01'] )
                } else if ( 2 == cols_num ) {
                    cols.splice(1,0, '01' )
                }
                $( '.hb56__' + section ).find( '.col' ).each(function(index) {
                    var col = cols[index],
                        col_cl = col.split('')
                    $( this ).removeClass( 'col-1-2 col-1-3 col-1-4 col-1-5 col-1-6 col-2-3 col-2-5 col-3-4 col-3-5 col-4-5 col-5-6 col-1-1 col-0-1' )
                    $( this ).addClass( 'col-' + col_cl[0] + '-' + col_cl[1] )

                    /* ----------------------       move elements when layout become zero */
                    if ( '0' == col_cl[0] ) {
                        $( this ).find( '.hb56__element' ).appendTo( container.find('.hb56__elements') )
                    }
                });

                /**
                 * when changed
                 */
                api( section + '_layout', function( value ) {
                    value.bind( function(newval) {

                        var section = value.id.replace( '_layout', '' ),
                            container = $( '.hb56__' + section ).closest( '.hb56' )

                        /* ----------------------       set the col correctly */
                        var cols = newval.split('-'),
                            cols_num = cols.length
                        if ( 1 == cols_num ) {
                            cols = [ '01' ].concat( cols ).concat( ['01'] )
                        } else if ( 2 == cols_num ) {
                            cols.splice(1,0, '01' )
                        }
                        $( '.hb56__' + section ).find( '.col' ).each(function(index) {
                            var col = cols[index],
                                col_cl = col.split('')
                            $( this ).removeClass( 'col-1-2 col-1-3 col-1-4 col-1-5 col-1-6 col-2-3 col-2-5 col-3-4 col-3-5 col-4-5 col-5-6 col-1-1 col-0-1' )
                            $( this ).addClass( 'col-' + col_cl[0] + '-' + col_cl[1] )

                            /* ----------------------       move elements when layout become zero */
                            if ( '0' == col_cl[0] ) {
                                $( this ).find( '.hb56__element' ).appendTo( container.find('.hb56__elements') )
                            }
                        })
                        
                    })
                })
            }

            /* ------------------------     edit section */
            $( '.hb56' ).on( 'click', '.hb56__name', function( e ) {
                e.preventDefault()
                var part = $( this ).data( 'part' )
                api.section( part ).focus()
            });

            /* ------------------------     edit element */
            $( '.hb56__element i' ).on( 'click', function( e ) {
                if( $(this).hasClass( 'rm' ) ) { return true; }
                e.preventDefault()
                var ele = $( this ).parent(),
                    ele_name = ele.data( 'element' )
                var name_to_section_map = {
                    'hamburger' : 'header_hamburger',
                    'nav' : 'header_nav',
                    'logo' : 'title_tagline',
                    'social' : 'header_social',
                    'search' : 'header_search',
                    'cart' : 'header_cart',
                    'html1' : 'header_html',
                    'html2' : 'header_html',
                    'html3' : 'header_html',
                    'button1' : 'header_button1',
                    'button2' : 'header_button2',
                    'darkmode' : 'design_darkmode',
                }
                var section_name = name_to_section_map[ ele_name ]
                api.section( section_name ).focus()
            });
            
            /* ------------------------     REMOVE element */
            $( '.hb56__wrapper' ).on( 'click', '.rm', function( e ) {
                let $this = $(this)
                    , el = $this.closest('.hb56__element')
                    , elements_list = $this.closest( '.hb56' ).find( $('.hb56__elements') );
                elements_list.append( el );
                parts_refresh( $this.closest( '.hb56' ) );
            });

            /* ------------------------     init header parts */
            $( '.hb56__part' ).each(function() {
                var part = $( this ),
                    part_id = part.data( 'part' ),
                    elements_setting = api( part_id + '_elements' )
                    container = part.closest( '.hb56' )
                if ( ! elements_setting ) {
                    return;
                }
                elements = elements_setting()
                if ( typeof elements == 'string' ) {
                    elements = [ elements ]
                }
                if ( ! typeof elements == 'object' ) {
                    return
                }
                for ( var element of elements ) {
                    container.find( '.hb56__element[data-element="' + element + '"]' ).appendTo( part )
                }
            });

            var screens = [ 'desktop', 'mobile' ],
                funcs = {
                    desktop: function() { parts_refresh( $( '.hb56--desktop' ) ) },
                    mobile: function() { parts_refresh( $( '.hb56--mobile' ) ) },
                }
            for ( var screen of screens ) {

                var container = $( '.hb56--' + screen ),
                    container_selector = '.hb56--' + screen

                /* ------------------------     sortable */
                container.find( '.hb56__part, .hb56__elements' ).sortable({
                    items : '.hb56__element',
                    placeholder: "sortable-placeholder",
                    connectWith: container.find( '.hb56__part, .hb56__elements' ),
                    update: funcs[ screen ],
                });

            } // each screen
        } // init_headerbuilder() function

        /* ------------------------     activate header builder when panel section opened */
        window.header_builder_init = false
        api.panel( 'header' ).expanded.bind( function( isExpanding ) {
            if(isExpanding) {
                $( '.hb56' ).addClass( 'active' )
                if ( ! window.header_builder_init ) {
                    init_headerbuilder()
                    window.header_builder_init = true
                }
            } else {
                $( '.hb56' ).removeClass( 'active' )
            }
        });

        api.section( 'header_offcanvas' ).expanded.bind( function( isExpanding ) {
            if(isExpanding) {
                $( '.hb56' ).removeClass( 'active' )
            }
        });

        /* ----------init header parts functions */
        let set_customize_sidebar_content = function( setting_data = [] ) {
            let $el;
            // Set value for settings on header
            for ( let setting_item in setting_data ) {
                if( undefined === api( setting_item ) ) {
                    continue;
                }
                $el = $('#customize-control-'+setting_item);
                // Init before set data
                if ( $el.length > 0 && ! $el.data( 'fox_init' ) ) {
                    $el.data( 'fox_init', true )
                    $el.trigger( 'fox_init' )
                }
                //Set setting
                api( setting_item ).set( setting_data[setting_item] );
                
                // Update UI
                if( $el.hasClass('customize-control-fox56_color') ) {
                    fox_colorpicker( $el )
                } else if( $el.hasClass('customize-control-group') ) {
                    $el.find( '.group56__item' ).each(function() {
                        if( $( this ).hasClass('group56__item--color') ) {
                            fox_colorpicker( $( this ) )
                        }else if( $( this ).hasClass('group56__item--image') ) {
                            fox_image_upload( $( this ) )
                        }
                    })
                }
            }
        }

        let init_header_parts = function() {
    
            $( '.hb56__part' ).each(function() {
                var part = $( this )
                    , part_id = part.data( 'part' )
                    , elements_setting = api( part_id + '_elements' )
                    , elements_list = part.closest( '.hb56' ).find( $('.hb56__elements') );

                if ( ! elements_setting ) {
                    return;
                }
                let elements = elements_setting();
                if ( typeof elements == 'string' ) {
                    elements = [ elements ];
                }
                if ( ! typeof elements == 'object' ) {
                    return;
                }
                // Remove all elements-- (waiting a moment) before append NEW elements into Header
                elements_list.append( part.find( '.hb56__element' ) );
                setTimeout(() => {
                    for ( var element of elements ) {
                        elements_list.find( '.hb56__element[data-element="' + element + '"]' ).appendTo( part );
                    }    
                }, 300);
            });
        }
        
        //===========================================
        //========= PRESET HEADER FEATURE
        api( 'header_presets_layout', function( setting ) {
            setting.bind( function( header_name ) {
                if( !header_name ) { return false; }
                // Get Data of Header Preset
                let header_presets = [];
                if( typeof FOX_CUSTOMIZE.custom_data.header_presets_layout !== 'undefined' ) {
                    header_presets = FOX_CUSTOMIZE.custom_data.header_presets_layout;
                }
                // Get data of header preset by header_name
                header_data = header_presets[header_name];
                if( undefined === header_data ) {
                    return false;
                }

                set_customize_sidebar_content(header_data);
                init_header_parts();
                // Reset value of header_presets_layout
                setTimeout(() => { setting.set('') }, 900);
            });
        });

        // import Header
        $( '#header56_export_btn' ).on( 'click', function() {
            if ( ! $('#downloadAnchorElem').length ) {
                $( 'body' ).append( '<a id="downloadAnchorElem" style="display:none"></a>' )
            }
            // Prepare data with group_data contains "header" value
            let list_fields_header = [
                //topbar
                'topbar_layout', 'topbar_left_elements', 'topbar_center_elements', 'topbar_right_elements',
                'topbar_stretch', 'topbar_height', 'topbar_background', 'topbar_text_skin', 'topbar_text_color', 'topbar_border', 'topbar_container_border', 'topbar_border_color', 
                //main_header
                'main_header_layout', 'main_header_left_elements', 'main_header_center_elements', 'main_header_right_elements',
                'main_header_stretch', 'main_header_padding', 'main_header_background--skip', 
                'main_header_text_skin', 'main_header_text_color', 'main_header_border_bottom', 'main_header_container_border_bottom', 'main_header_border_color', 
                //header_bottom
                'header_bottom_layout', 'header_bottom_left_elements', 'header_bottom_center_elements', 'header_bottom_right_elements',
                'header_bottom_stretch', 'header_bottom_height', 'header_bottom_background', 'header_bottom_text_skin', 'header_bottom_text_color', 'header_bottom_border', 'header_bottom_container_border', 'header_bottom_border_color',
                //header_mobile==
                'header_mobile_layout', 'header_mobile_left_elements', 'header_mobile_center_elements', 'header_mobile_right_elements',
                'mobile_header_sticky', 'header_mobile_height', 'header_mobile_background', 'header_mobile_color', 'header_mobile_border', 'header_mobile_border_color', 'header_mobile_shadow',
                //Sticky header
                'header_sticky', 'header_sticky_parts', 'header_sticky_background', 'header_sticky_border', 'header_sticky_shadow',
                //header hero post
                'single_hero_header', 'min_logo', 'min_logo_type', 'logo_minimal_height',
                //logo
                'logo_type', 'logo_width', 'mobile_logo_height', 'logo_box',
                'tagline_enable', 'tagline_margin_top', 'tagline_color'
            ]
            , length = list_fields_header.length
            , storageObj = {};

            for(let i=0; i<length; i++) {
                if( undefined == api( list_fields_header[i] ) ) { continue; }
                storageObj[list_fields_header[i]] = api( list_fields_header[i] ).get();
            }

            var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(storageObj));
            var dlAnchorElem = document.getElementById('downloadAnchorElem');
            dlAnchorElem.setAttribute("href",     dataStr     );
            dlAnchorElem.setAttribute( "download", "header-data-" + Date.now() + ".json" );
            dlAnchorElem.click();

        });

        // Import Header
        $( '#header56_import_btn' ).on( 'click', function(e) {
            e.preventDefault();
            $('#header56_importer').trigger('click');
        });

        $( document ).on( 'change', '#header56_importer', function(e) {
            let file = e.target.files[0]; // Get the first selected file
            if (file && file.type === "application/json") {
                let reader = new FileReader();
                reader.onload = function(e) {
                    try {
                        let header_data = JSON.parse(e.target.result);
                        // Check all setting_items before set
                        for ( let setting_item in header_data ) {
                            if( undefined === api( setting_item ) ) {
                                throw new Error('JSON file is invalid. Please Reload page!');
                            }
                        }
                        set_customize_sidebar_content(header_data);
                        init_header_parts();

                    } catch (error) {
                        alert('Import Header ' + error);
                    }
                };
                reader.readAsText(file);
            } else {
                alert('Please select a valid JSON file.');
            }
        });
	});

    /**
     * OFFCANVAS ACTIVE PANEL
     * HEADER MOBILE
     * SIDEDOCK
     * ====================================================================================
     */
    api.bind( 'ready', function() {

        api.previewer.bind( 'ready', function() {
            
            /* off canvas
            ------------------------------------------------------ */
            api.section( 'header_offcanvas' ).expanded.bind(function (isExpanded) {
                if( isExpanded ) {
                    api.previewer.send( 'show_offcanvas' );
                } else {
                    api.previewer.send( 'hide_offcanvas' );
                }
            });
            
            /* mobile header
            ------------------------------------------------------ */
            api.section( 'header_mobile' ).expanded.bind(function (isExpanded) {
                if( isExpanded ) {
                    wp.customize.previewedDevice.set( 'mobile' );
                } else {
                    wp.customize.previewedDevice.set( 'desktop' );
                }
            });

            /* side dock
            ------------------------------------------------------ */
            api.section( 'single_sidedock' ).expanded.bind(function (isExpanded) {
                if( isExpanded ) {
                    api.previewer.send( 'show_single_sidedock' );
                } else {
                    api.previewer.send( 'hide_single_sidedock' );
                }
            });
            
        });
    });
    
})( jQuery, wp.customize );