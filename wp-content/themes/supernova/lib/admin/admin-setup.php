<?php ob_start();
/*
* The scripts and styles for the admin pages have been enqueued from 'admin-enquque.php' file under 'enqueue' folder
* This page mainly registers the settings page and has callback function for data validation.
* 
*/
	//Adding settings page
	add_action('admin_menu', 'supernova_add_options');
	function supernova_add_options(){		
		add_theme_page( __('Theme Options', 'Supernova'), __('Supernova Options', 'Supernova'), 'manage_options', 'theme-options', 'supernova_page');		
		}
	
	//Registering Settings with validation callback								
	add_action('admin_init', 'supernova_register_settings');
	function supernova_register_settings(){						
		register_setting( 'supernova_group', 'supernova_settings', 'supernova_validate_settings' );						
		}		
				
	include SUPERNOVA_ADMIN.'arrays.php';
									
	//Function only for checkboxes
	function supernova_options( $option ) {
			global $supernova_defaults, $supernova_defaults_values;			
				$supernova_options = get_option('supernova_settings', $supernova_defaults_values);	
				if(isset($supernova_options[$option])){
					return trim($supernova_options[$option]);
				}
		}		
							
	$supernova_options = get_option('supernova_settings', $supernova_defaults_values);
	
	//Creating Admin page	
	function supernova_page(){
		global $supernova_options;		
		?>        			        
        		<div class="supernova_wrap wrap">
        	<div id="icon-options-general" class="supernova32 icon32"></div>
            	<h2 class="supernova_heading">Supernova <?php _e('Theme Options', 'Supernova'); ?></h2>
                    <div id="supernovaoptions">
                        <form action="options.php" method="post" enctype="multipart/form-data">
                            <?php settings_fields('supernova_group'); supernova_writer(); ?>
                            <?php include SUPERNOVA_ADMIN.'admin-int.php'; ?>
                             <div class="submit_sticky">
   		   <p class="supernova-botton-primary"><input type="submit" name="supernova-save" class="button-primary new-button-primary" value="<?php _e('Save Settings', 'Supernova') ?>"></p>
                            </div>
                        </form>
                    </div>
        		</div><!--wrap -->

	<?php if(isset($_POST['truncate'])){
				global $wpdb;
				delete_option('supernova_settings');
                                supernova_writer();
				wp_cache_flush();
	?> 
		<script> window.location.reload(); //to make sure all fields appear empty to the user on reset </script>
	<?php }	 ?>

    <form action="" method="post">
		<p class="tooltip3 tooltip2">
        	<input type="submit" name="truncate" class="button-primary reset_button" value="<?php _e('Reset All', 'Supernova'); ?>"  />
       	</p>
    </form>
			<?php }	//supernova page ENDS
		
/*
 * Callback to the register_settings function will pass through an input variable
 * All arrays are in array.php file
 */
function supernova_validate_settings($input)
{
	global $supernova_link_array, $supernova_checkbox_array, $supernova_text_array, $supernova_text_array, $supernova_numbers_array;
	
	foreach($input as $key => $value)
	{		
	$newinput[$key] = trim($value);	
	
	if(in_array($key,$supernova_numbers_array)){
		if(!ereg('^[0-9]+$', $value)){
			$newinput[$key]='';
			}
		}
	elseif(in_array($key,$supernova_text_array)){
		if(!preg_match('/^[A-Z0-9 _]*$/i', $value)){
			$newinput[$key]='';
			}
		}
	elseif(in_array($key, $supernova_link_array)){		
		if(!preg_match('^(?:https?://)?(?:[a-z0-9-]+\.)*((?:[a-z0-9-]+\.)[a-z]+)^', $value)){
			$newinput[$key]='';
				}
			}
	elseif(in_array($key, $supernova_checkbox_array)){
		if(!$value==1){ //because it cannot get any other value
			$newinput[$key]='';
				}			
			}	
	}
	return $newinput;
}

/*
 * Redirecting user to the theme's option page on activation
 */
add_action('after_setup_theme', 'supernova_on_activation');
function supernova_on_activation(){
    global $pagenow;
if(isset($_GET['activated'] ) && $pagenow == "themes.php") {
	wp_redirect( admin_url('themes.php?page=theme-options') );
        if(function_exists(supernova_writer())){
            supernova_writer();
        }
	exit();
}
    }
    
 
add_action('admin_init', 'supernova_on_updation');
function supernova_on_updation(){
      global $pagenow;
if(isset($_GET['action'] ) && $pagenow == "update.php") {
        if($_GET['action'] == 'upgrade-theme'){
	wp_redirect( admin_url('themes.php?page=theme-options') );        
        if(function_exists(supernova_writer())){
            supernova_writer();
        }        
        if(function_exists(supernova_update_massage())){
            supernova_update_massage();   
        }        
	exit();
        }
    }
}