<?php
/**
 * The default template for displaying Snippets
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
<div class="blog-main quote-main" >

      <i class="fa fa-snippet-left fa-3x fa-code"></i><h1 class="snippet"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

     <div class="snippet-code"><?php the_content(); ?></div>
<hr class="meta-hr">
     <section class="post-meta meta-options">
    <?php comments_popup_link(__('<i class="fa fa-comments"></i> 0', 'responsive'), __('<i class="fa fa-comments"></i> 1', 'responsive'), __('<i class="fa fa-comments"></i> %', 'responsive')); ?>
	  	 &nbsp;&nbsp;<i class="fa fa-tags"></i> <?php the_tags('<span class="tags-title">' . __("","standardStrap") . '</span> ', ', ',' '); ?>
	</section>
	  	
	</div> <!---end blog-main-->
	</article><!-- #post -->