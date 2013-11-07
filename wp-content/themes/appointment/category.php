<?php 
/**
 * Category Template
 *
 *
 * @file           category.php
 * @package        Appointment
 * @author         Priyanshu Mittal,Shahid Mansuri and Akhilesh Nagar
 * @copyright      2013 Appointment
 * @license        license.txt
 * @version        Release: 1.1
 * @filesource     wp-content/themes/appoinment/category.php
 */


?>


<?php get_header(); 

	get_template_part('orange','header');
?>

		<div class="container">
			<div class="row-fluid">
			
			<div class="span12 main_space">
			<!---Main Div--->
			<div class="span8 appo_main_content">
                 <div class="row-fluid appo_blog_post"> 
                <h3 class="main_title">
                	<?php  _e( "Category  Archives : ", 'appointment' ); echo single_cat_title( '', false ); ?>
                            
			
               </h3><!--page_blog_row_mn-->
                 </div>
                   <?php    while(have_posts()): the_post();?>
                      
                      <h3><a class="blog_title-anchor" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'appointment' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php $title = get_the_title();
    if (strlen($title) == 0)  _e('no title','appointment'); 
	else  echo $title; ?></a>
	</h3>
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
					<p><?php  the_excerpt(); ?></p>
					<?php if(wp_link_pages(array('echo'=>0))):?>
					<div class="pagination"><ul><?php 
					 $args=array('before' => '<li>'.__('Pages:','appointment'),'after' => '</li>');
					 wp_link_pages($args); ?></ul>
                     </div><!--pagination_blog-->
					 <?php endif;?>
					<div class="blog_bot_mn">
						
					<button class="btn appo_btn" type="button">	<a href="<?php the_permalink(); ?>" class="blog_rdmore"> <?php _e('Read More','appointment'); ?> </a></button>
					<p class="tag-element"> <?php the_tags('<b>'.__('Tags:','appointment').'</b>','');?> 
					</p>
					</div><!--blog_bot_mn-->
				<!--blog_row_mn-->
				
				<?php endwhile;?>		 
				 
	           <?php 
				global $wp_query;
				// post pagination
				$args = array(
	'base'         => add_query_arg( 'paged', '%#%' ),
	'format'       => '',
	'total'		   => $wp_query->max_num_pages,
	'current'      => 0,
	'show_all'     => true,
	'end_size'     => 1,
	'mid_size'     => 1,
	'prev_next'    => True,
	//'prev_text'    => __('« Previous'),
	//'next_text'    => __('Next »'),
	'type'         => 'list',
	'add_args'     => False,
	'add_fragment' => ''
); ?>
<?php if($wp_query->max_num_pages != 1 ):?>
   <div class="pagination"><?php _e("Scroll More Posts:",'appointment') ?><?php echo paginate_links( $args ); ?> </div>
   <?php endif;?>
            	
				</div>
				<?php get_sidebar();?>
				</div>
				
			</div>
			
			</div><!--blog_right_bg_mn_con-->
<!--page_wi-->
<?php get_footer();?>


