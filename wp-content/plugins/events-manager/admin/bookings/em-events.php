<?php

/**
 * Determines whether to show meeting page or meetings page, and saves any updates to the meeting or meetings
 * @return null
 */
function em_bookings_meetings_table() {
	//TODO Simplify panel for meetings, use form flags to detect certain actions (e.g. submitted, etc)
	global $wpdb;
	global $EM_Meeting;

	$scope_names = array (
		'past' => __ ( 'Past meetings', 'dbem' ),
		'all' => __ ( 'All meetings', 'dbem' ),
		'future' => __ ( 'Future meetings', 'dbem' )
	);
	
	$action_scope = ( !empty($_REQUEST['em_obj']) && $_REQUEST['em_obj'] == 'em_bookings_meetings_table' );
	$action = ( $action_scope && !empty($_GET ['action']) ) ? $_GET ['action']:'';
	$order = ( $action_scope && !empty($_GET ['order']) ) ? $_GET ['order']:'ASC';
	$limit = ( $action_scope && !empty($_GET['limit']) ) ? $_GET['limit'] : 20;//Default limit
	$page = ( $action_scope && !empty($_GET['pno']) ) ? $_GET['pno']:1;
	$offset = ( $action_scope && $page > 1 ) ? ($page-1)*$limit : 0;
	$scope = ( $action_scope && !empty($_GET ['scope']) && array_key_exists($_GET ['scope'], $scope_names) ) ? $_GET ['scope']:'future';
	
	// No action, only showing the meetings list
	switch ($scope) {
		case "past" :
			$title = __ ( 'Past Meetings', 'dbem' );
			break;
		case "all" :
			$title = __ ( 'All Meetings', 'dbem' );
			break;
		default :
			$title = __ ( 'Future Meetings', 'dbem' );
			$scope = "future";
	}
	$owner = !current_user_can('manage_others_bookings') ? get_current_user_id() : false;
	$meetings = EM_Meetings::get( array('scope'=>$scope, 'limit'=>$limit, 'offset' => $offset, 'order'=>$order, 'bookings'=>true, 'owner' => $owner ) );
	$meetings_count = EM_Meetings::count( array('scope'=>$scope, 'limit'=>0, 'order'=>$order, 'bookings'=>true, 'owner' => $owner ) );
	
	$use_meetings_end = get_option ( 'dbem_use_meeting_end' );
	?>
	<div class="wrap em_bookings_meetings_table em_obj">
		<form id="posts-filter" action="" method="get">
			<input type="hidden" name="em_obj" value="em_bookings_meetings_table" />
			<?php if(!empty($_GET['page'])): ?>
			<input type='hidden' name='page' value='meetings-manager-bookings' />
			<?php endif; ?>		
			<div class="tablenav">			
				<div class="alignleft actions">
					<!--
					<select name="action">
						<option value="-1" selected="selected"><?php esc_html_e( 'Bulk Actions' ); ?></option>
						<option value="deleteMeetings"><?php esc_html_e( 'Delete selected','dbem' ); ?></option>
					</select> 
					<input type="submit" value="<?php esc_html_e( 'Apply' ); ?>" name="doaction2" id="doaction2" class="button-secondary action" />
					 --> 
					<select name="scope">
						<?php
						foreach ( $scope_names as $key => $value ) {
							$selected = "";
							if ($key == $scope)
								$selected = "selected='selected'";
							echo "<option value='$key' $selected>$value</option>  ";
						}
						?>
					</select>
					<input id="post-query-submit" class="button-secondary" type="submit" value="<?php esc_html_e( 'Filter' )?>" />
				</div>
				<!--
				<div class="view-switch">
					<a href="/wp-admin/edit.php?mode=list"><img class="current" id="view-switch-list" src="http://wordpress.lan/wp-includes/images/blank.gif" width="20" height="20" title="List View" alt="List View" name="view-switch-list" /></a> <a href="/wp-admin/edit.php?mode=excerpt"><img id="view-switch-excerpt" src="http://wordpress.lan/wp-includes/images/blank.gif" width="20" height="20" title="Excerpt View" alt="Excerpt View" name="view-switch-excerpt" /></a>
				</div>
				-->
				<?php 
				if ( $meetings_count >= $limit ) {
					$meetings_nav = em_admin_paginate( $meetings_count, $limit, $page, array('em_ajax'=>0, 'em_obj'=>'em_bookings_meetings_table'));
					echo $meetings_nav;
				}
				?>
			</div>
				
			<?php
			if (empty ( $meetings )) {
				// TODO localize
				_e ( 'no meetings','dbem' );
			} else {
			?>
			<div class='table-wrap'>	
			<table class="widefat">
				<thead>
					<tr>
						<th><?php esc_html_e( 'Meeting', 'dbem' ); ?></th>
						<th><?php esc_html_e( 'Date and time', 'dbem' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$rowno = 0;
					foreach ( $meetings as $meeting ) {
						/* @var $meeting EM_Meeting */
						$rowno++;
						$class = ($rowno % 2) ? ' class="alternate"' : '';
						// FIXME set to american
						$localised_start_date = date_i18n(get_option('date_format'), $meeting->start);
						$localised_end_date = date_i18n(get_option('date_format'), $meeting->end);
						$style = "";
						$today = date ( "Y-m-d" );
						
						if ($meeting->start_date < $today && $meeting->end_date < $today){
							$style = "style ='background-color: #FADDB7;'";
						}							
						?>
						<tr <?php echo "$class $style"; ?>>
							<td>
								<strong>
									<?php echo $meeting->output('#_BOOKINGSLINK'); ?>
								</strong>
								&ndash; 
								<?php esc_html_e("Booked Spaces",'dbem') ?>: <?php echo $meeting->get_bookings()->get_booked_spaces()."/".$meeting->get_spaces() ?>
								<?php if( get_option('dbem_bookings_approval') == 1 ) : ?>
									| <?php esc_html_e("Pending",'dbem') ?>: <?php echo $meeting->get_bookings()->get_pending_spaces(); ?>
								<?php endif; ?>
							</td>
					
							<td>
								<?php echo $localised_start_date; ?>
								<?php echo ($localised_end_date != $localised_start_date) ? " - $localised_end_date":'' ?>
								&ndash;
								<?php
									//TODO Should 00:00 - 00:00 be treated as an all day meeting? 
									echo substr ( $meeting->start_time, 0, 5 ) . " - " . substr ( $meeting->end_time, 0, 5 ); 
								?>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
			</div>
			<?php
			} // end of table
			?>
			<div class='tablenav'>
				<div class="alignleft actions">
				<br class='clear' />
				</div>
				<?php if (!empty($meetings_nav) &&  $meetings_count >= $limit ) : ?>
				<div class="tablenav-pages">
					<?php
					echo $meetings_nav;
					?>
				</div>
				<?php endif; ?>
				<br class='clear' />
			</div>
		</form>
	</div>
	<?php
}

?>