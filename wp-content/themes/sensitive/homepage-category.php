 
            
<?php $tcid =(int)sensitive_get_theme_opts('home_cat_4',1); $homecategory = get_category($tcid); $category_link = get_category_link( $homecategory->term_id ); //$introcontent = strip_tags($intropage->post_content,"p,br"); if (preg_match('/^.{1,100}\b/s', $introcontent, $match)) $introcontent = $match[0];  ?> 
 
<div class="span12">
        <div class="breadcrumb home-cat" ><?php echo $homecategory->name; ?>
         
        <div class="pull-right">
                    <a href="<?php echo esc_url( $category_link ); ?>" class="btn btn-mini <?php echo sensitive_get_theme_opts('button_style','btn-info'); ?>">View All <i class="icon icon-white icon-chevron-right"></i></a>
        </div>        
        <div class="clear"></div>

 </div>        
</div> <br>
<div class="span12" >
<ul class="thumbnails">
<?php 
query_posts('posts_per_page=4&cat='.$homecategory->term_id);
$ccnt = 0;
while(have_posts()): the_post(); ?> 
<li class="span3 home-cat-single"> 
<div class="breadcrumb"><?php echo get_the_date(); ?> / by <a href="<?php $taid = get_the_author_meta( 'ID' ); echo get_author_posts_url( $taid ); ?>"><?php the_author(); ?></a></div>
<a href="<?php the_permalink(); ?>" class="thumbail">
<?php sensitive_thumb($post, array(500,300)); ?>
</a>
<div class="entry-content">
<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>&nbsp;</h2>  
</div> 
 
</li>
<?php endwhile; ?>               
</ul>
</div>


