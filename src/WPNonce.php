<?php
/**
 *
 *  @package jeffarrubla
 *  @subpackage wp-nonce
 *
 *
 *	Name: WP Nonce
 *	URI: https://github.com/jeffarrubla/wp_nonce
 *	Description: Class to use wp_nonce_*() functions in an object oriented  way.
 * 				 These functions are: wp_nonce_ays(), wp_nonce_field(), wp_nonce_url(),
 *									  wp_verify_nonce(), wp_create_nonce(), check_admin_referer(),
 *									  check_ajax_referer(), wp_referer_field()
 *	Version: 0.1
 *	Author: Jefferson Arrubla
 *	Author URI: http://github.com/jeffarrubla
 *	License: GPL2
 *	License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 */
class WPNonce {

	/**
	 * Constructor
	 *
	 */
	function __construct() {
	}

	/**
	 * Display "Are You Sure" message to confirm the action being taken.
	 *
	 * If the action has the nonce explain message, then it will be displayed
	 * along with the "Are you sure?" message.
	 *
	 * @since 2.0.4
	 *
	 * @param string $action The nonce action.
	 */
	public function ays( $action ) {
		if(function_exists('wp_nonce_ays')){
			echo wp_nonce_ays( $action );
		}else{
			echo 'the function wp_nonce_ays does not exists.';
		}

	}

	/**
	 * Retrieve or display nonce hidden field for forms.
	 *
	 * The nonce field is used to validate that the contents of the form came from
	 * the location on the current site and not somewhere else. The nonce does not
	 * offer absolute protection, but should protect against most cases. It is very
	 * important to use nonce field in forms.
	 *
	 * The $action and $name are optional, but if you want to have better security,
	 * it is strongly suggested to set those two parameters. It is easier to just
	 * call the function without any parameters, because validation of the nonce
	 * doesn't require any parameters, but since crackers know what the default is
	 * it won't be difficult for them to find a way around your nonce and cause
	 * damage.
	 *
	 * The input name will be whatever $name value you gave. The input value will be
	 * the nonce creation value.
	 *
	 * @since 2.0.4
	 *
	 * @param int|string $action  Optional. Action name. Default -1.
	 * @param string     $name    Optional. Nonce name. Default '_wpnonce'.
	 * @param bool       $referer Optional. Whether to set the referer field for validation. Default true.
	 * @param bool       $echo    Optional. Whether to display or return hidden form field. Default true.
	 * @return string Nonce field HTML markup.
	 */
	public function field( $action = -1, $name = "_wpnonce", $referer = true , $echo = true ) {
		if(function_exists('wp_nonce_field')){
			return wp_nonce_field( $action, $name, $referer, $echo );
		}else{
			echo 'the function wp_nonce_field does not exists.';
		}
	}

	/**
	 * Retrieve URL with nonce added to URL query.
	 *
	 * @since 2.0.4
	 *
	 * @param string     $actionurl URL to add nonce action.
	 * @param int|string $action    Optional. Nonce action name. Default -1.
	 * @param string     $name      Optional. Nonce name. Default '_wpnonce'.
	 * @return string Escaped URL with nonce action added.
	 */
	public function url( $actionurl, $action = -1, $name = '_wpnonce' ){
		if(function_exists('wp_nonce_url')){
			return wp_nonce_url( $actionurl, $action, $name );
		}else{
			echo 'the function wp_nonce_url does not exists.';
		}
	}

	/**
	 * Verify that correct nonce was used with time limit.
	 *
	 * The user is given an amount of time to use the token, so therefore, since the
	 * UID and $action remain the same, the independent variable is the time.
	 *
	 * @since 2.0.3
	 *
	 * @param string     $nonce  Nonce that was used in the form to verify
	 * @param string|int $action Should give context to what is taking place and be the same when nonce was created.
	 * @return false|int False if the nonce is invalid, 1 if the nonce is valid and generated between
	 *                   0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
	 */
	public function verify( $nonce, $action = -1 ) {
		if(function_exists('wp_verify_nonce')){
			return wp_verify_nonce( $nonce, $action );
		}else{
			echo 'the function wp_verify_nonce does not exists.';
		}
	}

	/**
	 * Creates a cryptographic token tied to a specific action, user, user session,
	 * and window of time.
	 *
	 * @since 2.0.3
	 * @since 4.0.0 Session tokens were integrated with nonce creation
	 *
	 * @param string|int $action Scalar value to add context to the nonce.
	 * @return string The token.
	 */
	public function create($action = -1) {
		if(function_exists('wp_create_nonce')){
			return wp_create_nonce($action);
		}else{
			echo 'the function wp_create_nonce does not exists.';
		}
	}

	/**
	 * Makes sure that a user was referred from another admin page.
	 *
	 * To avoid security exploits.
	 *
	 * @since 1.2.0
	 *
	 * @param int|string $action    Action nonce.
	 * @param string     $query_arg Optional. Key to check for nonce in `$_REQUEST` (since 2.5).
	 *                              Default '_wpnonce'.
	 * @return false|int False if the nonce is invalid, 1 if the nonce is valid and generated between
	 *                   0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
	 */
	public function check_admin( $action = -1, $query_arg = '_wpnonce' ) {
		if(function_exists('check_admin_referer')){
			return check_admin_referer( $action, $query_arg );
		}else{
			echo 'the function check_admin_referer does not exists.';
		}
	}

	/**
	 * Verifies the Ajax request to prevent processing requests external of the blog.
	 *
	 * @since 2.0.3
	 *
	 * @param int|string   $action    Action nonce.
	 * @param false|string $query_arg Optional. Key to check for the nonce in `$_REQUEST` (since 2.5). If false,
	 *                                `$_REQUEST` values will be evaluated for '_ajax_nonce', and '_wpnonce'
	 *                                (in that order). Default false.
	 * @param bool         $die       Optional. Whether to die early when the nonce cannot be verified.
	 *                                Default true.
	 * @return false|int False if the nonce is invalid, 1 if the nonce is valid and generated between
	 *                   0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
	 */
	public function check_ajax( $action = -1, $query_arg = false, $die = true ) {
		if(function_exists('check_ajax_referer')){
			return check_ajax_referer( $action, $query_arg, $die );
		}else{
			echo 'the function check_ajax_referer does not exists.';
		}
	}

	/**
	 * Retrieve or display referer hidden field for forms.
	 *
	 * The referer link is the current Request URI from the server super global. The
	 * input name is '_wp_http_referer', in case you wanted to check manually.
	 *
	 * @since 2.0.4
	 *
	 * @param bool $echo Optional. Whether to echo or return the referer field. Default true.
	 * @return string Referer field HTML markup.
	 */
	public function referer_field( $echo = true ){
		if(function_exists('wp_referer_field')){
			return wp_referer_field( $echo );
		}else{
			echo 'the function wp_referer_field does not exists.';
		}
	}
}