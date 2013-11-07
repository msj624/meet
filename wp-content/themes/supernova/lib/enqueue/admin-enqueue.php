<?php
/*
* All the admin CSS and Scripts are loaded only from this file and most of the files are loaded 
* only of the theme's  options page
*/

class supernova_admin_enqueue {
    	public function __construct(){
		add_action( 'admin_enqueue_scripts', array($this, 'supernova_admin_styles') );
		add_action('admin_enqueue_scripts', array($this, 'supernova_admin_scripts'));
		}
    		
public function supernova_admin_styles() {
        global $wp_version;
                    wp_register_style( 'custom_wp_admin_css', SUPERNOVA_ROOT_ADMIN.'css/admin-css.css', array(), '1.4.2', 'all' );
                    wp_register_style( 'supernova_all_css', SUPERNOVA_ROOT_ADMIN.'css/all.css', array(), '1.4.2', 'all' );
                    wp_register_style( 'supernova_older_css', SUPERNOVA_ROOT_ADMIN.'css/old/older.css', array(), '1.3.2', 'all' );
        if (isset($_GET['page']) && $_GET['page'] == 'theme-options'){
                    wp_enqueue_style( 'custom_wp_admin_css' );                    
                    wp_enqueue_style('thickbox');
                    if ( $wp_version < 3.5 )
                    wp_enqueue_style( 'supernova_older_css' ); //For Older Versions  
                }
            wp_enqueue_style( 'supernova_all_css' );  //Just a bit of css which loads eveywhere on dashboard                    
            }

public function supernova_admin_scripts() {
         if (isset($_GET['page']) && $_GET['page'] == 'theme-options'){
            wp_enqueue_script('jQuery');            
            wp_register_script( 'my_jscolor_script', SUPERNOVA_ROOT_ADMIN.'assets/jscolor/jscolor.js' );
            wp_register_script( 'my_custom_script', SUPERNOVA_ROOT_ADMIN.'js/adminjs.js', array('jquery'),'1.4.2', false );
            wp_register_script( 'jquery_ui_plugin', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js', array('jquery'),'1.4.2', false );
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');
            wp_enqueue_script( 'my_custom_script');
            wp_enqueue_script( 'my_jscolor_script');
            wp_enqueue_script( 'jquery_ui_plugin');            
            }
    }
}

new supernova_admin_enqueue();