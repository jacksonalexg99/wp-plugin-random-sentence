<?php
/*
Plugin Name: جملات تصادفی
Plugin URI: https://wakatime.com/@kiani
Description: ایجاد جملات تصادفی برای پنل ادمین
Version: 1.0.0
Author: Mohammadreza kiani
Author URI:https://wakatime.com/@kiani
License: GPLv2 or later
Text Domain: جملات تصادفی
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( "!! مجوز دسترسی نداری!!" );
}

define( 'RS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'RS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
function create_table_sentence() {
	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	$table_name = $wpdb->prefix . 'sentence';
	$sql        = "CREATE TABLE `${table_name}` 
                (
                    `id` INT(200) NOT NULL AUTO_INCREMENT ,
                    `text` TEXT NOT NULL ,
                    PRIMARY KEY (`id`)) ENGINE = InnoDB;";

	dbDelta( $sql );
}

function delete_table_sentence() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'sentence';
	$sql        = "DROP TABLE IF EXISTS  $table_name";
	$wpdb->query( $sql );

}

register_activation_hook( __FILE__, 'create_table_sentence' );
register_deactivation_hook( __FILE__, 'delete_table_sentence' );


if ( is_admin() ) {
	include_once RS_PLUGIN_DIR . '_inc/menu.php';
	include_once RS_PLUGIN_DIR . '_inc/widget_rs.php';
	include_once RS_PLUGIN_DIR . '_inc/sentence.php';
	include_once RS_PLUGIN_DIR . '_inc/random-sentence.php';
	function register_style_js() {
		//style
		wp_enqueue_style( 'bootstrap_rs', RS_PLUGIN_URL . 'assets/css/bootstrap.css', '', '5.2.3', );
		wp_enqueue_style( 'toast_rs', RS_PLUGIN_URL . 'assets/css/toast.css' );
		wp_enqueue_style( 'icons_css', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css' );
		wp_enqueue_style( 'style_rs', RS_PLUGIN_URL . 'assets/css/style.css', '', '1.0.0', );
		//script
		wp_enqueue_script( 'script_rs', RS_PLUGIN_URL . 'assets/js/dashboard.js', [ 'jquery' ], '1.0.0', true );
		wp_enqueue_script( 'bootstrap_rs', RS_PLUGIN_URL . 'assets/js/bootstrap.min.js','' ,'5.2.3', );
		wp_enqueue_script( 'popper_rs', RS_PLUGIN_URL . 'assets/js/popper.min.js','', '1.0.0', );
		wp_enqueue_script( 'toast_rs', RS_PLUGIN_URL . 'assets/js/toast.js' );
	    wp_enqueue_script( 'jscolor_rs', RS_PLUGIN_URL . 'assets/js/jscolor.min.js', [ 'jquery' ],'1.0.0' );

		wp_localize_script('script_rs','wp_nonce',[
			"nonce"=>wp_create_nonce()
		]);

	}
} else {
	include_once RS_PLUGIN_DIR . '_inc/random-sentence.php';
	include_once RS_PLUGIN_DIR . '_inc/shortcode.php';
}

add_action( 'admin_enqueue_scripts', 'register_style_js' );