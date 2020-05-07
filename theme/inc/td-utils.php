<?php
/*

Available Functions:

convert_string_to_slug($string)
return_link_from_array($arr, $class = '')
getPostViews($postID)
setPostViews($postID)
td_acf_options($field)
td_build_term_string($arr, $last = ', AND ', $delimiter = ', ', $special_Char = '')
td_content_image_sizes_attr( $sizes, $size )
td_excerpt_more( $link )
td_javascript_detection()


*/

function td_build_term_string($arr, $last = ', AND ', $delimiter = ', ', $special_Char = '') {
    $html = '';
    foreach($arr as $key=>$item) {
        $html .= $item->name . $special_Char;
        if((count($arr)-2) == $key) {
            $html .= $last;
            // second to last
        } elseif((count($arr)-1) > $key) {
            // regular spacing
            $html .= $delimiter;
        }
    }
    return __($html);
}

// Helper Functions //
function td_acf_options($field){
	return get_field($field, 'option');
}

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since brooklyn 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function  td_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'brooklyn' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'td_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since brooklyn 1.0
 */
function  td_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'td_javascript_detection' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since brooklyn 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function td_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'td_content_image_sizes_attr', 10, 2 );

// Function to handle-ize a string
function convert_string_to_slug($string){
    if($string){
        $string = str_replace(' ', '-', $string);
        $string = str_replace(',', '', $string);
        return strtolower($string);
    }else{
        return;
    }

}

function return_link_from_array($arr, $class = '') {
	if($arr) {
		if($arr["target"] == '_blank') {
			$string = '<a class="' . $class . '" href="' . $arr["url"] . '" title="Click here to read ' . $arr["title"] . ', opens in a new window" target="_blank">' . __($arr["title"], "brooklyn") . '</a>';
		} else {
			$string = '<a class="' . $class . '" href="' . $arr["url"] . '" title="Click here to read ' . $arr["title"] . '">' . __($arr["title"], "brooklyn") . '</a>';
		}
		return $string;
	}
}
