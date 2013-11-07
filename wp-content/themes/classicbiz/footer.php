<?php global $classicbiz; ?>
		<div style="clear: both; height: 20px;">&nbsp;</div>
	<!-- Spot 4 -->		
	<?php if ($classicbiz->hideSpot4() !== 'true' ){ ?>		
		<div id="two-cols">
			<div class="col1">
				<?php if ($classicbiz->spot4Content() != '') : ?>
					<?php echo $classicbiz->spot4Content(); ?>
				<?php else : ?>			
					<p>Replace this with your own text by editing <b>Spot 4</b> in the Footer section of the <em>ClassicBiz Options</em> page. You can also hide this whole section by checking the corresponding box in the <em>ClassicBiz Options</em>.</p>			
				<?php endif; ?>	
			</div>
			<div class="col2">
				<ul>
					<?php if ( !dynamic_sidebar( 'main_footer' ) ): ?>
					<?php endif; ?>
				</ul>	
			</div>
		</div>
		<div style="clear: both;">&nbsp;</div>
	<?php } ?>
	<!-- End spot 4 -->		
	</div>
</div>
<!-- End page -->

<div id="footer">
	<p>Copyright &copy; <?php echo date('Y'); ?>
	<a href="<?php echo home_url(); ?>">
		<?php if ($classicbiz->copyrightName() != '') : ?>
			<?php echo $classicbiz->copyrightName(); ?>
		<?php else : ?>
            <?php bloginfo( 'name'); ?>
		<?php endif; ?></a><br />		
		Designed by <?php $classicbiz_theme=wp_get_theme(); echo $classicbiz_theme['Author']; ?>. Powered by <a href="http://wordpress.org/">WordPress</a>.
	</p>
	<?php
		if ($classicbiz->statisticsCode() != '') {
			echo $classicbiz->statisticsCode();
		}
	?>
</div>
	<?php wp_footer(); ?>	
</body>
</html>