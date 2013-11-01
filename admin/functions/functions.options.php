<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
			$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
			$categories_tmp 	= array_unshift($of_categories, "Select a category:");    

		//Access the WordPress Pages via an Array
			$of_pages 			= array();
			$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
			foreach ($of_pages_obj as $of_page) {
				$of_pages[$of_page->ID] = $of_page->post_name; }
				$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       

		//Testing 
				$of_options_select 	= array("one","two","three","four","five"); 
				$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");

				$font_size = array( 'select', '12px', '13px', '14px' );
				$font_style = array( "normal", "italic", "bold", "bold italic");

		//Sample Homepage blocks for the layout manager (sorter)
				$of_options_homepage_blocks = array
				( 
					"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
				), 
					"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
				),
					);


		//Stylesheets Reader
				$alt_stylesheet_path = LAYOUT_PATH;
				$alt_stylesheets = array();

				if ( is_dir($alt_stylesheet_path) ) 
				{
					if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
					{ 
						while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
						{
							if(stristr($alt_stylesheet_file, ".css") !== false)
							{
								$alt_stylesheets[] = $alt_stylesheet_file;
							}
						}    
					}
				}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
			if ($bg_images_dir = opendir($bg_images_path) ) { 
				while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
					if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
						$bg_images[] = $bg_images_url . $bg_images_file;
					}
				}    
			}
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/

		$menu_color = array( 'Default', 'Inverse' );
		// Homepage Latest Blog or Featured Image
		$hp_array = array('featured' => __('Featured Hero Unit', 'responsive'),'latest' => __('Blog Style', 'responsive'));
		// Buttons
		$btn_color = array("default" => "Default Gray","primary" => "Primary","info" => "Info","success" => "Success","warning" => "Warning","danger" => "Danger","inverse" => "Inverse");
		$btn_size = array("xs" => "Extra Small","sm" => "Small","default" => "Medium","lg" => "Large");
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


		/*-----------------------------------------------------------------------------------*/
		/* The Options Array */
		/*-----------------------------------------------------------------------------------*/

// Set the Options Array
		global $of_options;
		$of_options = array();

		$of_options[] = array( "name"	=> __( 'General', 'responsive' ),
			"type"	=> "heading",
			);

		$of_options[] = array( "name"	=> __( 'Maintenance mode', 'responsive' ),
			"desc"	=> __( 'Enable and disable maintenance mode.', 'responsive' ),
			"id"	=> "maintenance-mode",
			"std"	=> '0',
			"on"	=> __( 'Enable', 'responsive' ),
			"off"	=> __( 'Disable', 'responsive' ),
			"type"	=> "switch");

		$of_options[] = array( "name"	=> __( 'Login Logo', 'responsive' ),
			"desc"	=> __( 'Upload a custom logo for your Wordpress login screen. (Recommended 300px x 80px)', 'responsive' ),
			"id"	=> "custom_login_logo",
			"std"	=> "",
			"type"	=> "media");

		$of_options[] = array( "name"	=> __( 'Login Logo Height', 'responsive' ),
			"desc"	=> __( 'Enter the height of your custom logo to override the default WordPress image height. Width, can not change.', 'responsive' ),
			"id"	=> "custom_login_logo_height",
			"std"	=> "67px",
			"type"	=> "text");

		$of_options[] = array( "name"	=> __( 'Favicon', 'responsive' ),
			"desc"	=> __( 'Upload or past the URL for your custom favicon.', 'responsive' ),
			"id"	=> "custom_favicon",
			"std"	=> "",
			"type"	=> "media");

				
// Header & Top menu
		$of_options[] = array( "name"	=> __( 'Header', 'responsive' ),
			"type"	=> "heading");

		// $of_options[] = array( "name"	=> __( 'Fixed Navbar', 'responsive' ),
		// 	"desc"	=> __( 'Select to enable/disable a fixed navbar.', 'responsive' ),
		// 	"id"	=> "disable_fixed_navbar",
		// 	"std"	=> '1',
		// 	"on"	=> __( 'Enable', 'responsive' ),
		// 	"off"	=> __( 'Disable', 'responsive' ),
		// 	"type"	=> "switch");

		$of_options[] = array( "name"	=> __( 'Main Logo', 'responsive' ),
			"desc"	=> __( 'Use this field to upload your custom logo for use in the theme header. (Recommended 40px H x 200px W)', 'responsive' ),
			"id"	=> "custom_logo",
			"std"	=> "",
			"type"	=> "media",
			);

		// $of_options[] = array( "name"	=> __( 'Header Search Bar', 'responsive' ),
		// 	"desc"	=> __( 'Select to enable/disable the search bar in the header', 'responsive' ),
		// 	"id"	=> "enable_disable_search",
		// 	"std"	=> '0',
		// 	"on"	=> __( 'Enable', 'responsive' ),
		// 	"off"	=> __( 'Disable', 'responsive' ),
		// 	"type"	=> "switch");	
			
