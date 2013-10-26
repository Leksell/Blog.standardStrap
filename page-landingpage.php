<?php
/**
 * Landing Page Template
 *
   Template Name:  Landing Page 
 *
 * @file           landing-page.php
 * @package        StandardStrap 
 * @author         Frederik Leksell 
 * @copyright      2013 Frederik Leksell
 * @license        license.txt
 * @version        Release: 1.0.0
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>

<div class="row">
        <div class="col-md-12 box drop-shadow page-landing">
        <div id="landing-content-full">
        
<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
        
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header>
						<?php if( bi_get_data('enable_disable_featured_image','1') == '1') {?>
								<?php the_post_thumbnail('blog-thumb'); ?>
						<?php } ?>
							<div class="page-header"><h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1></div>
							
				
							<hr class="meta-hr">

						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
						

							<?php the_content(); ?>

					
						</section> <!-- end article section -->
            </article><!-- end of #post-<?php the_ID(); ?> -->
                        
        <?php endwhile; ?> 
       
<?php endif; ?>  
      
        </div><!-- end of #content-full -->
    </div>
</div>
</div>
