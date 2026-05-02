/*
    TOC
    
    1. widgets 
    2. edit fields & update field options
    3. correlation with previewer frame
*/

// https://dev.to/grandemayta/javascript-dom-manipulation-to-improve-performance-459a
// https://www.freecodecamp.org/news/dom-manipulation-best-practices/

"use strict";

( function( $, api ) {

    function get_ids( widget_id ) {
        let arr = [ widget_id ]
        let widget_settings = api( widget_id )()
        widget_settings.content.forEach(function( sub_id ) {
            arr = arr.concat( get_ids( sub_id ) )
        })
        return arr
    }

    /**
     * RETURN array of widget_id of builder
     */
    function get_all_ids() {
        return get_ids( 'sectionlist' )
    }

    function update_pencils() {
        api.previewer.send( 'all_ids', get_all_ids() )
    }

    function array_remove( array, value ) {
        let index = array.indexOf( value );
        if (index > -1) { // only splice array when item is found
            array.splice(index, 1); // 2nd parameter means remove one item only
        }
    }

    /* 1. close_widget_editor
    ----------------------------------------------------------------- */
    function close_widget_editor() {

        if ( undefined === window.widget_editor_ele ) {
            window.widget_editor_ele = $( '.widget56__editor' )
        }
        if ( ! window.widget_editor_ele.length ) {
            console.error( 'why cant find .widget56__editor?' )
            return
        }
        if ( undefined === window.widget_editor_ele_bar ) {
            window.widget_editor_ele_bar = $( '.widget56__editor__bar' )
        }
        if ( ! window.widget_editor_ele_bar.length ) {
            console.error( 'why cant find .widget56__editor__bar?' )
            return
        }
        window.widget_editor_ele.removeClass( 'showing' )
        window.widget_editor_ele_bar.removeClass( 'showing' )
        $( 'body' ).removeClass( 'openning-widget56' )

    }

    api.controlConstructor.fox56_builder = api.Control.extend({
        ready: function() {
            const   control = this, 
                    container = this.container,
                    $container = $( container ),
                    $sections = $container.find( '.builder56__sections' ),
                    $widget_ele_sample = $container.find( '.widget56--placeholder' ),
                    widgets_info = FOX_CUSTOMIZE_BUILDER.widgets_info, // { widget_id: {type: post-list, ..} }
                    widget_arr = Object.keys( widgets_info ), // list of widget_id
                    $more_dropdown = $container.find( '.widget56__dropdown' )
            
            let preload_ids = [], // widget56--id--1, widget56--id--2, widget56--id--3..
                preload_prefix = 'widget56--id--'
            for ( let k in api.settings.settings ) {
                if ( k.substr(0, 14) == preload_prefix ) {
                    preload_ids.push( k )
                }
            }

            function delete_widget( widget_id ) {

                let widget = $sections.find( `.widget56[data-id="${widget_id}"]` )
                if ( ! widget.length ) {
                    console.log( `cant find widget having ID: ${widget_id}, to delete` )
                    return
                }
                let widget_settings = api( widget_id )(),
                    widget_type = widget_settings.type,
                    parent = widget.parent().closest( '.widget56' ),
                    parent_id = '',
                    h__css = structuredClone( api( 'h2[css]' )() )

                if ( undefined === widget_type ) {
                    console.log( `widget having ID: ${widget_id} has no type. The settings: ${ JSON.stringify( widget_settings )}` )
                    return
                }

                if ( 'section' == widget_type ) {
                    parent_id = 'sectionlist'
                } else {
                    if ( parent.length ) {
                        parent_id = parent.data( 'id' )
                    }
                }

                let parent_settings = structuredClone( api( parent_id )() )
                array_remove( parent_settings.content, widget_id )
                api( parent_id ).set( parent_settings )

                // remove related ids css
                let related_ids = get_ids( widget_id )
                for ( let k in related_ids ) {
                    delete h__css[ k ]
                }

                // restore its default value
                api( widget_id ).set({
                    widget_id: widget_id,
                    content: []
                })

                // finally remove it from DOM
                widget.remove()
            }

            /**
             * default CSS arr for each field of builder
             */
            window.default_css_arr = {}
            const default_css = function( type ) {
                if ( undefined !== window.default_css_arr[ type ] ) {
                    return window.default_css_arr[ type ]
                }
                let fields = widgets_info[type].fields,
                    std = {}
                for ( let field_id in fields ) {
                    let field = fields[ field_id ]
                    if ( undefined === field.css ) {
                        continue
                    }
                    std[ field_id ] = field.std
                }
                window.default_css_arr[ type ] = std
                return std
            }

            /* ==================================================================================== */
            // FRAMEWORK FUNCTIONS
            /* ==================================================================================== */
            /**
             * RETURN list of widget_id of current widget, and descendants
             */
            api.previewer.bind( 'ready', function() {
                update_pencils()
            })

            /**
             * update the widget56__bar title, desc
             * settings = { type: heading, .. }
             * RETURN void
             */
            const update_widget_from_dict = function( widget_settings = {} ) {
                let $widget = $( '.' + widget_settings.widget_id ),
                    title = ''
                if ( ! $widget.length ) {
                    return
                }
                // section name
                if ( 'section' == widget_settings.type ) {
                    title = widget_settings.section_name
                    if ( ! title ) {
                        title = 'Section'
                    }
                    $widget.find( '>.widget56__bar' ).find( '.widget56__bar__text' ).text( title )
                }
                if ( 'column' == widget_settings.type ) {
                    title = 'Column '
                    title += widget_settings.size ? widget_settings.size.replace( '-', '/' ) : ''
                    $widget.find( '>.widget56__bar' ).find( '.widget56__bar__text' ).text( title )
                }
                if ( 'heading' == widget_settings.type ) {
                    title = widget_settings.heading ? widget_settings.heading : 'Heading'
                    $widget.find( '>.widget56__bar' ).find( '.widget56__bar__text' ).text( title )
                }
            }
            
            /**
             * RETURN dom $widget element
             * NOTE: remove widget56__dropdown if possible
             */
            const widget_ele_from_dict = function( widget_settings ) {
                let widget_type = widget_settings.type
                if ( ! widgets_info[ widget_type ] ) {
                    console.error( 'no valid type: ' + widget_type )
                    return
                }
                // we always equip it widget_id first
                let widget_id = widget_settings.widget_id
                if ( ! widget_id ) {
                    console.error( 'no widget_id' )
                    return
                }

                // CLONE + put appropriate data
                let $widget = $widget_ele_sample.clone()
                $widget.removeClass( 'widget56--placeholder' )
                $widget.attr( 'data-widget', widget_type )
                $widget.attr( 'data-id', widget_id )
                $widget.addClass( widget_id )
                if ( widgets_info[ widget_type ].icon ) {
                    $widget.find( '.widget56__icon' ).html( '<i class="dashicons dashicons-' + widgets_info[ widget_type ].icon + '"></i>' )
                }
                let title = widget_settings.widget_title ? widget_settings.widget_title : widgets_info[ widget_type ].title
                $widget.find( '.widget56__bar__text' ).text( title )
                let info = ''
                if ( 'column' == widget_type ) {
                    if ( widget_settings.size ) {
                        info = widgets_info.column.fields.size.options[ widget_settings.size ]
                    } else {
                        info = widgets_info.column.fields.size.std
                    }
                }
                $widget.find( '.widget56__info' ).text( info )

                // BUTTON
                if ([ 'row', 'column', 'section' ].includes( widget_type ) ) {

                    /* btn
                    ----------------------------- */
                    let btn_text = '', btn = ''
                    if ( 'row' == widget_type ) {
                        btn_text = 'Add column'
                    } else if ( 'section' == widget_type ) {
                        btn_text = 'Add element'
                    } else if ( 'column' == widget_type ) {
                        btn_text = 'Add element'
                    }

                    if ( 'column' == widget_type || 'section' == widget_type ) {
                        btn = '<a href="#" class="widget56__btn widget56__add__tooltip" data-parent_widget_id="' + widget_id + '"><i class="dashicons dashicons-plus-alt2"></i>' + btn_text + '</a>'

                        // btn += '<a href="#" class="widget56__btn widget_import" data-parent_widget_id="' + widget_id + '" title="When you upload *json template file, It will be inserted immediately"><i class="dashicons dashicons-arrow-up-alt"></i> Template</a>'

                        // btn += '<a href="#" class="widget56__btn add_template" data-parent_widget_id="' + widget_id + '" title="Choose predefined templates"><i class="dashicons dashicons-plus-alt2"></i> Template</a>'

                    } else if ( 'row' == widget_type ) {
                        btn = '<a href="#" class="widget56__btn widget56__add" data-cat="column" data-parent_widget_id="' + widget_id + '"><i class="dashicons dashicons-plus-alt2"></i>' + btn_text + '</a>'
                    }
                    
                    btn = '<div class="widget56__btns">' + btn + '</div>'
                    $widget.find( '> .widget56__content' ).append( btn )
                    

                // for those don't have content, we don't need indicator
                } else {
                    $widget.find( ' > .widget56__bar > .indicator' ).addClass( 'invisible' )
                }

                return $widget
            }

            /**
             * RETURN { ele: $widget, settings: widget_settings }
             */
            const create_widget_from_type = function( type ) {
                let widget_info = widgets_info[ type ],
                    fields = widget_info.fields,
                    title = widget_info.title

                if ( ! widget_info.std_obj ) {
                    widget_info.std_obj = {}
                    for( let field_id in fields ) {
                        let field = fields[field_id]
                        if ( undefined === field.std ) {
                            continue
                        }
                        widget_info.std_obj[ field_id ] = field.std
                    }
                }
                let widget_sttings = structuredClone( widget_info.std_obj )
                widget_sttings.widget_id = next_id()
                widget_sttings.type = type
                widget_sttings.content = []
                if ( 'section' == type ) {
                    widget_sttings.section_id = widget_sttings.widget_id
                }
                let $widget = widget_ele_from_dict( widget_sttings )
                return {
                    'settings' : widget_sttings,
                    'ele' : $widget
                }
            }

            const generate_section_name = function( name, list = [] ) {

                // list = [ 'New section (1)', 'New section (3)', 'New section (4)', 'New section (5)', 'New section 10'];
                name = String(name);
                name = name.trim();
                if( !name ) name = 'New Section';
                if( !Array.isArray(list) ) return name;
        
                var pos = name.search(/\s\([\d]+\)$/);
                var sec_number = 1, name_1 = name, name_2;
                if( -1 !== pos){
                    name_1 = name.substring(0, pos);
                    sec_number = name.substring(pos+2, name.length-1);
                    sec_number = parseInt(sec_number) + 1;
                }
                
                // if( Number.isNaN(sec_number) ) sec_number = 1;
        
                name_2 = name_1 + " (" + sec_number + ")";
                var i=0, maxlength = list.length;
                while( i < maxlength ) {
                    
                    if( name_2 != list[i] ) {
                        i++; continue;
                    }
                    // If duplicate
                    i = 0; sec_number++;
                    name_2 = name_1 + " (" + sec_number + ")";
                    
                }
                return name_2;
            }

            /**
             * this will be used for duplicating widget
             * RETURN void
             */
            const map_settings = function( old_id, map ) {
                let settings = api( old_id )(),
                    new_settings = structuredClone( settings )
                new_settings.widget_id = map[ old_id ]
                let new_content = []
                new_settings.content.forEach(function( id ) {
                    new_content.push( map[ id ] )
                    map_settings( id, map )
                })
                new_settings.content = new_content
                if ( 'section' == settings.type ) {
                    new_settings.section_name = settings.section_name + '(1)'
                    update_widget_from_dict( new_settings )
                }
                api( map[ old_id] ).set( new_settings )
            }

            /**
             * the UNUSED widget_id 
             * RETURN str
             */
            const next_id = function() {
                let all_ids = get_ids( 'sectionlist' )
                for ( let preload_id of preload_ids ) {
                    if ( ! all_ids.includes( preload_id ) ) {
                        return preload_id
                    }
                }
            }

            /**
             * number is int
             * RETURN array of widget_id
             */
            const next_ids = function( number = 1 ) {
                let all_ids = get_ids( 'sectionlist' )
                let ids = [],
                    count = 0
                for ( let preload_id of preload_ids ) {
                    if ( ! all_ids.includes( preload_id ) ) {
                        ids.push( preload_id )
                        count += 1
                    }
                    if ( count >= number ) {
                        break
                    }
                }
                return ids
            }

            /**
             * normally parent is $('.sectionlist') or $( '.widget56__content' )
             * parent_id is "sectionlist" or "widget56--id--18"
             */
            function bind_sortable( parent, parent_id ) {
                parent.sortable({
                    items : '> .widget56',
                    placeholder: "sortable-placeholder",
                    handle: " > .widget56__bar",
                    update: function( event, ui ) {

                        let updated_ids = []
                        parent.find( ' > .widget56' ).each(function(){
                            updated_ids.push( $( this ).data('id' ) )
                        })
                        let parent_settings = structuredClone( api( parent_id )() )
                        parent_settings.content = updated_ids
                        api( parent_id ).set( parent_settings )
                        
                    }
                })
            }

            /**
             * OPEN WIDGET
             * RETURN void
             */
            const open_widget = function( $widget ) {
                let indicator = $widget.find( '> .widget56__bar .indicator' )
                $widget.find( '> .widget56__content' ).slideDown( 'fast', 'linear', function() {
                    indicator.removeClass( 'dashicons-arrow-right-alt2' )
                    indicator.addClass( 'dashicons-arrow-down-alt2' )
                })
            }
            // open all inner rows, cols
            const open_widget_deep = function( $widget, widget_settings ) {
                open_widget( $widget )
                if ( 'row' == widget_settings.type || 'section' == widget_settings.type ) {
                    $widget.find( '.widget56[data-widget="row"], .widget56[data-widget="column"]' ).each(function(){
                        open_widget( $( this ) )
                    })
                }
            }
            const is_close = function( widget, indicator ) {
                return indicator.hasClass( 'dashicons-arrow-right-alt2' )
            }
            const is_open = function( widget, indicator ) {
                return indicator.hasClass( 'dashicons-arrow-down-alt2' )
            }
            const close_widget = function( widget, indicator = null ) {
                if ( indicator === null ) {
                    indicator = widget.find( '> .widget56__bar .indicator' )
                }
                widget.find( '> .widget56__content' ).slideUp( 'fast', 'linear', function() {
                    indicator.addClass( 'dashicons-arrow-right-alt2' )
                    indicator.removeClass( 'dashicons-arrow-down-alt2' )
                })
            }
            
            /**
             * Scroll to
             */
            const scroll_to_widget = function( $widget ) {
                let scrollPos = $widget.position().top
                $( '.wp-full-overlay-sidebar-content' ).animate({
                        scrollTop: scrollPos
                }, 400);
            }

            /**
             * INIT widget_id
             * RETURN void
             */
            const init_id = function( widget_id, parent ) {
                let widget_settings = structuredClone( api( widget_id )() )
                if ( ! widget_settings.type ) {
                    console.error( widget_settings )
                    return
                }
                let $widget = widget_ele_from_dict( widget_settings )
                if ( ! $widget ) {
                    console.error( widget_settings )
                    return
                }
                $widget.appendTo( parent )

                update_widget_from_dict( widget_settings )

                // now the children
                let new_parent = $widget.find( '> .widget56__content' )
                widget_settings.content.forEach( function( sub_id ) {
                    init_id( sub_id, new_parent )
                })
            }

            /* ==================================================================================== */
            // EVENTS BIND
            /* ==================================================================================== */
            /**
             * widget_added --- update css
             */
            $( document ).on( 'widget_added', function( e, $widget, widget_settings ) {
                
                let widget_id = widget_settings.widget_id,
                    h__css = structuredClone( api( 'h2[css]' )() ),
                    parent_widget_id = null
                if ( 'section' == widget_settings.type ) {
                    parent_widget_id = 'sectionlist'
                } else {
                    let parent = $widget.parent().closest( '.widget56' )
                    if ( parent.length ) {
                        parent_widget_id = parent.data( 'id' )
                    }
                }

                if ( parent_widget_id ) {
                    let foo = structuredClone( api( parent_widget_id )() )
                    foo.content.push( widget_id )
                    api( parent_widget_id ).set( foo )
                }
                h__css[ widget_id ] = default_css( widget_settings.type )
                api( widget_id ).set( widget_settings )

                // this should be updated later
                control.settings.css.set( h__css )

                // with the pencil
                update_pencils()

            })
            
            /**
             * widget_added ---- sortable
             */
            $( document ).on( 'widget_added', function( e, $widget, widget_settings ) {
                // sortable for $wrapper
                let parent_id = $widget.data( 'id' ),
                    parent = $widget.find( ' > .widget56__content' )
                    bind_sortable( parent, parent_id )
            })

            /**
             * widget_added ---- open deep
             */
            $( document ).on( 'widget_added', function( e, $widget, widget_settings ) {
                if ( ['row','column', 'section'].includes( widget_settings.type ) ) {
                    open_widget_deep( $widget, widget_settings )
                }
            })

            /**
             * scroll to section added ---- open deep
             */
            $( document ).on( 'widget_added', function( e, $widget, widget_settings ) {
                if ( 'section' == widget_settings.type ) {
                    scroll_to_widget( $widget )
                }
            })

            /**
             * sections_init ---- sortable
             */
            $( document ).on( 'sections_init', function() {
                rerun_sortable()
            })

            function rerun_sortable() {

                bind_sortable( $sections, 'sectionlist' )
                
                $( '.widget56' ).each( function() {
                    let parent_id = $( this ).data( 'id' ),
                        parent = $( this ).find( ' > .widget56__content' )
                        bind_sortable( parent, parent_id )
                })
            }

            /* ==================================================================================== */
            // UI ACTIONS (CLICK)
            /* ==================================================================================== */
            /**
             * add widget without tooltip
             */
            $( document ).on( 'click', '.widget56__add', function(e) {
                e.preventDefault()
                let result = create_widget_from_type( $( this ).data( 'cat' ) ),
                    $widget = result.ele,
                    widget_settings = result.settings,
                    parent_widget_id = $( this ).data( 'parent_widget_id' ),
                    $widget_content,
                    $parent_widget
                if ( ! parent_widget_id ) {
                    console.error( 'no parent_widget_id' )
                    return
                }
                $parent_widget = $container.find( '.' + parent_widget_id )

                if ( ! $parent_widget.length ) {
                    return
                }
                if ( 'sectionlist' == parent_widget_id ) {
                    $widget_content = $sections
                } else {
                    $widget_content = $parent_widget.find( '> .widget56__content' )
                }
                $widget.appendTo( $widget_content )
                $( document ).trigger( 'widget_added', [ $widget, widget_settings ] )
            })

            /**
             * import manually
             */
            if ( ! $( '#import56_widget_importer').length ) {
                $( 'body' ).append( '<input type="file" accept="application/json" id="import56_widget_importer" style="display:none" />' )
            }
            $( document ).on( 'click', '.widget_import', function(e) {
                e.preventDefault();
                $('#import56_widget_importer').attr( 'data-parent_widget_id', $( this ).data( 'parent_widget_id' ) ).trigger('click');
            });

            /**
             * delete widget
             */
            $more_dropdown.on( 'click', '.widget56__action[data-action="delete"]', function( e ) {
                e.preventDefault()

                let widget = $( this ).closest( '.widget56' ),
                    widget_id = widget.data( 'id' )

                $more_dropdown.removeClass( 'shown' )
                $more_dropdown.appendTo( $sections ) // remove from specific bar

                delete_widget( widget_id )

            })

            /**
             * Duplicate
             */
            $more_dropdown.on( 'click', '.widget56__action[data-action="duplicate"]', function( e ) {

                e.preventDefault()
                let $widget = $( this ).closest( '.widget56' ),
                    widget_id = $widget.data( 'id' ),
                    widget_settings = api( widget_id )()

                // remove first then clone later
                $more_dropdown.removeClass( 'shown' )
                $more_dropdown.appendTo( $sections ) // remove from specific bar

                let $widget_clone = $widget.clone(),
                    parent_id = '',
                    parent_content,
                    h__css = structuredClone( api( control.id + '[css]' )() )

                if ( 'section' == widget_settings.type ) {
                    parent_id = 'sectionlist'
                    parent_content = $sections
                } else {
                    let parent = $widget.parent().closest( '.widget56' )
                    if ( parent.length ) {
                        parent_id = parent.data( 'id' )
                        parent_content = parent.find( '>.widget56__content' )
                    }
                }

                $widget_clone.insertAfter( $widget )

                // problem 2: clone massive id
                let related_ids = get_ids( widget_id ),
                    clone_ids = next_ids( related_ids.length ),
                    idmap = {}
                
                related_ids.forEach((key, i) => idmap[key] = clone_ids[i]);

                map_settings( widget_id, idmap )
                
                // problem 2: update structure, h__css
                related_ids.forEach(function( original_id ) {
                    let new_id = idmap[ original_id ]
                    // clone css 
                    h__css[ new_id ] = structuredClone( h__css[ original_id ] )

                    // replace all id in HTML
                    let ele = $widget_clone.find( '.' + original_id )
                    ele.removeClass( original_id ).attr( 'data-id', new_id ).addClass( new_id )
                    ele.data( 'id', new_id )
                })

                $widget_clone.removeClass( widget_id ).attr( 'data-id', idmap[ widget_id ] ).addClass( idmap[ widget_id ] )
                $widget_clone.data( 'id', idmap[ widget_id ] )

                $widget_clone.find( '.widget56__btn' ).each(function() {
                    let parent_widget_id = $( this ).data( 'parent_widget_id' )
                    $( this ).attr( 'data-parent_widget_id', idmap[ parent_widget_id ] )
                    $( this ).data( 'parent_widget_id', idmap[ parent_widget_id ] )
                })
                $widget_clone.find( '.tooltipstered' ).removeClass( 'tooltipstered' )

                // update parent
                let parent_settings = structuredClone( api( parent_id )() ),
                    current_index = parent_settings.content.indexOf( widget_id )
                parent_settings.content.splice( current_index + 1, 0, idmap[ widget_id ] )
                api( parent_id ).set( parent_settings )

                control.settings.css.set( h__css )

                /*
                // sortable
                bind_sortable( $widget_clone.find( ' > .widget56__content' ), idmap[ widget_id ] )
                $widget_clone.find( '.widget56' ).each(function(){
                    bind_sortable( $( this ).find( ' > .widget56__content' ), $( this ).data( 'id' ) )
                })
                */

                rerun_sortable()

                update_pencils()
                
            })

            /**
             * DROPDOWN
             */
            $sections.on( 'click', '.widget56__more', function( e ) {
                e.preventDefault()
                // append $more_dropdown to this
                let $bar = $( this ).closest( '.widget56__bar' ),
                    $widget = $bar.closest( '.widget56' ),
                    widget_id = $widget.data( 'id' ),
                    widget_settings = api( widget_id )()
                if ( $bar.find( '.widget56__dropdown' ).length ) {
                    $more_dropdown.addClass( 'shown' )
                    return
                } else {
                    $more_dropdown.appendTo( $bar )
                    $more_dropdown.addClass( 'shown' )
                }
            })
            $( '#sub-accordion-section-h2, #customize-theme-controls' ).on( 'click', function( e ) {
                if ( ! $( e.target ).is( '.widget56__more' ) && ! $( e.target ).is( $more_dropdown ) ) {
                    $more_dropdown.removeClass( 'shown' )
                }
            })

            /**
             * OPEN CHILDREN
             */
            $sections.on( 'click', '.widget56__bar .indicator', function( e ) {
                e.preventDefault()
                let widget = $( this ).closest( '.widget56' ),
                    widget_type = widget.data( 'widget' ),
                    indicator = $( this )

                if ( is_open( widget, indicator ) ) {
                    close_widget( widget, indicator )
                } else {
                    open_widget( widget )
                    if ( 'row' == widget_type || 'section' == widget_type ) {
                        widget.find( '.widget56[data-widget="row"], .widget56[data-widget="column"]' ).each(function(){
                            var self = $( this ) 
                            open_widget( self )
                        })
                    }
                }
            })

            /**
             * ADD ELEMENT
             */
            let widget_arr_filtered = widget_arr.filter(item => item !== 'column' && item !== 'builder' ),
                $board = $container.find( '.elements__popup' ),
                $board_templates_main = $board.find( '.elements__popup__templates' )

            // populate templates
            for ( let template_name in FOX_CUSTOMIZE_BUILDER.templatelist ) {
                let template_data = FOX_CUSTOMIZE_BUILDER.templatelist[ template_name ],
                    json = template_data.json,
                    thumbnail_src = template_data.thumbnail,
                    category = json.refresh.widget_type,
                    cl = json.refresh.type == 'row' ? 'elements__popup__template shown' : 'elements__popup__template' 

                $board_templates_main.append(`
                    <div class="${cl}" data-id="${template_name}" data-cat="${json.refresh.type}">
                        <a href="#" class="insert_template" data-id="${template_name}" data-parent_widget_id="">
                            <img src="${thumbnail_src}" />
                        </a>
                    </div><!-- .elements__popup__template -->
                    `)
            }

            $container.on( 'click', '.widget56__add__tooltip:not(.tooltipstered), .builder56__add-section:not(.tooltipstered)', function( e ) {
                e.preventDefault()
                let a = $( this )

                a.tooltipster({
                    debug: false,
                    animation: 'fade',
                    animationDuration: 0,
                    delay: 0,
                    size: {
                        width: 600,
                        height: 600,
                    },
                    minWidth: 600,
                    theme: 'tooltipster-shadow tooltipster-board',
                    triggerClose: 'custom',
                    trigger: 'click',
                    contentAsHTML: true,
                    side: 'right',
                    interactive: true,
                    content: $board,
                    contentCloning: true,
                    functionReady : function( instance, helper ) {

                        let parent_widget_id = a.data( 'parent_widget_id' ),
                            is_section

                        if ( a.hasClass( 'builder56__add-section' ) ) {
                            is_section = true
                        } else {
                            is_section = false
                        }

                        let $content = instance.content()
                        if ( is_section ) {
                            $content.addClass( 'popup--section' )
                        } else {
                            $content.addClass( 'popup--nonsection' )
                        }

                        // set parent_widget_id correctly
                        $content.find( '.widget56__add, .widget_import, .insert_template' ).each(function() {
                            $( this ).attr( 'data-parent_widget_id', parent_widget_id )
                        })

                        // close when click insert or insert template
                        $content.on( 'click', '.widget56__add, .widget_import, .insert_template', function( e ) {
                            instance.content().off( 'click' )
                            instance.content().off( 'mouseenter' )
                            instance.close();
                        })

                        // hover board__item
                        $content.on( 'click', '.elements__popup__cats span', function( e ) {
                            e.preventDefault()
                            
                            $content.find( '.elements__popup__cats span.active' ).removeClass( 'active' )
                            $( this ).addClass( 'active' )
                            var widget_cat = $( this ).data( 'cat' )

                            // filter the items
                            $content.find( '.elements__popup__template' ).removeClass( 'shown' )
                            $content.find( '.elements__popup__template[data-cat="' + widget_cat + '"]' ).addClass( 'shown' )

                        })
                        
                    }
                })
                .tooltipster('open')
            })

            $( document ).on( 'click', '.insert_template', function( e ) {
                e.preventDefault()
                let a = $( this ),
                    template_id = a.data( 'id' ),
                    parent_widget_id = a.data( 'parent_widget_id' )
                
                if ( undefined === FOX_CUSTOMIZE_BUILDER.templatelist[ template_id ] ) {
                    console.error( 'cant get info: ' + template_id )
                    return
                }

                let widget_data = structuredClone( FOX_CUSTOMIZE_BUILDER.templatelist[ template_id ].json )
                
                generate_widget_import( widget_data, parent_widget_id )

                // if ( 'sectionlist' == parent_widget_id ) {
                    $( '.widget56' ).each( function() {
                        let parent_id = $( this ).data( 'id' ),
                            parent = $( this ).find( ' > .widget56__content' )
                            bind_sortable( parent, parent_id )
                    })
                // }

            })

            /**
             * INIT SECTIONS
             */
            let sectionlist = api( 'sectionlist' )()
            sectionlist.content.forEach(function( section_id ){
                init_id( section_id, $sections )
            })

            $( document ).trigger( 'sections_init' )
            
            /* ------------------------------------------------------------------------------------------ */
            /* ------------------------------------------------------------------------------------------ */
            /* ------------------------------------------------------------------------------------------ */
            // PART 2
            /* ------------------------------------------------------------------------------------------ */
            /* ------------------------------------------------------------------------------------------ */
            /* ------------------------------------------------------------------------------------------ */

            /* initialize the editor
            ================================================================================ */
            if ( ! $( '.widget56__editor' ).length ) {
                console.error( 'widget editor is missing' )
                return
            }
            const   widget_editor = $( '.widget56__editor' ),
                    widget_editor_bar = $( '.widget56__editor__bar' )

            widget_editor.appendTo( $( '.wp-full-overlay-sidebar-content' ) )
            widget_editor_bar.appendTo( $( '.wp-full-overlay-sidebar-content' ) )

            // close editor
            widget_editor_bar.on( 'click', '.widget56__editor__bar__close', function( e ) {
                e.preventDefault()
                close_widget_editor()
            })

            // delete
            widget_editor_bar.on( 'click', '.widget56__editor__bar__del', function( e ) {

                e.preventDefault()

                let widget_id = widget_editor_bar.data( 'id' )
                if ( ! widget_id ) {
                    return
                }

                delete_widget( widget_id )

                // close the bar
                close_widget_editor()

            })

            /* OPEN EDITOR
             * method 1: click .widget56__bar__text
             * method 2: click edit from frontend
            ================================================================================ */
            const open_widget_editor = function( widget_id ) {
                
                let widget_settings = api( widget_id )(),
                    widget_type = widget_settings.type,
                    h__css = api( control.id + '[css]' )(),
                    widget_css = h__css[ widget_id ] ? h__css[ widget_id ] : {},
                    widget_full_settings = {...widget_settings, ...widget_css }
                
                if ( ! widgets_info[ widget_type ] ) {
                    console.error( widget_settings ); return;
                }

                /**
                 * show it first, do stuffs later
                 */
                widget_editor.html( '' )
                widget_editor.addClass( 'showing' )
                widget_editor_bar.addClass( 'showing' )
                widget_editor_bar.data( 'id', widget_id )
                $( 'body' ).addClass( 'openning-widget56' )

                if ( undefined === window.cached_editor[ widget_type ] ) {
                    setup_sample_editor( widget_type )
                }

                // we clone here because we will set up sortable, color.. and we don't wanna ruin the original html
                let $form = window.cached_editor[ widget_type ].clone()
                fill_settings( $form, widget_full_settings )

                /**
                 * how show the editor
                 */
                widget_editor.data( 'widget_id', widget_id )
                $( '.widget56__editor' ).html('') // clean the editor
                $( '.widget56__editor__bar__title' ).text( widgets_info[ widget_type ].title )
                //Show Export button ==> except column, row. 
                $( '.widget56__editor__export' ).hide();
                if( !['column', 'row'].includes( widget_type ) ) {
                    $( '.widget56__editor__export' ).show();
                }
                widget_editor.append( $form )
                widget_show_hide_fields_by_device()
                widget_show_hide_fields_by_condition()

                widget_editor.find('textarea[data-rich="true"]').each( function(){
                    let self = $( this )
                    self.summernote({
                        placeholder: self.val(),
                        // airMode: true,
                        // focus: true,
                        tabsize: 2,
                        height: 120,
                        toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['view', [ 'codeview', 'help']]
                        ],
                        callbacks: {
                            onChange: function(contents, $editable) {
                                self.val(contents);
                                self.trigger('change')
                            },

                        }

                    });
                })

            }

            $sections.on( 'click', '.widget56__bar__edit', function( e ) {
                e.preventDefault();
                var widget = $( this ).closest( '.widget56' ),
                    widget_id = widget.data( 'id' )
                open_widget_editor( widget_id )
            })

            //Show/hide fields of widget when clicking preview mode: preview-desktop, preview-tablet, preview-mobile
            $('.devices-wrapper').on( 'click', '.preview-desktop, .preview-tablet, .preview-mobile', function( e ) {
                widget_show_hide_fields_by_device();
            });
            let widget_show_hide_fields_by_device = function() {
                if( !widget_editor.hasClass('showing') ) { return false; }

                let current_preview_device = $('.devices-wrapper button.active').data('device');
                //Hide all widgets have "data-preview_device" attr
                widget_editor.find('.widget56__field[data-preview_device]').hide()
                //Show widgets have data-preview_device="current-device"
                widget_editor.find('.widget56__field[data-preview_device="' + current_preview_device + '"]').fadeIn()
            }
            let widget_show_hide_fields_by_condition = function() {
                let $fields = widget_editor.find('.widget56__field[data-required]');
                $fields.each( function(index) {
                    let required = $(this).data('required'), is_show = false;
                    for( const id in required ) {
                        let sourse_el = widget_editor.find('.widget56__field[data-field-id="'+id+'"]')
                            , val_el;
                        if( sourse_el.length != 1 ) { continue }
                        val_el = get_val(sourse_el);
                        if( 'string' == typeof required[id] ) {
                            if( val_el == required[id] ) { is_show = true; }
                        }else if( 'object' == typeof required[id] ) {
                            for( const sub_id in required[id] ) {
                                if( 'string' == typeof required[id][sub_id] && val_el == required[id][sub_id] ){
                                    is_show = true;
                                    break;
                                }
                            }
                        }
                        if( true == is_show ) { break;}
                    }
                    (true == is_show) ? $(this).fadeIn() : $(this).fadeOut();
                });
            }
            /**
             * Trigger click on Preview Button
             */
            widget_editor.on( 'click', '[data-trigger]', function() {
                if( !$(this).data('trigger') ) { return true; }
                $('#customize-footer-actions').find('.'+$(this).data('trigger')).trigger('click');
            });
            /**
             * Reset values into group
             */
            widget_editor.on( 'click', '[data-reset]', function(e) {
                e.stopPropagation();
                if( !$(this).data('reset') ) { return true; }
                let parent;
                if( 'all' == $(this).data('reset')) parent = $(this).closest('.widget56__section');
                else  parent = $(this).closest('.widget56__field');
                parent.find('input').val('').trigger('change');
            });

            /* POPULATE widget fields
             * widget is jQuery ele
            ================================================================================ */
            window.cached_editor = {}
            const setup_sample_editor = function( type ) {

                let fields = widgets_info[ type ].fields,
                    tabs = {},
                    tab,
                    tab_name,
                    section,
                    section_name,
                    $form = $( '<div class="form56" data-type="' + type + '"></div>' )

                /**
                 * set up each field
                 */
                for ( let field_id in fields ) {

                    let field = fields[ field_id ],
                        field_title = field.name ? field.name : field.title,
                        field_type = field.type,
                        field_desc = field.desc,
                        field_placeholder = field.placeholder ? field.placeholder : '',
                        field_options = field.options,
                        field_html = [],
                        field_tab = field.tab,
                        field_section = field.section,
                        field_preview_device = field.preview_device ? field.preview_device : ''

                    if ( undefined !== field_tab ) {
                        tab = field_tab
                        tab_name = field.tab_name ? field.tab_name : tab
                    }
                    if ( undefined !== field_section ) {
                        section = field_section
                        section_name = field.section_name ? field.section_name : section
                    }
                    if ( undefined === tab ) {
                        tab = 'general'
                        tab_name = 'General'
                    }
                    if ( undefined === section ) {
                        section = 'general'
                        section_name = 'General'
                    }
                    if ( undefined == tabs[ tab ] ) {
                        tabs[ tab ] = {
                            'name' : tab_name,
                            'sections' : {},
                        }
                    }
                    if ( undefined == tabs[ tab ].sections[ section ] ) {
                        tabs[ tab ].sections[ section ] = {
                            'name' : section_name,
                            'fields' : []
                        }
                    }

                    if ( 'checkbox' != field_type && 'html' != field_type && 'heading' != field_type ) {
                        field_html.push( '<h3>' + field_title + '</h3>' )
                    }
                    if ( field_desc ) {
                        field_html.push( '<small>' + field_desc + '</small>' )
                    }

                    switch( field_type ) {
                        case 'heading' :
                            field_html.push( '<h2>' + field.heading + '</h2>' )
                        break;

                        case 'text' :
                            field_html.push( '<input type="text" class="widget56__field__input" name="' + field_id + '" placeholder="' + field_placeholder + '" value="" />' )
                        break;

                        case 'number' :
                            field_html.push( '<input type="number" class="widget56__field__input" name="' + field_id + '" value="" />' )
                        break;

                        case 'textarea' :
                            field_html.push( '<textarea class="widget56__field__input" data-rich="' + field.rich + '" name="' + field_id + '" placeholder="' + field_placeholder + '"></textarea>' )
                        break;

                        case 'checkbox' :
                            field_html.push( '<label>' )
                            field_html.push( '<input class="widget56__field__input" type="checkbox" value="true" data-field-id="' + field_id + '" />' + field_title )
                            field_html.push( '</label>' )
                        break;

                        case 'image' :
                            field_html.push( '<div class="uploader56">' )
                            field_html.push( '<div class="uploader56__image">' )
                            field_html.push( '<a class="uploader56__image__remove" title="Remove Image">&times;</a>' )
                            field_html.push( '</div>' )
                            field_html.push( '<input type="hidden" class="uploader56__result widget56__field__input" data-field-id="' + field_id + '" value="" />' )
                            field_html.push( '<input type="hidden" class="uploader56__src" data-field-id="' + field_id + '__src" value="" />' )
                            field_html.push( '<input type="button" class="uploader56__button button button-primary" value="Upload Image" />' )
                            field_html.push( '</div><!-- .uploader56 -->' )
                        break;

                        case 'multicheckbox' :

                            for ( let k in field.options ) {

                                field_html.push( '<label>' )
                                field_html.push( '<input class="widget56__field__input" type="checkbox" value="' + k + '" data-field-id="' + field_id + '" />' + field.options[k] )
                                field_html.push( '</label>' )
                    
                            }

                        break;

                        case 'sortable' :
                            field_html.push( '<div class="sortable56">' )
                            field_html.push( '<div class="sortable56__table"><span class="sortable56__label">In use</span></div>' )
                            field_html.push( '<div class="sortable56__elements">' )
                            field_html.push( '<span class="sortable56__label">Not in use</span>' )
                            for ( let k in field.options  ) {
                                let v = field.options[k],
                                    name,
                                    display
                                if ( v.name ) {
                                    name = v.name
                                    display = v.display
                                } else {
                                    name = v
                                    display = 'block'
                                }
                                field_html.push( '<div class="sortable56__element sortable56__element--' + display + '" data-element="' + k + '">' + name + ' <span class="x">&times;</span></div>' )
                            }
                            field_html.push( '</div>' ) // sortable56__elements
                            field_html.push( '</div>' ) // sortable56

                            field_html.push( '<input type="hidden" class="widget56__field__input" value="" data-field-id="' + field_id +'" />' )
                        break;

                        case 'radio' :
                            for ( let option_key in field_options ) {
                                let option_value = field_options[ option_key ]
                                field_html.push( '<label><input type="radio" class="widget56__field__input" name="' + field_id + '" value="' + option_key + '" />' + option_value + '</label>' )
                            }
                        break;

                        case 'radio_image' :
                            for ( var option_key in field_options ) {
                                var option_value = field_options[ option_key ]
                                field_html.push( '<label><input type="radio" class="widget56__field__input" name="' + field_id + '" value="' + option_key + '" />' + '<img src="' + option_value + '" /></label>' )
                            }
                        break;

                        case 'select' :
                            let select = []
                            for ( let option_key in field_options ) {
                                let option_value = field_options[ option_key ]
                                select.push( '<option value="' + option_key + '">' + option_value + '</option>' )
                            }
                            select = select.join( "\n" )
                            let multiple = field.multiple ? ' multiple' : ''
                            select = '<select class="widget56__field__input" name="' + field_id + '"' + multiple + '>' + select + '</select>'
                            field_html.push( select )
                        break;

                        case 'color' :
                            let colorpicker = []
                            colorpicker.push( '<div class="colorpicker56">' )
                            colorpicker.push( '<input type="hidden" class="widget56__field__input" value="" name="' + field_id + '" />' )
                            colorpicker.push( '<span class="colorpicker56__button"></span>' )
                            colorpicker.push( '</div>' )
                            colorpicker = colorpicker.join( "\n" )
                            field_html.push( colorpicker )
                        break;

                        case 'group' :
                            var subfields = field.fields,
                                group_html = []
                            for ( let subfield_id in subfields ) {
                                let subfield = subfields[ subfield_id ],
                                    subfield_col = subfield.col ? subfield.col : '1-1',
                                    subfield_placeholder = subfield.placeholder ? subfield.placeholder : ''
                                group_html.push( '<div class="col col-' + subfield_col + ' col-' + subfield.type + '" data-subfield-id="' + subfield_id + '">' )
                                group_html.push( '<small>' + subfield.name + '</small>' )

                                switch( subfield.type ) {
                                    case 'text' :
                                        group_html.push( '<input type="text" class="widget56__field__input" placeholder="' + subfield_placeholder + '" value="" data-group-id="' + subfield_id + '" />' )
                                    break
                                    case 'number' :
                                        let attrs = '';
                                        attrs += (subfield.min != undefined) ? 'min="' + subfield.min + '"' : ''
                                        attrs += (subfield.max != undefined) ? 'max="' + subfield.max + '"' : ''
                                        attrs += (subfield.step != undefined) ? 'step="' + subfield.step + '"' : ''
                                        group_html.push( '<input type="number" class="widget56__field__input" value="" ' + attrs + ' data-group-id="' + subfield_id + '" />' )
                                    break
                                    case 'color' :
                                        group_html.push( '<div class="colorpicker56">' )
                                        group_html.push( '<input type="hidden" class="widget56__field__input" value="" data-group-id="' + subfield_id + '" />' )
                                        group_html.push( '<span class="colorpicker56__button"></span>' )
                                        group_html.push( '</div>' )
                                    break
                                    case 'select' :
                                        group_html.push( '<select class="widget56__field__input" data-group-id="' + subfield_id + '">' )
                                        for( let k in subfield.options ) {
                                            group_html.push( '<option value="' + k + '">' + subfield.options[k] + '</option>' )
                                        }
                                        group_html.push( '</select>' )
                                    break
                                }

                                group_html.push( '</div><!-- .col -->' )
                            }
                            group_html = group_html.join( "\n" )
                            group_html = '<div class="row">' + group_html + '</div>'
                            field_html.push( group_html )
                        break;

                    }

                    field_html = field_html.join( "\n" )
                    let cl = [ 'widget56__field', 'widget56__field--' + field_type ]
                    cl = cl.join( ' ' )
                    let change = field.css ? 'css' : 'refresh'
                    , data_preview_device = (field_preview_device) ? ' data-preview_device="' + field_preview_device + '"' : ''
                    field_html = '<div class="' + cl + '" data-field="' + field_type + '" data-field-id="' + field_id + '" data-change="' + change + '"' + data_preview_device + '>' + field_html + '</div>'

                    tabs[ tab ].sections[ section ].fields.push( field_html )

                }

                // now after collecting tabs + sections, we append
                let tabnav = [],
                    tab_content = [],
                    tab_active,
                    active_cl = ''
                for ( let tab in tabs ) {
                    if ( undefined === tab_active ) {
                        tab_active = true
                    } else {
                        tab_active = false
                    }
                    if ( tab_active ) {
                        active_cl = ' active'
                    } else {
                        active_cl = ''
                    }
                    tabnav.push( '<span data-tab="' + tab + '" class="' + active_cl + '">' + tabs[tab].name + '</span>' )
                    let tab_sections = [],
                        section_active = null,
                        section_active_cl = ''
                    for ( let section in tabs[ tab].sections ) {
                        if ( null === section_active ) {
                            section_active = true
                        } else {
                            section_active = false
                        }
                        if ( section_active ) {
                            section_active_cl = ' active'
                        } else {
                            section_active_cl = ''
                        }
                        let section_fields = tabs[ tab].sections[ section ].fields,
                            section_content = section_fields.join( "\n" ),
                            section_name = tabs[ tab].sections[ section ].name
                        
                        let section_html = []
                        section_html.push( '<h2 class="widget56__section__heading"><i class="dashicons dashicons-arrow-right"></i><i class="dashicons dashicons-arrow-down"></i>' + section_name + '</h2>' )
                        section_html.push( '<div class="widget56__section__content">' + section_content + '</div>' )
                        section_html = section_html.join( "\n" )
                        section_html = '<div class="widget56__section' + section_active_cl + '">' + section_html + '</div>'

                        tab_sections.push( section_html )
                        
                    }
                    tab_sections = tab_sections.join( "\n" )
                    tab_sections = '<div class="tab-content' + active_cl + '" data-tab="' + tab + '">' + tab_sections + '</div>'
                    tab_content.push( tab_sections )
                }
                tab_content = tab_content.join( "\n" )
                tabnav = tabnav.join( "\n" )
                tabnav = '<div class="tabnav">' + tabnav + '</div>'

                $form.append( tabnav + tab_content )
                window.cached_editor[ type ] = $form
            }
            const fill_settings = function( $form, settings ) {
                let widget_type = settings.type,
                    fields = widgets_info[ widget_type ].fields
                for( let field_id in fields ) {
                    let field = fields[ field_id ],
                        condition = field.condition,
                        std = field.std,
                        field_type = field.type,
                        final_value,
                        data_required = '';

                    if ( undefined === std ) {
                        if ( [ 'text', 'textarea', 'number', 'select', 'radio', 'radio_image', 'color', 'image' ].includes( field_type ) ) {
                            std = ''
                        } else if ( 'checkbox' == field_type ) {
                            std = false
                        } else if ( 'group' == field_type ) {
                            std = {}
                        } else {
                            std = ''
                        }
                    }

                    if ( undefined === settings[ field_id ] ) {
                        final_value = std
                    } else {
                        final_value = settings[ field_id ]
                    }
                    if ( undefined === final_value ) {
                        console.error( field_id )
                    }
                    if( 'object' === typeof condition ) {
                        data_required = JSON.stringify(condition);
                    }

                    let $field = $form.find( '.widget56__field[data-field-id="' + field_id + '"]' )
                    if ( ! $field.length ) {
                        continue
                    }

                    switch ( field_type ) {
                        case 'text' :
                        case 'textarea' :
                        case 'color' :
                        case 'number' :
                            $field.find( '.widget56__field__input' ).val( final_value )
                        break;

                        case 'checkbox' :
                            $field.find( '.widget56__field__input' ).prop( 'checked', Boolean( final_value ) )
                        break;

                        case 'radio' :
                        case 'radio_image' :
                            $field.find( '.widget56__field__input' ).prop( 'checked', false )
                            let right_input = $field.find( '.widget56__field__input[value="' + final_value + '"]' )
                            if ( right_input.length ) {
                                right_input.prop( 'checked', true )
                            }
                        break;

                        case 'select' :
                            let multiple = field.multiple
                            if ( ! multiple ) {
                                $field.find( '.widget56__field__input' ).val( final_value )
                            } else {
                                if ( typeof final_value === 'object' ) {
                                    final_value = Object.values( final_value )
                                } else if ( typeof final_value === 'string' ) {
                                    final_value = final_value.split(',')
                                }
                                if ( typeof final_value !== 'object' ) {
                                    console.error( 'expect array value' )
                                    return;
                                }
                                $field.find( 'option' ).each(function() {
                                    if ( final_value.includes( $(this).val() ) ) {
                                        $( this ).prop( 'selected', true )
                                    } else {
                                        $( this ).prop( 'selected', false )
                                    }
                                })
                            }
                        break

                        case 'multicheckbox' :
                            if ( typeof final_value === 'object' ) {
                                final_value = Object.values( final_value )
                            } else if ( typeof final_value === 'string' ) {
                                final_value = final_value.split(',')
                            }
                            if ( typeof final_value !== 'object' ) {
                                console.error( 'expect array value' )
                                return
                            }
                            $field.find( '.widget56__field__input' ).each(function(){
                                if ( final_value.includes( $(this).val() ) ) {
                                    $( this ).prop( 'checked', true )
                                } else {
                                    $( this ).prop( 'checked', false )
                                }
                            })
                        break

                        case 'sortable' :
                            $field.find( '.widget56__field__input' ).val( final_value )
                        break

                        case 'group' :
                            $field.find( '.widget56__field__input' ).each(function() {
                                let sub_key = $( this ).data( 'group-id' ),
                                    sub_value = final_value[ sub_key ]
    
                                if ( 'face' != sub_key ) {
                                    if ( undefined === sub_value ) {
                                        sub_value = ''
                                    }
                                    $( this ).val( sub_value )
                                } else {
                                    if ( ! sub_value ) {
                                        sub_value = ''
                                    }
                                    font_ui( $( this ), sub_value )
                                }
                            })
                        break

                        case 'image' :
                            $field.find( '.widget56__field__input' ).val( final_value )
                            let src_value = settings[ field_id + '__src' ]
                            if ( src_value ) {
                                $field.find( '.uploader56__src' ).val( src_value )
                            }
                        break
                    }

                    if( data_required ) $field.attr("data-required", data_required);
                }

                $( document ).trigger( 'widget_editor_init', [ $form ] )
                widget_editor_show_hide( $form, fields )
            }

            function widget_editor_show_hide( $form, fields ) {
                $form.find('.widget56__field__input').each( function( index ) {
                    widget_editor_show_hide_condition( $form, fields, {'name' : $(this).attr('name'), 'value' : $(this).val()} );
                })

                $form.find('.widget56__field__input').off('change').on( 'change', function(e) {
                    widget_editor_show_hide_condition( $form, fields, {'name' : e.target.name, 'value' : e.target.value} );
                } )
            }
            
            function widget_editor_show_hide_condition( $form, fields, el ) {
                $.each(fields, function(k, f) {
                    if( undefined == f['condition'] || undefined == f['condition'][el.name] ) { return; }

                    if( f['condition'][el.name] == el.value ){
                        $form.find('[data-field-id='+k+']').removeClass( 'hide--condition' )
                    }else {
                        $form.find('[data-field-id='+k+']').addClass( 'hide--condition' )
                    }
                });
            }
            
            /* toggle sections
            ================================================================================ */
            var inthemiddle = false
            widget_editor.on(  'click', '.widget56__section__heading', function( e ) {
                e.preventDefault()
                if ( inthemiddle ) {
                    return
                }
                inthemiddle = true
                var section = $( this ).closest( '.widget56__section' ),
                    tab = section.closest( '.tab-content' )
                if ( section.hasClass( 'active' ) ) {
                    section.find('.widget56__section__content').slideUp( 'fast', 'swing', function() {
                        section.removeClass( 'active' )
                        inthemiddle = false
                    })
                } else {
                    var active_section = tab.find( '.widget56__section.active' )
                    active_section.find('.widget56__section__content').slideUp('fast','swing', function(){
                        active_section.removeClass( 'active' )
                        inthemiddle = false
                    })
                    section.find('.widget56__section__content').slideDown( 'fast', 'swing', function() {
                        section.addClass( 'active' )
                        inthemiddle = false
                    })
                }
            })

            /* UI
            ================================================================================ */
            $( document ).on( 'widget_editor_init', function( e, $form ) {

                $form.find( '.widget56__field--color, .col-color' ).each(function(){
                    fox_colorpicker( $( this ) )
                });
                $form.find( '.widget56__field--sortable' ).each( function() {
                    fox_sortable( $( this ) )
                })
                $form.find( '.widget56__field--image' ).each(function(){
                    fox_image_upload( $( this ) )
                })

            })

            /* INPUT CHANGE
            ================================================================================ */
            const get_val = function( field ) {
                let field_type = field.data( 'field' ),
                    input = field.find( '.widget56__field__input' ),
                    val = null,
                    collect = []

                switch( field_type ) {
                    case 'text' :
                    case 'textarea' :
                    case 'number' :
                    case 'color' :
                    case 'image' :
                    case 'hidden' :
                        val = input.val()
                    break

                    case 'select' :
                        if ( field.find( 'select').attr( 'multiple' ) ) {
                            collect = []
                            input.find( 'option' ).each(function() {
                                if ( $( this ).prop( 'selected') ) {
                                    collect.push( $( this ).val() )
                                }
                            })
                            val = collect
                        } else {
                            val = input.val()
                        }
                    break

                    case 'radio' :
                    case 'radio_image' :
                        let checked = field.find( '.widget56__field__input:checked' )
                        if ( checked.length ) {
                            val = checked.val()
                        }
                    break

                    case 'checkbox' :
                        val = input.prop( 'checked' )
                    break

                    case 'multicheckbox' :
                        collect = []
                        input.each(function() {
                            if ( $( this ).prop( 'checked') ) {
                                collect.push( $( this ).val() )
                            }
                        })
                        val = collect
                    break

                    case 'group' :
                        collect = {}
                        field.find( '.col' ).each(function() {
                            let subfield_input = $( this ).find( '.widget56__field__input' ),
                                sub_key = $( this ).data( 'subfield-id' ),
                                sub_value = subfield_input.val()
                            collect[ sub_key ] = sub_value    
                        })
                        val = collect
                    break

                    case 'sortable' :
                        val = input.val()
                        if ( ! val ) {
                            val = []
                        } else {
                            val = val.split(',')
                        }
                    break

                }

                return val

            }

            const get_val_src = function( field ) {
                let input = field.find( '.uploader56__src' ),
                    val = input.val()
                return val
            }

            widget_editor.on( 'change', '.widget56__field__input', function() {
                let input = $( this ),
                    $field = input.closest( '.widget56__field' ),
                    change = $field.data( 'change' ),
                    field_id = $field.data( 'field-id' ),
                    new_val = get_val( $field ),
                    widget_id = widget_editor.data( 'widget_id' )
                
                if ( ! widget_id ) {
                    return
                }

                /**
                 * check css or refresh
                 */
                if ( 'css' == change ) {
                    let h__css = structuredClone( api( control.id + '[css]' )() )
                    if ( undefined === h__css[ widget_id ] ) {
                        // this won't happen because we initialize h__css[widget_id] when widget_id being added already
                        console.error( 'why?' )
                        return
                    }
                    h__css[ widget_id ][ field_id ] = new_val
                    control.settings.css.set( h__css )
                } else {
                    let settings = structuredClone( api( widget_id )() )
                    settings[ field_id ] = new_val
                    if ( 'image' == $field.data( 'field' ) ) {
                        settings[ field_id + '__src' ] = get_val_src( $field )
                    }
                    api( widget_id ).set( settings )

                    update_widget_from_dict( settings )
                }
                /**
                 * Show/hide by condition
                 */
                widget_show_hide_fields_by_condition();
            })

            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */

            // relationship with the preview screen

            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */
            /* click scroll to in previewer
             * there must be a correlation between those two
             * we find order in correlation with the section
            --------------------------------- */
            $sections.on( 'click', '.widget56__bar__text', function( e ) {
                e.preventDefault()
                
                $( '.widget56__bar' ).removeClass( 'active' )
                $( this ).closest( '.widget56__bar' ).addClass( 'active' )
                // now scroll to
                var widget = $( this ).closest( '.widget56' ),
                    widget_id = widget.data( 'id' )

                api.previewer.send( 'fox_builder_scroll', {
                    widget_id: widget_id,
                })
            })

            // edit button from frontend
            api.previewer.bind( 'mouseenter', function( widget_id ) {
                let widget = $sections.find( '.widget56.' + widget_id )
                if ( ! widget.length ) {
                    return
                }
                $( '.widget56__bar' ).removeClass( 'active' )
                let ancestor_widgets = widget.find( '>.widget56__bar' ).parents( '.widget56' )
                ancestor_widgets.each(function(){
                    $( this ).find( '> .widget56__bar' ).addClass( 'active' )
                })
            })

            // edit button from frontend
            api.previewer.bind( 'edit_widget', function( widget_id ) {
                api.section( 'h2' ).focus()
                open_widget_editor( widget_id )
            })
            
            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */
            /* -------------------------------------------------------------------------------------------------- */

            // export / import
            /**
             * @todo64: make this import work for deeper layers: it exports all children of current widget
             */
            function get_widget_storage_obj( widget_id ) {
                var h__css = api( control.id + '[css]' )()
                    , widget_css = h__css[ widget_id ]
                    , storageObj = {
                        'refresh' : structuredClone( api( widget_id )() ),
                        'css': widget_css,
                    };
                
                storageObj.refresh.children = [];
                for( let i=0; i<storageObj.refresh.content.length; i++ ){
                    storageObj.refresh.children[i] = get_widget_storage_obj( storageObj.refresh.content[i] );
                }
                return storageObj;
            }

            $sections.on( 'click', '.widget56__action[data-action="export"]', function( e ) {
                e.preventDefault()
                let widget = $( this ).closest( '.widget56' ),
                    widget_id = widget.data( 'id' )
                if ( ! widget_id ) {
                    return
                }

                if ( ! $('#downloadAnchorElem').length ) {
                    $( 'body' ).append( '<a id="downloadAnchorElem" style="display:none"></a>' )
                }

                // call the recursive function to retrieve all data.
                let storageObj = get_widget_storage_obj( widget_id );

                let name = (storageObj.refresh.section_name) ? storageObj.refresh.section_name : Date.now(); 
                name = storageObj.refresh.type + '--' + name;

                var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(storageObj));
                var dlAnchorElem = document.getElementById('downloadAnchorElem');
                dlAnchorElem.setAttribute("href",     dataStr     );
                dlAnchorElem.setAttribute( "download", name + ".json" );
                dlAnchorElem.click();
            })

            function generate_widget_import( widget_data, parent_widget_id ) {
                var widget_settings = widget_data['refresh'],
                    css = widget_data['css'], 
                    parent_widget_content;

                // Check if importing is in the wrong place.
                if( ( widget_settings.type != 'section' && 'sectionlist' == parent_widget_id ) 
                    || ( widget_settings.type == 'section' && 'sectionlist' != parent_widget_id ) 
                ){
                    return false;
                }

                if( 'sectionlist' == parent_widget_id ) {
                    parent_widget_content = $sections;
                } else {
                    if( ! $container.find( '.' + parent_widget_id ).length ) { return; }
                    parent_widget_content = $container.find( '.' + parent_widget_id ).find( '> .widget56__content' );
                }
                widget_settings.widget_id = next_id();
                var $widget = widget_ele_from_dict( widget_settings );
                $widget.appendTo( parent_widget_content )
                update_widget_from_dict( widget_settings );

                let widget_id = widget_settings.widget_id
                    , h__css = structuredClone( api( 'h2[css]' )() )
                    , widget_children = structuredClone( widget_settings.children );
                // remove content before import
                widget_settings.content = [];

                if ( parent_widget_id ) {
                    var foo = structuredClone( api( parent_widget_id )() )
                    foo.content.push( widget_id )
                    api( parent_widget_id ).set( foo )
                }
                
                h__css[ widget_id ] = css;
                api( widget_id ).set( widget_settings );
                // this should be updated later
                control.settings.css.set( h__css );

                for( let i=0; i<widget_children.length; i++ ){
                    generate_widget_import(widget_children[i], widget_id )
                }
                return true;
            }

            function is_valid_widget_import_data( widget_data ) {
                
                if( widget_data.length != 2 || undefined == widget_data.refresh || undefined == widget_data.css ) {
                    return false;
                }
                if( !widget_data.refresh.type ) { return false; }
                //Disallow some type
                if( ['column', 'row'].includes( widget_data.refresh.type ) ) { return false; }
                return true;
            }

            $( document ).on( 'change', '#import56_widget_importer', function(e) {

                let input_file_ele = $( this )

                let file = e.target.files[0]; // Get the first selected file
                if (file && file.type === "application/json") {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        try {
                            let widget_data = JSON.parse(e.target.result), 
                                parent_widget_id

                            if( is_valid_widget_import_data(widget_data) ) {
                                throw new Error('JSON file is invalid.');
                            }

                            parent_widget_id = $( '#import56_widget_importer' ).attr( 'data-parent_widget_id' );
                            if( !generate_widget_import( widget_data, parent_widget_id) ) {
                                alert( "Import wrong. JSON file is invalid!" );
                            }
                            update_pencils();
                            input_file_ele.val('') // reset it
                            
                        } catch (error) {
                            alert('Import ' + error);
                        }
                    };
                    reader.readAsText(file);
                } else {
                    alert('Please select a valid JSON file.');
                }
            });

            /* import json
            --------------------------------- */
            function onReaderLoad(event) {
                console.log(event.target.result);
                var json_values = JSON.parse(event.target.result);
                
                var new_section_id = next_id()
                if ( ! new_section_id ) {
                    return;
                }
                run_new_section( new_section_id, {
                    values: json_values
                })
                update_sectionlist();
            }

            $( '#builder56__import__file' ).on( 'change', function(e) {
                var reader = new FileReader();
                reader.onload = onReaderLoad;
                reader.readAsText(e.target.files[0]);
            })

		}
	});

    /**
     * documents about api
     * https://wordpress.stackexchange.com/questions/280561/customizer-instantiating-settings-and-controls-via-javascript
     * https://gist.github.com/westonruter/0e98d8e507ddb18c0371935f2c6929c1
     * 
     * lots of examples here: https://gist.github.com/westonruter
     */
    api.bind( 'ready', function() {

        /**
         * this is reload action when we add new section
         */
        api.bind( 'saved', function() {
            if ( window.shouldReload ) {
                location.reload()
            }
        });

        /**
         * section_css_id => CSS array
         */
        window.css = {}
        window.css_builder_structure = {}
        window.update_css = function() {
            
            /**
             * we have 2 sources for CSS: builder.fields and css from a normal element
             */
            _.each( api.settings.controls, function( option ) {
                
                if ( 'fox56_builder' == option.type ) {

                } else if ( option.css ) {
                    /**
                     * we need to send value as well
                     */
                    window.css[ option.settings.default ] = option.css
                } else {
                    return;
                }
            });

            api.previewer.bind( 'ready', function() {
                api.previewer.send( 'window_css', window.css )
            });

        }

        // onload
        update_css()

    });
    
})( jQuery, wp.customize );