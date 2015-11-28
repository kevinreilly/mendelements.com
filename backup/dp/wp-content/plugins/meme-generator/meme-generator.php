<?php
/*
Plugin Name: Meme Generator
Plugin URI: http://www.wpgoods.com/products/meme-generator/
Description: Meme Generator is the best way to add user-generated content to your WordPress site. You can create a meme using the WordPress visual editor or allow site visitors to create memes with an easy-to-use WordPress shortcode.
Version: 1.1
Author: Brandon Bell
Author URI: http://www.wpgoods.com
Author Email: contact@wpgoods.com
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Global Scope Constants
define('memegen_path', plugin_dir_path(__FILE__));
// Declare Global Variables
$Meme_Generator_Path = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
$Meme_Generator_Data = get_option('memegen_options');
$Meme_Generator_Slug = basename(dirname(__FILE__));
$Meme_Generator_Class = array('admin','dialog','preview','shortcode','post','api');
// Require the Dialog, Preview, Shortcode, Post and API classes
foreach($Meme_Generator_Class as $class) {
	require_once( memegen_path . 'inc/'.$class.'/class.php' );
}

class MemeGenerator {

	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/
	const name = 'Meme Generator';
	const slug = 'memegen';
	
	/**
	 * Constructor
	 */
	function __construct() {
		// Register an activation hook for the plugin
		register_activation_hook( __FILE__, array( $this, 'install_memegen' ) );

		// Hook up to the init action
		add_action( 'init', array( $this, 'init_memegen' ) );
	}
  
	/**
	 * Runs when the plugin is activated
	 */
	public function install_memegen() {
		//check for gd extension
		if (!extension_loaded('gd') && !function_exists('gd_info')) {
			exit('<div id="message" class="error"><p><strong>'.__('GD Library Error: The PHP extension GD is not properly configured on your server. As a result, Meme Generator will not function correctly. Please contact your webhost and ask them to install the GD library.','memegen').'</p></div>');
		}
		
		//save default shortcodes
		if (!get_option('memegen_options')) {
			$default = array(
				'submission_policy' => 'pending',
				'require_registration' => 'no',
				'admin_notification' => 'yes',
				'user_notification' => 'yes',
				'watermark_image' => 'yes',
				'max_width' => '450',
				'max_height' => '450'
			);
			update_option('memegen_options',$default);
		}
	}
  
	/**
	 * Runs when the plugin is initialized
	 */
	public function init_memegen() {        
        // Setup localization
		load_plugin_textdomain( 'memegen', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
		// Load JavaScript and Stylesheets
		$this->register_scripts_and_styles();
		// Add TinyMCE button
		$this->memegen_add_button();
		
		// Add action links in Plugins page
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'memegen_action_links' ) );
		// Add meta links in Plugins page
		add_filter( 'plugin_row_meta', array( $this, 'memegen_meta_links' ), 10, 2 );
		
		// Ajax request for all users
		add_action('wp_ajax_nopriv_ajax_memegen_verify', array( $this, 'ajax_memegen_verify' ));
		// Ajax request for logged in users
		add_action('wp_ajax_ajax_memegen_verify', array( $this, 'ajax_memegen_verify' ));        
	}
	
	// Add action links in Plugins page
	public function memegen_action_links( $links ) {
		return array_merge(
			array(
				'settings' => '<a href="' . admin_url('admin.php?page=memegen') . '">' . __( 'Settings', 'memegen' ) . '</a>'
			),
			$links
		);
	}
	
	// Add meta links in Plugins page
	public function memegen_meta_links( $links, $file ) {
		$plugin = plugin_basename(__FILE__);
		// create link
		if ( $file == $plugin ) {
			return array_merge(
				$links,
				array( '<a href="http://twitter.com/wpgoods">'.__('Twitter', 'memegen').'</a>' )
			);
		}
		return $links;
	}
	
	// Add Meme Generator button to TinyMCE
	public function memegen_add_button() {
		global $pagenow;
		
		// Don't bother doing this stuff if the current user lacks permissions
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
		
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true' && ( in_array( $pagenow, array( 'post.php', 'post-new.php', 'page-new.php', 'page.php' ) ) ) ) {
			add_filter( 'mce_external_plugins', array( $this, 'add_memegen_tinymce_plugin' ) );
			add_filter( 'mce_buttons', array( $this, 'register_memegen_button' ) );
		}
	}

	// Load the TinyMCE plugin: editor_plugin.js
	public function add_memegen_tinymce_plugin($plugin_array) {
		// This plugin file will work the magic of our button
		global $Meme_Generator_Path;
		$plugin_array["meme_generator"] = $Meme_Generator_Path . 'inc/plugin/editor_plugin.js';
		return $plugin_array;
	}
        
	// Register the button
	public function register_memegen_button($buttons) {
		// Add a separation before our button, here our button's id is meme_generator
	   array_push($buttons, "|", "meme_generator");
	   return $buttons;
	}
  
	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {	
		if ( is_admin() ) {
			if (isset($_GET['page']) && $_GET['page'] == 'memegen') {
				$this->load_file( self::slug . '-admin-script', '/js/admin.min.js', true );
				$this->load_file( self::slug . '-admin-style', '/css/admin.css' );
			}
		} else {
			$this->load_file( self::slug . '-script', '/js/display.min.js', true );
			$this->load_file( self::slug . '-style', '/css/display.css' );
            wp_enqueue_style( 'thickbox' );
            wp_enqueue_script( 'thickbox' );
            wp_localize_script( self::slug . '-script', 'MemeGen', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		} // end if/else
	} // end register_scripts_and_styles
	
	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name	The 	ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file( $name, $file_path, $is_script = false ) {

		$url = plugins_url($file_path, __FILE__);
		$file = plugin_dir_path(__FILE__) . $file_path;

		if( file_exists( $file ) ) {
			if( $is_script ) {
				wp_register_script( $name, $url, array('jquery','thickbox') ); //depends on jquery
				wp_enqueue_script( $name );
			} else {
				wp_register_style( $name, $url );
				wp_enqueue_style( $name );
			} // end if
		} // end if

	} // end load_file

	// Create nonce to verify ajax calls
	public function ajax_memegen_verify() {
		echo wp_create_nonce('memegen_verify');
		die();
	}
  
} // end class
$memegen_plugin = new MemeGenerator();
?>