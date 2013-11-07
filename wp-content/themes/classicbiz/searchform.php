<form method="get" class="searchform" action="<?php echo esc_url( $_SERVER['PHP_SELF'] ); ?>">
	<div class="searchfields">
		<input type="text" value="<?php esc_attr_e( the_search_query() ); ?>" name="s" class="s" />
		<input type="submit" class="searchsubmit" value="Search" />
	</div>
</form>