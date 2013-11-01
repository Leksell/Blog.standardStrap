<?php
/*
 *Template Name: Full Width Page
 *
 * Author: Frederik Leksell 
 * Author URI: http://frederik.se
 * Version: 0.8.0
 * Copyright (C) 2013 Frederik leksell 
 * License: GNU General Public License, version 3 (GPLv3)
 * License URI: license.txt 
 */
?>

<?php get_header(); ?>
			
			<div class="row">
			
				<div id="main" class="col-md-12 clearfix" role="main">

					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="page-main">
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" >
						
						<header>
						<?php if( bi_get_data('enable_disable_featured_image','1') == '1') {?>
								<?php the_post_thumbnail('blog-thumb'); ?>
						<?php } ?>
							<div class="page-header"><h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1></div>
							
				
							<hr class="meta-hr">

						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
						
<?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_content', 'sharing_display', 19 ); ?>
<?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_excerpt', 'sharing_display', 19 ); ?>

							<?php the_content(); ?>

					
						</section> <!-- end article section -->
						
										
					</article> <!-- end article -->
				
					
					<?php endwhile; ?>		
					
										
					<?php endif; ?>
					
					

					</div> <!-- end page-main -->
					<div class="page-main">
						<!--- Share Buttons here  ---->
						<?php echo sharing_display(); ?>
					</div> <!-- end #main -->
					
				
					</div> <!-- end page-main -->
				</div> <!-- end #main -->
   
    
			</div> <!-- end #content -->

<?php get_footer(); ?>