<?php
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;
add_action( 'rest_api_init', function () {
    $namespace = 'masa-api';
    $base      = 'woocommerce';

    register_rest_route( $namespace . '/api/v1/' . $base, 'get-category/', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_category',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'get-product/', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_product',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'get-product-details/', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_product_details',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'get-sub-category/', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_sub_category',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'get-product-attribute/', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_product_attribute',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'get-single-product/', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_single_product',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'get-featured-product/', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_featured_product',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'get-offer-product/', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_offer_product',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'get-search-product/', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_search_product',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'place-order/', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_place_order',
        'permission_callback' => '__return_true',
    ) );
    register_rest_route( $namespace . '/api/v1/' . $base, 'delete-review/', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_delete_review',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'get-dashboard/', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_dashboard',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'get-checkout-url/', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_checkout_url',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'get-product-attributes/', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_product_attributes_with_terms',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'customer/login', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_customer_login',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'customer/register', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_customer_registration',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'customer/registration', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_customer_registration',
        'permission_callback' => '__return_true',
    ) );

    register_rest_route( $namespace . '/api/v1/' . $base, 'user/forgot-password', array(
        'methods'  => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_forgot_password',
        'permission_callback' => '__return_true',
    ) );


    register_rest_route($namespace . '/api/v1/' . $base, 'get-customer-orders', array(
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_customer_orders',
        'permission_callback' => '__return_true',
    ));

    register_rest_route($namespace . '/api/v1/' . $base, 'get-stripe-client-secret/', array(
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => 'getStripeClientSecret',
        'permission_callback' => '__return_true',
    ));

    register_rest_route($namespace . '/api/v1/' . $base, 'change-password/', array(
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => 'changeUserPassword',
        'permission_callback' => '__return_true',
    ));

    register_rest_route($namespace . '/api/v1/' . $base, 'get-vendors', array(
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_vendors',
        'permission_callback' => '__return_true',
    ));

    register_rest_route($namespace . '/api/v1/' . $base, 'get-vendor-products', array(
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_vendor_products',
        'permission_callback' => '__return_true',
    ));

    register_rest_route($namespace . '/api/v1/' . $base, 'get-all-review', array(
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_all_review',
        'permission_callback' => '__return_true',
    ));

    register_rest_route($namespace . '/api/v1/' . $base, 'create-cart-url', array(
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_create_cart_url',
        'permission_callback' => '__return_true',
    ));

    register_rest_route($namespace . '/api/v1/' . $base, 'get-book-downloads', array(
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_book_downloads',
        'permission_callback' => '__return_true',
    ));

    register_rest_route( $namespace . '/api/v1/' . $base, 'get-vendor-dashboard', array(
        'methods'             => WP_REST_Server::ALLMETHODS,
        'callback'            => 'masa_get_vendor_dashboard',
        'permission_callback' => '__return_true'
    ));

    register_rest_route( $namespace . '/api/v1/' . $base, 'get-admin-dashboard', array(
        'methods'             => WP_REST_Server::ALLMETHODS,
        'callback'            => 'masa_get_admin_dashboard',
        'permission_callback' => '__return_true'
    ));
    
} );

function masa_get_book_downloads ($request) {

    $parameters = $request->get_params();

    $header = $request->get_headers();

    $validate = masa_validate_api_request($parameters);

    if (!isset($parameters['book_id'])) {
        return new WP_Error( 'book_id', 'Book id not found', array(
            'status' => 400
        ) );
    }

    if ($validate === false) {
        return new WP_Error( 'invalid_secret', 'Invalid secret or request time', array(
            'status' => 400
        ) );
    }

    $token = isset($header['token'][0]) ? $header['token'][0] : "";
    $user_id = isset($header['id'][0]) ? $header['id'][0] : "";

    if ($user_id !== "" && $token !== "") {

        $validate = new masa_Api_Authentication();
        $response = $validate->masa_validate_token($header['token'][0]);

        $res = (array)  json_decode($response['body'], true);

        if ($res['data']['status'] != 200)
        {
            return $res;
        }

    }

    $product_data = masa_get_product_details_helper($parameters['book_id'],$user_id, true);

    $download = [];

    if (isset($product_data['downloads']) && $product_data['downloads'] || []) {
        $download = $product_data['downloads'];
    }

    $response = new WP_REST_Response( [
        'message' => 'Downloads list',
        'data' => $download
    ] );
    $response->set_status( 200 );

    return $response;

}


function masa_create_cart_url($request)
{
    $parameters = $request->get_params();
    $product_ids = $parameters['products'];
    $add_to_cart_url = esc_url_raw( add_query_arg( 'add-to-cart', $product_ids, wc_get_cart_url() ) );

    $response = new WP_REST_Response( array("cart_url" => $add_to_cart_url) );
    $response->set_status( 200 );

    return $response;
}

function masa_get_all_review($request)
{
    $masterarray = array();

    $parameters = $request->get_params();
    $number = 5;
    $paged = 1;
    global $product;
    $product_id = $parameters['product_id'];
    $product = wc_get_product($product_id);
    if ($product === false) {
        return [];
    }


    if(isset($parameters['number']) && !empty($parameters['number']))
    {
        $number = $parameters['number'];
    }
    if(isset($parameters['paged']) && !empty($parameters['paged']))
    {
        $paged = $parameters['paged'];
    }

    $masterarray['count'] =  get_approved_comments( $product_id , array('count'=>true) );
    $args = array(
        'number' => $number,
        'pages' => $paged

    );

    $masterarray['reviews'] =  get_approved_comments( $product_id , $args );

    $response = new WP_REST_Response( $masterarray );
    $response->set_status( 200 );

    return $response;


}
function masa_get_vendors ($request) {
    
    $parameters = $request->get_params();
    
    $master_array = [];
    $number = isset($parameters['number']) && !empty($parameters['number']) ? $parameters['number'] : 10;
    $paged = isset($parameters['paged']) && !empty($parameters['paged']) ? $parameters['paged'] : 1;

    $stores = dokan()->vendor->get_vendors([
        'paged'  => $paged,
        'number' => $number,
    ]);

    if (count($stores)) {
        foreach ($stores as $store) {
            $store_data = $store->to_array();
            $store_data['description'] = get_the_author_meta('description',$store_data['id']);
            $master_array[] = $store_data;
        }
    }

    $response = new WP_REST_Response( $master_array );
    $response->set_status( 200 );

    return $response;

}

function masa_get_vendor_products ($request) {

    $masterarray = array();

    $parameters = $request->get_params();

    if ( empty( $parameters['vendor_id'] ) ) {
        return new WP_Error( 'empty_vendor_id', 'Vendor id is missing', array(
            'status' => 404
        ) );
    }

    $products = dokan()->product->all( [
        'author' => $parameters['vendor_id'],
        'post_status' => 'publish'
    ] )->posts;
    
    if (count($products)) {
        foreach ($products as $product) {
            $masterarray[] =  masa_get_product_details_helper($product->ID);
        }
    }

    $response = new WP_REST_Response( $masterarray );
    $response->set_status( 200 );

    return $response;

}


