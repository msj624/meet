
<div class="site-search">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="form-inline" id="searchform" role="search">
		<fieldset>
			<div class="input-group">
				<input type="search" value="<?php echo esc_attr( get_search_query() ); ?>" class="input-medium form-control" id="search" name="s">
				<span class="input-group-btn">
					<span class="btn btn-primary search-submit-button nowrap"><i class="icon-search"></i> <?php echo esc_attr( __( 'Search', 'activetab' ) ); ?></span>
					<!-- <input type="submit" value="<?php echo esc_attr( __( 'Search', 'activetab' ) ); ?>" class="btn btn-default"> -->
				</span>
			</div>
		</fieldset>
	</form>
</div>
