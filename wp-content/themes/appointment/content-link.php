<?php 
/**
 * Content-Link  Template
 *
 *
 * @file           content-link.php
 * @package        Appointment
 * @author         Priyanshu Mittal,Shahid Mansuri and Akhilesh Nagar
 * @copyright      2013 Appointment
 * @license        license.txt
 * @version        Release: 1.1
 * @filesource     wp-content/themes/appoinment/content-link.php
 */


?>




<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<h3 class="main_title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'appointment' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php $title = get_the_title();
    if (strlen($title) == 0)  _e('no title','appointment'); 
	else  echo $title; ?></a></h3>
			
			<ul class="the-icons clearfix">
                     
					 
						<li><i class="icon-calendar"></i> <?php the_time('M j,Y');?></li>	
						<li><i class="icon-comment"></i>  <?php  comments_popup_link( __( 'Leave a comment', 'appointment' ),__( '1 Comment', 'appointment' ), __( 'Comments', 'appointment' ),'name' ); ?></li>

						<li><i class="icon-edit"></i><?php edit_post_link( __( 'Edit', 'appointment' ), '<span class="meta-sep"></span> <span class="name">', '</span>' ); ?></li>
						 
					   <li><i class="icon-ok-circle">  </i></li> <li><?php the_category(); ?><li>
						 
			</ul>
 
 
 
 
 
		 <div class="blog_con_mn">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'appointment' ) ); ?>
		</div>
  <footer class="entry-meta">
		
			<?php if ( comments_open() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'appointment' ) . '</span>', __( '1 Reply', 'appointment' ), __( '% Replies', 'appointment' ) ); ?>
			</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'appointment' ), '<span class="edit-link">', '</span>' ); ?>
</footer><!-- .entry-meta -->
		 <div class="blog_bot_mn">
						
						<button class="btn appo_btn" type="button">	<a href="<?php the_permalink(); ?>" class="blog_rdmore"> <?php _e('Read More','appointment'); ?> </a></button>
<p class="tag-element"> <?php the_tags('<b>'.__('Tags:','appointment').'</b>','');?> </p>
					</div><!--blog_bot_mn-->

	</article><!-- #post -->