<?php
class PluginLightCaptcha_Abstract
{
	protected $_config;
	public $viewIndexAll;
	public $viewIndex;
	public $pluginHook = null;
	
	public function __construct()
	{
		$this->_config = array();
	} // end func __construct
	
	public function configure($config)
	{
		$this->_config = $config;
	} // end func confugure
	
	// }}}
	// {{{ init
	
	/**
	 * init
	 */
	public function init()
	{
		$hook = $this->_config['plugin-hook'];
		register_activation_hook($hook, array($this,'_hook_activate'));
		register_deactivation_hook($hook, array($this,'_hook_deactivate'));
		
		//add_filter( 'plugin_row_meta', array($this,'_hook_plugin_action_links'),10,2);
		add_filter( 'query_vars', array($this,'_hook_query_vars'));
		add_filter( 'rewrite_rules_array', array($this,'_hook_rewrite_rules_array'));
		add_filter( 'wp_print_styles', array($this,'_hook_wp_print_style'));
		add_filter( 'widgets_init', array($this,'_hook_widgets_init'));
		add_filter( 'save_post', array($this,'_hook_save_post'));
	//	add_filter( 'contextual_help', array($this,'_hook_contextual_help'),10,3);
		add_filter( 'wp_head', array($this, '_hook_wp_head'));
		add_filter( 'wp_footer', array($this, '_hook_wp_footer'));
		add_filter( 'wp_loaded', array($this, '_hook_wp_loaded'));
		
		if (is_admin()) {
			add_filter('add_meta_boxes', array($this,'_hook_add_meta_boxes'));
			add_filter('admin_init', array($this,'_hook_admin_init'));
			add_filter('admin_menu', array($this,'_hook_admin_menu'));
		}
		$config_s = $this->config('default-s');
		$config_m = $this->config('default-m');
		if ($config_m['math_comment']!="" || $config_s['w3_comment']!="") {
			add_action('comment_form_after_fields', array($this, 'thethe_captcha_comment_form'), 1);
			add_action('comment_form_logged_in_after', array($this, 'thethe_captcha_comment_form'), 1);
			add_filter('preprocess_comment', array($this, 'thethe_captcha_comment_post'), 1);
		}
		if ($config_m['math_reg']!="" || $config_s['w3_reg']!="") {
			add_action('register_form', array($this, 'thethe_captcha_register_form'), 10);
			add_filter('registration_errors', array($this, 'thethe_captcha_register_post'), 10);
		}
		add_filter( 'init', array($this,'_hook_init'));	
	} // end func init

	// }}}
	// {{{ manage_options

	/**
	 * display
	 */
	public function display()
	{
		if (!is_admin()) return false;
		if (!current_user_can('manage_options')) {
			wp_die('You do not have sufficient permissions to access this page.');
		}
		$view = (isset($_REQUEST['view']) ? $_REQUEST['view'] : 'default');
		$view = str_replace(' ','',ucwords(str_replace('-',' ',$view)));
		$methodName = '_'.$view.'View';
		if (method_exists($this,$methodName)) {
			return call_user_method($methodName,$this);
		} else {
			return $this->_defaultView();
		}
	} // end func display
	
	// }}}
	// {{{ displayAboutClub

	/**
	 * Func displayAboutClub
	 */

	
	// }}}
	// {{{ config
	
	/**
	 * Config
	 * @return array|mixed
	 */
	public function config($ns = 'default-s')
	{	
		return stripslashes_deep(get_option(
				'_ttf-' . $this->_config['shortname'] . '-' . $ns,
				$this->_config['options'][$ns]
			));
	} // end func config 

	
	// }}}
	// {{{ _hook_activate

	/**
	 * _hook_activate
	 */
	public function _hook_activate()
	{
		if (isset($this->_config['options'])) {
			if (is_array($data = $this->_config['options'])) {
				$suffix = '_ttf-' . $this->_config['shortname'];
				foreach ($data as $key => $config) {
					if ($key && ($key != 'default')) {
						$name = $suffix . '-' . $key;
					} else {
						$name = $suffix;
					}
					update_option(mb_strtolower($name),$this->_config['options'][$key]);
				}
			}
		}
	} // end func _hook_activate
	
	// }}}
	// {{{ _hook_admin_menu
	
