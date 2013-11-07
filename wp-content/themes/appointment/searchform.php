<?php
/**
 * Search-form Template
 *
 @file             searchform.php
 * @package        Appointment
 * @author         Priyanshu Mittal,Shahid Mansuri and Akhilesh Nagar
 * @copyright      2013 Appointment
 * @license        license.txt
 * @version        Release: 1.1
 * @filesource     wp-content/themes/appoinment/searchform.php
*/ 

?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		
		<input type="text" class=" search_btn"  name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'appointment' ); ?>" />
		<input type="submit" class=" btn appo_btn  search_btn" name="submit" value="<?php esc_attr_e( 'Search', 'appointment' ); ?>" />

	</form>
	
	
	