function changeUserPassword($request) {

    $master = [];

    $parameters = $request->get_params();

    $header = $request->get_headers();

    if (empty($header['token'][0]))
    {
        return new WP_Error('token_missing', 'Token Required', array(
            'status' => 404
        ));
    }

    $validate = new masa_Api_Authentication();
    $response = $validate->masa_validate_token($header['token'][0]);

    if (!isset($header['id'][0]))
    {
        return new WP_Error('id_missing', 'id is required in headers', array(
            'status' => 404
        ));
    }

    $userid = $header['id'][0];

    $res = (array)  json_decode($response['body'], true);

    if ($res['data']['status'] != 200)
    {
        return $res;
    }

    if (!isset($parameters['username']) || !isset($parameters['password'])) {
        return new WP_Error('username', 'Username and password is required', array(
            'status' => 400
        ));
    }

    if (!isset($parameters['new_password'])) {
        return new WP_Error('username', 'New password is required', array(
            'status' => 400
        ));
    }

    $userdata = get_user_by('login', $parameters['username']);

    if ($userdata == null) {
        $userdata = get_user_by('email', $parameters['username']);

        if ($userdata == null) {
            return new WP_Error('not_found', 'User not found', array(
                'status' => 404
            ));
        }

    }

    if ( wp_check_password($parameters['password'], $userdata->data->user_pass) ){
        wp_set_password($parameters['new_password'], $userdata->ID);
        $response = new WP_REST_Response([
            'message' => 'Password has been changed successfully',
        ]);
        $response->set_status(200);

        return $response;
    } else {
        return new WP_Error('not_found', 'Current password is invalid', array(
            'status' => 404
        ));
    }

}


function getStripeClientSecret ($request) {

    $master = [];

    $parameters = $request->get_params();

    $header = $request->get_headers();

    if (empty($header['token'][0]))
    {
        return new WP_Error('token_missing', 'Token Required', array(
            'status' => 404
        ));
    }

    $validate = new masa_Api_Authentication();
    $response = $validate->masa_validate_token($header['token'][0]);

    if (!isset($header['id'][0]))
    {
        return new WP_Error('id_missing', 'id is required in headers', array(
            'status' => 404
        ));
    }

    $userid = $header['id'][0];

    $res = (array)  json_decode($response['body'], true);

    if ($res['data']['status'] != 200)
    {
        return $res;
    }

    try {

        \Stripe\Stripe::setApiKey($parameters['apiKey']);

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $parameters['amount'],
            'currency' => $parameters['currency'],
            /*'metadata' => [
                'name' => isset($parameters['name']) ? $parameters['name'] : "",
                'address' => implode($parameters['address'], " ")
            ]*/

            'description' => isset($parameters['description']) ? $parameters['description'] : "",
            'shipping' => [
                'name' => 'Jenny Rosen',
                'address' => [
                    'line1' => '510 Townsend St',
                    'postal_code' => '98140',
                    'city' => 'San Francisco',
                    'state' => 'CA',
                    'country' => 'US',
                ],
            ]

        ]);

        $master['client_secret'] = $intent->client_secret;
        $master['message'] = "Token generated";

    } catch (Exception $e) {
        $master['message'] = $e->getMessage();
        $master['client_secret'] = "";
        $response = new WP_REST_Response($master);
        $response->set_status(400);
    }


    $response = new WP_REST_Response($master);
    $response->set_status(200);

    return $response;
}


function masa_get_customer_orders($request) {

    $header = $request->get_headers();

    if (empty($header['token'][0]))
    {
        return new WP_Error('token_missing', 'Token Required', array(
            'status' => 404
        ));
    }

    $validate = new masa_Api_Authentication();
    $response = $validate->masa_validate_token($header['token'][0]);

    if (!isset($header['id'][0]))
    {
        return new WP_Error('id_missing', 'id is required in headers', array(
            'status' => 404
        ));
    }

    $userid = $header['id'][0];

    $res = (array)  json_decode($response['body'], true);

    if ($res['data']['status'] != 200)
    {
        return $res;
    }

    global $wpdb;
    $masterarray = array();

    $customer_orders = get_posts(array(
        'numberposts' => -1,
        'meta_key' => '_customer_user',
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_value' => $userid,
        'post_type' => wc_get_order_types(),
        'post_status' => array('wc-completed'),
        //'post_status' => array('wc-processing', 'wc-pending'),
    ));

    if (count($customer_orders)) {
        foreach ($customer_orders as $order) {
            $details = new WC_Order( $order->ID );
            $temp = $details->data;

            $line_items = [];
            if (count($temp['line_items'])) {
                foreach ($temp['line_items'] as $line) {
                    $line_data = $line->get_data();

                    if (isset($line_data['product_id'])) {
                        $product_id = $line_data['product_id'];
                        $product = wc_get_product( $product_id );

                        if(!empty($product)){
                            $line_data['product_images'] = masa_get_product_images_helper($product);
                        } else {
                            $line_data['product_images'] = [];
                        }
                    }

                    $line_items[] = $line_data;
                }
                $temp['line_items'] = $line_items;
            }

            $masterarray[] = $temp;
        }
    }


    $response = new WP_REST_Response($masterarray);
    $response->set_status(200);
    return $response;

}


function masa_get_product_attributes_with_terms( $request ) {
    $masterarray = array();
    $attributes  = wc_get_attribute_taxonomies();

    if ( count( $attributes ) ) {
        foreach ( $attributes as $attribute ) {

            $temp = array(
                'id'           => $attribute->attribute_id,
                'name'         => $attribute->attribute_label,
                'slug'         => $attribute->attribute_name,
                'type'         => $attribute->attribute_type,
                'order_by'     => $attribute->attribute_orderby,
                'has_archives' => $attribute->attribute_public,
                'terms'        => get_terms( wc_attribute_taxonomy_name( $attribute->attribute_name ), 'hide_empty=0' ),
            );

            $masterarray[] = $temp;
        }
    }


    // Get all product categories...
    $taxonomy     = 'product_cat';
    $orderby      = 'name';
    $show_count   = 0;      // 1 for yes, 0 for no
    $pad_counts   = 0;      // 1 for yes, 0 for no
    $hierarchical = 1;      // 1 for yes, 0 for no
    $title        = '';
    $empty        = 0;

    $args = array(
        'taxonomy'     => $taxonomy,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'hide_empty'   => $empty
    );

    $all_categories = get_categories( $args );

    if (count($all_categories)) {
        foreach ($all_categories as $category) {

            $args2 = array(
                'taxonomy'     => $taxonomy,
                'child_of'     => 0,
                'parent'       => $category->term_id,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
            );
            $sub_cats = get_categories( $args2 );
            //print_r($sub_cats);
        }
    }

    //die;

    //print_r($all_categories);die;


    $response = new WP_REST_Response( $masterarray );
    $response->set_status( 200 );

    return $response;

}


