<?php
/**
* Class Name: santos_nav_walker
* Description: A custom Wordpress nav walker to implement custom navigation
* Version: 1.0
* Author: UXCODE
*/
class santos_nav_walker extends Walker_Nav_Menu{

		
 
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		
		$post_id = santos_get_post_id();
		$santos_options = get_option('santos_options');
		$dropdown_scheme = isset($santos_options['menu_dropdown_scheme']) ? $santos_options['menu_dropdown_scheme'] : 'darckBg';
		
		$dropdown_scheme  = rwmb_meta('santos_menu_dropdown_scheme',$args = array(),$post_id) ? rwmb_meta('santos_menu_dropdown_scheme',$args = array(),$post_id) : $dropdown_scheme;  
		
		
		$menu_class = '';
		
			
			
			
			 if($depth === 0) 
            {
			$menu_class = $dropdown_scheme;
			}
			
            if($depth === 0 && $this->active_megamenu) 
            {
                $menu_class .= ' megamenu-content';
            }
			
		$output .= "\n$indent<ul class='dropdown-menu $menu_class'>\n";
	}

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 )
      {
           global $wp_query;
		   
		   $description = '';

           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $a_class = $value = '';
		   
		   
	
		
			
				 
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
		


		if($depth==0){

			$this->active_megamenu = $item->megamenu;

			if($this->active_megamenu){

				$classes[] = 'megamenu-fw';			

				if($item->megamenu_cols != ""){

					$classes[] = $item->megamenu_cols;

				}else{

					$classes[] = 'columns_3';

				}

			}

		}
		   
	   	$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		  
			
		if ( $args->has_children && $depth === 0 ) {
			$class_names .= ' dropdown';
			}else if( $args->has_children && $depth !== 0 ) {
			$class_names .= ' dropdown';
			}

		 
          $class_names = ' class="'. esc_attr( $class_names ) . '"';
			
           $output .= $indent . '<li id="main-menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  	. esc_attr( $item->attr_title 		) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' 	. esc_attr( $item->target     		) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    	. esc_attr( $item->xfn        		) .'"' : '';
          
			
			if ( $depth === 0 ) {
			$a_class .= ' link';
			}
			
		  	if ( $args->has_children  ) {
			$attributes .= ' role="button"';
			$attributes .= ' data-toggle="dropdown"';
			$a_class .= ' dropdown-toggle';
			}
				
			$attributes .= ' class="'. esc_attr( $a_class ) . '"';
			
           $prepend = '';
           $append = '';

           if($depth != 0)
           {
                $append = $prepend = "";
           }
			
			
			if ( $args->has_children && $depth === 0 ) {
			$attributes .= ' href="#"';

			} else{
			$attributes .= ! empty( $item->url ) ? ' href="'. esc_attr( $item->url) .'"' : '';	
			}

			
			
            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
			

			

            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $args->link_after;
			

            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			
			
			
            }
			
	
			
			
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}

?>