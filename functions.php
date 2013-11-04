<?php
/**
 * Author: Frederik Leksell 
 * Author URI: http://frederik.se
 * Version: 0.8.0
 * Copyright (C) 2013 Frederik leksell 
 * License: GNU General Public License, version 3 (GPLv3)
 * License URI: license.txt 
 */

//************* INCLUDES ********************/

// Slightly Modified Options Framework
require_once ('admin/index.php');

if ( ! function_exists('bi_get_data') ) {
	function bi_get_data($id, $fallback = false) {
		global $smof_data;
		if ( $fallback == false ) $fallback = '';
		$output = ( isset($smof_data[$id]) && $smof_data[$id] !== '' ) ? $smof_data[$id] : $fallback;
		return $output;
	}
}
require_once( get_template_directory() .'/admin/front-end/admin-opstions-css.php' );

// Enqueue Scripts/Styles for our Lightbox
function twentytwelve_add_lightbox() {
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/functions/lightbox/js/jquery.fancybox.pack.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/functions/lightbox/js/lightbox.js', array( 'fancybox' ), false, true );
    wp_enqueue_style( 'lightbox-style', get_template_directory_uri() . '/functions/lightbox/css/jquery.fancybox.css' );
}
add_action( 'wp_enqueue_scripts', 'twentytwelve_add_lightbox' );

// Register Login Logo
require_once('functions/login-logo.php');

// Redirect Manager
require_once('functions/Redirect-Manager/redirect-manager.php');

/*
// Bootstrap carousel !!! Har problem med featured image i Admin posts
require_once('functions/bootstrap-carousel.php');
*/
// Register social widget
//require_once('functions/widgets/social-widget.php');

// Register Tracking
//require_once('functions/tracking.php');

//************* Wodrpress Suppot and fuctions ********************/
//Custom Background Support
add_theme_support( 'custom-background');

// Maintenance mode
if( bi_get_data('maintenance-mode','1') == '1') :

function maintenace_mode() {
      if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {wp_die('Hi, we do some maintenance for the moment, please check back in a while!');}
}
add_action('get_header', 'maintenace_mode'); 
  
endif; 

// Register Font awesome
function prefix_enqueue_awesome() {
wp_enqueue_style( 'prefix-font-awesome', get_template_directory_uri() . '/library/css/font-awesome.min.css' );
}
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_awesome' );

// Register Custom Navigation Walker
require_once('functions/wp_bootstrap_navwalker.php');

//--------- Register Bootstrap JS----------/
function bootstrap_scripts()
{
	// Register the scripts for this theme:
    wp_register_script( 'bootstrap-script', get_template_directory_uri() . '/library/js/bootstrap.min.js', array( 'jquery' ) );
    wp_register_script( 'modernizr-script', get_template_directory_uri() . '/library/js/modernizr.js', array( 'jquery' ) );
    wp_register_script( 'scrolltotop-script', get_template_directory_uri() . '/library/js/jquery.scrollToTop.js', array( 'jquery' ) );
    // wp_register_script( 'jquery-ui' , 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js' );
	

	//  enqueue the script:
	wp_enqueue_script( 'bootstrap-script' );
	wp_enqueue_script( 'modernizr-script' );
	wp_enqueue_script( 'scrolltotop-script' );
 //  wp_enqueue_script( 'jquery-ui' );
	
}
add_action( 'wp_enqueue_scripts', 'bootstrap_scripts' );
add_action( 'wp_enqueue_scripts', 'modernizr-script' );
add_action( 'wp_enqueue_scripts', 'scrolltotop-script' );
// add_action( 'wp_enqueue_scripts', 'jquery-ui' );

function wpb_adding_scripts() {
wp_register_script('main-script', get_template_directory_uri() . '/library/js/main.js','','1.1', true);
wp_enqueue_script('main-script');
}
add_action( 'wp_enqueue_scripts', 'wpb_adding_scripts' );  


function bootstrap_styles()
{
	// Register the style like this for a theme:
	wp_register_style( 'bootstrap-styles', get_template_directory_uri() .'/library/css/bootstrap.min.css' );
    wp_register_style( 'responsive-style', get_stylesheet_uri(), false, '3.0.0' );

	//  enqueue the style:
	wp_enqueue_style( 'bootstrap-styles' );
    wp_enqueue_style( 'responsive-style' );
 
}
add_action( 'wp_enqueue_scripts', 'bootstrap_styles' );


/************* Read More ********************/
function new_excerpt_more( $more ) {
	return ' <a class="btn btn-primary btn-xs btn-post" href="'. get_permalink( get_the_ID() ) . '">Read More</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

/************* Post Formats ********************/

add_theme_support( 'post-formats', array( 'status', 'quote', 'image', 'link', ) );
// add post-formats to post_type 'page'
add_post_type_support( 'content', 'post-formats' );

/************* Post Thumbnails ********************/

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
    	//add_image_size( 'blog-main', 800, 9999 ); //300 pixels wide (and unlimited height)
    	add_image_size( 'blog-thumb', 100, 100, true ); //(cropped)
		add_image_size( 'blog-feed-thumb', 180, 180, true ); //(cropped)
        
}
/************* Menues ********************/

//register Menues
register_nav_menus( array(
	'top_navigation' => 'Responsive Top Navigation'
) );



/************** Meta Description ******************/
// 'Custom Meta Description' field below post/page editor
add_action('admin_menu', 'custom_meta_desc');
add_action('save_post', 'save_custom_meta_desc');
function custom_meta_desc() {
add_meta_box('custom_meta_desc', 'Add meta description <small>(if left empty, the first 200 characters will be used. Use Max 160 characters for best SEO.)</small>', 'custom_meta_desc_input_function', 'post', 'normal', 'high');
add_meta_box('custom_meta_desc', 'Add meta description <small>(if left empty, the first 200 characters will be used. Use Max 160 characters for best SEO.)</small>', 'custom_meta_desc_input_function', 'page', 'normal', 'high');
}
function custom_meta_desc_input_function() {
global $post;
echo '<input type="hidden" name="custom_meta_desc_input_hidden" id="custom_meta_desc_input_hidden" value="'.wp_create_nonce('custom-meta-desc-nonce').'" />';
echo '<input type="text" name="custom_meta_desc_input" id="custom_meta_desc_input" style="width:100%;" value="'.get_post_meta($post->ID,'_custom_meta_desc',true).'" />';
}
function save_custom_meta_desc($post_id) {
if (!wp_verify_nonce($_POST['custom_meta_desc_input_hidden'], 'custom-meta-desc-nonce')) return $post_id;
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
$customMetaDesc = $_POST['custom_meta_desc_input'];
update_post_meta($post_id, '_custom_meta_desc', $customMetaDesc);
}

/************* ACTIVE SIDEBARS ********************/
if ( function_exists('register_sidebar') )
	// Sidebars & Widgetizes Areas
     register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Blog Sidebar',
    	'description' => 'Used on every blog post.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="sidebar-default">',
    	'after_title' => '</h4>',
    ));
    
     register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => 'Pages Sidebar',
    	'description' => 'Used on pages.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="sidebar-pages-right">',
    	'after_title' => '</h4>',
    ));
  
     register_sidebar(array(
    	'id' => 'sidebar3',
    	'name' => 'Mobile Menu',
    	'description' => 'Used instead of mobile menu',
    	'before_widget' => '<div id="%1$s" class="mobile-widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="mobile-menu">',
    	'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
      'id' => 'footer1',
      'name' => 'Footer 1',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer2',
      'name' => 'Footer 2',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer3',
      'name' => 'Footer 3',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));
    