function masa_get_checkout_url( $request ) {
    global $wpdb;
    $masterarray = array();


    $parameters = $request->get_params();

    $header = $request->get_headers();

    if ( empty( $parameters['order_id'] ) ) {
        return new WP_Error( 'empty_order_id', 'Order Id Is Missing', array(
            'status' => 404
        ) );
    }

    if ( empty( $header['token'][0] ) ) {
        return new WP_Error( 'token_missing', 'Token Required', array(
            'status' => 404
        ) );
    }

    $validate = new masa_Api_Authentication();
    $response = $validate->masa_validate_token( $header['token'][0] );
    $userid   = $header['id'][0];

    $res = (array) json_decode( $response['body'], true );

    if ( $res['data']['status'] != 200 ) {
        return $res;
    }

    $cart_items = $wpdb->get_results( "DELETE FROM 
                {$wpdb->prefix}masa_add_to_cart 
                    where 
                    user_id=" . $userid . " ", OBJECT );


    $order = new WC_Order( $parameters['order_id'] );


    $payment_page = $order->get_checkout_payment_url();

    $masterarray['checkout_url'] = $payment_page;

    $response = new WP_REST_Response( $masterarray );
    $response->set_status( 200 );


    return $response;
}


function masa_get_dashboard( $request ) {

    global $app_opt_name;
    global $post;
    global $wpdb;
    $parameters    = $request->get_params();
    $masa_option = get_option( 'masa_app_options' );
    $masterarray   = array();
    $array         = array();
    $dashborad     = array();
    $social        = array();
    $testimonial   = array();

    if ( isset( $masa_option['whatsapp'] ) ) {
        $social['whatsapp'] = $masa_option['whatsapp'];
    } else {
        $social['whatsapp'] = '';
    }

    if ( isset( $masa_option['facebook'] ) ) {
        $social['facebook'] = $masa_option['facebook'];
    } else {
        $social['facebook'] = '';
    }

    if ( isset( $masa_option['twitter'] ) ) {
        $social['twitter'] = $masa_option['twitter'];
    } else {
        $social['twitter'] = '';
    }

    if ( isset( $masa_option['instagram'] ) ) {
        $social['instagram'] = $masa_option['instagram'];
    } else {
        $social['instagram'] = '';
    }


    if ( isset( $masa_option['contact'] ) ) {
        $social['contact'] = $masa_option['contact'];
    } else {
        $social['contact'] = '';
    }

    if ( isset( $masa_option['privacy_policy'] ) ) {
        $social['privacy_policy'] = $masa_option['privacy_policy'];
    } else {
        $social['privacy_policy'] = '';
    }

    if ( isset( $masa_option['copyright_text'] ) ) {
        $social['copyright_text'] = esc_html( $masa_option['copyright_text'] );
    } else {
        $social['copyright_text'] = '';
    }

    if ( isset( $masa_option['term_condition'] ) ) {
        $social['term_condition'] = esc_html( $masa_option['term_condition'] );
    } else {
        $social['term_condition'] = '';
    }

    $dashborad['social_link'] = $social;
    $dashboard['banner'] = [];
    $dashboard['slider'] = [];
   

    if (isset($masa_option['banner_slider']) && !empty($masa_option['banner_slider']))
    {
        foreach ($masa_option['banner_slider'] as $slide)
        {
            $array['image'] = $slide['image'];
            $array['thumb'] = $slide['thumb'];            
            $array['url'] = $slide['url'];
            $array['desc'] = $slide['title'];

            if ( ! empty( $slide['image'] ) ) {
                $dashboard['banner'][] = $array;
            }
            $array = array();
        }
    }
    
    if (isset($masa_option['opt-slides']) && !empty($masa_option['opt-slides']))
    {
        foreach ($masa_option['opt-slides'] as $slide)
        {
            $array['image'] = $slide['image'];
            $array['thumb'] = $slide['thumb'];
            $array['url'] = $slide['url'];

            if (!empty($slide['image']))
            {
                $dashboard['slider'][] = $array;
            }
            $array = array();
        }
    }
    
   


    $primary_color = '';
    if ( isset( $masa_option['masa_app_primary_color'] ) ) {
        if ( ! empty( $masa_option['masa_app_primary_color'] ) ) {

            $primary_color = $masa_option['masa_app_primary_color'];
        }
    }
    //$dashborad['primary_color'] = $primary_color;

    $secondary_color = '';
    if ( isset( $masa_option['masa_app_secondary_color'] ) ) {
        if ( ! empty( $masa_option['masa_app_secondary_color'] ) ) {

            $secondary_color = $masa_option['masa_app_secondary_color'];
        }
    }
    //$dashborad['secondary_color'] = $secondary_color;

    $app_lang = '';
    if ( isset( $masa_option['masa_app_lang'] ) ) {
        if ( ! empty( $masa_option['masa_app_lang'] ) ) {

            $app_lang = $masa_option['masa_app_lang'];
        }
    }
    else
    {
        $app_lang = 'en';
    }

    $masa_payment_method = '';
	if ( isset( $masa_option['masa_payment_method'] ) ) {
		if ( ! empty( $masa_option['masa_payment_method'] ) ) {

			$masa_payment_method = $masa_option['masa_payment_method'];
		}
	}
	else
	{
		$masa_payment_method = 'webview';
	}
	$dashborad['payment_method'] = $masa_payment_method;

    $dashborad['app_lang'] = $app_lang;

    $dashborad['enable_coupons'] = false;// wc_coupons_enabled();

    $dashborad['currency_symbol'] =
        array(
            "currency_symbol" =>
                get_woocommerce_currency_symbol()
        ,
            "currency"        => get_woocommerce_currency()
        );

    $dashborad['deal_of_the_day']   = masa_get_special_product_details_helper( 'masa_deal_of_the_day' );
    $dashborad['suggested_for_you'] = masa_get_special_product_details_helper( 'masa_suggested_for_you' );
    $dashborad['offer']             = masa_get_special_product_details_helper( 'masa_offer' );
    $dashborad['you_may_like']      = masa_get_special_product_details_helper( 'masa_you_may_like' );

    //print_r($dashborad['deal_of_the_day']);die;

    $masterarray = array();

    if ( isset( $parameters['user_id'] ) ) {
        $customer_orders = wc_get_orders( array(
            'meta_key'    => '_customer_user',
            'meta_value'  => $parameters['user_id'],
            'numberposts' => - 1
        ) );
        $count           = 0;

        $dashborad['total_order'] = count( $customer_orders );
    }


    // Best Selling Product
    $masterarray = array();
    $args        = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 5,
        'paged'          => 1,
        'meta_key'       => 'total_sales',
        'orderby'        => 'meta_value_num'
    );

    $wp_query  = new WP_Query( $args );
    $total     = $wp_query->found_posts;
    $num_pages = 1;
    $num_pages = $wp_query->max_num_pages;
    $i         = 1;
    if ( $total == 0 ) {
        $masterarray = array();
    }


    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();

        /*$product = wc_get_product( get_the_ID() );
        masa_get_product_details_helper( get_the_ID() );

        $arr           = $product->get_data();
        $arr['images'] = masa_get_images_link( get_the_ID() );*/
        $masterarray[] = masa_get_product_details_helper( get_the_ID() );

        //array_push($masterarray, $arr);

    }

    $dashborad['best_selling_product'] = $masterarray;

    // Best Selling Product

    // Sale product Start
    $masterarray = array();
    $args        = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 5,
        'paged'          => 1,
        'post__in'       => wc_get_product_ids_on_sale(),
        //'meta_key'       => '_sale_price'
    );

    $wp_query  = new WP_Query( $args );
    $total     = $wp_query->found_posts;
    $num_pages = 1;
    $num_pages = $wp_query->max_num_pages;
    $i         = 1;
    if ( $total == 0 ) {
        $masterarray = array();
    }


    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();


        /*$product = wc_get_product( get_the_ID() );

        $arr           = $product->get_data();
        $arr['images'] = masa_get_images_link( get_the_ID() );
        array_push( $masterarray, $arr );*/

        $masterarray[] = masa_get_product_details_helper( get_the_ID() );

        //array_push( $masterarray, $arr );


    }

    $dashborad['sale_product'] = $masterarray;

    // Sale product end
    // masa_featured Product start
    $masterarray = array();

    $args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 5,
        'paged'          => 1,
        'tax_query'      => array(
            array
            (
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured'
            )

        )

    );

    $wp_query  = new WP_Query( $args );
    $total     = $wp_query->found_posts;
    $num_pages = 1;
    $num_pages = $wp_query->max_num_pages;
    $i         = 1;
    if ( $total == 0 ) {
        $masterarray = array();
    }


    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();


        /*$product = wc_get_product( get_the_ID() );

        $arr           = $product->get_data();
        $arr['images'] = masa_get_images_link( get_the_ID() );
        array_push( $masterarray, $arr );*/

        $masterarray[] = masa_get_product_details_helper( get_the_ID() );

    }

    $dashborad['featured'] = $masterarray;
    $masterarray           = array();


    // masa_featured Product End

    // masa_newest Product start

    $masterarray = array();

    $args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 5,
        'paged'          => 1,
        'orderby'        => 'ID',
        'order'          => 'DESC',


    );

    $wp_query  = new WP_Query( $args );
    $total     = $wp_query->found_posts;
    $num_pages = 1;
    $num_pages = $wp_query->max_num_pages;
    $i         = 1;
    if ( $total == 0 ) {
        $masterarray = array();
    }


    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        /*$product       = wc_get_product( get_the_ID() );
        $arr           = $product->get_data();
        $arr['images'] = masa_get_images_link( get_the_ID() );
        array_push( $masterarray, $arr );*/

        $masterarray[] = masa_get_product_details_helper( get_the_ID() );

    }


    $taxonomy     = 'product_cat';
    $orderby      = 'name';
    $show_count   = 0; // 1 for yes, 0 for no
    $pad_counts   = 0; // 1 for yes, 0 for no
    $hierarchical = 1; // 1 for yes, 0 for no
    $title        = '';
    $empty        = 0;

    $args = array(
        'taxonomy'     => $taxonomy,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'hide_empty'   => $empty,
        'parent'       => 0,
        'number'       => ''  // get all category
    );
    $all_categories = get_categories( $args );

    //$a = array_map( 'get_category_child', $all_categories );
    $enable = array_map( 'get_enable_category', $all_categories );

    $dashborad['category'] = array_map( 'masa_attach_category_image', masa_filter_array($enable) );






    $dashborad['newest'] = $masterarray;
    $masterarray         = array();


    // masa_newest Product End


    return comman_custom_response ( $dashboard ); 


}

