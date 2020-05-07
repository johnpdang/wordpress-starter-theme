<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package %Theme_name_sentence_case%
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function %theme_name_underscored%_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', '%theme_name_underscored%_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function %theme_name_underscored%_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', '%theme_name_underscored%_pingback_header' );

// SVG Function
function td_returnSVG($svg) {
     switch($svg) {
		 case 'example' :
		 $html = '<svg class="headphones" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 39 36.32"><g class="Group_3370" data-name="Group 3370"><path class="Path_4357" data-name="Path 4357" d="M34.53,20.42h-.3V14.85a14.69,14.69,0,1,0-29.37,0v5.57h-.3A4.55,4.55,0,0,0,0,24.94v6.83a4.58,4.58,0,0,0,4.56,4.55H9.17A1.33,1.33,0,0,0,10.51,35V21.69a1.3,1.3,0,0,0-1.33-1.27H7.47V14.85a12.08,12.08,0,1,1,24.15,0v5.57h-1.7a1.3,1.3,0,0,0-1.34,1.26h0V35a1.33,1.33,0,0,0,1.34,1.3h4.61A4.5,4.5,0,0,0,39,31.8V24.94a4.48,4.48,0,0,0-4.43-4.52ZM7.9,33.71H4.56a2,2,0,0,1-1.95-1.94V24.94A1.92,1.92,0,0,1,4.56,23H7.9Zm28.49-1.94a1.89,1.89,0,0,1-1.83,1.94H31.18V23h3.35a1.86,1.86,0,0,1,1.86,1.87v6.87Z" style="fill:#fff"/></g></svg>';
		 break;
         default:
         //
         break;
     }
     return $html;
 }
