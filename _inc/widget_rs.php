<?php
$widget= get_option('_rs_widget');
if($widget)
{

	include_once RS_PLUGIN_DIR . '_inc/random-sentence.php';
	function register_widget_rs() {
		wp_add_dashboard_widget(
			'widget_rs_',
			'جملات تصادفی',
			'widget_rs_callback',
			'',
			'',
			'normal',
			'high'
		);
	}

	function widget_rs_callback() {
		echo random_sentence();
	}

	add_action( 'wp_dashboard_setup', 'register_widget_rs' );

}
