<?php
/* Sendy integration for Layered Popups */
class ulp_sendy_class {
	var $default_popup_options = array(
		'sendy_enable' => 'off',
		'sendy_url' => '',
		'sendy_listid' => ''
	);
	function __construct() {
		if (is_admin()) {
			add_action('ulp_popup_options_show', array(&$this, 'popup_options_show'));
			add_action('ulp_subscribe', array(&$this, 'subscribe'), 10, 2);
			add_filter('ulp_popup_options_check', array(&$this, 'popup_options_check'), 10, 1);
			add_filter('ulp_popup_options_populate', array(&$this, 'popup_options_populate'), 10, 1);
		}
	}
	function popup_options_show($_popup_options) {
		$popup_options = array_merge($this->default_popup_options, $_popup_options);
		echo '
				<h3>'.__('Sendy Parameters', 'ulp').'</h3>
				<table class="ulp_useroptions">
					<tr>
						<th>'.__('Enable Sendy', 'ulp').':</th>
						<td>
							<input type="checkbox" id="ulp_sendy_enable" name="ulp_sendy_enable" '.($popup_options['sendy_enable'] == "on" ? 'checked="checked"' : '').'"> '.__('Submit contact details to Sendy', 'ulp').'
							<br /><em>'.__('Please tick checkbox if you want to submit contact details to Sendy.', 'ulp').'</em>
						</td>
					</tr>
					<tr>
						<th>'.__('Installation URL', 'ulp').':</th>
						<td>
							<input type="text" id="ulp_sendy_url" name="ulp_sendy_url" value="'.esc_html($popup_options['sendy_url']).'" class="widefat">
							<br /><em>'.__('Enter your Sendy installation URL (without the trailing slash).', 'ulp').'</em>
						</td>
					</tr>
					<tr>
						<th>'.__('List ID', 'ulp').':</th>
						<td>
							<input type="text" id="ulp_sendy_listid" name="ulp_sendy_listid" value="'.esc_html($popup_options['sendy_listid']).'" class="widefat">
							<br /><em>'.__('Enter your List ID. This encrypted & hashed id can be found under View all lists section named ID.', 'ulp').'</em>
						</td>
					</tr>
				</table>';
	}
	function popup_options_check($_errors) {
		$errors = array();
		$popup_options = array();
		foreach ($this->default_popup_options as $key => $value) {
			if (isset($_POST['ulp_'.$key])) {
				$popup_options[$key] = stripslashes(trim($_POST['ulp_'.$key]));
			}
		}
		if (isset($_POST["ulp_sendy_enable"])) $popup_options['sendy_enable'] = "on";
		else $popup_options['sendy_enable'] = "off";
		if ($popup_options['sendy_enable'] == 'on') {
			if (strlen($popup_options['sendy_url']) == 0 || !preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $popup_options['sendy_url'])) $errors[] = __('Sendy installation URL must be a valid URL.', 'ulp');
			if (empty($popup_options['sendy_listid'])) $errors[] = __('Invalid Sendy list ID', 'ulp');
		}
		return array_merge($_errors, $errors);
	}
	function popup_options_populate($_popup_options) {
		$popup_options = array();
		foreach ($this->default_popup_options as $key => $value) {
			if (isset($_POST['ulp_'.$key])) {
				$popup_options[$key] = stripslashes(trim($_POST['ulp_'.$key]));
			}
		}
		if (isset($_POST["ulp_sendy_enable"])) $popup_options['sendy_enable'] = "on";
		else $popup_options['sendy_enable'] = "off";
		return array_merge($_popup_options, $popup_options);
	}
	function subscribe($_popup_options, $_subscriber) {
		$popup_options = array_merge($this->default_popup_options, $_popup_options);
		if ($popup_options['sendy_enable'] == 'on') {
			$request = http_build_query(array(
				'email' => $_subscriber['{subscription-email}'],
				'name' => $_subscriber['{subscription-name}'],
				'list' => $popup_options['sendy_listid'],
				'boolean' => 'true'
			));

			$popup_options['sendy_url'] = rtrim($popup_options['sendy_url'], '/');
			$curl = curl_init($popup_options['sendy_url'].'/subscribe');
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

			curl_setopt($curl, CURLOPT_TIMEOUT, 20);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
			curl_setopt($curl, CURLOPT_HEADER, 0);
								
			$response = curl_exec($curl);
			curl_close($curl);
		}
	}
}
$ulp_sendy = new ulp_sendy_class();
?>