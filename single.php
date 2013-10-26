<?php get_header(); ?>

			<div class="row">
				<div id="main" class="col-md-9 clearfix single-mai" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="single-main">
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<header>
						<?php if( bi_get_data('enable_disable_featured_image','1') == '1') {?>
								<?php the_post_thumbnail('blog-thumb'); ?>
						<?php } ?>
							<div class="page-header"><h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1></div>
							
				<hr class="meta-hr">
				  	<section class="post-meta meta-options">
				                <i class="icon-time"></i>
				                <?php if( strlen( trim( get_the_title() ) ) == 0 ) { ?>
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'standard' ), the_title_attribute( 'echo=0' ) ); ?>"><span class="the-time updated"> 
									<?php the_time( get_option( 'date_format' ) ); ?></span></a>
								<?php } else { ?>
									<span class="post-last-updated">
									<?php echo (''), human_time_diff(get_the_modified_date('U'), current_time('timestamp'));?> ago&nbsp;&nbsp; <i class="icon-user"></i> <?php the_author_posts_link(); ?>
									</span>
								<?php if ( comments_open() ) : ?>
                        <span class="comments-link">
                        <span class="mdash">&nbsp;&nbsp;</span>
                    <?php comments_popup_link(__('<i class="icon-comments"></i> 0', 'responsive'), __('<i class="icon-comments"></i> 1', 'responsive'), __('<i class="icon-comments"></i> %', 'responsive')); ?>
                        </span>
                        
                    <?php endif; ?>
								<?php } //end if/else ?>                    
				     </section>       
							<hr class="meta-hr">

						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
						
<?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_content', 'sharing_display', 19 ); ?>
<?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_excerpt', 'sharing_display', 19 ); ?>

							<?php the_content(); ?>
							
							<?php wp_link_pages(); ?>
					
						</section> <!-- end article section -->
						
						<footer>
			
							
							<?php 
							// only show edit button if user has permission to edit posts
							if( $user_level > 0 ) { 
							?>
							<a href="<?php echo get_edit_post_link(); ?>" class="btn btn-success edit-post"><i class="icon-pencil icon-white"></i> <?php _e("Edit post","standardStrap"); ?></a>
							<?php } ?>
							
						</footer> <!-- end article footer -->
					 
					 <hr class="meta-hr meta-hr-margin">
								<section class="post-meta-bottom meta-options">
									<i class="icon-tags"></i> <?php the_tags('<span class="tags-title">' . __("","standardStrap") . '</span> ', ', ',' '); ?>
								</section>
					 
					</article> <!-- end article -->
					</div> <!-- end #main -->
					
					<div class="single-main">
						<!--- Share Buttons here  ---->
						<?php echo sharing_display(); ?>
					</div> <!-- end #main -->
					
					
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
										<i class="icon-angle-right float-left"></i><div class="related-h3 h3 "><?php the_title(); ?></div> 
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
					</div> <!-- end single-main--->
					<?php endwhile; ?>			
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "standardStrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "standardStrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php get_sidebar(); // sidebar ?>
    </div>
			</div> <!-- end #content -->

<?php get_footer(); ?>