//===============================================================================================================================
//! 		
//  
//  //Homepage					
//  		$of_options[] = array( "name"	=> __( 'Homepage', 'responsive' ),
//  			"type"	=> "heading");
//  
//  	
//   	$of_options[] = array( 	"name" 		=> "Select homepage hero unit or blog style.",
//    			"desc" 		=> "Featured content or blog style.",
//    			"id" 		=> "hero_radio",
//    			"std" 		=> "featured",
//    			"type" 		=> "radio",
//    			"options" 	=> $hp_array
//    			);
//  	
//  			
//  		$of_options[] = array( "name"	=> __( 'Featured Hero Unit Full Width', 'responsive' ),
//  			"desc"	=> __( 'Enable/disable full width Hero Unit.', 'responsive' ),
//  			"id"	=> "hero_full",
//  			"std"	=> '1',
//  			"on"	=> __( 'Enable', 'responsive' ),
//  			"off"	=> __( 'Disable', 'responsive' ),
//  			"type"	=> "switch");
//  
//  		$of_options[] = array( "name"	=> __( 'Featured Content', 'responsive' ),
//  			"desc"	=> __( 'Add your own HTML/embed code for the right featured homepage section.', 'responsive' ),
//  			"id"	=> "featured_content",
//  			"std"	=> "<img class=\"aligncenter\" src=\"/wp-content/themes/decigo/images/standardStrap_big.png\"/>", 
//  			"type"	=> "textarea");
//  
//  		$of_options[] = array( 	"name"	=> "",
//  			"desc"	=> "",
//  			"id"	=> "subheading",
//  			"std"	=> "<h3 style=\"margin: 0;\">". __( 'Homepage Styling', 'responsive' ) ."</h3>",
//  			"icon"	=> true,
//  			"type"	=> "info");
//  
//  		$of_options[] = array( "name"	=> __( 'Fatured Background Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "jumbotron_bg",
//  			"std"	=> "#456c81",
//  			"fold"	    => "hero_radio",
//  			"type"	=> "color");
//  
//  		$of_options[] = array( "name"	=> __( 'Default Featured Text Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "jumbotron_text_color",
//  			"std"	=> "#ffffff",
//  			"fold"	    => "hero_radio",
//  			"type"	=> "color");
//  
//  		$of_options[] = array( "name"	=> __( 'Default Featured Button Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "jumbotron_button_color",
//  			"std"	=> "#93ba47",
//  			"fold"	    => "hero_radio",
//  			"type"	=> "color");
//  
//  		$of_options[] = array( "name"	=> __( 'Default Featured Button Hover Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "jumbotron_button_hover_color",
//  			"std"	=> "#b4b4b4",
//  			"fold"	    => "hero_radio",
//  			"type"	=> "color");
//  
//  		$of_options[] = array( "name"	=> __( 'Left Widget Background Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "home_left_widget_bg",
//  			"std"	=> "#ededed",
//  			"fold"	    => "hero_radio",
//  			"type"	=> "color");
//  			
//  		$of_options[] = array( "name"	=> __( 'Left Widget Text Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "home_left_widget_text",
//  			"std"	=> "#333333",
//  			"fold"	    => "hero_radio",
//  			"type"	=> "color");
//  			
//  		$of_options[] = array( "name"	=> __( 'Center Widget Background Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "home_middle_widget_bg",
//  			"std"	=> "#ededed",
//  			"fold"	    => "hero_radio",
//  			"type"	=> "color");
//  			
//  		$of_options[] = array( "name"	=> __( 'Center Widget Text Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "home_middle_widget_text",
//  			"std"	=> "#333333",
//  			"fold"	    => "hero_radio",
//  			"type"	=> "color");
//  			
//  		$of_options[] = array( "name"	=> __( 'Right Widget Background Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "home_right_widget_bg",
//  			"std"	=> "#80477c",
//  			"fold"	    => "hero_radio",
//  			"type"	=> "color");
//  			
//  		$of_options[] = array( "name"	=> __( 'Right Widget Text Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "home_right_widget_text",
//  			"std"	=> "#ffffff",
//  			"fold"	    => "hero_radio",
//  			"type"	=> "color");
//  			
//  			
//  		$of_options[] = array( "name"	=> __( 'Homepage Text Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "home_widget_text",
//  			"std"	=> "#333333",
//  			"type"	=> "color");
//  			
//===============================================================================================================================
//======================================================================================================
//! //Breadcrumbs
//    		$of_options[] = array( "name"	=> __( 'Breadcrumbs', 'responsive' ),
//  			"type"	=> "heading");
//  			
//  		$of_options[] = array( "name"	=> __( 'Breadcrumbs', 'responsive' ),
//  			"desc"	=> __( 'Select to enable/disable breadcrumbs', 'responsive' ),
//  			"id"	=> "enable_disable_breadcrumbs",
//  			"std"	=> '0',
//  			"on"	=> __( 'Enable', 'responsive' ),
//  			"off"	=> __( 'Disable', 'responsive' ),
//  			"type"	=> "switch");
//  			
//  		$of_options[] = array( "name"	=> __( 'Breadcrumb Background Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "breadcrumb_bg",
//  			"std"	=> "#ededed",
//  			"type"	=> "color");
//  
//  		$of_options[] = array( "name"	=> __( 'Breadcrumb Link Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "breadcrumb_link",
//  			"std"	=> "#456c81",
//  			"type"	=> "color");
//  
//  		$of_options[] = array( "name"	=> __( 'Breadcrumb Active Link Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "breadcrumb_active",
//  			"std"	=> "#333333",
//  			"type"	=> "color");
//  
//  		$of_options[] = array( "name"	=> __( 'Breadcrumb Separator Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "breadcrumb_sep",
//  			"std"	=> "#80477c",
//  			"type"	=> "color");
//======================================================================================================

