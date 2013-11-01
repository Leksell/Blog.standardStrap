<!-- 
 * Author: Frederik Leksell
 * Author URI: http://frederik.se
 * Version: 0.8.0
 * Copyright (C) 2013 Frederik leksell 
 * License: GNU General Public License, version 3 (GPLv3)
 * License URI: license.txt 
  -->

<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-stacked">
		<div class="clearfix">
			<div class="searchbox">
				<input type="text" name="s" id="search" placeholder="<?php _e("Search","standardStrap"); ?>" value="<?php the_search_query(); ?>" />
			</div>
        </div>
</form>