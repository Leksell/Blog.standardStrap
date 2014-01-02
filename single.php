<?php
/**
 * Author: Frederik Leksell 
 * Author URI: http://frederik.se
 * Version: 0.8.0
 * Copyright (C) 2013 Frederik leksell 
 * License: GNU General Public License, version 3 (GPLv3)
 * License URI: license.txt 
 */

get_header(); ?>

		<div class="row row-offcanvas row-offcanvas-right">
		  <div class="col-md-9">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>
				

					
						<!--- Share Buttons here -->
						<div class="page-main">
							
							<div class="social-button-container">
								<div class="SocialCustomMenu">
									<a class="scmTwitter" href="http://twitter.com/home?status=<?php the_title();?> - <?php echo wp_get_shortlink();?> by @FrederikLeksell"title="Tweet this!" target="_blank">Twitter</a>
									<a class="scmLinkedIN" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>&amp;title=<?php the_title();?>&amp;summary=via @frederikleksell" target="_blank" title="Share on LinkedIn!">LinkedIn</a>
									<a class="scmGoogleplus" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"onclick="javascript:window.open(this.href,
									  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600px,width=600px');return false; "title="Share on Google +">Google +</a>
									<!-- <a class="scmPinterest" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?> - <?php echo wp_get_shortlink();?> "title="Share on Pinterest!">Pinterest</a> -->
								</div>

							</div>

						</div>
					
					
					<div class="single-main">
					<div class="related-psots-box">


					    <div class="relatedposts clearfix">  
						    <h4>Related posts</h4>  
						    <?php  
						        $orig_post = $post;  
						        global $post;  
						        $tags = wp_get_post_tags($post->ID);  
						          
						        if ($tags) {  
						        $tag_ids = array();  
						        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
						        $args=array(  
						        'tag__in' => $tag_ids,  
						        'post__not_in' => array($post->ID),  
						        'posts_per_page'=>3, // Number of related posts to display.  
						        'caller_get_posts'=>1  
						        );  
						          
						        $my_query = new wp_query( $args );  
						      
						        while( $my_query->have_posts() ) {  
						        $my_query->the_post();  
						        ?>  
						          
						        <div class="relatedheading">  
						            <a  rel="external" href="<? the_permalink()?>">  
										<i class="fa fa-angle-right float-left"></i><div class="related-h3 h3 "><?php the_title(); ?></div> 
						            </a>  
						        </div>  
						          
						    
						        <? }  
						        }  
						        $post = $orig_post;  
						        wp_reset_query();  
						        ?>  
						    </div>  
					
					</div>
			
					</div> <!-- end #main -->
					<div class="single-main">
					    <?php if ( did_action( 'jetpack_comments_loaded' ) ) : ?>
					    <?php comment_form(); ?>
					    <?php else: ?>
					    <?php comment_form(); ?><!-- here comes default theme's comment form -->
					    <?php endif; ?>
					</div> <!-- end single-main -->
					
			

			<?php endwhile; ?>

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>