function masa_delete_review( $request ) {
    global $wpdb;

    $parameters = $request->get_params();

    $header = $request->get_headers();

    if ( empty( $header['token'][0] ) ) {
        return masa_throw_error( "Token Required" );
    }

    $validate = new masa_Api_Authentication();
    $response = $validate->masa_validate_token( $header['token'][0] );
    $userid   = $header['id'][0];

    $res = (array) json_decode( $response['body'], true );

    if ( $res['data']['status'] != 200 ) {
        return $res;
    }
    $query      = "DELETE FROM {$wpdb->prefix}comments where comment_ID =" . $parameters['review_id'] . "";
    $cart_items = $wpdb->get_results( $query, OBJECT );

    $response = new WP_REST_Response(
        array(
            "code"    => "success",
            "message" => "Review Deleted",
            "data"    => array(
                "status" => 200
            )
        )
    );

    if ( $cart_items > 1 ) {
        return $response;
    } else {
        return masa_throw_error( "Review not deleted" );
    }
}

function masa_place_order( $request ) {


    $parameters = $request->get_params();

    $header = $request->get_headers();


    $transaction_id = $parameters['transaction_id'];

    $payment_gateway_id = $parameters['payment_gateway_id'];


    $payment_gateway = WC()->payment_gateways->payment_gateways()[ $payment_gateway_id ];

    $order = wc_get_order( $parameters['order_id'] );

    $order->set_payment_method( $payment_gateway->id );
    $order->set_payment_method_title( $payment_gateway->title );
    $order->set_transaction_id( $transaction_id );
    $order->set_date_paid( date( 'Y-m-d' ) );
    $order->get_payment_method();
    $order->update_status( 'processing' );

    $order_data = $order->get_data();

    $masterarray = array();
    array_push( $masterarray, $order_data );


    $response = new WP_REST_Response( $masterarray );
    $response->set_status( 200 );


    return $response;
}

