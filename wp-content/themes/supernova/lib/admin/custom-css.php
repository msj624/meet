<?php

/*
 * Manages Header Logo Position
 * @since Supernova 1.4.2
 */
add_action('wp_head', 'supernova_header_logopos');
function supernova_header_logopos(){
   $value = (get_theme_mod( 'supernova_header_logopos', 'Default Value' )) ? esc_attr( get_theme_mod( 'supernova_header_logopos', 'Default Value' )) : '';
   if( $value || $value != 1){
    echo '<style>';
        if($value == '3'){       
            echo '.header-ad, #header_widgets {float:left}';
            echo '#header_title {float:right; padding: 15px 0px 15px 15px;}';
        }elseif($value == '2' ){
            echo '.header-ad, #header_widgets {float:none; clear:both; text-align:center;margin-bottom: 10px;}';
            echo '#header_title {float:none;text-align:center}';
            echo '#title_wrapper{text-align:center;}';
            echo '#title_wrapper{text-align:center;}';
        }
    echo '</style>';
   }
}

/*
 * Handles css when background image is set from background options page
 * @since Supernova 1.4.2
 */    
add_action('load-appearance_page_custom-background','supernova_handle_background_save');    
function supernova_handle_background_save(){
    if (isset($_GET['page']) && $_GET['page'] == 'custom-background'){
        if(isset($_POST['save-background-options'])){
         supernova_writer();         
        }            
    }
}

/*
 * To hook in the header only if we are not able to write file for any reason or its an old user who didn't save settings yet.
 * @since Supernova 1.4.2
 */

add_action('init', 'supernova_file_status_check');
function supernova_file_status_check(){        
    $file_stauts = get_option('supernova_file_write_status');    
    $old_user = get_option('supernova_old_user_check');
    if($file_stauts == 'failed' || $old_user != 'no' ){
        add_action('wp_head', 'supernova_temp_user_css');
    }    
}

/*
 * Will hook in the header in case something goes wrong
 * @param NULL
 * @returns styles
 * 
 */
function supernova_temp_user_css(){
    echo "<style>";
    echo supernova_user_css();
    echo "</style>";
}

/*
 * Handles css when header is set from background options page
 * @since Supernova 1.4.2
 */    
add_action('load-appearance_page_custom-header','supernova_handle_header_save');    
function supernova_handle_header_save(){
    if (isset($_GET['page']) && $_GET['page'] == 'custom-header'){
        if(isset($_POST['save-header-options'])){
         supernova_writer();         
        }            
    }
}

function supernova_user_css(){
    
global $supernova_options;
$background_color = get_background_color(); $background_image= get_background_image();
$styles = '';

if($supernova_options['font-style']!=='default')
$styles .= "#content .entry p, #sidebar a, #sidebar p, #sidebar, #sidebar lable, body{font-family:".$supernova_options['font-style']."!Important;}";

if($supernova_options['post-para-size']!=='14')
$styles .= "#content .entry p{font-size:". intval($supernova_options['post-para-size'])/10 ."em !important ;}";

if(trim($supernova_options['post-para-color'])!=='000000')
$styles .= "#content .entry p{color: #".esc_html($supernova_options['post-para-color']) ."!Important;}";

if(trim($supernova_options['post-heading-color'])!=='525252')
$styles .= ".post_title a, .single_heading{color: #".esc_html($supernova_options['post-heading-color']) ."!Important;}";

if($supernova_options['post-heading-size']!=='25')
$styles .= ".post_title{font-size:".intval($supernova_options['post-heading-size'])/10 ."em !important ;}";

if($supernova_options['site-heading-size']!=='30')
$styles .= "#header_title h1{font-size:". intval($supernova_options['site-heading-size'])/10 ."em !important ;}";

if($supernova_options['site-desc-size'] !=='14')
$styles .= "#header_title p{font-size:". intval($supernova_options['site-desc-size'])/10 ."em !important ;}";

if($supernova_options['sidebar-heading-size']!=='23')
$styles .= "#sidebar .widget h2{font-size:". intval($supernova_options['sidebar-heading-size'])/10 ."em !important ;}";

if($supernova_options['sidebar-width'])
$styles .= "#sidebar{width:". intval($supernova_options['sidebar-width']-2) ."%!Important;}";

if($supernova_options['layout-width'])
$styles .=  "#wrapper, #footer, #top_most, .wrapper{width:". esc_html(intval($supernova_options['layout-width'])) ."px;}";

if($supernova_options['content-width'])
$styles .= "#content{width:".intval($supernova_options['content-width']-3)."% !Important;}";

if($supernova_options['sidebar-pos']==1){
$styles .= "#sidebar{float:right !important; margin-right:5% !important;}";
$styles .= "#content{float:right !important; margin-right:0% !important;}";
}
if(supernova_options('disable-search')==1)
$styles .=  "#nav {max-width:100% !important;}";

if(supernova_options('disable-categories')==1)
$styles .= ".header_nav{max-width:90%;padding-bottom: 5px;} .top_search_box {left: -187px;}";

if(supernova_options('footer-color')!=='FFFFFF')
$styles .= "#footer_wrapper, #footer, #lower_footer{background:#".esc_html(supernova_options('footer-color')).";}";

if(trim(supernova_options('footer-bg'))!=='')
$styles .= "#footer_wrapper, #footer, #lower_footer{background:url('".esc_url(supernova_options('footer-bg'))."');}";

if(supernova_options('footertext-color')!=='CCCCCC')
$styles .= "#footer #footer_left_part span, #footer #footer_left_part a, #footer .widget, #footer a, #footer p, #footer pre, #footer span, #footer i, #footer a.rsswidget{color:#".esc_html(supernova_options('footertext-color')) ." !important;}";

if(supernova_options('footerheading-color')!=='FFFFFF')
$styles .= "#footer .widget h2{color:#".esc_html(supernova_options('footerheading-color'))."!important;}";

if(supernova_options('sidebar-heading-color')!=='FFFFFF')
$styles .= "#sidebar .widget h2{color:#".esc_html(supernova_options('sidebar-heading-color'))."!important;}";

if(supernova_options('nosidebar-home')){
$styles .= ".home #wrapper #content{width:100%!important; margin-right:0;} .home #supernova_slider img {height: 350px;}
.home #supernova_slider_wrapper {margin-bottom:50px;}";
}

if(supernova_options('icon-color')=='2'){
$styles .= "#footer .facebook_b{background-position:0 0}#footer .twitter_b{background-position:-32px 0}#footer .google_b{background-position:-64px 0}#footer .stumble_b{background-position:-96px 0}#footer .rss_b{background-position:-128px 0}#footer .youtube_b{background-position:-160px 0}#footer .linkedin_b{background-position:-192px -96px}";
} 

if($background_color=='ffffff' || !$background_color  && !$background_image)
$styles .=  ".main_content{border:none;}"; //box shadow fix for main content

if(isset($supernova_options['sup_css']))
$styles .= $supernova_options['sup_css'];

return $styles;

    }