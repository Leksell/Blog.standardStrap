<!-- 
 * Author: Frederik Leksell
 * Author URI: http://frederik.se
 * Version: 0.8.0
 * Copyright (C) 2013 Frederik leksell 
 * License: GNU General Public License, version 3 (GPLv3)
 * License URI: license.txt 
  -->
  
<?php get_header(); ?>

<div class="row row-offcanvas row-offcanvas-right">
<div class="col-md-12">
	 
<?php
$args = array( 'numberposts' => 1, );
$postslist = get_posts( $args );
foreach ($postslist as $post) :  setup_postdata($post); ?> 
   <?php get_template_part( 'content', get_post_format() ); ?>
<?php endforeach; ?>
	
</div>
</div>
<div class="row">
  <div class="col-md-9">
  

	<?php query_posts('posts_per_page=6&offset=1'); if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
	
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

		

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
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
