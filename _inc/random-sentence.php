<?php


function random_sentence() {
	global $wpdb;
	$table           = $wpdb->prefix . 'sentence';
	$res             = $wpdb->get_results( "SELECT * FROM $table" );
	$sentence        = json_decode( json_encode( $res ), true );
	$length          = count( $sentence );
	$random          = rand( 0, $length - 1 );
	$_rs_fontsize    = get_option( '_rs_fontsize' );
	$_rs_textcolor   = get_option( '_rs_textcolor' );
	$_rs_bgcolor     = get_option( '_rs_bgcolor' );
	$_rs_transparent = get_option( '_rs_transparent' );
	$_rs_fontsize_px = $_rs_fontsize . 'px';
	if ( $_rs_transparent == 1 ) {
		$_rs_bgcolor = "transparent";
	}
	echo "<p style=\"font-size:$_rs_fontsize_px;color: $_rs_textcolor;background-color: $_rs_bgcolor\">", $sentence[ $random ]['text'], "</p>";
}
