<?php
add_action( 'wp_ajax_save_sentence', 'save_sentence' );
add_action( 'wp_ajax_remove_sentence', 'remove_sentence' );
add_action( 'wp_ajax_fetch_sentence', 'fetch_sentence' );
add_action( 'wp_ajax_update_sentence', 'update_sentence' );
add_action( 'wp_ajax_save_setting', 'save_setting' );

function save_sentence() {
	if ( ! wp_verify_nonce( $_POST['nonce'] ) ) {
		die( 'مجوز دسترسی نداری' );
	}
	global $wpdb;
	$table = $wpdb->prefix . 'sentence';
	$text  = sanitize_textarea_field( $_POST['text'] );
	$data  = [
		'text' => $text
	];
	$res   = $wpdb->insert( $table, $data, [ '%s' ] );

	if ( $res ) {
		wp_send_json( [
			"success" => "true",
			"message" => "با  موفقیت اضافه شد",
		], 200 );
	} else {
		wp_send_json( [
			"error"   => "true",
			"message" => "خطایی رخ داده است"
		], 403 );
	}
}

function remove_sentence() {
	if ( ! wp_verify_nonce( $_POST['nonce'] ) ) {
		die( 'مجوز دسترسی نداری' );
	}
	global $wpdb;
	$table = $wpdb->prefix . 'sentence';
	$id    = intval( $_POST['id'] );
	$res   = $wpdb->delete( $table, [ "id" => $id ], [ '%d' ] );
	if ( $res ) {
		wp_send_json( [
			"success" => true,
			"message" => "با موفقیت حذف شد"
		], 200 );
	} else {
		wp_send_json( [
			"error"   => "true",
			"message" => "خطای رخ داده است"
		], 401 );
	}

}

function get_sentence() {
	global $wpdb;
	$table    = $wpdb->prefix . 'sentence';
	$res      = $wpdb->get_results( "SELECT * FROM $table" );
	$sentence = json_decode( json_encode( $res ), true );

	return $sentence;
}

function fetch_sentence() {
	global $wpdb;
	$table = $wpdb->prefix . 'sentence';
	$id    = intval( $_POST['id'] );
	$res   = $wpdb->get_row( "SELECT * FROM $table WHERE id = $id" );

	if ( $res ) {
		$data = [
			"id"   => $res->id,
			"text" => $res->text
		];
		echo wp_json_encode( $data, 200 );
	}
	wp_die();
}

function update_sentence() {
	if ( ! wp_verify_nonce( $_POST['nonce'] ) ) {
		die( 'مجوز دسترسی نداری' );
	}
	global $wpdb;
	$table = $wpdb->prefix . 'sentence';
	$id    = intval( $_POST['id'] );
	$text  = sanitize_textarea_field( $_POST['text'] );
	var_dump( $text );
	$wpdb->update( $table, [ 'text' => $text ], [ 'id' => $id ], [ '%s' ], [ '%d' ] );

}

function save_setting() {
	if ( ! wp_verify_nonce( $_POST['nonce'] ) ) {
		die( 'مجوز دسترسی نداری' );
	}
	$rs_fontsize       = intval( $_POST['rs_fontsize'] );
	$rs_color          = sanitize_text_field( $_POST['rs_color'] );
	$rs_bgcolor        = sanitize_text_field( $_POST['rs_bgcolor'] );
	$check_transparent = sanitize_text_field( $_POST['check_transparent'] );
	$check_widget      = sanitize_text_field( $_POST['check_widget'] );
	$check_transparent == "on" ? $check = 1 : $check = 0;
	$check_widget == "on" ? $check_w = 1 : $check_w = 0;
	update_option( '_rs_fontsize', $rs_fontsize );
	update_option( '_rs_textcolor', $rs_color );
	update_option( '_rs_bgcolor', $rs_bgcolor );
	update_option( '_rs_transparent', $check );
	update_option( '_rs_widget', $check_w );

}