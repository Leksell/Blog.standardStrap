<?php get_header(); ?>
			
			<div class="row">
			
				<div id="main" class="col-md-9 clearfix" role="main">

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
				</div> <!-- end #main -->
    
				<?php get_sidebar( 'pages' ); // sidebar-pages ?>
    </div>
			</div> <!-- end #content -->

<?php get_footer(); ?>