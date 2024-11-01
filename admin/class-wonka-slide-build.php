<?php
/**
 * The core plugin class.
 *
 * This is used to build slider and shortcodes.
 *
 * @since      1.0.1
 * @package    Wonka_Slide
 * @subpackage wonka-slide/inc
 * @author     Wonkasoft <info@wonkasoft.com>
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function wonka_slide_shortcode( $atts ) {

	$output = '';
	$atts = shortcode_atts( array(
		'id' => 'wonka-slider-main',
		'slide_indicators' => true,
		'slide_arrows' => true,
		'indicators_wrap_class' => 'wonka-slide-indicators-wrap',
		'indicators_list_class' => 'wonka-slide-indicators-list',
		'indicators_item_class' => 'wonka-slide-indicators-item',
		'slide_count' => '3',
		'container_class' => 'wonka-slider-container',
		'list_class' => 'wonka-slide-list',
		'item_class' => 'wonka-slider-item',
		'img_class' => 'wonka-slide-img',
		'style' => false,
	), $atts);
	$excerpt_style = ($atts['style']) ? ' italic': '';

	$posts_array = get_posts();
	strtolower( $atts['slide_arrows'] );
	$atts['slide_arrows'] = ( $atts['slide_arrows'] === 'false' ) ? false: true;
	strtolower( $atts['slide_indicators'] );
	$atts['slide_indicators'] = ( $atts['slide_indicators'] === 'false' ) ? false: true;
	if ( $atts['slide_count'] > 10 ) { $atts['slide_count'] = 10; }
	if ( $atts['slide_count'] > sizeof( $posts_array ) ) { $atts['slide_count'] = sizeof( $posts_array ); }

		// Starting the slide build
		$output .= '<div id="' . $atts['id'] . '" class="' . $atts['container_class'] . '">';
		$output .= '<div class="content-box">';

		// Setting the indicators
		if ( (bool)$atts['slide_indicators'] ) :
			$output .= '<div id="indicators-wrap" class="' . $atts['indicators_wrap_class'] . '">';
			$output .= '<ul class="' . $atts['indicators_list_class'] . '">';
			$i = 0;
			foreach ( $posts_array as $current ) :
				$i++;
				$active = ( $i == 1 ) ? ' active-indicator': '';
				$output .= '<li id="slide-indicator-' . $i . '" data-slide-indicator="' . $i . '" class="' . $atts['indicators_item_class'] . $active . '">';
				$output .= '<div class="background-img" style="background: url(' . get_the_post_thumbnail_url( $current->ID ) . '); background-size: cover; background-position: top center;"></div>';
				$output .= '</li>';
			if ( $atts['slide_count'] == $i ) {
				break;
			} 
			endforeach;
			$output .= '</ul></div>';
		endif;

		// Building the slides
		$output .= '<div class="list-wrap">';
		$output .= '<ul class="' . $atts['list_class'] . '">';
		$i = 0;
		foreach ( $posts_array as $current ) :
			$i++;
			setup_postdata( $current );
			$active = ( $i == 1 ) ? ' active': '';
			$output .= '<li id="slide-' . $i . '" data-slide="' . $i . '" class="' . $atts['item_class'] . $active . '">';
			// Building slide titles
			$output .= '<a href="' . get_post_permalink( $current->ID ) . '" class="slide-post-anchor">';
			$output .= '<div id="wonka-slide-title-wrap" class="' . $atts['container_class'] . '">';
			$output .= '<span class="slide-post-title">' . get_the_title( $current->ID ) . '</span></div>';
			$output .= '<div class="slide-post-img-wrap"><img src="' . get_the_post_thumbnail_url( $current->ID ) . '" class="' . $atts['img_class'] . '" /></div>';
			$output .= '<div class="wonka-slide-excerpt-wrap' . $excerpt_style . '">' . wp_strip_all_tags( get_the_excerpt( $current->ID ), true ) . '</div>';
			$output .= '</a></li>'; 
		if ( $atts['slide_count'] == $i ) {
			break;
		} 
		endforeach;
		$output .= '</ul></div></div>';

		// Building slider controls
		if ( (bool)$atts['slide_arrows'] ) :
			$output .= '<a role="button" data-direction="prev" class="slide-control slide-control-left"></a>';
			$output .= '<a role="button" data-direction="next" class="slide-control slide-control-right"></a>';
		endif;
		$output .= '</div>';
		ob_start();

		$output .= ob_get_clean();

		return $output;

}
add_shortcode( 'wonka-slider', 'wonka_slide_shortcode', 30, 1);