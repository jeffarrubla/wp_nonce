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
