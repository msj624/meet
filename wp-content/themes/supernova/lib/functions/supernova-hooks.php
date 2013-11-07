<?php

/*
 * Contains some hooks for the theme
 * @since Supernova 1.4.2
 */

//Next to Logo
add_action('supernova_next_to_logo', 'supernova_next_to_logo_items');
function supernova_next_to_logo_items(){
    echo supernova_display_ad('header-ad');    
}

add_action('supernova_next_to_logo', 'supernova_header_widget');
function supernova_header_widget(){
    if( is_active_sidebar( 'Header Widgets' ) ){
        echo '<div id="header_widgets">';
            dynamic_sidebar('Header Widgets');
            echo '<div class="clerfix"></div>';
        echo '</div>';
        }
}

//Below Navigation
add_action('supernova_below_nav', 'supernova_below_nav_items');
function supernova_below_nav_items(){         
    echo supernova_display_ad('belownav-ad'); 
}

//Above the posts
add_action('supernova_above_posts', 'supernova_above_post_items');
function supernova_above_post_items(){
    global $supernova_options;
    
if($supernova_options['latest-blog']){ 
    echo '<h1 class="latest_blogs">'.esc_attr($supernova_options["latest-blog"]).'</h1>';}
    echo '<img class="supernova_ajax_loader" src="'.SUPERNOVA_ROOT_ADMIN.'images/loader.gif" alt="ajax-loader">';    
        
    echo supernova_display_ad('above-posts-ad'); 
}

//Below the posts
add_action('supernova_below_posts', 'supernova_below_posts_ad', 3);
function supernova_below_posts_ad(){
    echo supernova_display_ad('below-posts-ad');
}

//Above the footer
add_action('supernova_above_footer', 'supernova_above_footer_items');
function supernova_above_footer_items(){
    echo supernova_display_ad('abovefooter-ad');    
}

//Above Single Posts
add_action('above_single_posts', 'supernova_above_single_posts_items');
function supernova_above_single_posts_items(){         
    echo supernova_display_ad('abovesinglepost-ad'); 
}

//Below Single Posts
add_action('supernova_below_single_posts', 'supernova_below_single_posts_items');
function supernova_below_single_posts_items(){         
    echo supernova_display_ad('belowsinglepost-ad');
}

//Footer Navigation
add_action('supernova_footer_nav', 'supernova_footer_navigation');
function supernova_footer_navigation(){
global $supernova_theme_uri;
$responsive = '';
if(!supernova_options('no-responsive'))
$responsive = 'responsive';
    echo '<span class="copyright">'.supernova_footer_text().'</span>';
    if(has_nav_menu('Footer_Nav'))
    wp_nav_menu( array('theme_location'=>'Footer_Nav', 'menu'=>'Footer Navigation', 'menu_class' => 'footer_nav' ));
    echo '<span class="credits '.$responsive.'"><a href="'.$supernova_theme_uri.'" title="'.__('Visit ', 'Supernova').'supernovathemes.com" target="_blank">Supernova Themes</a></span>';
    //If you want to remove link, go ahead, however dont remove <span class='credits $responsive'> or else you would no longer have control over site's responsiveness.
}

//Footer Social
add_action('supernova_footer_right', 'supernova_footer_social');
function supernova_footer_social(){
    global $supernova_options;    
echo '<ul>';
    if(trim($supernova_options['facebook-link']))
        echo '<li class="facebook_b" title="Facebook"><a href="'.esc_url($supernova_options['facebook-link']).'" target="_blank"></a></li>';
    if(trim($supernova_options['twitter-link']))
        echo '<li class="twitter_b" title="Twitter"><a href="'.esc_url($supernova_options['twitter-link']).'" target="_blank"></a></li>';                
    if(trim($supernova_options['google-link']))
        echo '<li class="google_b" title="Google +1"><a href="'.esc_url($supernova_options['google-link']).'" target="_blank"></a></li>';
    if(trim($supernova_options['rss-link']))
        echo '<li class="rss_b" title="RSS"><a href="'.esc_url($supernova_options['rss-link']).'" target="_blank"></a></li>';
    if(trim($supernova_options['youtube-link']))
        echo '<li class="youtube_b" title="YouTube"><a href="'.esc_url($supernova_options['youtube-link']).'" target="_blank"></a></li>';
    if(trim($supernova_options['linkedin-link']))
        echo '<li class="linkedin_b" title="linkedin"><a href="'.esc_url($supernova_options['linkedin-link']).'" target="_blank"></a></li>';
echo '</ul>';
}

//Post Meta 
add_action('supernova_meta', 'supernova_meta_content');
function supernova_meta_content(){
    if(!supernova_options('disable-meta')){
        echo '<div class="postmetadata">';
        echo    '<div class="meta">';
        echo        '<span class="left_meta">';
                         if(!supernova_options('disable-author')){
        echo            '<em class="meta_by">'. __('By', 'Supernova').'</em><em class="meta_author">';
                            the_author_posts_link(); 
        echo            '</em> | ';
                                }
                         if(!supernova_options('disable-date')){
        echo            '<em class="meta_date">'.the_time('F jS, Y').'</em>';
                            }
        echo     '<span class="leave_comment">';
                    comments_popup_link(__('| LEAVE A COMMENT', 'Supernova'), __('| SHOW COMMENT(1)', 'Supernova') , __('| SHOW COMMENTS (%)', 'Supernova'), 'comments-link', '');
        echo     '</span>';
        echo     '</span>';
        echo    '<span class="social_black">';
                    do_action('supernova_meta_hook');  //You can hook or replace your social icons here
        echo    '</span>';
        echo    '</div>';
        echo '</div>';
     }else{
        echo '<div class="dvd_line"></div>';
            }
}