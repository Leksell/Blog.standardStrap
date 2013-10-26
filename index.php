
   
   
   <?php get_header(); ?>


<div class="row row-offcanvas row-offcanvas-right">
  <div class="col-md-9">
  
<!--
<p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
-->
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="blog-main">
	<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<hr class="meta-hr">
  	<section class="post-meta meta-options">
                <i class="fa fa-clock-o"></i>
                <?php if( strlen( trim( get_the_title() ) ) == 0 ) { ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'standard' ), the_title_attribute( 'echo=0' ) ); ?>"><span class="the-time updated"><?php the_time( get_option( 'date_format' ) ); ?></span></a>
				<?php } else { ?>
					<span class="post-last-updated">
					<?php echo (''), human_time_diff(get_the_modified_date('U'), current_time('timestamp'));?> ago
					</span>
				 <span class="mdash">&nbsp;&nbsp;</span>
                    <?php comments_popup_link(__('<i class="fa fa-comments"></i> 0', 'responsive'), __('<i class="fa fa-comments"></i> 1', 'responsive'), __('<i class="fa fa-comments"></i> %', 'responsive')); ?>
                        </span>
				<?php } //end if/else ?>                    
     </section>       
			<hr class="meta-hr">
			<?php if( bi_get_data('enable_disable_featured_image','1') == '1') {?>
				<?php if ( has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                    <?php the_post_thumbnail('blog-feed-thumb'); ?>
                        </a>
                    <?php endif; ?>
            <?php } ?>
	  	<?php the_content('<button type="button" class="btn btn-primary btn-xs btn-post">Read more</button>'); ?>
	  	
	  	<hr class="meta-hr">
	  	<section class="post-meta meta-options">
	  	<i class="fa fa-tags"></i> <?php the_tags('<span class="tags-title">' . __("","standardStrap") . '</span> ', ', ',' '); ?>
	  	</section>
	  	
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