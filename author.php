
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
				
					<div class="author-header"><h3 class="archive_title h3">
						<span><?php _e("Posts By:", "standardStrap"); ?></span> 
						<?php 
							// If google profile field is filled out on author profile, link the author's page to their google+ profile page
							$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
							$google_profile = get_the_author_meta( 'google_profile', $curauth->ID );
							if ( $google_profile ) {
								echo '<a href="' . esc_url( $google_profile ) . '" rel="me">' . $curauth->display_name . '</a>'; 
						?>
						<?php 
							} else {
								echo get_the_author_meta('display_name', $curauth->ID);
							}
						?>
					</h3></div>
					
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
