<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-stacked">
		<div class="clearfix">
			<div class="searchbox">
				<input type="text" name="s" id="search" placeholder="<?php _e("Search","standardStrap"); ?>" value="<?php the_search_query(); ?>" />
			</div>
        </div>
</form>