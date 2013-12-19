<!-- 
 * Author: Frederik Leksell
 * Author URI: http://frederik.se
 * Version: 0.8.0
 * Copyright (C) 2013 Frederik leksell 
 * License: GNU General Public License, version 3 (GPLv3)
 * License URI: license.txt 
  -->


<?php get_header(); ?>
			
			<div class="row">
			
				<div id="main" class="col-md-9 clearfix" role="main">
				
					<div class="archive-header">
					<?php if (is_category()) { ?>
						<h3 class="archive_title h3">
							<span><?php _e("Posts Categorized:", "standardStrap"); ?></span> <?php single_cat_title(); ?>
						</h3>
					<?php } elseif (is_tag()) { ?> 
						<h3 class="archive_title h3">
							<span><?php _e("Posts Tagged:", "standardStrap"); ?></span> <?php single_tag_title(); ?>
						</h3>
					<?php } elseif (is_author()) { ?>
						<h3 class="archive_title h3">
							<span><?php _e("Posts By:", "standardStrap"); ?></span> <?php get_the_author_meta('display_name'); ?>
						</h3>
					<?php } elseif (is_day()) { ?>
						<h3 class="archive_title h3">
							<span><?php _e("Daily Archives:", "standardStrap"); ?></span> <?php the_time('l, F j, Y'); ?>
						</h3>
					<?php } elseif (is_month()) { ?>
					    <h3 class="archive_title h3">
					    	<span><?php _e("Monthly Archives:", "standardStrap"); ?>:</span> <?php the_time('F Y'); ?>
					    </h3>
					<?php } elseif (is_year()) { ?>
					    <h3 class="archive_title h3">
					    	<span><?php _e("Yearly Archives:", "standardStrap"); ?>:</span> <?php the_time('Y'); ?>
					    </h3>
					<?php } ?>
					</div>

					<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'excerpt', get_post_format() ); ?>
			<?php endwhile; ?>

		

		<?php else : ?>
			<?php get_template_part( 'excerpt', 'none' ); ?>
		<?php endif; ?>
	  	
	<?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <nav>
        <ul class="pager">
			<li class="previous"><?php next_posts_link( __( '&#8249; Older posts', 'responsive' ) ); ?></li>
            <li class="next"><?php previous_posts_link( __( 'Newer posts &#8250;', 'responsive' ) ); ?></li>
		</ul><!-- end of .navigation -->
        </nav>
        <?php endif; ?>
	
</div> 

    <?php get_sidebar(); ?>

</div> 

<?php get_footer(); ?>