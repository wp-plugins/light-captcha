<?php /** @version $Id: view-settings-math.php */ ?>
<?php $config = $this->config('default-m');?>
<form method="post" action="">

<?php include 'inc.submit-buttons.php';?>
<fieldset>
  <h3 style="margin-left:20px"><?php _e('Mathematical CAPTCHA Settings','light-captcha'); ?></h3>

  <?php
$math_backg = substr($config['math_backg'], 1);
$math_text = substr($config['math_text'], 1);
$math_grid = substr($config['math_grid'], 1);

echo '
<script type=\'text/javascript\'>
jQuery(document).ready(function($) {
	$("#reload_captcha_math").click(function() {
	document.images["light_captcha_math"].src="'.WP_PLUGIN_URL.'/light-captcha/lib/math_captcha.php?math_captcha_w='.$config['math_captcha_w'].'&math_captcha_h='.$config['math_captcha_h'].'&math_min_font_size='.$config['math_min_font_size'].'&math_max_font_size='.$config['math_max_font_size'].'&math_angle='.$config['math_angle'].'&math_bg_size='.$config['math_bg_size'].'&math_operators_mu='.$config['math_operators_mu'].'&math_operators_sub='.$config['math_operators_sub'].'&math_operators_plus='.$config['math_operators_plus'].'&math_operators_di='.$config['math_operators_di'].'&math_first_num_1='.$config['math_first_num_1'].'&math_first_num_2='.$config['math_first_num_2'].'&math_second_num_1='.$config['math_second_num_1'].'&math_second_num_2='.$config['math_second_num_2'].'&math_backg='.$math_backg.'&math_text='.$math_text.'&math_grid='.$math_grid.'&rand="+ Math.round(Math.random (0) * 1000);
	})
})
</script>
';
?>
<span style="padding: 0 20px 0 20px"><?php _e('Current','light-captcha'); ?></span>
<?php
echo '<img src="'.WP_PLUGIN_URL.'/light-captcha/lib/math_captcha.php?math_captcha_w='.$config['math_captcha_w'].'&math_captcha_h='.$config['math_captcha_h'].'&math_min_font_size='.$config['math_min_font_size'].'&math_max_font_size='.$config['math_max_font_size'].'&math_angle='.$config['math_angle'].'&math_bg_size='.$config['math_bg_size'].'&math_operators_mu='.$config['math_operators_mu'].'&math_operators_sub='.$config['math_operators_sub'].'&math_operators_plus='.$config['math_operators_plus'].'&math_operators_di='.$config['math_operators_di'].'&math_first_num_1='.$config['math_first_num_1'].'&math_first_num_2='.$config['math_first_num_2'].'&math_second_num_1='.$config['math_second_num_1'].'&math_second_num_2='.$config['math_second_num_2'].'&math_backg='.$math_backg.'&math_text='.$math_text.'&math_grid='.$math_grid.'" alt="CAPTCHA" id="light_captcha_math" />';
echo '	<img src="'.WP_PLUGIN_URL.'/light-captcha/style/images/reload.png" id="reload_captcha_math" alt="CAPTCHA Reload" title="'.__("Generate new CAPTCHA","light-captcha").'"/><br />';?>


  <ul class="light-captcha-settings-list">
	<li>
      <label for="data-math_comment"><?php _e('Enable on Comments Form','light-captcha'); ?>:</label>
      <input name="data[math_comment]" id="data-math_comment" class="str-field"  type="checkbox" <?php if ($config['math_comment']) echo 'checked="checked"'; ?> >
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Check this box to add the CAPTCHA to your comment forms','light-captcha'); ?></span></a> 
	</li> 
	 <li>
      <label for="data-math_reg"><?php _e('Enable on Registration Form','light-captcha'); ?>:</label>
      <input name="data[math_reg]" id="data-math_reg" class="str-field"  type="checkbox" <?php if ($config['math_reg']) echo 'checked="checked"'; ?> >
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Check this box to add the CAPTCHA to your user registration form','light-captcha'); ?></span></a>
	</li>
	<li>
      <label for="data-math_text"><?php _e('Text Color'); ?>:</label>
      <input name="data[math_text]" id="data-math_text" class="pickcolor" size="19" value="<?php print $config['math_text'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Choose the color for generating digits','light-captcha'); ?></span></a> 
	</li>
	<li>
      <label for="data-math_backg"><?php _e('Background Color'); ?>:</label>
      <input name="data[math_backg]" id="data-math_backg" class="pickcolor" size="19" value="<?php print $config['math_backg'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Choose a color for your CAPTCHA area background','light-captcha'); ?></span></a>
	</li>
	<li>
      <label for="data-math_grid_r"><?php _e('Grid Color','light-captcha'); ?>:</label>
      <input name="data[math_grid]" id="data-math_grid" class="pickcolor" size="19" value="<?php print $config['math_grid'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Choose the color for your background cells','light-captcha'); ?></span></a>
	</li>
	 <li>
      <label for="data-math_bg_size"><?php _e('Grid Size','light-captcha'); ?>:</label>
      <input name="data[math_bg_size]" id="data-math_bg_size" class="str-field" value="<?php print $config['math_bg_size'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify cell size of your generating background grid','light-captcha'); ?></span></a>
	</li>
    <li>
    <label for="data-math_captcha_w"><?php _e('Width'); ?>:</label>
      <input name="data[math_captcha_w]" id="data-math_captcha_w" class="str-field" value="<?php print $config['math_captcha_w'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the CAPTCHA area width in pixels','light-captcha'); ?></span></a>
	</li> 
    <li>
      <label for="data-math_captcha_h"><?php _e('Height'); ?>:</label>
      <input name="data[math_captcha_h]" id="data-math_captcha_h" class="str-field" value="<?php print $config['math_captcha_h'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the CAPTCHA area height in pixels','light-captcha'); ?></span></a>
	</li>
	<li>
      <label for="data-math_min_font_size"><?php _e('Minimum Font Size','light-captcha'); ?>:</label>
      <input name="data[math_min_font_size]" id="data-math_min_font_size" class="str-field" value="<?php print $config['math_min_font_size'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the minimal font size for generating digits','light-captcha'); ?></span></a> 
	</li>
	<li>
      <label for="data-math_max_font_size"><?php _e('Maximum Font Size','light-captcha'); ?>:</label>
      <input name="data[math_max_font_size]" id="data-math_max_font_size" class="str-field" value="<?php print $config['math_max_font_size'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the maximal font size for generating digits','light-captcha'); ?></span></a> 
	</li>
	<li>
      <label for="data-math_angle"><?php _e('Rotation Angle','light-captcha'); ?>:</label>
      <input name="data[math_angle]" id="data-math_angle" class="str-field" value="<?php print $config['math_angle'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the maximal slop of the generating digits','light-captcha'); ?></span></a> 
	</li>
	<li>
      <label for="data-math_operators"><?php _e('Possible Math Operators','light-captcha'); ?>:</label>
		<input name="data[math_operators_plus]" id="data-math_operators_plus"   type="checkbox" <?php if ($config['math_operators_plus']) echo 'checked="checked"'; ?> > <span style="padding-right:10px">+</span>

	  <input name="data[math_operators_sub]" id="data-math_operators_sub"   type="checkbox" <?php if ($config['math_operators_sub']) echo 'checked="checked"'; ?> > <span style="padding-right:10px">-</span>

	  <input name="data[math_operators_mu]" id="data-math_operators_mu"   type="checkbox" <?php if ($config['math_operators_mu']) echo 'checked="checked"'; ?> > <span style="padding-right:10px">*</span>

	  <input name="data[math_operators_di]" id="data-math_operators_di"  type="checkbox" <?php if ($config['math_operators_di']) echo 'checked="checked"'; ?> > <span>/</span>
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Choose mathematical operations to use','light-captcha'); ?></span></a> 
	</li>

	<li>
      <label for="data-math_first_num"><?php _e('First Number, Range of Random Values (Keep it lower than Second Number)','light-captcha'); ?>:</label>
      <input name="data[math_first_num_1]" id="data-math_first_num_1"  value="<?php print $config['math_first_num_1'];?>" type="text" size="5">
	  <input name="data[math_first_num_2]" id="data-math_first_num_2"  value="<?php print $config['math_first_num_2'];?>" type="text" size="5">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Range of Random Values from X to Y','light-captcha'); ?></span></a> 
	</li>
	<li>
      <label for="data-math_second_num"><?php _e('Second Number Random Value','light-captcha'); ?>:</label>
      <input name="data[math_second_num_1]" id="data-math_second_num_1" value="<?php print $config['math_second_num_1'];?>" type="text" size="5">
	    <input name="data[math_second_num_2]" id="data-math_second_num_2" value="<?php print $config['math_second_num_2'];?>" type="text" size="5">
      <a class="tooltip" href="javascript:void(0);">?<span>	<?php _e('Range of Random Values from X to Y','light-captcha'); ?></span></a> 
	</li>
  </ul>
</fieldset>

<?php include 'inc.submit-buttons.php';?>
</form>