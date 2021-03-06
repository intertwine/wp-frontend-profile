<?php

// TODO: Obtain production Google Maps API Key
define( 'MAPS_SCHEMA', ( is_ssl() ? 'https:' : 'http:' ) );
define( 'MAPS_API_KEY', 'AIzaSyDcFXYRFPvjXJRsoFpkzV0UFcQnZrL1Lkc'); // ISI Dev Key
define( 'MAPS_API_URL',  MAPS_SCHEMA.'//maps.googleapis.com/maps/api/js?libraries=places&key='.MAPS_API_KEY);

/**
 * function wpfep_register_scripts()
 * register the plugins scripts ready for enqueing
 */
function wpfep_register_scripts() {

	/* make sure that jquery is enqueued */
	wp_enqueue_script( 'jquery' );

	/* make a filter to allow turning off styles */
	$style_output = apply_filters( 'wpfep_frontend_styles', true );

	/* if we should output styles - enqueue them */
	if( $style_output == true )
		wp_enqueue_style( 'wpfep_styles', plugins_url( 'css/wpfep-style.css', dirname( __FILE__ ) ) );

	/* make a filter to allow turning off tab js */
	$tab_js_output = apply_filters( 'wpfep_tabs_js', true );

	/* if we should output styles - enqueue them */
	if( $tab_js_output == true )
		wp_enqueue_script( 'wpfep_tabs_js', plugins_url( 'js/tabs.js', dirname( __FILE__ ) ), 'jquery', array(), true );

	wp_enqueue_style( 'geosuggest', plugins_url( 'css/geosuggest.css', dirname( __FILE__ ) ) );
	wp_register_script( 'google-maps', MAPS_API_URL, array( 'jquery' ), false, true );
	wp_enqueue_script( 'geocomplete', plugins_url('js/jquery.geocomplete.min.js', dirname(__FILE__)), 'google-maps', array(), true);
	wp_enqueue_script( 'maskedinput', plugins_url('js/jquery.maskedinput.min.js', dirname(__FILE__)), 'jquery', array(), true);
}

add_action( 'wp_enqueue_scripts', 'wpfep_register_scripts' );
