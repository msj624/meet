<?php 

/**
 * This file contains functions which are not called directly but only through ajax
 * @package Supernova
 * @since Supenova 1.4.0
 * 
 */


/*
 * @param $meta_key, $meta_value(optional)
 * @returns number of posts $count
 * 
 */

function supernova_count_posts_by_metakey($meta_key, $meta_value=NULL){
        $count =0;
        $arg = array( 'posts_per_page' => -1, 'post_type'=>'post', 'post_status'=>'publish', 'meta_key' => $meta_key, 'meta_value'=>$meta_value);
	$the_query = new WP_Query( $arg);
        
    if ( $the_query->have_posts() ){
            while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $count++;
    }}
    wp_reset_postdata();
    
    return $count;
}


/**
 * Gets post content by post ids. If you want to change the the html of the post, you should change it here
 * @param $post_ids, $class
 * @returns html content
 * @since Supernova 1.4.0
 */

function supernova_ajax_posts_content($post_ids, $outer_class, $inner_class){           
	$the_query = new WP_Query( array( 'post__in'=>$post_ids, 'orderby'=>'post__in'));
        echo '<div class="'.$outer_class.'">';            
if ( $the_query->have_posts() ){
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
            echo '<article class="post '.$inner_class.'">';
            echo    '<h2 class="post_title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
            echo    '<div class="entry">';
            echo        '<a href="'.get_permalink().'">'.supernova_thumbnail().'</a>';            
            echo        '<p>'.the_excerpt().'</p>';
            echo    '</div>';
                    get_template_part('includes/meta');
            echo'</article>';                
}
                }
	wp_reset_postdata();            
             echo '</div>'; 
            
        }     

/*
 * Gets post ids by given variables
 * @param $posts_per_page, $offset, $orderby, $meta_key, $meta_value
 * @returns $post_ids
 */

function supernova_get_specific_post_ids($posts_per_page, $offset, $orderby, $meta_key, $meta_value){
       $post_ids = array();
       $arg = array( 'posts_per_page' => $posts_per_page, 'post_type'=>'post', 'post_status'=>'publish', 'meta_key' => $meta_key, 'meta_value'=>$meta_value,  'orderby'=>$orderby,  'offset'=>$offset);
	$the_query = new WP_Query( $arg);
        
if ( $the_query->have_posts() ){
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
                $post_ids[] = get_the_ID();
}
                }
	wp_reset_postdata();
        
        return $post_ids;            
}

/*
 * RECENT POSTS
 * Does query for more RECENT POSTS on index page
 * @returns post content
 * @since Supernova 1.4.0
 */
        
add_action('wp_ajax_supernova_load_main_posts', 'supernova_load_main_posts');       
add_action('wp_ajax_nopriv_supernova_load_main_posts', 'supernova_load_main_posts');        
function supernova_load_main_posts(){
    $paged           = intval($_POST['paged']);
    $posts_per_page  = get_option('posts_per_page ');
    $offset = ($posts_per_page)* $paged;
    $post_ids = supernova_get_specific_post_ids($posts_per_page, $offset, 'date', NULL, NULL);
     supernova_ajax_posts_content($post_ids, 'ajax_recent_posts_wrapper', 'ajax_recent_posts');
     
    die();
}


/*
 * POPULAR POSTS
* Does query for the POPULAR POSTS based on key
* @param NULL
* @returns post final content
* @since Supernova 1.4.0
*/

add_action('wp_ajax_supernova_get_popular_posts', 'supernova_get_popular_posts');
add_action('wp_ajax_nopriv_supernova_get_popular_posts', 'supernova_get_popular_posts');
function supernova_get_popular_posts(){        
        $posts_per_page = get_option('posts_per_page');
        $offset         = (isset($_POST['offset'])) ?  intval($_POST['offset']): 0;                   
        $offset         = ($offset)*($posts_per_page);
        $total_posts    = supernova_count_posts_by_metakey('supernova_post_views_count');        
        $left_posts     = (intval($total_posts) - intval($offset)) - intval($posts_per_page);
        $disabled       = ($left_posts > 0) ? '' : 'disabled = disabled'; /*Dont change order(Value is available only at this point)*/
        $left_posts     = ($left_posts > 0) ? $left_posts.__(' more', 'Supernova') : __('Sorry no more posts available, please check back later', 'Supernova');                
        $post_ids       = supernova_get_specific_post_ids($posts_per_page, $offset, 'meta_value_num', 'supernova_post_views_count', NULL);      
        supernova_ajax_posts_content($post_ids, 'ajax_popular_posts_wrapper', 'ajax_popular_posts');
        echo '<button class="popular_load_more '.$total_posts.' button '.$posts_per_page.'" title="'.$left_posts.'" '.$disabled .' >'.__('Show More', 'Supernova').'</button>';        
        die();
    }

/*
 * RECOMMENDED POSTS
* Does query for the RECOMMENDED POSTS
* @param NULL
* @returns post final content
* @since Supernova 1.4.0
*/

add_action('wp_ajax_supernova_get_recommended_posts', 'supernova_get_recommended_posts');
add_action('wp_ajax_nopriv_supernova_get_recommended_posts', 'supernova_get_recommended_posts');
function supernova_get_recommended_posts(){        
        $posts_per_page = get_option('posts_per_page ');         
        $offset         = (isset($_POST['offset'])) ?  intval($_POST['offset']): 0;
        $offset         = ($offset)*($posts_per_page);
        $total_posts    = supernova_count_posts_by_metakey('supernova-recommended-post', '1');        
        $left_posts     = (intval($total_posts) - intval($offset)) - intval($posts_per_page);                
        $post_ids       = supernova_get_specific_post_ids($posts_per_page, $offset, NULL , 'supernova-recommended-post', '1' );
        $total_pages    = ceil($total_posts/$posts_per_page); //Number of pages that would be created
        supernova_ajax_posts_content($post_ids, 'ajax_rec_posts_wrapper', 'ajax_rec_posts');
        
        if($total_posts > $posts_per_page){
        echo '<button class="rec_load_more '.$total_pages.' button" >'.__('Show More', 'Supernova').'<img class="rec_loader" src="'.SUPERNOVA_ROOT_ADMIN.'/images/loader.gif" alt="ajax-loader"></button>';        
            }
        die();
    }