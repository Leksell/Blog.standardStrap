<?php
/**
 * The default template for displaying content
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="blog-main" >
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
           
            <?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_content', 'sharing_display', 19 ); ?>
		<?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_excerpt', 'sharing_display', 19 ); ?>
		
	  	<?php the_content('<button type="button" class="btn btn-primary btn-xs btn-post">Read more</button>'); ?>
	  	
	  	<hr class="meta-hr">
	  	<section class="post-meta meta-options">
	  	<i class="fa fa-tags"></i> <?php the_tags('<span class="tags-title">' . __("","standardStrap") . '</span> ', ', ',' '); ?>
	  	</section>
	  	
	</div> <!---end blog-main-->
	</article><!-- #post -->