// //Search & Archive
//   		$of_options[] = array( "name"	=> __( 'Search-Archive', 'responsive' ),
// 			"type"	=> "heading");
			
// 		$of_options[] = array( "name"	=> __( 'Search & Archive Showing results title', 'responsive' ),
// 			"desc"	=> __( 'Select your desired font size in pixels.', 'responsive' ),
// 			"id"	=> "we-found",
// 			"std"	=> '4px',
// 			"type"	=> "text");
		
//==========================================================================================================
//! 
//  //Pages
//    		$of_options[] = array( "name"	=> __( 'Pages', 'responsive' ),
//  			"type"	=> "heading");
//  			
//  			
//  		$of_options[] = array( "name"	=> __( 'Page Background Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "page-post-bg",
//  			"std"	=> "#ededed",
//  			"type"	=> "color");
//  			
//  		$of_options[] = array( "name"	=> __( 'Full Width Page Background Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "page-full-width-bg",
//  			"std"	=> "#ededed",
//  			"type"	=> "color");
//  			
//  		$of_options[] = array( "name"	=> __( 'Landing Page Background Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "landingpage-bg",
//  			"std"	=> "#456c81",
//  			"type"	=> "color");
//  			
//  		$of_options[] = array( "name"	=> __( 'Landing Page Text Color', 'responsive' ),
//  			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
//  			"id"	=> "landingpage-text",
//  			"std"	=> "#ffffff",
//  			"type"	=> "color");
//  
//==========================================================================================================
				
				//Blog				
		$of_options[] = array( "name"	=> __( 'Blog', 'responsive' ),
			"type"	=> "heading");


		// $of_options[] = array( "name"	=> __( 'Display Meta & Tags', 'responsive' ),
		// 	"desc"	=> __( 'Select to enable/disable the post meta & tags.', 'responsive' ),
		// 	"id"	=> "enable_disable_meta_tags",
		// 	"std"	=> '1',
		// 	"on"	=> __( 'Enable', 'responsive' ),
		// 	"off"	=> __( 'Disable', 'responsive' ),
		// 	"type"	=> "switch");
			
		$of_options[] = array( "name"	=> __( 'Display Featured Image', 'responsive' ),
			"desc"	=> __( 'Select to enable/disable Featured Image on single page view.', 'responsive' ),
			"id"	=> "enable_disable_featured_image",
			"std"	=> '1',
			"on"	=> __( 'Enable', 'responsive' ),
			"off"	=> __( 'Disable', 'responsive' ),
			"type"	=> "switch");

		
			
