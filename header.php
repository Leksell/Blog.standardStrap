<!-- 
 * Author: Frederik Leksell
 * Author URI: http://frederik.se
 * Version: 0.8.0
 * Copyright (C) 2013 Frederik leksell 
 * License: GNU General Public License, version 3 (GPLv3)
 * License URI: license.txt 
  -->
	
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="resource-type" content="document" />
		<meta http-equiv="content-language" content="en-us" />
		<meta name="author" content="Frederik Leksell" />
		<meta name="contact" content="info@frederik.se" />
		<meta name="copyright" content="Copyright (c)2013 
		Frederik Leksell. All Rights Reserved." />

		<?php global $post;
			if( is_single() || is_page() ) :
				$tags = get_the_tags($post->ID);
				if($tags) :
			foreach($tags as $tag) :
				$sep = (empty($keywords)) ? '' : ', ';
				$keywords .= $sep . $tag->name;
			endforeach;
		?>
		<meta name="keywords" content="<?php echo $keywords; ?>" />
		<?php
			endif;
		endif;
		?>
	
	<title>
		   <?php
  			global $page, $paged;
  			wp_title('|', true, 'right');
  			bloginfo('name');
  			$site_description = get_bloginfo('description', 'display');
  			if ($site_description && (is_home() || is_front_page())) { echo " | $site_description"; }
  			if ( $paged >= 2 || $page >= 2 ) { echo ' | ' . sprintf('Page %s', max($paged, $page)); }
  			?>
	</title>
		<!-- <meta name="ke" -->
		<meta name="description" content="<?php
if( is_single() || is_page() ) :
$text = get_post_meta($post->ID,'_custom_meta_desc',true);
if(!$text) $text = ($post->post_excerpt) ? $post->post_excerpt : substr($post->post_content, 0, 200).'...';
echo esc_attr(strip_tags(apply_filters('get_the_excerpt',$text)));
else :
/* optional area to program meta descriptions for index and archive pages, etc */
endif; ?>" />





			<?php if( bi_get_data('custom_favicon') !== '' ) : ?>
				<link rel="icon" type="image/png" href="<?php echo bi_get_data('custom_favicon'); ?>" />
			<?php endif; ?>
			<?php if( bi_get_data('terminal_icon') !== '' ) : ?>
				<link rel="apple-touch-icon-precomposed" href="<?php echo bi_get_data('terminal_icon'); ?>">
				<link rel="shortcut icon" href="<?php echo bi_get_data('terminal_icon'); ?>">
			<?php endif; ?>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php wp_enqueue_script("jquery"); ?>
		<?php if( bi_get_data('tracking_header') ) : ?>
        <?php echo bi_get_data('tracking_header'); ?>
            <?php endif; ?>


		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
	

	</head>
	
	<body <?php body_class(); ?>>

		<!-- If landingpage, remove menu -->	
<?php if ( is_page_template('page-landingpage.php') ) {} else { ?>

	
	
	<div id="outer-wrap">
<div id="inner-wrap">
<header id="top" role="banner">
		
			<div id="inner-header" class="clearfix">
				
				<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="container">
		<div class="navbar-header">
          
			
            <?php if( bi_get_data('custom_logo') !== '' ) { ?>
            <div id="logo"><a href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ); ?>" rel="home">
                <img src="<?php echo bi_get_data('custom_logo'); ?>" alt="<?php bloginfo( 'name' ) ?>" />
            </a></div>
            <?php } else { ?>
            <?php if (is_front_page()) { ?>
            <a class="navbar-brand" href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="homepage"><?php bloginfo( 'name' ) ?></a>
            <?php } else { ?>
            <a class="navbar-brand" href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="homepage"><?php bloginfo( 'name' ) ?></a>
            <?php } } ?>

		</div>
		<a id="nav-open-btn" href="#nav"><i class="fa fa-reorder fa-lg"></i></a>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<?php
				wp_nav_menu( array(
					'menu'       => 'top_navigation',
					'theme_location' => 'top_navigation',
					'depth'      => 2,
					'container'  => false,
					'menu_class' => 'nav navbar-nav',
					'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
					'walker' => new wp_bootstrap_navwalker())
				);
			?>
			
		</div>
	</div>
</nav>			
			</div> <!-- end #inner-header -->
		
		</header> <!-- end header -->
		
		 <nav id="nav" role="navigation">
		 <a class="" id="nav-close-btn" href="#top"><i class="fa fa-times-circle-o fa-2x"></i></a>
        <div class="block is-active">
        
            <div class="margin-sidebar mobile-navbar">
				<?php if ( is_active_sidebar( 'sidebar3' ) ) : ?>

					<?php dynamic_sidebar( 'sidebar3' ); ?>

					<?php else : ?>

					<!-- This content shows up if there are no widgets defined in the backend. -->
				
					You have not configured you mobile menu. Go to Admin, Appearance -> Widgets and configure you Mobile Menu.

				<?php endif; ?>
			</div>           
			
        </div>
    </nav>
		<?php } ?> <!-- end remove landingpage menu-->
<div class="container">
   <div id="wrapper" class="clearfix">
 
 
 
 
 