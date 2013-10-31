			
			</div> <!-- end #container -->
			<footer role="contentinfo">
			
				<div class="footer-holder">
				<div class="container">
				<div class="row footer-row clearfix">
				<div class="col-md-3">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
							<?php endif; ?>	
				</div>
				<div class="col-md-3">		
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
							<?php endif; ?>
				</div>			
				<div class="col-md-3">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
							<?php endif; ?>	
				</div>
				</div>
				<div class="col-md-3">
				</div>
					
					</div>
			</footer> <!-- end footer -->
		</div>	
		
		</div> <!-- end #container -->
			<div class="copyright clearfix">
				<div class="container">

 <?php if( bi_get_data('custom_copyright') ) : ?>
       <div class="credits"> <?php echo bi_get_data('custom_copyright'); ?></div>
      <?php else : ?>
              <div class="credits">&copy; <?php _e('Copyright', 'responsive'); ?> <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?>" rel="home"><?php bloginfo('name'); ?></a></div>
            <?php endif; ?>

				</div><!-- /.container -->
			</div><!-- /#sub-floor -->
		
		<a href="#"><i class="fa fa-arrow-circle-up fa-3x to-top" id="toTop"></i></a>
		
		<?php wp_footer(); // js scripts are inserted using this function ?>
	
			</div>
<!--/#inner-wrap-->
</div>
<!--/#outer-wrap-->

			<?php wp_register_script( $handle, $src, $deps, $ver, $in_footer ); ?>
		<script type="text/javascript">
			jQuery(function() {
					jQuery("#toTop").scrollToTop(800);
				});
		</script>
		<?php if( bi_get_data('tracking_footer') ) : ?>
        <?php echo bi_get_data('tracking_footer'); ?>
            <?php endif; ?>
	</body>

</html>