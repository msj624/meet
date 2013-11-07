	<!-- Header Strip -->
	<div class="hero-unit-small">
		<div class="container">
			<div class="row-fluid about_space">
				<div class="span12">
					<div class="span8">
					<h2 class="about_head"><?php bloginfo('title');?></h2>
					<p class="about_p"><?php bloginfo('description');?><p>
					</div>
					<div class="span4 ">
						<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<div class="input-append search_head">
					  <input type="text" class="search-query" name="s"  placeholder="<?php _e( 'Search', 'appointment' ); ?>" />
					     <!-- <input type="submit" class="search_btn_submit" name="submit"  value="" />-->
						</div>
			            </form>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<!-- /Header Strip -->