			
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
				<div class="credits">&copy; Copyright <?php echo date("Y") ?> by Frederik Leksell</div>			
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
	</body>

</html>