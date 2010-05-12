<div class="wrap sonicblink_settings">
<h2>SonicBlink Settings</h2>
<form method="post" action="options.php">
<?php settings_fields( 'sonicblink-options' ); ?>
<?php $options = get_option('sonicblink'); ?>
<table class="form-table">
<tr><td colspan="2"><h3>Visibility Settings</h3></td></tr>
<tr valign="top" class="sb_options">
<th scope="row">Visible on index page?</th>
<td>
    <label>Yes <input name="sonicblink[index]" type="radio" value="yes"<?php checked('yes', $options['index']); ?> /></label>
    <label>No <input name="sonicblink[index]" type="radio" value="no"<?php checked('no', $options['index']); ?> /></label>
</td>
</tr>
<tr valign="top" class="sb_options">
<th scope="row">Visible on individual page?</th>
<td>
    <label>Yes <input name="sonicblink[page]" type="radio" value="yes"<?php checked('yes', $options['page']); ?> /></label>
    <label>No <input name="sonicblink[page]" type="radio" value="no"<?php checked('no', $options['page']); ?> /></label>
</td>
</tr>
<tr valign="top" class="sb_options">
<th scope="row">Visible on individual post?</th>
<td>
    <label>Yes <input name="sonicblink[post]" type="radio" value="yes"<?php checked('yes', $options['post']); ?> /></label>
    <label>No <input name="sonicblink[post]" type="radio" value="no"<?php checked('no', $options['post']); ?> /></label>
</td>
</tr>
</table>
<table class="form-table">
<tr><td colspan="2"><h3>Popup Settings</h3></td></tr>
<tr valign="top" class="sb_options">
<th scope="row">Include "On The Web" Tab</th>
<td>
    <label>Yes <input name="sonicblink[on_the_web]" type="radio" value="yes"<?php checked('yes', $options['on_the_web']); ?> /></label>
    <label>No <input name="sonicblink[on_the_web]" type="radio" value="no"<?php checked('no', $options['on_the_web']); ?> /></label>
</td>
</tr>
</table><p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</form>
</div>