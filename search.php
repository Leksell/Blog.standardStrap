<?php get_header(); ?>
			
			<div class="row">
			
				<div id="main" class="col-md-9 clearfix" role="main">
				
					<div class="search-header"><h3 class="search-title"><span><?php _e("Search Results for","standardStrap"); ?>:</span> <?php echo esc_attr(get_search_query()); ?></h3></div>

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="blog-main">
	<?php get_template_part( 'excerpt', get_post_format() ); ?>
	  	
	</div> <!---end blog-main--->
	<?php endwhile; else: ?>
		<p><?php _e('Sorry, this page does not exist.'); ?></p>
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
</div>

<?php get_footer(); ?>