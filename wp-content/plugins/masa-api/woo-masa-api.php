<?php
/*
Plugin Name: Masa Api
Plugin URI:  http://www.book.gerarmart.com
Description: Plugin Use For Custom Woccommerce Api Like Cart , Wishlist, Filter Product , Get Category.
Version:     2.3.4
Author:      GerarTechnologies
Author URI:  http://www.book.gerarmart.com
License:     GPL2
License URI: Licence URl
Text Domain: masa
*/
if (!defined('ABSPATH'))
{
    exit;
}

if (!defined('JWT_AUTH_CORS_ENABLE'))
{
    define('JWT_AUTH_CORS_ENABLE', true);
}

if (!defined('JWT_AUTH_SECRET_KEY'))
{
    define('JWT_AUTH_SECRET_KEY', AUTH_KEY);
}

if (!defined('MASA_API_DIR'))
{
    define('MASA_API_DIR', plugin_dir_path(__FILE__));
}

if (!defined('MASA_API_DIR_URI'))
{
    define('MASA_API_DIR_URI', plugin_dir_url(__FILE__));
}

//include_once (ABSPATH . 'wp-includes/pluggable.php');


if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
} else {
	die( 'Something went wrong' );
}

/**
 * The core JWT Authentication for WP-API class that is used to authorize api
 */

if (!class_exists('Jwt_Auth_Public'))
{
    // require plugin_dir_path(__FILE__) . '/jwt-authentication-for-wp-rest-api/jwt-auth.php';
}

require plugin_dir_path(__FILE__) . '/includes/class.masa.api.php';


function load_custom_wp_admin_style()
{
    wp_enqueue_script('oauth-signature', MASA_API_DIR_URI . 'assest/js/oauth-signature.js', array() , '1.0', true);
    wp_register_script('masa-sample', MASA_API_DIR_URI . 'assest/js/sample.js', array() , '1.0', true);
    //wp_enqueue_style('masa-sample', MASA_API_DIR_URI.'assest/js/sample.js',array(), '1.0', 'all');
    wp_localize_script('masa-sample', 'request_token', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
    wp_enqueue_script('masa-sample');

    //wp_enqueue_style('bootstrap', MASA_API_DIR_URI . 'assest/css/bootstrap.min.css', array() , '4.1.3', 'all');

}
if(isset($_REQUEST['page']) && $_REQUEST['page'] == '_masa_app_options')
{
    add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');
}


if (!class_exists('ReduxFramework'))
{
    // require_once (MASA_API_DIR . '/redux-framework/redux-framework.php');
}

require_once MASA_API_DIR . '/app-option/option-set.php';




new masa_Api();

add_filter( 'jwt_auth_token_before_dispatch', 'add_website_to_jwt_token', 10, 2 );

/**
 * Adds a website parameter to the auth.
 *
 */
function add_website_to_jwt_token( $data, $user ) {

    $img = get_user_meta( $user->ID, 'masa_profile_image' ) ;
    $user_data = get_userdata( $user->ID );

    $customer = (new WC_Customer( $user->ID ))->get_data();

    $data['user_email'] = $user->data->user_email;
    $data['user_nicename'] = $user->data->user_nicename;
    $data['user_display_name'] = $user->data->display_name;
    $data['first_name'] = $user_data->first_name;
	$data['last_name']  = $user_data->last_name;
    $data['billing'] = $customer['billing'];
    $data['shipping'] = $customer['shipping'];

    if($img)
    {
        $data['profile_image'] = $img[0];
        $data['book_profile_image'] = $img[0];
    }
    else
    {
        $data['profile_image'] = "";
        $data['book_profile_image'] = "";
    }

    return $data;
}


if (!defined('masa_API_SECRET_SALT'))
{
    define('masa_API_SECRET_SALT', "!Q2w#E4r%T6y&U8i(O0p");
}