<?php
// Declare global variable
$Meme_Generator_API = 'http://wpgoods.com/api/';

if (!class_exists('memegenAPI')) {

	class memegenAPI {
    
        /**
         * Constructor
         */
        function __construct() {
            // Take over the update check
            add_filter('pre_set_site_transient_update_plugins', array( $this, 'memegen_update_check' ));
            // Take over the Plugin info screen
            add_filter('plugins_api', array( $this, 'memegen_api_call' ), 10, 3);	
        }

		// Take over the update check
		public function memegen_update_check($checked_data) {
			global $Meme_Generator_API, $Meme_Generator_Slug, $wp_version;
				
			// Comment out these two lines during testing.
			if (empty($checked_data->checked))
				return $checked_data;
				
			$args = array(
				'slug' => $Meme_Generator_Slug,
				'version' => $checked_data->checked[$Meme_Generator_Slug .'/'. $Meme_Generator_Slug .'.php'],
			);
			$request_string = array(
					'body' => array(
						'action' => 'basic_check', 
						'request' => serialize($args),
						'api-key' => md5(home_url())
					),
					'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
				);
				
			// Start checking for an update
			$raw_response = wp_remote_post($Meme_Generator_API, $request_string);
				
			if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
				$response = unserialize($raw_response['body']);
				
			if (is_object($response) && !empty($response)) // Feed the update data into WP updater
				$checked_data->response[$Meme_Generator_Slug .'/'. $Meme_Generator_Slug .'.php'] = $response;
				
			return $checked_data;
		}
		
		// Take over the Plugin info screen
		public function memegen_api_call($def, $action, $args) {
			global $Meme_Generator_Slug, $Meme_Generator_API, $wp_version;

			if (!isset($args->slug) || ($args->slug != $Meme_Generator_Slug))
				return false;
				
			// Get the current version
			$plugin_info = get_site_transient('update_plugins');
			$current_version = $plugin_info->checked[$Meme_Generator_Slug .'/'. $Meme_Generator_Slug .'.php'];
			$args->version = $current_version;
				
			$request_string = array(
					'body' => array(
						'action' => $action, 
						'request' => serialize($args),
						'api-key' => md5(home_url())
					),
					'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
				);
				
			$request = wp_remote_post($Meme_Generator_API, $request_string);
				
			if (is_wp_error($request)) {
				$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.', 'memegen').'</p> <p><a href="?" onclick="document.location.reload(); return false;">'.__('Try again', 'memegen').'</a>', $request->get_error_message());
			} else {
				$res = unserialize($request['body']);
					
				if ($res === false)
					$res = new WP_Error('plugins_api_failed', __('An unknown error occurred', 'memegen'), $request['body']);
			}
				
			return $res;
		}
		
	} // end class

    $memegen_api = new memegenAPI();
}
?>