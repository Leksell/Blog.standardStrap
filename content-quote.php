<?php
/**
 * The default template for displaying images
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="blog-main quote-main" >

      <i class="fa fa-quote-left fa-3x quote-icons"></i><h1 class="quote"><?php the_title(); ?></h1>
     <div class="quoter"><?php the_content(); ?></div>

    
	  	
	</div> <!---end blog-main-->
	</article><!-- #post -->