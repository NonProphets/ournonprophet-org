<?php
/*
Plugin Name: Soren Set WP Mail From
Plugin URI:  https://soren.tech
Description: Filters to change wp_mail_from and wp_mail_from_name based on locally set config variables
Version:     1
Author:      Alex Floyd Marshall
Author URI:  https://soren.tech
License:     GPLv2
*/

$from_mail = null;
$from_name = null;

function soren_set_mail_from_init() {
    if ( ! defined( 'SET_MAIL_FROM_MAIL' ) ) {
        return;
    } else {
        $from_mail = SET_MAIL_FROM_MAIL;
    }
    if ( ! defined( 'SET_MAIL_FROM_NAME' ) ) {
        return;
    } else {
        $from_name = SET_MAIL_FROM_NAME;
    }
}

function soren_set_mail_from_mail( $email ) {
    return $from_mail;
}

function soren_set_mail_from_name ($name ) {
    return $from_name;
}
	
add_action( 'plugins_loaded', 'soren_set_mail_from_init' );

add_filter( 'wp_mail_from', 'soren_set_mail_from_mail' );

add_filter( 'wp_mail_from_name', 'soren_set_mail_from_name' );

?>