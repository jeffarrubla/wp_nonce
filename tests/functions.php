<?php
/**
 *
 * Declare the wp_nonce_*() wordpress functions, all as empty to do the tests,
 * in WPNonceTest.php the functions, here declared, are redefined using Patchwork.
 *
 *
 */
function wp_nonce_ays( $action ){

}

function wp_nonce_field( $action , $name, $referer, $echo ) {

}

function wp_nonce_url( $actionurl, $action, $name ) {

}

function wp_verify_nonce( $nonce, $action ) {

}

function wp_create_nonce($action) {

}

function check_admin_referer( $action, $query_arg ) {

}

function check_ajax_referer( $action, $query_arg, $die ) {

}

function wp_referer_field( $echo  ) {

}
