<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://wpeacock.com/
 * @since             0.0.1
 * @package           socialpost
 *
 * Plugin Name: SocialPost
 * Plugin URI: http://wpeacock.com/
 * Description: SocialPost - Social Media Auto Publish Plugin will post automatically from WordPress to social media with ease and comfortable interface. 
 * Version: 0.1.5
 * Author: codeparshuram
 * License: GPL-2.0+
 * Text Domain: socialpost
**/
if( !session_id() ) session_start();
if(isset($_SESSION['socialpost_admin_notices'])){
	add_action( 'admin_notices', 'socialpost_error_notice' );
}
function socialpost_error_notice() {
    ?>
    <div class="error notice">
        <p><?php _e( $_SESSION['socialpost_admin_notices']['msg'], 'socialpost' ); ?></p>
    </div>
    <?php
	unset($_SESSION['socialpost_admin_notices']);
}

register_activation_hook( __FILE__, 'socialpost_install' );
function socialpost_install(){
	global $wpdb;
	// code to creat database table
	

}


//register custom po	st types for plugin usage
function socialpost_custom_post_type(){
    register_post_type('socialpost_fb_cons',
                       [
                           'labels'      => [
                               'name'          => __('Facebook Connections','socialpost'),
                               'singular_name' => __('Facebook Connection','socialpost'),
                           ],
                           'public'      => true,
                           'has_archive' => true,
                           'rewrite'     => ['slug' => 'socialpost_fb_cons'], // my custom slug
						    'show_ui' => false
                       ]
    );
	register_post_type('socialpost_tw_cons',
                       [
                           'labels'      => [
                               'name'          => __('Twitter Connections','socialpost'),
                               'singular_name' => __('Twitter Connection','socialpost'),
                           ],
                           'public'      => true,
                           'has_archive' => true,
                           'rewrite'     => ['slug' => 'socialpost_tw_cons'], // my custom slug
						   'show_ui' => false
                       ]
    );
	register_post_type('socialpost_fbp_cons',
                       [
                           'labels'      => [
                               'name'          => __('FB-Page Connections','socialpost'),
                               'singular_name' => __('FB-Page Connection','socialpost'),
                           ],
                           'public'      => true,
                           'has_archive' => true,
                           'rewrite'     => ['slug' => 'socialpost_fbp_cons'], // my custom slug
						   'show_ui' => false
                       ]
    );
	register_post_type('socialpost_li_cons',
                       [
                           'labels'      => [
                               'name'          => __('LinkedIn Connections','socialpost'),
                               'singular_name' => __('LinkedIn Connection','socialpost'),
                           ],
                           'public'      => true,
                           'has_archive' => true,
                           'rewrite'     => ['slug' => 'socialpost_li_cons'], // my custom slug
						   'show_ui' => false
                       ]
    );
	register_post_type('socialpost_lip_cons',
                       [
                           'labels'      => [
                               'name'          => __('IN-Page Connections','socialpost'),
                               'singular_name' => __('IN-Page Connection','socialpost'),
                           ],
                           'public'      => true,
                           'has_archive' => true,
                           'rewrite'     => ['slug' => 'socialpost_lip_cons'], // my custom slug
						   'show_ui' => false
                       ]
    );
	
}
add_action('init', 'socialpost_custom_post_type');

global $socialPost_pluginDir,$socialPost_pluginUrl;
$socialPost_pluginDir = plugin_dir_path(__FILE__);
$socialPost_pluginUrl = plugin_dir_url(__FILE__);

//Include CSS files.
function socialpost_scripts() {
	global $socialPost_pluginUrl;
	 wp_enqueue_style( 'socialpost-jui-styles',  $socialPost_pluginUrl . 'css/jquery-ui.css' );
    wp_enqueue_style( 'socialpost-main-styles',  $socialPost_pluginUrl . 'css/main_styles.css' );
   
	
	
	
	//load script js files
	

	wp_enqueue_script('socialpost-custom-js', $socialPost_pluginUrl . 'js/main_script.js', array('jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-tabs', 'jquery-ui-accordion', 'jquery-ui-button'), '', true);

}
add_action( 'admin_enqueue_scripts', 'socialpost_scripts' );


add_action('admin_menu', 'socialpost_create_menu');
function socialpost_create_menu(){
	add_menu_page('SocialPost', __('SocialPost','socialpost'), 'administrator', 'socialpost', 'socialpost_welcome' , 'dashicons-admin-home' );
	
	/* remove duplicate menu hack */
	add_submenu_page(
		'socialpost', // parent slug, same as above menu slug
		'Dashboard',       // empty page title
		__('Dashboard','socialpost'),       // empty menu title
		'manage_options',       // same capability as above
		'socialpost',          // same menu slug as parent slug
		'socialpost_welcome'   // same function as above
	);

	add_submenu_page( 'socialpost', 'SocialPost Connections', __('Connections','socialpost'), 'manage_options', 'socialpost_con', 'socialpost_con');
	add_submenu_page( 'socialpost', 'SocialPost Log', __('Log Data','socialpost'), 'manage_options', 'socialpost_log', 'socialpost_log');
	add_submenu_page( Null, 'Connections', __('Save Connections','socialpost'), 'manage_options', 'socialpost_con_save', 'socialpost_con_save');
}

function socialpost_welcome(){
	
	global $socialPost_pluginUrl;
	
	//include this dashboard HTML
	include('html/socialpost_das_HTML.php');
}

include("socialpost_con.php");
include("socialpost_log.php");
include("socialpost_metabox.php");