<?php

class xt_corporate_lite_navwalker extends Walker_Nav_Menu {

	function start_lvl(&$output, $depth=0, $args = array()) {
		$output .= '<ul class="Srm-dropdown-menu">';
	}
 
	function end_lvl(&$output, $depth=0, $args = array()) {
		$output .= '<span class="Srm-caret"></span></ul>';
	}
	
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = !empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
 
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
		$class_names = $value = ''; 		
		if ( $args->has_children ) {
			$item->classes[]="Srm-item Srm-item-type-custom Srm-dropdown";
			if($depth > 0) {
				$item->classes[]=" Srm-dropdown-submenu";
			}
		}	
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		$output .= $indent . '<li'. $class_names .'>';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ''; 
 		if ( $args->has_children ) {	
			$subchlid =" class='Srm-dropdown-toggle'";
			$subarrow ='<span class="Srm-caret"></span>';			
		}else{
            $subchlid ='';
            $subarrow ='';
        }
		$item_output = $args->before;
		$item_output .= '<a'. $subchlid . $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= $subarrow.'</a>';
		$item_output .= $args->after;
 		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
function xt_corporate_lite_my_wp_nav_menu_args( $args = '' ) {
	if( 'primary_navigation' == $args['theme_location'] )
    {
	  $args['walker'] = new xt_corporate_lite_navwalker();
	  $args['items_wrap'] = '<div class="erm-menu-style" id="Srm"><div class="Srm-navCon">
	  <ul class="Srm-navbar-nav Srm-trigger-hoverintent Srm-is-responsive">%3$s</ul></div></div>';
    }
  return $args;
}
add_filter( 'wp_nav_menu_args', 'xt_corporate_lite_my_wp_nav_menu_args' );