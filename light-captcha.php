<?php
/*
Plugin Name: Light CAPTCHA
Text Domain: light-captcha
Domain Path: /languages
Version: 1.0
Plugin URI: http://arquivo.tk/dev/light-captcha
Description: Prevent spam in your site by using this simple CAPTCHA plugin. Light CAPTCHA does not require any external service account.Access Tools &rarr; <a href="tools.php?page=captcha">Light CAPTCHA</a>.
Author: Diana K. Cury
Author URI: http://arquivo.tk/
*/


require_once ABSPATH . WPINC . '/class-simplepie.php';

/** Require WP Plugin API */
require_once ABSPATH . '/wp-admin/includes/plugin.php';
require_once realpath(dirname(__FILE__) . '/lib/lib.core.php');
lightcaptcha_require(dirname(__FILE__) . '/inc', array('data.'));
lightcaptcha_require(dirname(__FILE__) . '/lib', array('func.','lib.'));
lightcaptcha_require(dirname(__FILE__) . '/lib', array('class.','widget.'));
$TheTheCaptcha = array(
    'wp_plugin_dir' => dirname(__FILE__),
	'wp_plugin_dir_url' => WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)),	
	'wp_plugin_base_name' => plugin_basename(__FILE__),
	'wp_plugin_name' => 'Light CAPTCHA',
	'wp_plugin_version' => '1.0.0'
);
/**
 * Current plugin config
 * @var array
 */
$Plugin_Config = array(
	'shortname' => 'captcha',
	'plugin-hook' => 'light-captcha/captcha.php',
	'options' => array(
		'default-s' => array(
			/* Symbol captcha */
			'w3_comment' => true,			
			'w3_reg' => false,			
			'w3_count' => 4,
			'w3_width' => 200,
			'w3_height' => 48,
			'w3_font_size_min' => 32,
			'w3_font_size_max' => 32,
			'w3_char_angle_min' => 0,
			'w3_char_angle_max' => 0,
			'w3_char_angle_shadow' => 10,
			'w3_char_align' => 40,
			'w3_start' => 10,
			'w3_interval' => 50,
			'w3_chars' => '02345689AwhM>',
			'w3_noise' => 0,
			'w3_backg' => '#FF9999',
			'w3_shadow' => '#000'
		),
		'default-m' => array(
			/* Mathematical captcha */	
			'math_comment' => false,			
			'math_reg' => false,			
			'math_captcha_w' => 150,
			'math_captcha_h' => 50,
			'math_min_font_size' => 20,
			'math_max_font_size' => 22,
			'math_angle' => 2,
			'math_bg_size' => 22,
			'math_operators_plus' => true,
			'math_operators_sub' => true,
			'math_operators_mu' => true,
			'math_operators_di' => false,
			'math_first_num_1' => 1,
			'math_first_num_2' => 5,
			'math_second_num_1' => 6,
			'math_second_num_2' => 10,
			'math_backg' => '#E2F7FA',
			'math_text' => '#666',
			'math_grid' => '#fff'
		)		
	),
	'requirements' => array('wp' => '3.1')
) + array('meta' => get_plugin_data(realpath(__FILE__)) + array(
	'wp_plugin_dir' => dirname(__FILE__),
	'wp_plugin_dir_url' => plugin_dir_url(__FILE__)
)) + array(

);

/**
 * @var PluginLiteCaptcha
 */
$GLOBALS['PluginLiteCaptcha'] = new PluginLiteCaptcha();

/**
 * Configure
 */
$GLOBALS['PluginLiteCaptcha']->configure($Plugin_Config);

/**
 * Init
 */
lightcaptcha_require(dirname(__FILE__),array('init.'));
$GLOBALS['PluginLiteCaptcha']->init();


 load_plugin_textdomain('light-captcha', false, dirname(plugin_basename(__FILE__)).'/languages' );