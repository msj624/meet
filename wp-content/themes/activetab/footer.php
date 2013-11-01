

</div> <!-- /#main /.site-main -->

</div> <!-- /.row -->


<footer id="colophon" class="site-footer clearfix" role="contentinfo">

	<div class="row">

		<div class="col-lg-8">
			<div class="site-footer-left">

				<?php if ( ! dynamic_sidebar( 'footer' ) ) : // footer widgetized area ?>

					<?php
						$description = '';
						if ( get_bloginfo( 'description' ) ){
							$description .= ' | '.esc_attr( get_bloginfo( 'description', 'display' ) );
						}
						echo '&copy; '.date( 'Y' ).' ';
						echo '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).$description.'" rel="home">'.get_bloginfo( 'name' ).'</a>';
					?>

				<?php endif; // end of the footer widgetized area ?>

			</div> <!-- /.site-footer-left -->
		</div> <!-- /.col-lg-8 -->

		<div class="col-lg-4">
			<div class="site-footer-right text-right">

				<?php if ( is_home() || is_front_page() ) : // show credit links only on homepage
					// it is completely optional, but if you like the theme I would appreciate it if you keep the credit link at the bottom ?>
					<?php _e( 'Powered by', 'activetab' ); ?>
					<a href="http://wordpress.org/" title="<?php _e( 'WordPress CMS', 'activetab' ); ?>" rel="generator"><?php _e( 'WordPress', 'activetab' ); ?></a><?php _e( ', ', 'activetab' ); ?>
					<a href="http://web-profile.com.ua/wordpress/themes/activetab/" title="<?php _e( 'activetab theme', 'activetab' ); ?>" rel="designer"><?php _e( 'activetab', 'activetab' ); ?></a>
				<?php endif; ?>

				<?php if ( ! is_home() && ! is_front_page() ) : // show rss links everywhere except homepage ?>
					<a href="<?php echo esc_url( get_bloginfo( 'rss2_url' ) ); ?>" class="rss-feed-link rss-feed-link-posts" title="<?php echo esc_attr( __( 'Posts RSS feed', 'activetab' ) ); ?>"></a>
					<a href="<?php echo esc_url( get_bloginfo( 'comments_rss2_url' ) ); ?>" class="rss-feed-link rss-feed-link-comments" title="<?php echo esc_attr( __( 'Comments RSS feed', 'activetab' ) ); ?>"></a>
				<?php endif; ?>

			</div> <!-- /.site-footer-right -->
		</div> <!-- /.col-lg-4 -->

	</div> <!-- /.row -->


</footer> <!-- /#colophon /.site-footer -->

</div> <!-- /.col-lg-12 -->
</div> <!-- /.row -->
</div> <!-- /.site-wrapper -->
</div> <!-- /.container -->

</div> <!-- /#page /.hfeed -->

<?php wp_footer(); // wp_footer() should be just before the closing </body> tag, or many plugins will be broken  ?>

</body>

</html>