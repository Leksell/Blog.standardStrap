
     <div id="default-sidebar" class="sidebar col-md-3 offcanvas-diplay-none" role="complementary">
			<div class="margin-sidebar">
				<?php if ( is_active_sidebar( 'sidebar2' ) ) : ?>

					<?php dynamic_sidebar( 'sidebar2' ); ?>

					<?php else : ?>

					<!-- This content shows up if there are no widgets defined in the backend. -->
				
					There is no sidebar widget configured.

				<?php endif; ?>
			</div>
		</div>