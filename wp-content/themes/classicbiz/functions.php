<?php

// Required functions
require_once ( get_template_directory() . '/functions/classicbiz-functions.php');

//Redirect to theme options page
if ( is_admin() && isset($_GET['activated'] ) && $pagenow ==	"themes.php" )
	wp_redirect ( 'themes.php?page=classicbiz-admin.php');
	
//Add support for post thumbnails
	add_theme_support ( 'post-thumbnails' );
	
//Title meta tag
    add_filter( 'wp_title', 'gbb_title', 10, 3 );
    
function gbb_title( $title, $sep, $seplocation )
    {
    global $page, $paged;
    // Don't affect in feeds.
    if ( is_feed() )
    return $title;
    // Add the blog name
    if ( 'right' == $seplocation )
    $title .= get_bloginfo( 'name' );
    else
    $title = get_bloginfo( 'name' ) . $title;
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
    $title .= " {$sep} {$site_description}";
    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
    return $title;
    }	
	
// Content Width
if ( ! isset( $content_width ) ) $content_width = 900;
	
//Function to customize default excerpts
function classicbiz_excerpt($text)
{
   return str_replace('[...]', '&hellip;', $text);
}
add_filter('the_excerpt', 'classicbiz_excerpt');	

//Navigation menu
 function classicbiz_addmenus() {
        register_nav_menus(
                array(
                        'main_nav' => 'The Main Menu',
                )
        );
 }
 add_action( 'after_setup_theme', 'classicbiz_addmenus' );

 function classicbiz_nav() {
	global $classicbiz;
    if ( function_exists( 'wp_nav_menu' ) ){
		$menu_id_slugs = array();
		$args = array( 'menu' => 'main_nav', 'container' => 'div', 'container_class' => 'menu', 'container_id' => 'navwrap', 'menu_class' => 'menu', 'menu_id' => '',
		'echo' => true, 'fallback_cb' => 'classicbiz_nav_fallback', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth' => 0, 'walker' => '', 'theme_location' => 'main_nav' );
		$args = apply_filters( 'wp_nav_menu_args', $args );
		$args = (object) $args;
		$menu = wp_get_nav_menu_object( $args->menu );
		if ( ! $menu && $args->theme_location && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args->theme_location ] ) )
			$menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );
		if ( ! $menu && !$args->theme_location ) {
			$menus = wp_get_nav_menus();
			foreach ( $menus as $menu_maybe ) {
				if ( $menu_items = wp_get_nav_menu_items($menu_maybe->term_id) ) {
					$menu = $menu_maybe;
					break;
				}
			}
		}
		if ( $menu && ! is_wp_error($menu) && !isset($menu_items) )
			$menu_items = wp_get_nav_menu_items( $menu->term_id );
		if ( ( !$menu || is_wp_error($menu) || ( isset($menu_items) && empty($menu_items) && !$args->theme_location ) )
			&& $args->fallback_cb && is_callable( $args->fallback_cb ) )
				return call_user_func( $args->fallback_cb, (array) $args );
		if ( !$menu || is_wp_error($menu) )
			return false;
		$nav_menu = $items = '';
		$show_container = false;
		if ( $args->container ) {
			$allowed_tags = apply_filters( 'wp_nav_menu_container_allowedtags', array( 'div', 'nav' ) );
			if ( in_array( $args->container, $allowed_tags ) ) {
				$show_container = true;
				$class = $args->container_class ? ' class="' . esc_attr( $args->container_class ) . '"' : ' class="menu-'. $menu->slug .'-container"';
				$id = $args->container_id ? ' id="' . esc_attr( $args->container_id ) . '"' : '';
				$nav_menu .= '<'. $args->container . $id . $class . '>';
			}
		}
		_wp_menu_item_classes_by_context( $menu_items );
		$sorted_menu_items = array();
		foreach ( (array) $menu_items as $key => $menu_item )
			$sorted_menu_items[$menu_item->menu_order] = $menu_item;
		unset($menu_items);
		$sorted_menu_items = apply_filters( 'wp_nav_menu_objects', $sorted_menu_items, $args );
		foreach( $sorted_menu_items as $key => &$item ){
			if ( ( $classicbiz->hidePages() === 'true' && $item->object=='page' )
				|| ( $classicbiz->hideCategories() === 'true' && $item->object=='category' )
			) {
				unset( $sorted_menu_items[$key] );
			}
		}
		$items .= walk_nav_menu_tree( $sorted_menu_items, $args->depth, $args );
		unset($sorted_menu_items);
		
		
		if ( ! empty( $args->menu_id ) ) {
			$wrap_id = $args->menu_id;
		} else {
			$wrap_id = 'menu-' . $menu->slug;
			while ( in_array( $wrap_id, $menu_id_slugs ) ) {
				if ( preg_match( '#-(\d+)$#', $wrap_id, $matches ) )
					$wrap_id = preg_replace('#-(\d+)$#', '-' . ++$matches[1], $wrap_id );
				else
					$wrap_id = $wrap_id . '-1';
			}
		}
		$menu_id_slugs[] = $wrap_id;
		$wrap_class = $args->menu_class ? $args->menu_class : '';
		$items = apply_filters( 'wp_nav_menu_items', $items, $args );
		$items = apply_filters( "wp_nav_menu_{$menu->slug}_items", $items, $args );
		$nav_menu .= sprintf( $args->items_wrap, esc_attr( $wrap_id ), esc_attr( $wrap_class ), $items );
		unset( $items );
		if ( $show_container )
			$nav_menu .= '</' . $args->container . '>';
		$nav_menu = apply_filters( 'wp_nav_menu', $nav_menu, $args );
		echo $nav_menu;
	}else
		classicbiz_nav_fallback();
 }
 
function classicbiz_nav_fallback() {
	global $classicbiz;
	echo '<div id="navwrap" class="menu"><ul>';
	if ($classicbiz->hidePages() !== 'true' ) {
		echo wp_list_pages( 'title_li=' );
	}
	if ($classicbiz->hideCategories() !== 'true' ){
		echo wp_list_categories( 'title_li=' );
	}
	echo '</ul></div>';
}

// Sidebar
function classicbiz_widget_init() {
	register_sidebar(array (
		'name'=> __( 'Sidebar', 'classicbiz'),
		'id' => 'main_sidebar',
		'description' => __( 'Main widget area - Sidebar', 'classicbiz' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
	register_sidebar(array (
		'name'=> __( 'Footer', 'classicbiz'),
		'id' => 'main_footer',
		'description' => __( 'Widget area - Footer', 'classicbiz' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));	
}
add_action( 'widgets_init', 'classicbiz_widget_init' );

?>