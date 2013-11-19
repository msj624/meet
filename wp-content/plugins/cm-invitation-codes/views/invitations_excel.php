<?
/**
 * CM Invitation Codes - Export invitation codes to excel
 * @package CMInvitationCodes/Views
 */
header("Pragma: public");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=invitation_codes_" . date('Ymd_His') . ".xls");
?>

<table id="invCodesTable" class="form-table">
    <tr valign="top">      	
        <th scope="col" colspan="3"><h2>Group Invitation Codes</h2></th>
<th scope="col" colspan="1"><h3>as of <? echo date('l jS \of F Y h:i:s A'); ?></h3></th>
</tr>
<?php $excel = true; CMInvitationCodes::showHeader($excel); ?>

<?php
self::_displayExcelInvitationCodes();
?>                
</table> 
<?php exit; ?>