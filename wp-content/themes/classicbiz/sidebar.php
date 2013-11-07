<?php global $classicbiz; ?>
<div id="sidebar">
	<!-- Spot 2 -->
	<?php if ($classicbiz->hideSpot2() !== 'true' ){ ?>
		<div class="spot">
			<?php if ($classicbiz->spot2Content() != '') : ?>
				<?php echo $classicbiz->spot2Content(); ?>
			<?php else : ?>
				<p>Replace this with your own text or code by editing <b>Spot 2</b> in the Sidebar Spots section of the <em>ClassicBiz Options</em> page. You can also hide any of the customizable spots by checking the related box in the <em>ClassicBiz Options</em>.</p>
			<?php endif; ?>			
		</div>
	<?php } ?>
	<!-- End spot 2 -->
	
	<ul>
		<?php if ( !dynamic_sidebar( 'main_sidebar' ) ): ?>
		<?php endif; ?>
	</ul>

	<!-- Spot 3 -->
	<?php if ($classicbiz->hideSpot3() !== 'true' ){ ?>
		<div class="spot">
			<?php if ($classicbiz->spot3Content() != '') : ?>
				<?php echo $classicbiz->spot3Content(); ?>
			<?php else : ?>
				<p>Show your custom content here by adding it into <b>Spot 3</b> box in the Sidebar Spots section of the <em>ClassicBiz Options</em> page.</p>
			<?php endif; ?>			
		</div>
	<?php } ?>
	<!-- End spot 3 -->
</div>
