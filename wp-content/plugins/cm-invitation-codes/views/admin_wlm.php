<p class="clear"></p>
<?php if (!empty($messages)): foreach ($messages as $msg): ?>
<div class="updated"><?php echo $msg; ?></div>
<?php endforeach; endif; ?>
<form method="post">
    <table class="form-table">
        <tr valign="top">
                <th scope="row">Integrate with WishList Member?</th>
                <td><input type="radio" name="cmic_integrate_wlm" value="0" id="cmic_integrate_wlm_0" <?php checked(!$integrate); ?>/><label for="cmic_integrate_wlm_0">No</label> <input type="radio" name="cmic_integrate_wlm" value="1" id="cmic_integrate_wlm_1" <?php checked($integrate); ?>/><label for="cmic_integrate_wlm_1">Yes</label></td>
            </tr>
            <?php if ($integrate): ?>
            <tr valign="top">
                <th scope="row">Default Level for new groups?</th>
                <td><select name="cmic_default_level">
                        <?php foreach ($levels as $key=>$val): ?>
                        <option value="<?php echo $key; ?>" <?php selected($key, $defaultLevel); ?>><?php echo $val; ?></option>
                        <?php endforeach; ?>
                    </select></td>
            </tr>
            <?php endif; ?>
    </table>
    
    <?php submit_button(); ?>

</form>