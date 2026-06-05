<?php
// Webriti scripts
if( !function_exists('busiporf_scripts'))
{
	function busiporf_scripts(){

		// css
		wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/free/css/bootstrap.css' );
		wp_enqueue_style('busiprof-style', get_template_directory_uri() . '/free/css/style-free.css' );
		wp_enqueue_style('busiporf-custom-css', get_template_directory_uri() . '/free/css/custom.css' );
		wp_enqueue_style('flexslider-css', get_template_directory_uri() . '/free/css/flexslider.css' );
		wp_enqueue_style('font-awesome-css', get_template_directory_uri() . '/free/css/font-awesome/css/all.min.css' );
		// js
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'bootstrap-js' , get_template_directory_uri() . '/free/js/bootstrap.bundle.min.js' );
		wp_enqueue_script( 'busiporf-custom-js' , get_template_directory_uri() . '/free/js/custom.js' );

		if ( is_singular() ) wp_enqueue_script( "comment-reply" );
		require_once('custom_style.php'); 
	}
}
add_action('wp_enqueue_scripts','busiporf_scripts');

//Enqueue Customizer css
function busiprof_enqueue_scripts(){
	wp_enqueue_style('busiprof_customizer-css', get_template_directory_uri() . '/free/css/drag-drop.css');
}
add_action( 'admin_enqueue_scripts', 'busiprof_enqueue_scripts' );
  //Load script at admin side
  if ( ! function_exists( 'busiprof_admin_scripts' ) ) { 
    function busiprof_admin_scripts() {
        wp_enqueue_script('busiprof-admin-script', BUSI_TEMPLATE_DIR_URI . '/free/admin/assets/js/admin.js', array('jquery'));
    }
    add_action( 'customize_controls_enqueue_scripts', 'busiprof_admin_scripts');
  }