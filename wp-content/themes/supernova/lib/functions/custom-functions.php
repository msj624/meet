<?php 
/* 
 * Gets the list of pages in select
 * @param $supernova_page_type
 * @param $supernova_pagelist_settings
 * @param $supernova_pagelist_options
 * Example: supernova_page_list('page', 'supernova_settings[featured_item_page_id'.$i.']', $supernova_options['featured_item_page_id'.$i]);
*/

function supernova_page_list($supernova_page_type, $supernova_pagelist_settings, $supernova_pagelist_options){
	global $wpdb;
	$page_results= $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type='$supernova_page_type' AND post_status='publish'  ORDER BY menu_order", 'OBJECT');		
	?>
	<select name="<?php echo $supernova_pagelist_settings ?>">
		<option value="<?php echo $supernova_pagelist_options; ?>"><?php if(trim($supernova_pagelist_options)){ echo get_the_title($supernova_pagelist_options);}else{ echo "------select ".$supernova_page_type."------";} ?></option>
                <option value=""><?php if(trim($supernova_pagelist_options)=='blank'){ echo '';} ?></option>
                <?php if ( $page_results ) : foreach ( $page_results as $pages ) : ?>
                        <option value="<?php echo $pages->ID; ?>">
                        <?php echo supernova_chopper($pages->post_title, 40);?>	
                        </option>
        <?php endforeach; endif; ?>
        </select>             
	<?php
	}

/*
 *Cuts off any string 
 *@param $string
 *@return $string
*/
function supernova_chopper($string, $limit){
	$string = (strlen($string) > $limit) ? substr($string,0,$limit).'...' : $string;
	return $string;
	}	

/* 
 * Returns script for the slider bar in admin
 * @param $slider_class
 * @param $result_class
 * @param $hidden_id
 * @param $slider_bar_value
 * @param $slider_default
 * @param $min_value 
 * @param $max_value
*/

function supernova_slider_bar_settings($slider_class, $result_class, $hidden_id, $slider_bar_value, $slider_default, $min_value, $max_value){
	?>
	<script>
        jQuery( ".<?php echo $slider_class; ?>" ).slider({
                animate: true,
                range: "min",
                value: <?php if($slider_bar_value){ echo $slider_bar_value;}else{echo $slider_default;} ?>,
                min: <?php echo $min_value; ?>,
                max: <?php echo $max_value; ?>,
                step: 1,				
                slide: function( event, ui ) {
                        jQuery( ".<?php echo $result_class; ?>" ).html( ui.value );
                },
                change: function(event, ui) { 
                jQuery('#<?php echo $hidden_id; ?>').attr('value', ui.value);
                }			
                });	
	</script>                
	<?php }
	
//Reminds user to update their version
function supernova_version_notice(){
    global $wp_version;
    if ( $wp_version < 3.6) {
            echo '<p id="message" class="supernova_version_notice">'.__('This theme works best on the latest version of WordPress, some features might not work properly on this version', 'Supernova').'</p>';
            }
	}
        
/*
 * Gets thumbnail for posts and listings
 * @since Supernova 1.4.2
 */
        
function supernova_thumbnail(){   
    if(is_single() && supernova_options('no-single-featured'))
        return false;    
	if (has_post_thumbnail()){
            if(is_single()){
                the_post_thumbnail();
            }else{
                the_post_thumbnail('thumbnail');
            }
		}
	}
 
//Header title image
function supernova_title_image(){
	    $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : 
                    echo '<a href="'.esc_url( home_url() ).'"><img class="site-logo" src="'.get_header_image().'" height="'.get_custom_header()->height.'" width="'.get_custom_header()->width.'" alt="'.get_bloginfo('name').'" title="'.get_bloginfo('name').'" /></a>';
                endif; 
	}	
/*Function for displaying Ad
* @param $id
* returns Ad Code
* @since version 1.1.0
*/
function supernova_display_ad($id){
	global $supernova_options;
         $ad = '';
if(supernova_options(''.$id.'')){   
    $ad .= '<section class="'.$id.'">';
    $ad .= '<div class="'.$id.'-inner">'.$supernova_options[''.$id.''].'</div>';
    $ad .= '</section>';
 }
        return $ad;
	}
        
function supernova_ajax_main_button(){
    global $wp_query, $supernova_options;
    $total_pages = $wp_query->max_num_pages;
    $posts_per_page = get_option('posts_per_page');
    if($total_pages == 1 || supernova_options('ajax-postloader') ){return false;}else{
    echo '<button class="supernova_load_more_main '.$total_pages.' button '.$posts_per_page.'">'.__('Show More', 'Supernova').'</button><img class="main_loader" src="'.SUPERNOVA_ROOT_ADMIN.'/images/loader.gif" alt="ajax-loader">';
        }
}

function supernova_ajax_tabs(){
    global $supernova_options;
    $tabs = '';
    $rec_text = (isset($supernova_options['rec-text'])) ? esc_attr($supernova_options['rec-text']): __('Recommended', 'Supernova');    
    if(!supernova_options('rec-tab')){
    $tabs .= '<div id="tabs">';
    $tabs .= '<div class="tab_current" id="tab_one">'.esc_attr($supernova_options["latest-blog"]).'</div>';
    if(!supernova_options('popular-tab'))
    $tabs .= '<div id="tab_two">'.$supernova_options['popular-text'].'</div>';
    $tabs .=  '<div id="tab_three">'.$rec_text.'</div>';
    $tabs .=  '</div>';
     echo $tabs;
        }
}

function supernova_footer_text(){
    global $supernova_options;
    if(trim($supernova_options['footer-text'])==''){        
        return '&nbsp;'.supernova_copyright_custom_date().bloginfo('name');
            }else{
                return '&nbsp;'.esc_html($supernova_options['footer-text']);                
            }
}

/*
 * Gets the content or content depending on what user has selected.
 */
function supernova_content(){
    if(!supernova_options('full-content')){
        the_excerpt();        
    }else{
        the_content();        
    }
}

/*
 * Creates Navigation for Category
 * @since Supernova 1.4.2
 */
function supernova_category_navigation(){
    if(!supernova_options('disable-categories')){
        echo '<div class="header_catnav">';        
        echo        '<div class="header_cat_title"><span class="cat_icon"></span><span class="first_cat">'.__('Categories', 'Supernova').'</span><div class="clearfix"></div></div>';
        echo '<div class="catnav">';
                        if(has_nav_menu('Header_Cat')){ wp_nav_menu( array('theme_location'=>'Header_Cat', 'menu'=>'Header Categories'));}else{
        echo                "<ul>";
                                wp_list_categories(array('title_li' => NULL, 'number' => 6));//Only if user has not selected menu
        echo                "</ul>";
                            }                
        echo  '</div></div>';
    }
}

/*
 * Gives Update to the user 
 * @since Supernova 1.4.2
 * 
 */

function supernova_update_massage(){
    return true;
}