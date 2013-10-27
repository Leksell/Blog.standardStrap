<?php
/**
 * The default template for displaying images
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="blog-main" >
		<div class="formatlink">
      <i class="fa fa-link fa-3x format-link"></i><h2 class="entry-title"><a href="<?php echo get_the_content(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
    </div>
    <hr class="meta-hr">
	  	<section class="post-meta meta-options">
                <i class="fa fa-clock-o"></i>
                <?php if( strlen( trim( get_the_title() ) ) == 0 ) { ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'standard' ), the_title_attribute( 'echo=0' ) ); ?>"><span class="the-time updated"><?php the_time( get_option( 'date_format' ) ); ?></span></a>
				<?php } else { ?>
					<span class="post-last-updated">
					<?php echo (''), human_time_diff(get_the_modified_date('U'), current_time('timestamp'));?> ago
					</span>
				<?php } //end if/else ?>                    
     </section>       
	  	
	</div> <!---end blog-main-->
	</article><!-- #post -->