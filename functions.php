<?php 
/* *** enqueue custom scripts and styles *** */
add_action( 'wp_enqueue_scripts', function() {

	if ( ! bricks_is_builder_main() ) {
		wp_enqueue_style( 'bricks-child', get_stylesheet_uri(), ['bricks-frontend'], filemtime( get_stylesheet_directory() . '/style.css' ) );
    wp_enqueue_script( 'bricks-child', get_stylesheet_directory_uri() . '/lib/js/scroll.js', [], filemtime( get_stylesheet_directory() . '/lib/js/scroll.js' ), true );
	}
} );

/* *** register custom elements *** */
add_action( 'init', function() {
  $element_files = [
    __DIR__ . '/elements/title.php',
  ];

  foreach ( $element_files as $file ) {
    \Bricks\Elements::register_element( $file );
  }
}, 11 );

/* *** add text strings to builder *** */
add_filter( 'bricks/builder/i18n', function( $i18n ) {
  // for element category 'custom'
  $i18n['custom'] = esc_html__( 'Custom', 'bricks' );

  return $i18n;
} );

/* *** add body class *** */
add_filter( 'body_class', function( $classes ) {
	return array_merge( $classes, array( 'hero-active' ) );
} );

/* *** disable theme and plugin editor *** */
define('DISALLOW_FILE_EDIT',true);

/* *** custom login *** */
add_action( 'login_head', function() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/lib/css/login.css" />';
} );

add_filter( 'login_headerurl', function() {
	return get_bloginfo( 'url' );
} );

add_filter( 'login_headertitle', function() {
	return get_bloginfo( 'name' );
} );