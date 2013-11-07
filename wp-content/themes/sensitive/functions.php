<?php
 
if ( ! isset( $content_width ) ) $content_width = 960;


require_once(dirname(__FILE__)."/admin/engine.php"); 
require_once(dirname(__FILE__)."/libs/nav-menu-walker.class.php"); 

    
//save theme option    
function sensitive_save_theme_opt(){                                                                                                   /*Save Theme Option in an array*/
        if(isset($_POST['sensitive_act'])&&$_POST['sensitive_act']=='savethmopt') {    
        $sensitive_nonce = $_REQUEST['_sensitive_nonce'];
        if (! wp_verify_nonce($sensitive_nonce, 'wpeden-nonce') ) die('Invalid nonce'); 
        
        //validate and sanitize data before save        
        update_option("sensitive_bs_thmopt_slider_cat",(int)$_POST['sensitive_bs_thmopt_slider_cat']);                                 
        update_option("sensitive_bs_intro_page",(int)$_POST['sensitive_bs_intro_page']);                                 
        update_option("sensitive_bs_intro_page_2",(int)$_POST['sensitive_bs_intro_page_2']);
        update_option("sensitive_bs_intro_page_3",(int)$_POST['sensitive_bs_intro_page_3']);
        
        header("location: $_SERVER[HTTP_REFERER]");
        die('');   
        }
 
    }

 
//generate thumbnail 
function sensitive_thumb($post, $size='', $extra = array(), $echo = true){    
    $size = $size?$size:'thumbnail';   
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); 
    $large_image_url = $large_image_url[0];    
    $large_image_url = $large_image_url?$large_image_url:'';
    $class = isset($extra['class'])?$extra['class']:'';
    if($large_image_url!=''&&is_array($size)){
        $path = str_replace(site_url('/'), ABSPATH, $large_image_url);
        $thumb = sensitive_dynamic_thumb($path, $size);
        $thumb = str_replace(ABSPATH, site_url('/'), $thumb);
        $alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
        $img = "<img src='".$thumb."' alt='{$alt}' class='{$class}' />";
        if($echo) { echo $img; return; }
        else
            return $img;
    }
    if($echo&&has_post_thumbnail($post->ID ))
    echo get_the_post_thumbnail($post->ID, $size, $extra );
    else if(!$echo&&has_post_thumbnail($post->ID ))
    return get_the_post_thumbnail($post->ID, $size, $extra );  
    else if($echo)
    echo "";
    else
    return "";
    
} 

//post thumbnail function
function sensitive_post_thumb($size='', $echo = true, $extra = null){
    global $post;
    $size = $size?$size:'thumbnail';
    $class = isset($extra['class'])?$extra['class']:'';

    if(is_array($size))
    {
        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
        $large_image_url = $large_image_url[0];
        if($large_image_url!=''&&is_array($size)){
            $path = str_replace(site_url('/'), ABSPATH, $large_image_url);
            $thumb = sensitive_dynamic_thumb($path, $size);
            $thumb = str_replace(ABSPATH, site_url('/'), $thumb);
            $alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
            $img = "<img src='".$thumb."' alt='{$alt}' class='{$class}' />";
            if($echo) { echo $img; return; }
            else
                return $img;
        }
    }
    if($echo&&has_post_thumbnail($post->ID ))
        echo get_the_post_thumbnail($post->ID, $size, $extra );
    else if(!$echo&&has_post_thumbnail($post->ID ))
        return get_the_post_thumbnail($post->ID, $size, $extra );
    else if($echo)
        echo "";
    else
        return "";
}

function sensitive_dynamic_thumb($path, $size){
    $name_p = explode(".",$path);
    $ext = ".".end($name_p);
    $thumbpath = str_replace($ext, "-".implode("x", $size).$ext, $path);
    if(file_exists($thumbpath)) return $thumbpath;
    $image = wp_get_image_editor( $path );
    if ( ! is_wp_error( $image ) ) {
        $image->resize( $size[0], $size[1], true );
        $image->save( $thumbpath );
    }
    return $thumbpath;
}

//post thumbnail url
function sensitive_post_thumb_url(){
    global $post;
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); 
    return $large_image_url[0];
    
}

//generate cutom excerpt
function sensitive_post_excerpt($length){
    global $post;
    $uexcerpt = $post->post_excerpt?$post->post_excerpt:$post->post_content;
    $uexcerpt = strip_tags($uexcerpt);
    $excerpt = substr($uexcerpt,0,$length);
    $eexcerpt = substr($uexcerpt,$length);
    $excerpt .= array_shift(explode(" ",$eexcerpt));
    echo $excerpt.'...';
}

