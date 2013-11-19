<?php
/**
 * CM Invitation Codes - Registration form field
 * @package CMInvitationCodes/Library
 */
?>
<style>
    .cmic_poweredby {clear:both;float:none;font-size:8px;line-height:1.5;margin-bottom:16px;display: inline-block;color:#bbb;text-decoration:none;font-weight:bold}
    .cmic_poweredby:before {content:'Powered by ';}
</style>
<p>
    <label><span title="Powered by CM Invitation Codes : http://plugins.cminds.com/cm-invitation-codes/">Invitation Code*</span></label><br />
        <!--// Get this plugin : http://plugins.cminds.com/cm-invitation-codes/ "CM Invitation Codes" , thank you. //-->
        <input name="<?php echo self::INVITATION_CODE_NAME; ?>" tabindex="30" type="text" class="input" id="<?php echo self::INVITATION_CODE_NAME; ?>" style="text-transform: uppercase;margin-bottom:0;" />
        <!--// By leaving following snippet in the code, you're expressing your gratitude to creators of this plugin. Thank You! //-->
                    <span class="cmic_poweredby"><a href="http://plugins.cminds.com/" target="_new">CreativeMinds WordPress Plugins</a> <a href="http://plugins.cminds.com/cm-invitation-codes/" target="_new">Invitation Codes</a></span>


</p>
