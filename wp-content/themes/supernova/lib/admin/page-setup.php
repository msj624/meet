<?php
/*
* For creating pages for admin
* @param $pagename, $width, $i, $options_array
* Returns pages
*/

function supernova_admin_page_setup($pagename, $width = false , $i = false, $option_array = false){
	global $supernova_options, $supernova_defaults; ?>
	
<table class="widefat">
    <thead>
        <tr><th colspan="3"><?php echo $pagename; ?></th></tr>
    </thead>
	<?php foreach($supernova_defaults as $value){
        switch($value['page']){
            case $pagename;
                switch($value['type']){
                    case 'text';
                     ?>
    <tr>
        <td width="<?php echo $width; ?>">
        <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
        </td>
        <td>
            <input type="text"  name="supernova_settings[<?php echo $value['id']; ?>]" id="<?php echo $value['id']; ?>" value="<?php echo esc_url(supernova_options(''.$value['id'].'')); ?>" size="40" class="supernova_links" />
            <input type="button" class="supernova-upload-button button" value="<?php _e('Upload', 'Supernova'); ?>" />
            <input type="button" class="remove-button button" value="<?php _e('Remove', 'Supernova'); ?>" /><br /><br />
            <?php if($value['desc']){ ?><div class="help_wrapper"><span class="Shelp"></span><span class="field_help help"><?php echo $value['desc']; ?></span></div><?php } ?>
        </td>
    </tr>


    <?php break; case 'checkbox'; ?> 
    <tr>
        <td width="<?php echo $width; ?>">
        	<label for="<?php echo $value['id']; ?>"><?php if(isset($value['image'])){?><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/<?php echo $value['image']; ?>"> <?php } ?><?php echo $value['name']; ?></label>
        </td>
        <td>
            <input type="checkbox" name="supernova_settings[<?php echo $value['id']; ?>]" value="1" <?php checked(1, supernova_options($value['id'])); ?> /><br />
            <?php if($value['desc']){ ?><div class="help_wrapper"><span class="Shelp"></span><span class="field_help help"><?php echo $value['desc']; ?></span></div><?php } ?>                       
        </td>
        <td></td>
    </tr>
    

<?php break; case 'hidden';?>
    <tr>
        <td width="<?php echo $width; ?>">
        	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
        </td>
        <td>
            <div class="slider_range<?php echo $i; ?> slider_range"></div> 
            <div class="slider-result slider-result<?php echo $i; ?>"><?php echo supernova_options(''.$value['id'].''); ?></div>
            <input type="hidden" id="<?php echo $value['id']; ?>" name="supernova_settings[<?php echo $value['id']; ?>]" value="<?php echo supernova_options(''.$value['id'].''); ?>"/>
            <?php if($value['desc']){ ?><div class="help_wrapper"><span class="Shelp"></span><span class="field_help help"><?php echo $value['desc']; ?></span></div><?php } ?>
        </td>
    </tr>    
    <?php supernova_slider_bar_settings('slider_range'.$i, 'slider-result'.$i, $value['id'], supernova_options(''.$value['id'].''), $value['default'], $value['min'], $value['max']); //slidebar settings
	$i++; ?>

    
<?php break; case 'radio'; ?>
    <tr>
        <td width="<?php echo $width; ?>">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
        </td>
        <td>
            <div class="sidebar_left">
            <img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/sidebar-left.png"><br />
            <input type="radio" id="<?php echo $value['id']; ?>" name="supernova_settings[<?php echo $value['id']; ?>]" value="1" <?php if (supernova_options($value['id']) == 1){ echo 'checked="checked"'; } ?> /></div>
            <div class="sidebar_right">
            <img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/sidebar-right.png"><br />
            <input type="radio" id="<?php echo $value['id']; ?>" name="supernova_settings[<?php echo $value['id']; ?>]" value="2" <?php if (supernova_options($value['id']) == 2){ echo 'checked="checked"'; }elseif(!supernova_options($value['id'])==1 || !supernova_options($value['id'])==1){echo 'checked="checked"';} ?> /></div>
        </td>
    </tr>
    
<?php break; case 'selection'; ?>
    <tr>
        <td width="<?php echo $width; ?>">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
        </td>        
        <td>
            <div class="popular_post_selection">
            <span>
                <label for="<?php echo $value['id'].'1'; ?>"><?php _e('Actual Count', 'Supernova'); ?></label>
                <input type="radio" id="<?php echo $value['id'].'1'; ?>" name="supernova_settings[<?php echo $value['id']; ?>]" value="1" <?php if (supernova_options($value['id']) == 1){ echo 'checked="checked"'; } ?> />
            </span>            
            <span>
                <label for="<?php echo $value['id'].'2'; ?>">  <?php _e('Number of Comments', 'Supernova'); ?></label>
                <input type="radio" id="<?php echo $value['id'].'2'; ?>" name="supernova_settings[<?php echo $value['id']; ?>]" value="1" <?php if (supernova_options($value['id']) == 1){ echo 'checked="checked"'; } ?> />
            </span>
            <span>
                <label for="<?php echo $value['id'].'3'; ?>" ><?php _e('Let me select', 'Supernova'); ?></label>
                <input type="radio" id="<?php echo $value['id'].'3'; ?>" name="supernova_settings[<?php echo $value['id']; ?>]" value="1" <?php if (supernova_options($value['id']) == 1){ echo 'checked="checked"'; } ?> />
            </span>
                </div>
        </td>
    </tr>    
    
<?php break; case 'color-scheme'; ?>    
    <tr>
        <td width="<?php echo $width; ?>">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
        </td>
        <td>
            <div class="scheme_one">
            <div class="scheme_color" style="background:#db9f0e"><span class="checkedyes"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/yes.png"></span></div>
            <input type="radio" name="supernova_settings[<?php echo $value['id']; ?>]" value="1" <?php if (supernova_options($value['id']) == 1){ echo 'checked="checked"'; }elseif(!supernova_options($value['id'])==2 || !supernova_options($value['id'])==3){echo 'checked="checked"';} ?> /></div>
            <div class="scheme_one">
            <div class="scheme_color" style="background:#e64e4b"><span class="checkedyes"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/yes.png"></span></div>
            <input type="radio" name="supernova_settings[<?php echo $value['id']; ?>]" value="2" <?php if (supernova_options($value['id']) == 2){ echo 'checked="checked"'; } ?> />
            </div>            
            <div class="scheme_one">
            <div class="scheme_color"><span class="checkedyes"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/yes.png"></span></div>
            <input type="radio" name="supernova_settings[<?php echo $value['id']; ?>]" value="3" <?php if (supernova_options($value['id']) == 3){ echo 'checked="checked"'; } ?> /></div>            
            <div class="scheme_one">
            <div class="scheme_color" style="background:#ba89b6"><span class="checkedyes"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/yes.png"></span></div>
            <input type="radio" name="supernova_settings[<?php echo $value['id']; ?>]" value="4" <?php if (supernova_options($value['id']) == 4){ echo 'checked="checked"'; } ?> /></div> 
            <div class="scheme_one">
            <div class="scheme_color" style="background:#9DB102"><span class="checkedyes"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/yes.png"></span></div>
            <input type="radio" name="supernova_settings[<?php echo $value['id']; ?>]" value="5" <?php if (supernova_options($value['id']) == 5){ echo 'checked="checked"'; } ?> /></div>             
            <div class="scheme_one">
            <div class="scheme_color" style="background:#6B4A30"><span class="checkedyes"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/yes.png"></span></div>
            <input type="radio" name="supernova_settings[<?php echo $value['id']; ?>]" value="6" <?php if (supernova_options($value['id']) == 6){ echo 'checked="checked"'; } ?> /></div> 
            <div class="scheme_one">
            <div class="scheme_color" style="background:#7d0e0a"><span class="checkedyes"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/yes.png"></span></div>
            <input type="radio" name="supernova_settings[<?php echo $value['id']; ?>]" value="7" <?php if (supernova_options($value['id']) == 7){ echo 'checked="checked"'; } ?> /></div> 
            <div class="scheme_one">
            <div class="scheme_color" style="background:#FFDC00"><span class="checkedyes"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/yes.png"></span></div>
            <input type="radio" name="supernova_settings[<?php echo $value['id']; ?>]" value="8" <?php if (supernova_options($value['id']) == 8){ echo 'checked="checked"'; } ?> /></div> 
            <div class="scheme_one">
            <div class="scheme_color" style="background:#4B4B4D"><span class="checkedyes"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/yes.png"></span></div>
            <input type="radio" name="supernova_settings[<?php echo $value['id']; ?>]" value="9" <?php if (supernova_options($value['id']) == 9){ echo 'checked="checked"'; } ?> /></div>
        </td>
    </tr>  
    
<?php break; case 'icon-color'; ?>    
    <tr>
        <td width="<?php echo $width; ?>">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
        </td>
        <td>
            <div class="scheme_two">           	
            <input type="radio" name="supernova_settings[<?php echo $value['id']; ?>]" value="1" <?php if (supernova_options($value['id']) == 1){ echo 'checked="checked"'; }elseif(!supernova_options($value['id'])==2){echo 'checked="checked"';} ?> />
            <img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/facebook-icon-off.png">
            </div>
            <div class="scheme_two">           	
            <input type="radio" name="supernova_settings[<?php echo $value['id']; ?>]" value="2" <?php if (supernova_options($value['id']) == 2){ echo 'checked="checked"'; } ?> />
            <img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/facebook-icon.png">
            </div>
            <?php if($value['desc']){ ?><div class="help_wrapper"><span class="Shelp"></span><span class="field_help help"><?php echo $value['desc']; ?></span></div><?php } ?>            
        </td>
    </tr>        

<?php break; case 'textarea'; ?>
    <tr>
        <td width="<?php echo $width; ?>">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
        </td>
        <td>
            <textarea class="supernova_ad" rows="7" name="supernova_settings[<?php echo $value['id']; ?>]"><?php echo supernova_options(''.$value['id'].''); ?></textarea>
            <?php if($value['desc']){ ?><div class="help_wrapper"><span class="Shelp"></span><span class="field_help help"><?php echo $value['desc']; ?></span></div><?php } ?>
        </td>
    </tr>


<?php break; case 'select'; ?>
    <tr>
        <td width="<?php echo $width; ?>">
        	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
        </td>
        <td>
        <select name="supernova_settings[<?php echo $value['id']; ?>]">
            <option value="<?php echo esc_attr($supernova_options[''.$value['id'].'']); ?>"><?php echo $supernova_options[''.$value['id'].'']; ?></option>
            <option value="Theme's Default"><?php _e('Theme\'s Default', 'Supernova'); ?></option>
            <?php foreach ($option_array as $key => $values){ ?>
            	<option value="<?php echo $values; ?>"><?php echo $values; ?></option>
            <?php } ?>
        </select>		
        <?php if($value['desc']){ ?><div class="help_wrapper"><span class="Shelp"></span><span class="field_help help"><?php echo $value['desc']; ?></span></div><?php } ?>
        </td> 
        <td></td> 
    </tr>   
           	 
<?php break; case 'color'; ?>
    <tr>
        <td width="<?php echo $width; ?>">
        	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
		</td>
        <td>
            <input type="text" class="color" id="<?php echo $value['id']; ?>" name="supernova_settings[<?php echo $value['id']; ?>]" value="<?php echo esc_attr($supernova_options[''.$value['id'].'']); ?>" size="40" /><br />
            <?php if($value['desc']){ ?><div class="help_wrapper"><span class="Shelp"></span><span class="field_help help"><?php echo $value['desc']; ?></span></div><?php } ?>            
        </td>
    </tr>	
	
<?php break; case 'slider'; ?>
    <tr>
        <td width="<?php echo $width; ?>">
        	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
		</td>
        <td>
            <?php supernova_page_list('post', 'supernova_settings['.$value['id'].']', intval($supernova_options[''.$value['id'].''])); ?>
            <input type="text"  name="supernova_settings[<?php echo $value['id2']; ?>]" value="<?php echo esc_url($supernova_options[''.$value['id2'].'']); ?>" placeholder="<?php echo $value['placeholder']; ?>" size="40" class="supernova_links" />
            <input type="button" class="supernova-upload-button button" value="<?php _e('Upload', 'Supernova') ?>" /><br />
            <input type="button" class="remove-button button" value="<?php _e('Remove', 'Supernova'); ?>" /><br /><br />
            <?php if($value['desc']){ ?><div class="help_wrapper"><span class="Shelp"></span><span class="field_help help"><?php echo $value['desc']; ?></span></div><?php } ?>
        </td>
        <td class="imgpre">
			<?php if(trim($supernova_options[''.$value['id2'].''])){ ?>
            <img src="<?php echo $supernova_options[''.$value['id2'].'']; ?>" />
            <?php } else{
                    echo get_the_post_thumbnail($supernova_options[''.$value['id'].'']); } ?>
		</td>
    </tr>


<?php break; case 'links'; ?>
    <tr>
        <td width="<?php echo $width; ?>">
            <label for="<?php echo $value['id']; ?>"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/<?php echo $value['image']; ?>"><i><?php echo $value['name']; ?></i></label>
        </td>
        <td>
            <input type="text" placeholder="<?php echo $value['placeholder']; ?>" id="<?php echo $value['id']; ?>"  name="supernova_settings[<?php echo $value['id']; ?>]" class="supernova_links" value="<?php echo $supernova_options[''.$value['id'].'']; ?>" size="40" />
            <input type="button" class="remove-button button" value="<?php _e('Remove', 'Supernova'); ?>" />        
            <?php if($value['desc']){ ?><div class="help_wrapper"><span class="Shelp"></span><span class="field_help help"><?php echo $value['desc']; ?></span></div><?php } ?>
        </td>
    </tr>
    
<?php break; case 'only-text'; ?>    

    <tr>
        <td width="<?php echo $width; ?>">
            <label for="<?php echo $value['id']; ?>"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/<?php echo $value['image']; ?>"><i><?php echo $value['name']; ?></i></label>
        </td>
        <td>
            <input type="text" placeholder="<?php echo $value['placeholder']; ?>"  name="supernova_settings[<?php echo $value['id']; ?>]" value="<?php echo $supernova_options[''.$value['id'].'']; ?>" size="40" />
            <?php if($value['desc']){ ?><div class="help_wrapper"><span class="Shelp"></span><span class="field_help help"><?php echo $value['desc']; ?></span></div><?php } ?>
        </td>
    </tr>
    
<?php break;  } } } ?>
</table>
<?php }