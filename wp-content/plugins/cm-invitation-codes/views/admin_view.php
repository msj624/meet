<?php
/**
 * CM Invitation Codes - Admin panel for invitation codes
 * @package CMInvitationCodes/Views
 */
    global $post;
    global $query_string, $wp_query;
    $aGet = $_GET;
    $items_per_page = 10;
    $paged = $_GET["paged"] ? $_GET["paged"] : 1;
    global $searchWord, $searchParam;
    $searchWord = "";
    $searchParam = "";

    if (isset($_REQUEST["ICsearch"]) && ($_REQUEST["ICsearch"] != "")) {
        //a search word inserted
        $searchWord = $_REQUEST["ICsearch"];
        $searchParam = "&ICsearch=" . $searchWord;
    }
    $items = self::getAllExistingInvitationCodes();
    $itemsFound = count($items);
    $total_numpages = ceil($itemsFound / $items_per_page);
    if ($paged > $total_numpages) {
        $paged = 1;
    }
    $query = $_SERVER['REQUEST_URI'];
    ?>  
<style>
    td.deleted {
        text-decoration: line-through;
    }
</style>
    <form name="ICform" id="ICform" method="post" action="<?php echo $query; ?>">
        <?php wp_nonce_field('update-options'); ?>  
                            <p class="search-box" style="margin-top:-25px">
                        <label class="screen-reader-text" for="post-search-input">Search:</label>	
                        <input type="text" id="ICsearch" name="ICsearch" value="<?php echo $searchWord; ?>" />
                        <input type="submit" name="" id="ICsearch-submit" class="button" value="Search Invitation codes"  />
                    </p>									
                    <div class="tablenav top" style="clear:right;float:right;">

                        <?php
                        //create pagination possibility for the current page
                        self::_invitationPagination('top', array(
                            'total_items' => $itemsFound,
                            'total_pages' => 0,
                            'per_page' => $items_per_page));
                        ?>													
                    </div>
        <table id="invCodesTable" class="wp-list-table widefat">
            
            <?php self::showHeader(); 
            //display the invitation codes list for the current page
            self::_displayExistingInvitationCodesOnPage($paged, $items_per_page);
            ?>

            <tr><td colspan="6">     
                    <div id="divNewInvitationCodes">		
                        <div style="clear: both; height: 10px;"></div>

                        <div class="divNewInvitationCode" class="left" style="border:1px solid gray; padding-top:10px;display:inline-block">				
                            &nbsp<strong>Group Name:</strong>&nbsp<input id="group[]" class="mform_file group" name="group[]" type="text" maxlength="1000" placeholder="Enter Group Name"  />&nbsp;&nbsp;
                            				
                            <?php do_action('cmic_custom_add_form_fields'); ?>
                            <div style="clear: both; height: 10px;"></div>
                        </div>
                    </div>
                    <div style="clear: both; height: 10px;"></div>
                    <button id="CreateAnotherInvCode" type="button" class="button tagadd" onclick="CreateAnotherInvCodeClick(); return false;">+ Add Another Group</button>

                    <script type="text/javascript">	
		
                        function CreateAnotherInvCodeClick() {	
                            var oNewDiv = jQuery(".divNewInvitationCode").last().clone(false,false);			
                            oNewDiv.find("input.group").val("");
                            oNewDiv.appendTo("#divNewInvitationCodes");				
                        };
				
                    </script>
                    <div style="clear: both; height: 20px;"></div>
                </td>
            </tr>      
        </table>
        <input type="hidden" name="action" value="update" />
        <p class="submit" style="background:#E1E1E1">
            <input type="submit" class="button-primary" value="<?php _e('Update Invitation Codes') ?>" name="AddInvCodes" />
            <?php do_action('cmic_list_footer'); ?>
        </p>
        
    </form>
<script type="text/javascript">			 
            function showDiv(id) {                                
                if(document.getElementById(id).style.display == "none") {
                    document.getElementById(id).style.display="block";         			         		
                } else {//the div is shown
                    document.getElementById(id).style.display="none";         			
                }
            }
        </script>	
