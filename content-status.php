<?php
/**
 * The default template for displaying images
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="blog-main" >
<div class="show-avatar"><?php echo get_avatar( get_the_author_meta('email') , 90 ); ?></div>
       <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
             <?php the_content(); ?>
		</a>

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
	  	
	</div> <!---end blog-main-->
	</article><!-- #post -->