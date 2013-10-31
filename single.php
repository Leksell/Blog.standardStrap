<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

		<div class="row row-offcanvas row-offcanvas-right">
		  <div class="col-md-9">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>
				

					
						<!--- Share Buttons here -->
						<?php if ( function_exists( 'sharing_display' ) ) { echo '<div class="page-main">' . sharing_display() . '</div>' ; } ?>
					
					
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
					
					<?php comments_template('',true); ?>
					</div> <!-- end single-main -->
					
			

			<?php endwhile; ?>

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>


