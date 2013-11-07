<?php 

add_action( 'add_meta_boxes', 'supernova_custom_meta' );
function supernova_custom_meta() {        
    add_meta_box( 'supernova_meta', __('Write CSS for this post', 'Supernova'), 'supernova_meta_callback', 'post', 'normal','high' );  
    add_meta_box( 'supernova_meta', __('Write CSS for this page', 'Supernova'), 'supernova_meta_callback', 'page', 'normal','high' );  
} 

function supernova_meta_callback( $post ) {
	//To verify the input and for security
    wp_nonce_field( basename( __FILE__ ), 'supernova_nonce' );
    $supernova_style_meta = get_post_meta( $post->ID );
    
    ?>    
    <p>
        <label for="post-style" class="supernova-row-title"><?php _e('Dont forget to wrap in <b>STYLE</b> tag', 'Supernova') ?></label><br>
        <textarea rows="5" style="width:95%;" name="post-style" /><?php if(isset($supernova_style_meta['post-style'][0])){echo $supernova_style_meta['post-style'][0];} ?></textarea>
    </p>

    <?php }

add_action( 'save_post', 'supernova_meta_save' );
function supernova_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'supernova_nonce' ] ) && wp_verify_nonce( $_POST[ 'supernova_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 		
	if( isset( $_POST[ 'post-style' ] ) ) {
    	update_post_meta( $post_id, 'post-style', $_POST[ 'post-style' ] );
	} 
	
 
}


/***************************************/
    /*Poplular & Recommended posts*/
/***************************************/

add_action( 'add_meta_boxes', 'supernova_postoptions_custom_meta' );
function supernova_postoptions_custom_meta() {        
    add_meta_box( 'supernova_meta_posts', __('List this post under', 'Supernova'), 'supernova_postoptions_meta_callback', 'post', 'side','core' );      
} 

function supernova_postoptions_meta_callback( $post ) {
    
	//To verify the input and for security
    wp_nonce_field( basename( __FILE__ ), 'supernova_postoptions_nonce' );
    $supernova_post_meta = get_post_meta( $post->ID );
    
    ?>
    <p>
        <input type="checkbox" name="supernova-recommended-post" id="supernova-recommended-post" <?php if(isset($supernova_post_meta['supernova-recommended-post'][0]) && $supernova_post_meta['supernova-recommended-post'][0] == 1 ){echo "checked=checked"; } ?> >
        <label for="supernova-recommended-post" ><?php _e('Recommended Posts', 'Supernova') ?></label>
    </p>

    <?php }

add_action( 'save_post', 'supernova_postoption_meta_save' );
function supernova_postoption_meta_save( $post_id ) {
  
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'supernova_postoptions_nonce' ] ) && wp_verify_nonce( $_POST[ 'supernova_postoptions_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
     
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    
	if( isset( $_POST[ 'supernova-recommended-post' ] ) ) {
    	update_post_meta( $post_id, 'supernova-recommended-post', '1' );
        }else{
            update_post_meta( $post_id, 'supernova-recommended-post', '0' );
        }
}