<?php /** @version $Id: view-settings-symbol.php */ ?>
<?php $config = $this->config('default-s');?>
<form method="post" action="">
<fieldset>
  <h3 style="margin-left:20px"><?php _e('Character CAPTCHA Settings','light-captcha'); ?></h3>

  <?php
$w3_backg = substr($config['w3_backg'], 1);
$w3_shadow = substr($config['w3_shadow'], 1);
echo '
<script type=\'text/javascript\'>
jQuery(document).ready(function($) {
	$("#reload_captcha_symbol").click(function() {
	document.images["light_captcha_symbol"].src="'.WP_PLUGIN_URL.'/light-captcha/lib/w3captcha.php?w3_count='.$config['w3_count'].'&w3_width='.$config['w3_width'].'&w3_height='.$config['w3_height'].'&w3_font_size_min='.$config['w3_font_size_min'].'&w3_font_size_max='.$config['w3_font_size_max'].'&w3_char_angle_min='.$config['w3_char_angle_min'].'&w3_char_angle_max='.$config['w3_char_angle_max'].'&w3_char_angle_shadow='.$config['w3_char_angle_shadow'].'&w3_char_align='.$config['w3_char_align'].'&w3_start='.$config['w3_start'].'&w3_interval='.$config['w3_interval'].'&w3_chars='.$config['w3_chars'].'&w3_noise='.$config['w3_noise'].'&w3_backg='.$w3_backg.'&w3_shadow='.$w3_shadow.'&rand="+ Math.round(Math.random (0) * 1000);
	})
})
</script>
';
?>
<span style="padding: 0 20px 0 20px"><?php _e('Current'); ?></span>
<?php
echo '<img src="'.WP_PLUGIN_URL.'/light-captcha/lib/w3captcha.php?w3_count='.$config['w3_count'].'&w3_width='.$config['w3_width'].'&w3_height='.$config['w3_height'].'&w3_font_size_min='.$config['w3_font_size_min'].'&w3_font_size_max='.$config['w3_font_size_max'].'&w3_char_angle_min='.$config['w3_char_angle_min'].'&w3_char_angle_max='.$config['w3_char_angle_max'].'&w3_char_angle_shadow='.$config['w3_char_angle_shadow'].'&w3_char_align='.$config['w3_char_align'].'&w3_start='.$config['w3_start'].'&w3_interval='.$config['w3_interval'].'&w3_chars='.$config['w3_chars'].'&w3_noise='.$config['w3_noise'].'&w3_backg='.$w3_backg.'&w3_shadow='.$w3_shadow.'" alt="CAPTCHA" id="light_captcha_symbol" />';
echo '<img src="'.WP_PLUGIN_URL.'/light-captcha/style/images/reload.png" id="reload_captcha_symbol" alt="CAPTCHA Reload" title="'.__("Generate new CAPTCHA","light-captcha").'"/><br />';
 include 'inc.submit-buttons.php';?>
  <ul class="light-captcha-settings-list">
	 <li>
      <label for="data-w3_comment"><?php _e('Enable on Comments Form','light-captcha'); ?>:</label>
      <input name="data[w3_comment]" id="data-w3_comment" class="str-field"  type="checkbox" <?php if ($config['w3_comment']) echo 'checked="checked"'; ?> >
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Check this to add the CAPTCHA to your comment forms','light-captcha'); ?></span></a>
	</li> 
	 <li>
      <label for="data-w3_reg"><?php _e('Enable on Registration Form','light-captcha'); ?>:</label>
      <input name="data[w3_reg]" id="data-w3_reg" class="str-field"  type="checkbox" <?php if ($config['w3_reg']) echo 'checked="checked"'; ?> >
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Check this to add the CAPTCHA to your user registration form','light-captcha'); ?></span></a>
	</li> 
	<li>
      <label for="data-w3_backg"><?php _e('Background Color'); ?>:</label>
      <input name="data[w3_backg]" id="data-w3_backg" class="pickcolor" size="19" value="<?php print $config['w3_backg'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Choose a color for your CAPTCHA area background','light-captcha'); ?></span></a>
	</li>
	<li>
      <label for="data-w3_shadow"><?php _e('Shadow Color','light-captcha'); ?>:</label>
        <input name="data[w3_shadow]" id="data-w3_shadow" class="pickcolor" size="19" value="<?php print $config['w3_shadow'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('CAPTCHA symbol shadow color','light-captcha'); ?></span></a>
	</li>
	<li>
      <label for="data-w3_char_angle_shadow"><?php _e('Shadow Distance','light-captcha'); ?>:</label>
      <input name="data[w3_char_angle_shadow]" id="data-w3_char_angle_shadow" class="str-field" value="<?php print $config['w3_char_angle_shadow'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Shadow distance (pixels)','light-captcha'); ?></span></a>
	</li>
    <li>
      <label for="data-w3_count"><?php _e('Character Quantity','light-captcha'); ?>:</label>
      <input name="data[w3_count]" id="data-w3_count" class="str-field" value="<?php print $config['w3_count'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('How many characters to use','light-captcha'); ?></span></a>
	</li> 
    <li>
    <label for="data-w3_width"><?php _e('Width'); ?>:</label>
      <input name="data[w3_width]" id="data-w3_width" class="str-field" value="<?php print $config['w3_width'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the CAPTCHA area width in pixels','light-captcha'); ?></span></a>
	</li> 
    <li>
      <label for="data-w3_height"><?php _e('Height'); ?>:</label>
      <input name="data[w3_height]" id="data-w3_height" class="str-field" value="<?php print $config['w3_height'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the CAPTCHA area height in pixels','light-captcha'); ?></span></a>
	</li>
	<li>
      <label for="data-w3_font_size_min"><?php _e('Minimum font size','light-captcha'); ?>:</label>
      <input name="data[w3_font_size_min]" id="data-w3_font_size_min" class="str-field" value="<?php print $config['w3_font_size_min'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Minimum font size for CAPTCHA characters (pixels)','light-captcha'); ?></span></a>
	</li>
	<li>
      <label for="data-w3_font_size_max"><?php _e('Maximum font size','light-captcha'); ?>:</label>
      <input name="data[w3_font_size_max]" id="data-w3_font_size_max" class="str-field" value="<?php print $config['w3_font_size_max'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Maximum font size for CAPTCHA characters (pixels)','light-captcha'); ?></span></a>
	</li>
	<li>
      <label for="data-w3_char_angle_min"><?php _e('Maximum Character Left Slope','light-captcha'); ?>:</label>
      <input name="data[w3_char_angle_min]" id="data-w3_char_angle_min" class="str-field" value="<?php print $config['w3_char_angle_min'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Maximum slop of the generating characters to the left','light-captcha'); ?></span></a>
	</li>
	 <li>
      <label for="data-w3_char_angle_max"><?php _e('Maximum Character Right Slope','light-captcha'); ?>:</label>
      <input name="data[w3_char_angle_max]" id="data-w3_char_angle_max" class="str-field" value="<?php print $config['w3_char_angle_max'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Maximum slop of the generating characters to the right','light-captcha'); ?></span></a>
	</li>
	<li>
      <label for="data-w3_char_align"><?php _e('Character Vertical Alignment','light-captcha'); ?>:</label>
      <input name="data[w3_char_align]" id="data-w3_char_align" class="str-field" value="<?php print $config['w3_char_align'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the vertical alignment','light-captcha'); ?></span></a>
	</li>
	<li>
      <label for="data-w3_start"><?php _e('Left Spacing','light-captcha'); ?>:</label>
      <input name="data[w3_start]" id="data-w3_start" class="str-field" value="<?php print $config['w3_start'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the first left character distance from edge(pixels)','light-captcha'); ?></span></a>
	</li>
	<li>
      <label for="data-w3_interval"><?php _e('Characters Spacing','light-captcha'); ?>:</label>
      <input name="data[w3_interval]" id="data-w3_interval" class="str-field" value="<?php print $config['w3_interval'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the spacing between characters','light-captcha'); ?></span></a>
	</li>
	<li>
      <label for="data-w3_chars"><?php _e('Characters Set','light-captcha'); ?>:</label>
      <input name="data[w3_chars]" id="data-w3_chars" class="str-field" value="<?php print $config['w3_chars'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Enter the set of characters to randomly use on CAPTCHA generation','light-captcha'); ?></span></a>
	</li>
		<li>
      <label for="data-w3_noise"><?php _e('Noise Level','light-captcha'); ?>:</label>
      <input name="data[w3_noise]" id="data-w3_noise" class="str-field" value="<?php print $config['w3_noise'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify in % the graphic noise level. The more noise level the harder to recognize a character','light-captcha'); ?></span></a>
	</li>
  </ul>
</fieldset>


<?php include 'inc.submit-buttons.php';?>
</form>