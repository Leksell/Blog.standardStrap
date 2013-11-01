<!-- 
 * Author: Frederik Leksell
 * Author URI: http://frederik.se
 * Version: 0.8.0
 * Copyright (C) 2013 Frederik leksell 
 * License: GNU General Public License, version 3 (GPLv3)
 * License URI: license.txt 
  -->
       
      <div id="default-sidebar" class="sidebar col-md-3 offcanvas-diplay-none" role="complementary">
			<div class="margin-sidebar">
				<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

					<?php dynamic_sidebar( 'sidebar1' ); ?>

					<?php else : ?>

					<!-- This content shows up if there are no widgets defined in the backend. -->
				
					There is no sidebar widget configured.

				<?php endif; ?>
			</div>
		</div>