function masa_get_product_details( $request ) {

    global $product;

    $parameters = $request->get_params();

    $header = $request->get_headers();

    if ( isset($header['token'][0]) ) {

        $validate = new masa_Api_Authentication();
        $response = $validate->masa_validate_token( $header['token'][0] );
        $userid   = $header['id'][0];

        $res = (array) json_decode( $response['body'], true );

        if ( $res['data']['status'] != 200 ) {
            return $res;
        }
    }

    $user_id = isset($header['id'][0]) ? $header['id'][0] : "";

    $json_response = [];

    $product_details = masa_get_product_details_helper( $parameters['product_id'], $user_id );

    if ( $product_details != [] ) {
        $product_details['is_added_cart'] = false;
        $product_details['is_added_wishlist'] = false;
        if (isset($header['id'][0])) {

            $userid = $header['id'][0];
            global $wpdb;
            $cart_item = $wpdb->get_results( "SELECT * FROM 
                                                {$wpdb->prefix}masa_add_to_cart 
                                                    where 
                                                        user_id='{$userid}' 
                                                    AND 
                                                    	pro_id='{$parameters['product_id']}'", OBJECT );

            if (count($cart_item)) {
                $product_details['is_added_cart'] = true;
            }


            $wishlist_item = $wpdb->get_results( "SELECT * FROM 
                                                {$wpdb->prefix}masa_wishlist_product 
                                                    where 
                                                        user_id='{$userid}' 
                                                    AND 
                                                    	pro_id='{$parameters['product_id']}'", OBJECT );

            if (count($wishlist_item)) {
                $product_details['is_added_wishlist'] = true;
            }

        }
        $json_response[] = $product_details;
        if ( isset( $product_details['variations'] ) && count( $product_details['variations'] ) ) {
            foreach ( $product_details['variations'] as $variation ) {
                $product = masa_get_product_details_helper( $variation, $user_id );

                if ( $product != [] ) {
                    $json_response[] = $product;
                }
            }
        }
    }


    $response = new WP_REST_Response( $json_response );

    $response->set_status( 200 );

    return $response;

}

function masa_get_product( $request ) {
    global $product;

    $parameters = $request->get_params();

    $array       = array();
    $masterarray = array();

    $meta      = array();
    $dummymeta = array();
    $taxargs   = array();
    $tax_query = array();
    $args      = array();
    $page      = 1;
    $product_per_page      = 10;


    if ( ! empty( $parameters ) ) {
        foreach ( $parameters as $key => $data ) {
            $taxargs['relation'] = 'AND';

            if ( $key == "price" ) {
                $meta['key']     = '_price';
                $meta['value']   = $parameters['price'];
                $meta['compare'] = 'BETWEEN';
                $meta['type']    = 'NUMERIC';

                array_push( $dummymeta, $meta );

            }

            if ( $key == "category" ) {
                $tax_query['taxonomy'] = 'product_cat';
                $tax_query['field']    = 'term_id';
                $tax_query['terms']    = $parameters[ $key ];
                $tax_query['operator'] = 'IN';
                array_push( $taxargs, $tax_query );
            }

            if ( $key == "page" ) {
                $page = $parameters[ $key ];

            }

        }

        if(isset($parameters['attribute']) && !empty($parameters['attribute']))
        {

            foreach($parameters['attribute'] as $key=>$val)
            {
                foreach($val as $k => $v)
                {

                    $tax_query['taxonomy'] = $k;
                    $tax_query['field']    = 'term_id';
                    $tax_query['terms']    = $v;
                    $tax_query['operator'] = 'IN';
                    array_push( $taxargs, $tax_query );
                }
            }
        }

        if(isset($parameters['text']) && !empty($parameters['text']))
        {
            $args['masa_title_filter'] = $parameters['text'];
        }

        if(isset($parameters['product_per_page']) && !empty($parameters['product_per_page']))
        {
            $product_per_page = $parameters['product_per_page'];
        }

        if(isset($parameters['best_selling']) && !empty($parameters['best_selling']))
        {
            $args['meta_key'] = $parameters['best_selling'];
            $args['orderby'] = $parameters['meta_value_num'];

        }

        if(isset($parameters['on_sale']) && !empty($parameters['on_sale']))
        {
            $args['meta_query']     = array(
                'relation' => 'OR',
                array( // Simple products type
                    'key'           => $parameters['on_sale'],
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                ),
                array( // Variable products type
                    'key'           => '_min_variation_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                )
            );

        }
        if(isset($parameters['featured']) && !empty($parameters['featured']))
        {
            $tax_query['taxonomy'] = $parameters['featured'];
            $tax_query['field']    = 'name';
            $tax_query['terms']    = 'featured';
            $tax_query['operator'] = 'IN';
            array_push( $taxargs, $tax_query );
        }

        if(isset($parameters['newest']) && !empty($parameters['newest']))
        {
            $args['orderby'] = 'ID';
            $args['order'] = 'DESC';

        }

        if(isset($parameters['special_product']) && !empty($parameters['special_product']))
        {
            $dummymeta =
                array(
                    array(
                        'key' => 'masa_'.$parameters['special_product'],
                        'value' => array('yes'),
                        'compare' => 'IN',
                    )
                );
            array_push( $meta, $dummymeta );

        }




    }



    $args['post_type']      = 'product';
    $args['post_status']    = 'publish';
    $args['posts_per_page'] = $product_per_page;
    $args['paged']          = $page;

    if ( ! empty( $meta ) ) {
        $args['meta_query'] = $dummymeta;
    }
    if ( ! empty( $taxargs ) ) {
        $args['tax_query'] = $taxargs;
    }





    $wp_query = new WP_Query( $args );

    $total     = $wp_query->found_posts;
    $num_pages = 1;
    $num_pages = $wp_query->max_num_pages;



    if ( $total == 0 ) {
        $response = new WP_REST_Response(
            array(
                "num_of_pages" => $num_pages,
                "data" => $masterarray
            )
        );

        $response->set_status( 200 );

        return $response;
    }

    $product = null;
    $i       = 1;
    $arr     = array();


    while ( $wp_query->have_posts() ) {
        $img = array();
        $wp_query->the_post();
        $masterarray [] = masa_get_product_details_helper( get_the_ID() );

        $i ++;
    }



    $response = new WP_REST_Response(
        array(
            "num_of_pages" => $num_pages,
            "data" => $masterarray)
    );

    $response->set_status( 200 );

    return $response;
}


function masa_get_search_product( $request ) {
    global $product;

    $parameters = $request->get_params();

    $array       = array();
    $masterarray = array();

    $meta        = array();
    $dummymeta   = array();
    $taxargs     = array();
    $tax_query   = array();
    $args        = array();
    $page        = 1;
    $search_term = '';

    if ( ! empty( $parameters ) ) {
        foreach ( $parameters as $key => $data ) {

            if ( $key == "page" ) {
                $page = $parameters[ $key ];

            }

            if ( $key == "text" ) {
                $search_term = $parameters[ $key ];
                if ( empty( $search_term ) ) {
                    return new WP_Error( 'empty_text', 'Please! Enter Product Name', array(
                        'status' => 404
                    ) );
                }
            }

        }
    }

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 50,
        'paged'          => $page,
        's'              => $search_term,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC'
    );

    $wp_query = new WP_Query( $args );

    $total     = $wp_query->found_posts;
    $num_pages = 1;
    $num_pages = $wp_query->max_num_pages;


    if ( $total == 0 ) {
        return new WP_Error( 'empty_product', 'Sorry! No Product Available', array(
            'status' => 404
        ) );
    }

    $product = null;
    $i       = 1;
    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        $array = masa_get_product_helper( get_the_ID(), $num_pages, $i );
        array_push( $masterarray, $array );
        $i ++;
    }

    $response = new WP_REST_Response( $masterarray );

    $response->set_status( 200 );

    return $response;
}

function masa_get_offer_product( $request ) {
    global $product;

    $parameters = $request->get_params();

    $array       = array();
    $masterarray = array();

    $meta      = array();
    $dummymeta = array();
    $taxargs   = array();
    $tax_query = array();
    $args      = array();
    $page      = 1;

    $category = get_term_by( 'slug', 'offers', 'product_cat' );
    $cat_id   = $category->term_id;

    if ( ! empty( $cat_id ) ) {
        $tax_query['taxonomy'] = 'product_cat';
        $tax_query['field']    = 'term_id';
        $tax_query['terms']    = $cat_id;
        $tax_query['operator'] = 'IN';
        array_push( $taxargs, $tax_query );
    }

    if ( ! empty( $parameters ) ) {
        foreach ( $parameters as $key => $data ) {

            if ( $key == "page" ) {
                $page = $parameters[ $key ];

            }

        }
    }

    $args['post_type']      = 'product';
    $args['post_status']    = 'publish';
    $args['posts_per_page'] = 10;
    $args['paged']          = $page;

    if ( ! empty( $taxargs ) ) {
        $args['tax_query'] = $taxargs;
    }

    $wp_query = new WP_Query( $args );

    $total     = $wp_query->found_posts;
    $num_pages = 1;
    $num_pages = $wp_query->max_num_pages;


    if ( $total == 0 ) {
        return new WP_Error( 'empty_product', 'Sorry! No Product Available', array(
            'status' => 404
        ) );
    }

    $product = null;
    $i       = 1;
    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        $product             = wc_get_product( get_the_ID() );
        $array['num_pages']  = $num_pages;
        $array['srno']       = $i;
        $array['pro_id']     = $product->get_id();
        $array['categories'] = $product->get_category_ids();

        $array['name'] = $product->get_name();

        $array['type']               = $product->get_type();
        $array['slug']               = $product->get_slug();
        $array['date_created']       = $product->get_date_created();
        $array['date_modified']      = $product->get_date_modified();
        $array['status']             = $product->get_status();
        $array['featured']           = $product->get_featured();
        $array['catalog_visibility'] = $product->get_catalog_visibility();
        $array['description']        = $product->get_description();
        $array['short_description']  = $product->get_short_description();
        $array['sku']                = $product->get_sku();

        $array['virtual']       = $product->get_virtual();
        $array['permalink']     = get_permalink( $product->get_id() );
        $array['price']         = $product->get_price();
        $array['regular_price'] = $product->get_regular_price();
        $array['sale_price']    = $product->get_sale_price();
        $array['brand']         = $product->get_attribute( 'brand' );
        $array['size']          = $product->get_attribute( 'size' );
        $array['color']         = $product->get_attribute( 'color' );

        $array['tax_status']        = $product->get_tax_status();
        $array['tax_class']         = $product->get_tax_class();
        $array['manage_stock']      = $product->get_manage_stock();
        $array['stock_quantity']    = $product->get_stock_quantity();
        $array['stock_status']      = $product->get_stock_status();
        $array['backorders']        = $product->get_backorders();
        $array['sold_individually'] = $product->get_sold_individually();
        $array['get_purchase_note'] = $product->get_purchase_note();
        $array['shipping_class_id'] = $product->get_shipping_class_id();

        $array['weight']     = $product->get_weight();
        $array['length']     = $product->get_length();
        $array['width']      = $product->get_width();
        $array['height']     = $product->get_height();
        $array['dimensions'] = html_entity_decode( $product->get_dimensions() );

        // Get Linked Products
        $array['upsell_ids']     = $product->get_upsell_ids();
        $array['cross_sell_ids'] = $product->get_cross_sell_ids();
        $array['parent_id']      = $product->get_parent_id();

        $array['reviews_allowed'] = $product->get_reviews_allowed();
        $array['rating_counts']   = $product->get_rating_counts();
        $array['average_rating']  = $product->get_average_rating();
        $array['review_count']    = $product->get_review_count();

        $thumb              = wp_get_attachment_image_src( $product->get_image_id(), "thumbnail" );
        $full               = wp_get_attachment_image_src( $product->get_image_id(), "full" );
        $array['thumbnail'] = $thumb[0];
        $array['full']      = $full[0];
        $gallery            = array();
        foreach ( $product->get_gallery_image_ids() as $img_id ) {
            $g         = wp_get_attachment_image_src( $img_id, "full" );
            $gallery[] = $g[0];
        }
        $array['gallery'] = $gallery;
        $gallery          = array();

        array_push( $masterarray, $array );
        $i ++;
    }

    $response = new WP_REST_Response( $masterarray );

    $response->set_status( 200 );

    return $response;
}

