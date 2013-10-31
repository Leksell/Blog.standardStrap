<?php
/**
 * The default template for displaying images
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="blog-main" >
		<div class="formatlink">
			<?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_content', 'sharing_display', 19 ); ?>
<?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_excerpt', 'sharing_display', 19 ); ?>
      <i class="fa fa-link fa-3x format-link"></i><h2 class="entry-title"><a href="<?php echo get_the_content(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
    </div>
    
	  	
	</div> <!---end blog-main-->
	</article><!-- #post -->