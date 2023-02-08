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

	$get      = $wpdb->get_results( "SELECT * FROM $table ORDER BY id DESC " );

	$sentence = json_decode(json_encode( $get ),true);
	$html_output='';
    foreach ($sentence as $sen)
    {
	    $html_output.='<tr><th class="col-1">'.$sen['id'].'</th>
                    <td id="text-sentence-'.$sen['id'].'">'.$sen['text'].'</td>
                    <td class="icon col-1">
                        <i class="fas fa-edit edit_sentence" data-id="'.$sen['id'].'" data-bs-toggle="modal"
                           data-bs-target="#edit"></i>
                        <i  class="fas fa-trash delete_sentence deletetest" data-id="'.$sen['id'].'"></i>
                    </td></tr>';
    }
	if ( $res ) {
		wp_send_json( [
			"success" => "true",
			"content"=>$html_output,
			"message" => "با  موفقیت اضافه شد",
		], 200 );
	} else {
		wp_send_json( [
			"error"   => "true",
			"content"=>$html_output,
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
	$res      = $wpdb->get_results( "SELECT * FROM $table ORDER BY id DESC " );
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

	  $wpdb->update( $table, [ 'text' => $text ], [ 'id' => $id ], [ '%s' ], [ '%d' ] );
		 $get_row   = $wpdb->get_row( "SELECT * FROM $table WHERE id = $id" );

		 $data=[
			 'id'=>$get_row->id,
			 'text'=>$get_row->text
		 ];
		echo wp_json_encode($data,200);
		 wp_die();



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

	if ($check_transparent==="on"){
		update_option( '_rs_transparent', 1 );
	}else if ($check_transparent==="off"){
		update_option( '_rs_transparent', 0 );
	}

	if ($check_widget==="on"){
		update_option( '_rs_widget', 1 );
	}else if ($check_widget==="off"){
		update_option( '_rs_widget', 0 );
	}
	update_option( '_rs_fontsize', $rs_fontsize );
	update_option( '_rs_textcolor', $rs_color );
	update_option( '_rs_bgcolor', $rs_bgcolor );
}