function masa_get_featured_product( $request ) {
    global $product;

    $parameters = $request->get_params();

    $array       = array();
    $masterarray = array();

    $meta                  = array();
    $dummymeta             = array();
    $taxargs               = array();
    $tax_query             = array();
    $args                  = array();
    $page                  = 1;
    $tax_query['taxonomy'] = 'product_visibility';
    $tax_query['field']    = 'name';
    $tax_query['terms']    = 'featured';
    array_push( $taxargs, $tax_query );

    if ( ! empty( $parameters ) ) {
        foreach ( $parameters as $key => $data ) {


            if ( $key == "price" ) {
                $meta['key']     = '_price';
                $meta['value']   = $parameters['price'];
                $meta['compare'] = 'BETWEEN';
                $meta['type']    = 'NUMERIC';
                array_push( $dummymeta, $meta );

            }
            if ( $key == "category" ) {
                $tax_query['taxonomy'] = 'product_cat';
                $tax_query['field']    = 'term_id';
                $tax_query['terms']    = $parameters[ $key ];
                $tax_query['operator'] = 'IN';
                array_push( $taxargs, $tax_query );
            }
            if ( $key == "brand" ) {
                $tax_query['taxonomy'] = 'pa_brand';
                $tax_query['field']    = 'slug';
                $tax_query['terms']    = $parameters[ $key ];
                $tax_query['operator'] = 'IN';
                array_push( $taxargs, $tax_query );

            }

            if ( $key == "size" ) {
                $tax_query['taxonomy'] = 'pa_size';
                $tax_query['field']    = 'slug';
                $tax_query['terms']    = $parameters[ $key ];
                $tax_query['operator'] = 'IN';
                array_push( $taxargs, $tax_query );

            }

            if ( $key == "color" ) {
                $tax_query['taxonomy'] = 'pa_color';
                $tax_query['field']    = 'slug';
                $tax_query['terms']    = $parameters[ $key ];
                $tax_query['operator'] = 'IN';
                array_push( $taxargs, $tax_query );

            }


            if ( $key == "page" ) {
                $page = $parameters[ $key ];

            }

        }
    }

    $args['post_type']      = 'product';
    $args['post_status']    = 'publish';
    $args['posts_per_page'] = 10;
    $args['paged']          = $page;

    if ( ! empty( $meta ) ) {
        $args['meta_query'] = $dummymeta;
    }
    if ( ! empty( $taxargs ) ) {
        $args['tax_query'] = $taxargs;
    }


    $wp_query = new WP_Query( $args );


    $total     = $wp_query->found_posts;
    $num_pages = 1;
    $num_pages = $wp_query->max_num_pages;

    if ( $total == 0 ) {
        return new WP_Error( 'empty_product', 'Sorry! No Product Available', array(
            'status' => 404
        ) );
    }

    $product = null;
    $i       = 1;
    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        $product             = wc_get_product( get_the_ID() );
        $array['num_pages']  = $num_pages;
        $array['srno']       = $i;
        $array['pro_id']     = $product->get_id();
        $array['categories'] = $product->get_category_ids();

        $array['name'] = $product->get_name();

        $array['type']               = $product->get_type();
        $array['slug']               = $product->get_slug();
        $array['date_created']       = $product->get_date_created();
        $array['date_modified']      = $product->get_date_modified();
        $array['status']             = $product->get_status();
        $array['featured']           = $product->get_featured();
        $array['catalog_visibility'] = $product->get_catalog_visibility();
        $array['description']        = $product->get_description();
        $array['short_description']  = $product->get_short_description();
        $array['sku']                = $product->get_sku();

        $array['virtual']       = $product->get_virtual();
        $array['permalink']     = get_permalink( $product->get_id() );
        $array['price']         = $product->get_price();
        $array['regular_price'] = $product->get_regular_price();
        $array['sale_price']    = $product->get_sale_price();
        $array['brand']         = $product->get_attribute( 'brand' );
        $array['size']          = $product->get_attribute( 'size' );
        $array['color']         = $product->get_attribute( 'color' );

        $array['stock_quantity'] = $product->get_stock_quantity();
        $array['tax_status']     = $product->get_tax_status();
        $array['tax_class']      = $product->get_tax_class();
        $array['manage_stock']   = $product->get_manage_stock();

        $array['stock_status']      = $product->get_stock_status();
        $array['backorders']        = $product->get_backorders();
        $array['sold_individually'] = $product->get_sold_individually();
        $array['get_purchase_note'] = $product->get_purchase_note();
        $array['shipping_class_id'] = $product->get_shipping_class_id();

        $array['weight']     = $product->get_weight();
        $array['length']     = $product->get_length();
        $array['width']      = $product->get_width();
        $array['height']     = $product->get_height();
        $array['dimensions'] = html_entity_decode( $product->get_dimensions() );

        // Get Linked Products
        $array['upsell_ids']     = $product->get_upsell_ids();
        $array['cross_sell_ids'] = $product->get_cross_sell_ids();
        $array['parent_id']      = $product->get_parent_id();

        $array['reviews_allowed'] = $product->get_reviews_allowed();
        $array['rating_counts']   = $product->get_rating_counts();
        $array['average_rating']  = $product->get_average_rating();
        $array['review_count']    = $product->get_review_count();

        $thumb              = wp_get_attachment_image_src( $product->get_image_id(), "thumbnail" );
        $full               = wp_get_attachment_image_src( $product->get_image_id(), "full" );
        $array['thumbnail'] = $thumb[0];
        $array['full']      = $full[0];
        $gallery            = array();
        foreach ( $product->get_gallery_image_ids() as $img_id ) {
            $g         = wp_get_attachment_image_src( $img_id, "full" );
            $gallery[] = $g[0];
        }
        $array['gallery'] = $gallery;
        $gallery          = array();

        array_push( $masterarray, $array );
        $i ++;
    }

    $response = new WP_REST_Response( $masterarray );

    $response->set_status( 200 );

    return $response;
}

function masa_get_single_product( $request ) {

    $parameters = $request->get_params();

    $product = wc_get_product( $parameters['pro_id'] );

    $array['pro_id']     = $product->get_id();
    $array['categories'] = $product->get_category_ids();

    $array['name'] = $product->get_name();

    $array['type']               = $product->get_type();
    $array['slug']               = $product->get_slug();
    $array['date_created']       = $product->get_date_created();
    $array['date_modified']      = $product->get_date_modified();
    $array['status']             = $product->get_status();
    $array['featured']           = $product->get_featured();
    $array['catalog_visibility'] = $product->get_catalog_visibility();
    $array['description']        = $product->get_description();
    $array['short_description']  = $product->get_short_description();
    $array['sku']                = $product->get_sku();

    $array['virtual']       = $product->get_virtual();
    $array['permalink']     = get_permalink( $product->get_id() );
    $array['price']         = $product->get_price();
    $array['regular_price'] = $product->get_regular_price();
    $array['sale_price']    = $product->get_sale_price();
    $array['brand']         = $product->get_attribute( 'brand' );
    $array['size']          = $product->get_attribute( 'size' );
    $array['color']         = $product->get_attribute( 'color' );

    $array['tax_status']        = $product->get_tax_status();
    $array['tax_class']         = $product->get_tax_class();
    $array['manage_stock']      = $product->get_manage_stock();
    $array['stock_quantity']    = $product->get_stock_quantity();
    $array['stock_status']      = $product->get_stock_status();
    $array['backorders']        = $product->get_backorders();
    $array['sold_individually'] = $product->get_sold_individually();
    $array['get_purchase_note'] = $product->get_purchase_note();
    $array['shipping_class_id'] = $product->get_shipping_class_id();

    $array['weight']     = $product->get_weight();
    $array['length']     = $product->get_length();
    $array['width']      = $product->get_width();
    $array['height']     = $product->get_height();
    $array['dimensions'] = html_entity_decode( $product->get_dimensions() );

    // Get Linked Products
    $array['upsell_ids']     = $product->get_upsell_ids();
    $array['cross_sell_ids'] = $product->get_cross_sell_ids();
    $array['parent_id']      = $product->get_parent_id();

    $array['reviews_allowed'] = $product->get_reviews_allowed();
    $array['rating_counts']   = $product->get_rating_counts();
    $array['average_rating']  = $product->get_average_rating();
    $array['review_count']    = $product->get_review_count();

    $thumb              = wp_get_attachment_image_src( $product->get_image_id(), "thumbnail" );
    $full               = wp_get_attachment_image_src( $product->get_image_id(), "full" );
    $array['thumbnail'] = $thumb[0];
    $array['full']      = $full[0];
    $gallery            = array();
    foreach ( $product->get_gallery_image_ids() as $img_id ) {
        $g         = wp_get_attachment_image_src( $img_id, "full" );
        $gallery[] = $g[0];
    }
    $array['gallery'] = $gallery;
    $gallery          = array();

    $response = new WP_REST_Response( $array );

    $response->set_status( 200 );

    return $response;
}