//comments
function sensitive_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; 
   $GLOBALS['comment'] = $comment;
    
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        ?>
    <li class="post pingback">
        <p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?></p>
    <?php
        break;
        default :
   ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">         
            <div class="comment-body">
               <div id="comment-<?php comment_ID(); ?>" class="clearfix">
                    <div class="author-box">
                        <?php echo get_avatar($comment,100); ?>
                         
                    </div> <!-- end .avatar-box -->
                    <div class="comment-wrap clearfix">                        
                        <div class="comment-meta commentmetadata">
                        <?php printf('<span class="fn">%s</span>', get_comment_author_link()) ?>
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                            <?php
                                /* translators: 1: date, 2: time */
                                printf( '%1$s at %2$s', 'wpeden' , get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link(  '(Edit)' , ' ' );
                            ?>
                        </div><!-- .comment-meta .commentmetadata -->

                        <?php if ($comment->comment_approved == '0') : ?>
                            <em class="moderation">Your comment is awaiting moderation.</em>
                            <br />
                        <?php endif; ?>

                        <div class="comment-content"><?php comment_text() ?></div> <!-- end comment-content-->
                        <div class="reply-container"><?php comment_reply_link(array_merge( $args, array('reply_text' => 'Reply','depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
                    </div> <!-- end comment-wrap-->
                    <div class="comment-arrow"></div>
                </div> <!-- end comment-body-->
            </div> <!-- end comment-body-->
         
 
<?php 
        break;
    endswitch;    
 }
 
 
 
 //Sidebars
 function sensitive_widget_init(){
     
    register_sidebar(array(
      'name' => 'Single Post',
      'id' => 'single_post_sidebar',
      'description' => 'Sidebar For Single post.',
      'before_widget' => '<div class="box widget">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
    ));
        
     register_sidebar(array(
      'name' => 'Archive Page',
      'id' => 'archive_page_sidebar',
      'description' => 'Sidebar For Archive Page.',
      'before_widget' => '<div class="box widget box_yellow">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
    ));    
       
    
    register_sidebar(array(
      'name' => 'Footer Left',
      'id' => 'footer1',
      'description' => 'Footer Left',
      'before_widget' => '<div class="widget widget-footer">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
    )); 
    
    register_sidebar(array(
      'name' => 'Footer Middle',
      'id' => 'footer2',
      'description' => 'Footer Middle',
      'before_widget' => '<div class="widget widget-footer">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
    )); 
    
    register_sidebar(array(
      'name' => 'Footer Right',
      'id' => 'footer3',
      'description' => 'Footer Right',
      'before_widget' => '<div class="widget widget-footer">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
    )); 
    
   
 }
 
 // wp_title filter
 function sensitive_filter_wp_title( $old_title, $sep, $sep_location ){
    $ssep = ' ' . $sep . ' ';
    // find the type of index page this is
    if( is_category() ) $insert = $ssep . 'Category';
    elseif( is_tag() ) $insert = $ssep . 'Tag';
    elseif( is_author() ) $insert = $ssep . 'Author';
    elseif( is_year() || is_month() || is_day() ) $insert = $ssep . 'Archives';
    else $insert = NULL;
     
    // get the page number we're on (index)
    if( get_query_var( 'paged' ) )
    $num = $ssep . 'page ' . get_query_var( 'paged' );
     
    // get the page number we're on (multipage post)
    elseif( get_query_var( 'page' ) )
    $num = $ssep . 'page ' . get_query_var( 'page' );
     
    // else
    else $num = NULL;
    
    $site_description = get_bloginfo( 'description', 'display' );
    if ( is_home() && $site_description )
    $old_title .=  $ssep  . $site_description;
     
    // concoct and return new title
    return get_bloginfo( 'name' ) . $insert . $old_title . $num;
}
 
 
//Theme setup function 
function sensitive_setup(){
    register_nav_menus( array(
        'primary' =>  'Top Menu' 
          
    ) );
    
    add_theme_support( 'post-thumbnails' );
    if(has_post_format('aside'))
    add_theme_support("post-formats");
    add_theme_support("automatic-feed-links");
    add_theme_support("excerpt");
    add_theme_support('custom-background');
     
    add_image_size( 'wpeden-responsive-post-thumb', 960, 99999, false );
    add_image_size( 'wpeden-responsive-blog-thumb', 960, 300, true ); 
    add_image_size( 'wpeden-responsive-intro-thumb', 470, 200, true ); 
    add_image_size( 'wpeden-responsive-category-thumb', 270, 270, true ); 
 
 }
 
 function sensitive_enqueue_scripts(){
    
    wp_enqueue_style('wpeden-bootstrap',get_template_directory_uri().'/bootstrap/css/bootstrap.css');   
    wp_enqueue_style('wpeden-bootstrap-responsive',get_template_directory_uri().'/bootstrap/css/bootstrap-responsive.css');   
    wp_enqueue_script('wpeden-bootstrap',get_template_directory_uri().'/bootstrap/js/bootstrap.min.js',array('jquery'));
    wp_enqueue_script('wpeden-site',get_template_directory_uri().'/js/site.js',array('jquery'));
    wp_enqueue_style('wpeden-main',get_stylesheet_uri());
    wp_enqueue_script( 'comment-reply' ); 
 }

 

add_action( 'wp_enqueue_scripts', 'sensitive_enqueue_scripts');
add_action("init","sensitive_save_theme_opt"); 
add_filter( 'wp_title', 'sensitive_filter_wp_title', 10, 3 );
add_action( 'init', 'sensitive_widget_init' );  
add_action( 'after_setup_theme', 'sensitive_setup' );  
 
