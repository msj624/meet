<?
/**
 * CM Invitation Codes - Export activation keys to excel
 * @package CMInvitationCodes/Views
 */
header("Pragma: public");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=activation_keys_" . date('Ymd_His') . ".xls");
?>

<table id="invCodesTable" class="form-table">
    <tr valign="top">      	
        <th scope="col" colspan="5"><h2>Activation Keys</h2></th>
<th scope="col" colspan="1"><h3>as of <? echo date('l jS \of F Y h:i:s A'); ?></h3></th>
</tr>
<?php $excel = true; self::_showHeader($excel); ?>

<?php
self::_displayExcelActivationKeys();
?>                
</table> 
<?php exit; ?>