function masa_get_category( $request ) {
    $taxonomy     = 'product_cat';
    $orderby      = 'name';
    $show_count   = 0; // 1 for yes, 0 for no
    $pad_counts   = 0; // 1 for yes, 0 for no
    $hierarchical = 1; // 1 for yes, 0 for no
    $title        = '';
    $empty        = 0;

    $args           = array(
        'taxonomy'     => $taxonomy,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'hide_empty'   => $empty,
        'parent'       => 0
    );
    $all_categories = get_categories( $args );

    // $temp = array_map('get_enable_category',$all_categories);

    $a = array_map( 'get_category_child', $all_categories );

    $arr = array_map( 'masa_attach_category_image', $a );


    $response = new WP_REST_Response( masa_filter_array( $arr ) );
    $response->set_status( 200 );

    return $response;

}

function masa_get_product_attribute( $request ) {

    $masterarray = array();
    $parameters  = $request->get_params();

    $taxonomy     = 'product_cat';
    $orderby      = 'name';
    $show_count   = 0; // 1 for yes, 0 for no
    $pad_counts   = 0; // 1 for yes, 0 for no
    $hierarchical = 1; // 1 for yes, 0 for no
    $title        = '';
    $empty        = 0;

    $args           = array(
        'taxonomy'     => $taxonomy,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'hide_empty'   => $empty,
        'parent'       => 0
    );
    $all_categories = get_categories( $args );

    //$temp = array_map('get_enable_category',$all_categories);
    $a   = array_map( 'get_category_child', $all_categories );
    $arr = array_map( 'masa_attach_category_image', $a );


    $masterarray['categories'] = masa_filter_array( $arr );

    $size = array();
    if ( taxonomy_exists( 'pa_size' ) ) {
        $size = get_terms( array(
            'taxonomy'   => 'pa_size',
            'hide_empty' => false,
        ) );

    }

    $masterarray['sizes'] = $size;

    $brand = array();

    if ( taxonomy_exists( 'pa_brand' ) ) {
        $brand = get_terms( array(
            'taxonomy'   => 'pa_brand',
            'hide_empty' => false,
        ) );
    }

    $masterarray['brands'] = $brand;

    $color = array();

    if ( taxonomy_exists( 'pa_color' ) ) {
        $color = get_terms( array(
            'taxonomy'   => 'pa_color',
            'hide_empty' => false,
        ) );

    }

    $masterarray['colors'] = $color;

    if ( taxonomy_exists( 'pa_weight' ) ) {
        $size = get_terms( array(
            'taxonomy'   => 'pa_weight',
            'hide_empty' => false,
        ) );

    }

    $masterarray['pa_weight'] = $size;

    $response = new WP_REST_Response( $masterarray );
    $response->set_status( 200 );

    return $response;

}


function masa_get_sub_category( $request ) {

    $parameters = $request->get_params();

    $taxonomy     = 'product_cat';
    $orderby      = 'name';
    $show_count   = 0; // 1 for yes, 0 for no
    $pad_counts   = 0; // 1 for yes, 0 for no
    $hierarchical = 1; // 1 for yes, 0 for no
    $title        = '';
    $empty        = 0;


    $args = array(
        'taxonomy'     => $taxonomy,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'child_of'     => $parameters['cat_id'],
        'hide_empty'   => $empty,
        'parent'       => $parameters['cat_id']
    );

    $all_categories = get_categories( $args );

    //$temp = array_map('get_enable_category',$all_categories);
    $a   = array_map( 'get_category_child', $all_categories );
    $arr = array_map( 'masa_attach_category_image', $a );


    $response = new WP_REST_Response( masa_filter_array( $arr ) );
    $response->set_status( 200 );

    return $response;

}

