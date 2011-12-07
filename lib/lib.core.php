<?php
/**
 * Function lightcaptcha_require
 * 
 * @param $dir
 * @param $load
 * @return void
 */
if (!function_exists('lightcaptcha_require')) :
function lightcaptcha_require($dir,$load = array('class.','func.','lib.'))
{
	if ( is_dir($dir)) {
		$handle = @opendir( $dir );
		while (($file = readdir( $handle ) ) !== false ) {
			if ( substr($file, 0, 1) == '.' ) continue;
			if ( is_dir($inc = realpath($dir.'/'.$file)) ) {
				lightcaptcha_require($inc,$load);
			} elseif (is_file($inc = realpath($dir.'/'.$file))) {
				foreach ($load as $needle) {
					if (strstr($file,$needle) !== false) {
						require_once $inc;
					}
				}
			}
		}
		@closedir( $handle );
	}
} // end func lightcaptcha_require
endif;