	/**
	 * _hook_admin_menu
	 */
	public function _hook_admin_menu()
	{
		global $menu;

		$flag['makebox'] = true;
		if (is_array($menu)) foreach ($menu as $e) {
			if (isset($e[0]) && (in_array($e[0], array('Light CAPTCHA','Light CAPTCHA')))) {
				$flag['makebox'] = false;
				break;
			}
		}
		
		if ($flag['makebox']) {
		 $icon_url = $title = $this->_config['meta']['wp_plugin_dir_url'] . 'style/admin/images/favicon.ico';

			//$hook = add_submenu_page('lightcaptcha', __('About Light CAPTCHA','light-captcha'), 'About the Club', 'manage_options', 'lightcaptcha', 'TheThe_makeAdminPage');
			add_filter( 'admin_print_styles-' . $hook, array($this,'_hook_admin_print_styles'));
		}

		$title = $this->_config['meta']['Name'];
		$title = trim(str_replace('TheThe', null, $title));
		$shortname = $this->_config['shortname'];
    $this->pluginHook = add_management_page('Light CAPTCHA', 'Light CAPTCHA','manage_options',$shortname,array($this,'display'));
		add_filter( 'admin_print_styles-' . $this->pluginHook , array($this,'_hook_admin_print_styles'));
	} // end func _hook_admin_menu
	
	// }}}
	// {{{ _hook_admin_print_styles
	
	/**
	 * _hook_admin_print_styles
	 */
	public function _hook_admin_print_styles()
	{
		wp_admin_css( 'nav-menu' );
		$interface_css = $this->_config['meta']['wp_plugin_dir_url'] . '/style/admin/interface.css';
		wp_enqueue_style( 'lightcaptcha-plugin-panel-interface', $interface_css );
		wp_enqueue_script( 'postbox' );
		wp_enqueue_script( 'post' );
		wp_register_script( 'lightcaptcha-color-picker', WP_PLUGIN_URL.'/light-captcha/style/admin/js/color-picker.js' );
		// Color picker
		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_script( 'lightcaptcha-color-picker' );
		wp_enqueue_script( 'farbtastic', false, array('lightcaptcha-color-picker'));	
	
	} // end func _hook_admin_print_styles
	



	/**
	 * _defaultView
	 */
	public function _defaultView()
	{
		$viewIndex = $this->getCurrentViewIndex();
		$dir = $this->_config['meta']['wp_plugin_dir'];
		$viewFileName = $dir . '/inc/view.' . $viewIndex . '.php';
		if (isset($this->viewIndexAll[$viewIndex]['file'])) {
			$file = $this->viewIndexAll[$viewIndex]['file'];
			if (file_exists($dir . '/inc/' . $file)) {
				$viewFileName = $dir . '/inc/' . $file;
			}
		}
		include $dir . '/inc/inc.header.php';
		include $viewFileName;
		include $dir . '/inc/inc.footer.php';
	} // end func _defaultView
	
	// }}}
	// {{{ getCurrentViewIndex
	
	/**
	 * Function getCurrentViewIndex
	 */
	public function getCurrentViewIndex()
	{
		$this->viewIndex = (isset($_REQUEST['view']) && isset($this->viewIndexAll[$_REQUEST['view']]))
			? $_REQUEST['view'] : 'overview';
		return $this->viewIndex;
	} // end func getCurrentViewIndex
	
	// }}}
	// {{{ getTabURL
	
	/**
	 * Function getTabURL
	 * @param string $viewIndex
	 * @return string
	 */
	public function getTabURL($viewIndex = null)
	{
		if (!$viewIndex) $viewIndex = 'overview';
		return get_admin_url() . 'admin.php?page=' . $this->_config['shortname'] . '&amp;view=' . $viewIndex;
	} // end func getTabURL
	
	// }}}
	// {{{ printTabsURL
	
	/**
	 * Function printTabsURL
	 * @param string $viewIndex
	 */
	public function printTabsURL($viewIndex = null)
	{
		print $this->getTabURL($viewIndex);
	} // end func printTabsURL
	
	// }}}

	public function _hook_wp_head() {}
	public function _hook_wp_footer() {}
	public function _hook_init() {}
	public function _hook_wp_loaded() {}
	public function _hook_wp_print_style(){}
	public function _hook_widgets_init() {}
	public function _hook_query_vars($args) { return $args; }
	public function _hook_rewrite_rules_array($rules) { return $rules; }
	public function _hook_save_post($post_id) {}
	public function _hook_add_meta_boxes() {}
	public function _hook_admin_init() {}
	public function _hook_deactivate() {}
	public function thethe_captcha_comment_form() {}
	public function thethe_captcha_comment_post() {}
	public function thethe_captcha_register_form() {}
	public function thethe_captcha_register_post($errors) {}
} // end class PluginAbstract