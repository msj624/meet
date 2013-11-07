<?php 
/**
 * Content-Chat Template
 *
 *
 * @file           content-chat.php
 * @package        Appointment
 * @author         Priyanshu Mittal,Shahid Mansuri and Akhilesh Nagar
 * @copyright      2013 Appointment
 * @license        license.txt
 * @version        Release: 1.1
 * @filesource     wp-content/themes/appoinment/content-chat.php
 */


?>



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				
		<h3 class="main_title">
<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'appointment' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php $title = get_the_title();
    if (strlen($title) == 0)  _e('no title','appointment'); 
	else  echo $title; ?></a></h3>
					<ul class="the-icons clearfix">
                     
					 
						<li><i class="icon-calendar"></i> <?php the_time('M j,Y');?></li>	
						<li><i class="icon-comment"></i>  <?php  comments_popup_link( __( 'Leave a comment', 'appointment' ),__( '1 Comment', 'appointment' ), __( 'Comments', 'appointment' ),'name' ); ?></li>

						<li><i class="icon-edit"></i><?php edit_post_link( __( 'Edit', 'appointment' ), '<span class="meta-sep"></span> <span class="name">', '</span>' ); ?></li>
						 
				   <li><i class="icon-ok-circle">  </i></li> <li><?php the_category(); ?><li>
						 
					</ul>
					
					<?php if(has_post_thumbnail()):?>					
					<div class="blog_img">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
						<?php the_post_thumbnail('large',array('class' => 'img-polaroid'));?>
						</a>
					</div>
					<?php endif;?>	
					
					<?php if ( post_password_required() ) : ?>	
					<p><?php  the_content(); ?></p>
					<div class="blog_bot_mn">
						
						<span> <?php the_tags('<b>Tags:</b>','appointment');?> </span>
						
					</div>
				<?php else:?>
	<p><?php  the_excerpt(); ?></p>
	
	<?php if(wp_link_pages(array('echo'=>0))):?>
	<div class="pagination"><ul><?php 
	$args=array('before' => '<li>'.__('Pages:','appointment'),'after' => '</li>');
	wp_link_pages($args); ?></ul></div>
<?php endif;?>
		<button class="btn appo_btn" type="button">	<a href="<?php the_permalink(); ?>" class="blog_rdmore"> <?php _e('Read More','appointment'); ?> </a></button>
<p class="tag-element"> <?php the_tags('<b>'.__('Tags:','appointment').'</b>','');?> </p>
<?php endif;?>

</article>
					
					<!--blog_bot_mn-->	
				<!--blog_row_mn-->
			