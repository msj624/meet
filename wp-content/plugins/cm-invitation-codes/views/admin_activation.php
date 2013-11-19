<?php
/**
 * CM Invitation Codes - Activation keys admin panel
 * @package CMInvitationCodes/Views
 */
?>

    <table id="RATable" class="wp-list-table widefat">      

        <?php
        self::_showHeader();
        self::displayExistingActivationKeys();
        ?>


    </table>
    <p class="submit">
        <?php
        $uri = self::_cleanUri();
        $clearAllActivationKeys = add_query_arg(array('del_all' => 1), $uri);
        echo '&nbsp;&nbsp;&nbsp;<a href="javascript:deleteallconfirmation()">[Clear All Activation Keys]</a>&nbsp;&nbsp;&nbsp;';
        $clearOldActivationKeys = add_query_arg(array('del_old' => 1), $uri);
        $excel = add_query_arg(array('as_excel' => 1), $uri);
        echo '<a href="javascript:deleteoldconfirmation()">[Clear Old Activation Keys]</a>&nbsp;&nbsp;&nbsp;';
        echo '<a href="' . $excel. '">>>View All Codes As Excel</a>&nbsp;&nbsp'
        ?>
    </p>

    <script type="text/javascript">
        <!--
        function deleteallconfirmation() {
            var answer = confirm("Are you sure you want to delete ALL activation Keys ? ")
            if (answer){
                window.location = "<?php echo $clearAllActivationKeys; ?>";
            }
            else{
                alert("No action taken")
            }
        }
        function deleteoldconfirmation() {
            var answer = confirm("Are you sure you want to delete Old activation Keys ? ")
            if (answer){
                window.location = "<?php echo $clearOldActivationKeys; ?>";
            }
            else{
                alert("No action taken")
            }
        }
		function deleteConfirmation(link) {
			var answer = confirm("Are you sure you want to delete this activation key? ")
			if (answer){
				window.location = link;	          	                 	
			}
			else{
				alert("No action taken")
			}
		}
        //-->
    </script>
