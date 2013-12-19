<?php
/**
 * The default template for displaying image
 *
 * Author: Frederik Leksell 
 * Author URI: http://frederik.se
 * Version: 0.8.0
 * Copyright (C) 2013 Frederik leksell 
 * License: GNU General Public License, version 3 (GPLv3)
 * License URI: license.txt 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="blog-main contnet-image-post" >

       <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
       	<?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_content', 'sharing_display', 19 ); ?>
<?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_excerpt', 'sharing_display', 19 ); ?>
            <span class="lightbx featured-image-post"> <?php the_content(); ?></span>
		</a>

    <h1 class="image-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <hr class="meta-hr">
	  	<section class="post-meta meta-options">
                <i class="fa fa-clock-o"></i>
                <?php if( strlen( trim( get_the_title() ) ) == 0 ) { ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'standard' ), the_title_attribute( 'echo=0' ) ); ?>"><span class="the-time updated"><?php the_time( get_option( 'date_format' ) ); ?></span></a>
				<?php } else { ?>
					<span class="post-last-updated">
					<?php echo (''), human_time_diff(get_the_modified_date('U'), current_time('timestamp'));?> ago
					</span>
					&nbsp;&nbsp;
				<i class="fa fa-user"></i> <?php the_author_posts_link(); ?> 
				 <span class="mdash">&nbsp;&nbsp;</span>
                    <?php comments_popup_link(__('<i class="fa fa-comments"></i> 0', 'responsive'), __('<i class="fa fa-comments"></i> 1', 'responsive'), __('<i class="fa fa-comments"></i> %', 'responsive')); ?>
                        </span>
				<?php } //end if/else ?>                    
     </section>       
	  	
	</div> <!---end blog-main-->
	</article><!-- #post -->