//=================================================================================
//! 
//  
//  //Sidebar				
//  		$of_options[] = array( "name"	=> __( 'Sidebar', 'responsive' ),
//  			"type"	=> "heading");
//  
//  		
//=================================================================================
//====================================================================================
//! 			
//  		//Background					
//  		$of_options[] = array( "name"	=> __( 'Background', 'responsive' ),
//  			"type"	=> "heading");
//  
//====================================================================================
//================================================================================================================
//! 
//  		//Solcial
//  		$of_options[] = array( "name"	=> __( 'Social', 'responsive' ),
//  			"type"	=> "heading");
//  
//  		$of_options[] = array( "name"	=> __( 'Social Icons In Footer', 'responsive' ),
//  			"desc"	=> __( 'Select to enable/disable the social icons in the footer.', 'responsive' ),
//  			"id"	=> "disable_social_footer",
//  			"std"	=> '0',
//  			"on"	=> __( 'Enable', 'responsive' ),
//  			"off"	=> __( 'Disable', 'responsive' ),
//  			"type"	=> "switch");
//  
//================================================================================================================

		$url =  ADMIN_DIR . 'assets/images/';					
		$of_options[] = array( "name"	=> __( 'Social Style', 'responsive' ),
			"desc"	=> __( 'Select your social icon style. Some icons don\'t have both styles. Refer to <a href="http://fortawesome.github.io/Font-Awesome/" target="_blank">Font Awesome</a>.', 'responsive' ),
			"id"	=> "social_style",
			"std"	=> "two",
			"type"	=> "images",
			"options"	=> array(
				'one'	=> $url . 'facebook.jpg',
				'two'	=> $url . 'facebook2.jpg' )
			);
			
		$of_options[] = array( "name"	=> __( 'Social Icon Color', 'responsive' ),
			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
			"id"	=> "social_link",
			"std"	=> "#456c81",
			"type"	=> "color");

		$of_options[] = array( "name"	=> __( 'Social Icon Hover Color', 'responsive' ),
			"desc"	=> __( 'Select your preferred color.', 'responsive' ),
			"id"	=> "social_link_hover",
			"std"	=> "#333333",
			"type"	=> "color");

		$social_links = bi_social_links();		
		foreach( $social_links as $social_link ) {
			$of_options[] = array( "name"	=> ucfirst($social_link),
				'desc'	=> ' '. __( 'Enter your ', 'responsive' ) . $social_link . __( ' url', 'responsive' ) .' <br />'. __( 'Include http:// at the front of the url.', 'responsive' ),
				'id'	=> $social_link,
				'std'	=> '#',
				'type'	=> 'text' );
		}
		//Footer
		$of_options[] = array( "name"	=> __( 'Footer', 'responsive' ),
			"type"	=> "heading");

		// $of_options[] = array( "name"	=> __( 'Footer Background Color', 'responsive' ),
		// 	"desc"	=> __( 'Select your preferred color.', 'responsive' ),
		// 	"id"	=> "footer_bg_color",
		// 	"std"	=> "#ededed",
		// 	"type"	=> "color");			
			
		// $of_options[] = array( "name"	=> __( 'Footer Text Color', 'responsive' ),
		// 	"desc"	=> __( 'Select your preferred color.', 'responsive' ),
		// 	"id"	=> "footer_text_color",
		// 	"std"	=> "#333333",
		// 	"type"	=> "color");	
			

		$of_options[] = array( "name"	=> __( 'Custom Copyright', 'responsive' ),
			"desc"	=> __( 'Add your own custom text/html for copyright region.', 'responsive' ),
			"id"	=> "custom_copyright",
			"std"	=> "",
			"type"	=> "textarea");

		// $of_options[] = array( "name"	=> __( 'Custom Powered By Text', 'responsive' ),
		// 	"desc"	=> __( 'Add your own custom text/html for powered by region.', 'responsive' ),
		// 	"id"	=> "custom_power",
		// 	"std"	=> "",
		// 	"type"	=> "textarea");

		$of_options[] = array( "name"	=> __( 'Tracking', 'responsive' ),
			"type"	=> "heading");

		$of_options[] = array( "name"	=> __( 'Header Tracking Code', 'responsive' ),
			"desc"	=> __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the header template of your theme.', 'responsive' ),
			"id"	=> "tracking_header",
			"std"	=> "",
			"type"	=> "textarea");    

		$of_options[] = array( "name"	=> __( 'Footer Tracking Code', 'responsive' ),
			"desc"	=> __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'responsive' ),
			"id"	=> "tracking_footer",
			"std"	=> "",
			"type"	=> "textarea");

		$of_options[] = array( "name"	=> __( 'Custom CSS', 'responsive' ),
			"type"	=> "heading");

		$of_options[] = array( "name"	=> __( 'Custom CSS', 'responsive' ),
			"desc"	=> __( 'Quickly add some CSS to your theme by adding it to this block.', 'responsive' ),
			"id"	=> "custom_css_box",
			"std"	=> "",
			"type"	=> "textarea"); 

// Backup Options
		$of_options[] = array( 	"name" 		=> "Backup Options",
			"type" 		=> "heading",
			);

		$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
			"id" 		=> "of_backup",
			"std" 		=> "",
			"type" 		=> "backup",
			"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
			);

		$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
			"id" 		=> "of_transfer",
			"std" 		=> "",
			"type" 		=> "transfer",
			"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
			);


		
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
