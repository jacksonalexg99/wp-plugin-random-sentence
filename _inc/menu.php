<?php
function rs_register_admin_menu() {
	add_menu_page(
		'ایجاد جملات تصادفی ',
		'ایجاد جملات تصادفی ',
		'manage_options',
		'random-sentence',
		'rs_page'
	);
	add_submenu_page(
		'random-sentence',
		'  لیست  جملات',
		'لیست جملات',
		'manage_options',
		'random-sentence-list',
		'rs_page_list',
	);
	add_submenu_page(
		'random-sentence',
		'تنظیمات',
		'تنظیمات',
		'manage_options',
		'random-sentence-setting',
		'rs_page_setting',
	);
}

function rs_page_list() {
	include_once RS_PLUGIN_DIR . 'view/list_sentence.php';
}

function rs_page() {
	include_once RS_PLUGIN_DIR . 'view/add_sentence.php';

}
function rs_page_setting(){
	include_once RS_PLUGIN_DIR . 'view/setting_sentence.php';
}


add_action( 'admin_menu', 'rs_register_admin_menu' );






