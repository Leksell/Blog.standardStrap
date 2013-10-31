<?php
/*
Author: Frederik Leksell
URL: htp://frederik.se

*/
/************* INCLUDES ********************/
/**
 * Slightly Modified Options Framework
 */
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

/*
//Regsiter Google fonts for this theme
function load_fonts() {
        wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Open+Sans|Raleway', array(), '', 'all' );
        wp_enqueue_style( 'googleFonts');
    }

add_action('wp_print_styles', 'load_fonts');
*/


    
//Custom Background Support
add_theme_support( 'custom-background');

// Register Login Logo
require_once('functions/login-logo.php');

// Redirect Manager
require_once('functions/Redirect-Manager/redirect-manager.php');

/*
// Bootstrap carousel !!! Har problem med featured image i Admin posts
require_once('functions/bootstrap-carousel.php');
*/

// Register Social Icons
require_once('functions/social-icons.php');

// Register Tracking
//require_once('functions/tracking.php');

// Register Font awesome
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_awesome' );

function prefix_enqueue_awesome() {
wp_enqueue_style( 'prefix-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.min.css', array(), '4.0.0' );
}


// Register Custom Navigation Walker
require_once('functions/wp_bootstrap_navwalker.php');

// Register Bootstrap JS
function bootstrap_scripts()
{
	// Register the scripts for this theme:
    wp_register_script( 'bootstrap-script', get_template_directory_uri() . '/library/js/bootstrap.js', array( 'jquery' ) );
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
	'top_navigation' => 'Responsive Top Navigation',
	'footer_menu' => 'Footer Menu'
) );

/************* Extended User profile ********************/

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3>Extra profile information</h3>

	<table class="form-table">

		<tr>
			<th><label for="twitter">Twitter</label></th>

			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Twitter username.</span>
			</td>
			
		</tr>
		<tr>
			<th><label for="twitter">LinkedIn</label></th>

			<td>
				<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your LinkedIn username.</span>
			</td>
			
		</tr>
		<tr>
			<th><label for="google">Google+</label></th>

			<td>
				<input type="text" name="google" id="google" value="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your google+ URL.</span>
			</td>
			
		</tr>

	</table>
<?php }

/* Saving the extr auser profile data*/

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'twitter', $_POST['twitter'] );
	update_usermeta( $user_id, 'linkedin', $_POST['linkedin'] );
	update_usermeta( $user_id, 'google', $_POST['google'] );
}

/********* END USER Profile extnd*****/




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
    

