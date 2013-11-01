<?php
/**
 * The default template for displaying Quotes
 *
 * Author: Frederik Leksell 
 * Author URI: http://frederik.se
 * Version: 0.8.0
 * Copyright (C) 2013 Frederik leksell 
 * License: GNU General Public License, version 3 (GPLv3)
 * License URI: license.txt 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="blog-main quote-main" >

      <i class="fa fa-quote-left fa-3x quote-icons"></i><h1 class="quote"><?php the_title(); ?></h1>
      <?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_content', 'sharing_display', 19 ); ?>
<?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_excerpt', 'sharing_display', 19 ); ?>
     <div class="quoter"><?php the_content(); ?></div>

    
	  	
	</div> <!---end blog-main-->
	</article><!-- #post -->