function masa_customer_registration($request = null) {

    $response = array();
    //$parameters = $request->get_json_params();


    $username = sanitize_text_field($request['username']);
    $first_name = sanitize_text_field($request['first_name']);
    $last_name = sanitize_text_field($request['last_name']);
    $email = sanitize_text_field($request['email']);
    $password = sanitize_text_field($request['password']);
    // $role = sanitize_text_field($parameters['role']);
    $error = new WP_Error();
    if (empty($username)) {
        $error->add(400, __("Username field is required.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }
    if (empty($email)) {
        $error->add(401, __("Email field is required.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }
    if (empty($password)) {
        $error->add(404, __("Password field is required.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }
    if (empty($first_name)) {
        $error->add(404, __("First name' is required.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }
    if (empty($last_name)) {
        $error->add(404, __("Last name' is required.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }
    // if (empty($role)) {
    //  $role = 'subscriber';
    // } else {
    //     if ($GLOBALS['wp_roles']->is_role($role)) {
    //      // Silence is gold
    //     } else {
    //    $error->add(405, __("Role field 'role' is not a valid. Check your User Roles from Dashboard.", 'wp_rest_user'), array('status' => 400));
    //    return $error;
    //     }
    // }
    $user_id = username_exists($username);
    if (!$user_id && email_exists($email) === false) {

        $user_id = wp_create_user($username, $password, $email);

        $u    = new WP_User( $user_id );
        $u->display_name = $first_name . ' ' .  $last_name;
        wp_insert_user($u);

        if (!is_wp_error($user_id)) {
            // Ger User Meta Data (Sensitive, Password included. DO NOT pass to front end.)
            $user = get_user_by('id', $user_id);
            wp_update_user([
                'ID' => $user_id,
                'first_name' => $first_name,
                'last_name' => $last_name
            ]);
            // $user->set_role($role);
            $user->set_role('subscriber');
            // WooCommerce specific code
            if (class_exists('WooCommerce')) {
                $user->set_role('customer');
            }
            // Ger User Data (Non-Sensitive, Pass to front end.)
            unset($u->data->user_pass);
            $response['code'] = 200;
            $response['data'] = $u->data;
            $response['message'] = __("User '" . $username . "' Registration was Successful", "wp-rest-user");
        } else {
            return $user_id;
        }
    } else {
        $error->add(406, __("Username or Email already exists, please try another", 'wp-rest-user'), array('status' => 400));
        return $error;
    }

    $json_response = new WP_REST_Response( $response );
    $json_response->set_status( 200 );
    return $json_response;
}


function masa_customer_login($request) {

    $creds = array();
    $creds['user_login'] = $request["username"];
    $creds['user_password'] =  $request["password"];
    $creds['remember'] = true;

    $error = new WP_Error();
    if (empty($request["username"])) {
        $error->add(400, __("Username field is required.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }

    if (empty($request["password"])) {
        $error->add(404, __("Password field is required.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }

    $user = wp_signon( $creds, true );

    if ( is_wp_error($user) ) {
        $error->add(400, __("Invalid username or password.", 'wp-rest-user'), array('status' => 400));
        return $error;
    }

    if ( ! in_array( 'customer', $user->roles, true ) ) {
        $error->add( 400, __( "Invalid username or password.", 'wp-rest-user' ), array( 'status' => 400 ) );

        return $error;
    }

    unset($user->data->user_pass);

    $response = [
        'status' => 200,
        'message' => "User has been logged in successfully",
        'data' => $user->data
    ];


    $json_response = new WP_REST_Response( $response );
    $json_response->set_status( 200 );

    return $json_response;
}


function masa_forgot_password ( $request ) {
    global $wpdb, $wp_hasher;

    $user_login = sanitize_text_field($request['email']);

    if ( empty( $user_login) ) {
        return false;
    }

    if ( strpos( $user_login, '@' ) ) {
        $user_data = get_user_by( 'email', trim( $user_login ) );
        if ( empty( $user_data ) ) {
            return false;
        }
    } else {
        $login = trim($user_login);
        $user_data = get_user_by('login', $login);
    }

    do_action('lostpassword_post');


    if ( !$user_data ) return false;

    // redefining user_login ensures we return the right case in the email
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;

    //do_action('retreive_password', $user_login);  // Misspelled and deprecated
    do_action('retrieve_password', $user_login);

    $allow = apply_filters('allow_password_reset', true, $user_data->ID);

    if ( ! $allow )
        return false;
    else if ( is_wp_error($allow) )
        return false;

    $key = wp_generate_password( 20, false );
    do_action( 'retrieve_password_key', $user_login, $key );

    if ( empty( $wp_hasher ) ) {
        require_once ABSPATH . 'wp-includes/class-phpass.php';
        $wp_hasher = new PasswordHash( 8, true );
    }
    $hashed = $wp_hasher->HashPassword( $key );
    $wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user_login ) );

    $message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
    $message .= network_home_url( '/' ) . "\r\n\r\n";
    $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
    $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
    $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
    $message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

    if ( is_multisite() )
        $blogname = $GLOBALS['current_site']->site_name;
    else
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $title = sprintf( __('[%s] Password Reset'), $blogname );

    $title = apply_filters('retrieve_password_title', $title);
    $message = apply_filters('retrieve_password_message', $message, $key);

    if ( $message && !wp_mail($user_email, $title, $message) )
        wp_die( __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...') );

    echo '<p>Link for password reset has been emailed to you. Please check your email.</p>';

    return '';
}

function masa_get_vendor_dashboard($request)
{
    $token = $request->get_header('token');
    $userid = $request->get_header('id');

    if ( empty( $token ) ) {
        return masa_throw_error( "Token Required" );
    }

    $validate = new masa_Api_Authentication();
    $response = $validate->masa_validate_token( $token );

    $res = (array) json_decode( $response['body'], true );
    
    if ( $res['data']['status'] != 200 ) {
        return $res;
    }
    $user_meta = get_userdata($userid);

    $user_roles = $user_meta->roles;
    $role = $user_roles[0];

    if ( $role != 'seller'){
        return new WP_Error('invalid_user', 'Sorry, you are not allowed to access this.', array(
			'status' => 401
		));
    }

    $parameters = $request->get_params();

    $dashboard = [];

    $authorization = 'Bearer '.$token;
    
    $order_list = wp_remote_get( get_home_url() . "/wp-json/dokan/v1/orders" , array(
        'headers' => array(
            'Authorization' => $authorization,
        )
    ));

    $dashboard['order'] = json_decode(wp_remote_retrieve_body($order_list));
    $product_summary = wp_remote_get( get_home_url() . "/wp-json/dokan/v1/products/summary" , array(
        'headers' => array(
            'Authorization' => $authorization,
        )
    ));

    $dashboard['product_summary'] = json_decode(wp_remote_retrieve_body($product_summary));

    $order_summary = wp_remote_get( get_home_url() . "/wp-json/dokan/v1/orders/summary" , array(
        'headers' => array(
            'Authorization' => $authorization,
        )
    ));
    
    $dashboard['order_summary'] = json_decode(wp_remote_retrieve_body($order_summary));

    $response = new WP_REST_Response($dashboard);
    $response->set_status(200);
    return $response;
}

function masa_get_admin_dashboard($request)
{
    $token = $request->get_header('token');
    $userid = $request->get_header('id');

    if ( empty( $token ) ) {
        return masa_throw_error( "Token Required" );
    }

    $validate = new masa_Api_Authentication();
    $response = $validate->masa_validate_token( $token );

    $res = (array) json_decode( $response['body'], true );
    
    if ( $res['data']['status'] != 200 ) {
        return $res;
    }
    $user_meta = get_userdata($userid);

    $user_roles = $user_meta->roles;
    $role = $user_roles[0];

    if ( $role != 'administrator'){
        return new WP_Error('invalid_user', 'Sorry, you are not allowed to access this.', array(
			'status' => 401
		));
    }

    global $woocommerce;
    $parameters = $request->get_params();

    $masterarray = [];
    $dashboard = [];
    $commmet_args = [
        'paged' => 1,
        'number' => 5,
        'comment_status' => 'approve'
    ];

    $comment_data = get_comments($commmet_args);
    $dashboard['new_comment'] = $comment_data;       

    $woocommerce = new Client(
        get_home_url(), $parameters['ck'],$parameters['cs'], 
        [
            'wp_api' => true, // Enable the WP REST API integration
            'version' => 'wc/v3', // WooCommerce WP REST API version
            'query_string_auth' => true
        ]
    );
    
    try {
        // Array of response results.
        $results = $woocommerce->get('');
    }catch (HttpClientException $e) {
        // return comman_message_response($e->getMessage(), $e->getCode()); // Error message.

        return new WP_Error('error', $e->getMessage(), array(
			'status' => $e->getCode()
		));
    }

    $new_order = $woocommerce->get('orders');
    $dashboard['new_order'] = $new_order;

    // sales report.
    $sale_query = [
        'date_min' => $parameters['date_min'], 
        'date_max' => $parameters['date_max']
    ];
    
    $sale_report = $woocommerce->get('reports/sales', $sale_query);
    $dashboard['sale_report'] = $sale_report;
    
    // list of top sellers report.
    $top_sale_query = [
        'period' => isset($parameters['period']) ? $parameters['period'] : 'week'
    ];

    $top_date_min = isset($parameters['top_date_min']) && $parameters['top_date_min'] != null ? isset($parameters['top_date_min']) : null;
    $top_date_max = isset($parameters['top_date_max']) && $parameters['top_date_max'] != null ? isset($parameters['top_date_max']) : null;

    if( $top_date_max != null && $top_date_min != null )
    {
        $top_sale_query['date_min'] = $top_date_min;
        $top_sale_query['date_max'] = $top_date_max;
    }

    $top_sale_report = $woocommerce->get('reports/sales', $top_sale_query);
    $dashboard['top_sale_report'] = $top_sale_report;

    // customers totals report.
    $customer_total = $woocommerce->get('reports/customers/totals');
    $dashboard['customer_total'] = $customer_total;

    // orders totals report.
    $order_total = $woocommerce->get('reports/orders/totals');
    $dashboard['order_total'] = $order_total;

    // products totals report.
    $products_total = $woocommerce->get('reports/products/totals');
    $dashboard['products_total'] = $products_total;

    // reviews totals report.
    $reviews_total = $woocommerce->get('reports/reviews/totals');
    $dashboard['reviews_total'] = $reviews_total;

    $response = new WP_REST_Response($dashboard);
    $response->set_status(200);
    return $response;
}
?>
