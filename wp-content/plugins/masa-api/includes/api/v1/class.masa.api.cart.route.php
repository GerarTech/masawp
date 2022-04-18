<?php
// WP_REST_Server::READABLE = 'GET'
// WP_REST_Server::CREATABLE = 'POST'
// WP_REST_Server::EDITABLE = 'POST, PUT, PATCH'
// WP_REST_Server::DELETABLE = 'DELETE'
// WP_REST_Server::ALLMETHODS = 'GET, POST, PUT, PATCH, DELETE'


add_action('rest_api_init', function ()
{
    $namespace = 'masa-api';
    $base = 'cart';

    register_rest_route($namespace . '/api/v1/' . $base, 'add-cart/', array(
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_add_cart',
        'permission_callback' => '__return_true',
    ));

    register_rest_route($namespace . '/api/v1/' . $base, 'get-cart/', array(
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_get_cart',
        'permission_callback' => '__return_true',
    ));

    register_rest_route($namespace . '/api/v1/' . $base, 'update-cart/', array(
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_update_cart',
        'permission_callback' => '__return_true',
    ));

    register_rest_route($namespace . '/api/v1/' . $base, 'delete-cart/', array(
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_delete_cart',
        'permission_callback' => '__return_true',
    ));

    register_rest_route($namespace . '/api/v1/' . $base, 'clear-cart/', array(
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => 'masa_clear_cart',
        'permission_callback' => '__return_true',
    ));

});

function masa_get_cart($request)
{

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
    global $product;
    $masterarray = array();
    $datarray = array();

    $cart_items = $wpdb->get_results("SELECT * FROM 
                                                {$wpdb->prefix}masa_add_to_cart 
                                                    where 
                                                        user_id=" . $userid . "", OBJECT);

    if (empty($cart_items))
    {
        return new WP_Error('empty_cart', 'no product available', array(
            'status' => 404
        ));
    }
    else
    {
        $result = json_decode(json_encode($cart_items) , True);

        foreach ($result as $items)
        {
            $products = wc_get_product($items['pro_id']);

            if (!$products)
            {
                continue;
            }

	        /*$shipping_class_id = $products->get_shipping_class_id();

	        $shipping = get_term_by( 'id', $shipping_class_id, 'product_shipping_class' );

	        print_r($shipping);die;
	        if ( $shipping_class_id ) {
		        $flat_rates = get_option( "woocommerce_flat_rates" );
		        print_r( $flat_rates );
		        die;
		        $fee = $flat_rates[ $shipping_class ]['cost'];
	        }*/

            $datarray['cart_id'] = $items['ID'];
            $datarray['pro_id'] = $products->get_id();
            $datarray['name'] = $products->get_name();
            $datarray['sku'] = $products->get_sku();
            $datarray['price'] = $products->get_price();
            $datarray['on_sale'] = $products->is_on_sale();
            $datarray['regular_price'] = $products->get_regular_price();
            $datarray['sale_price'] = $products->get_sale_price();
            $datarray['stock_quantity'] = $products->get_stock_quantity();            
            $datarray['stock_status'] = $products->get_stock_status();
            $datarray['shipping_class'] = $products->get_shipping_class();
            $datarray['shipping_class_id'] = $products->get_shipping_class_id();

            $thumb = wp_get_attachment_image_src($products->get_image_id() , "thumbnail");
            $full = wp_get_attachment_image_src($products->get_image_id() , "full");
            $datarray['thumbnail'] = $thumb[0];
            $datarray['full'] = $full[0];

            $gallery = array();
            foreach ($products->get_gallery_image_ids() as $img_id)
            {
                $g = wp_get_attachment_image_src($img_id, "full");
                $gallery[] = $g[0];
            }
            $datarray['gallery'] = $gallery;
            $gallery = array();

            $datarray['created_at'] = $items['created_at'];
            $datarray['quantity'] = $items['quantity'];
            
            
            $masterarray[] = $datarray;
            $datarray = array();
        }

    }

    $response = new WP_REST_Response($masterarray);
    //$response->set_status(200);
    return $response;

}

function masa_add_cart($request)
{
    global $wpdb;

    $parameters = $request->get_params();

    $header = $request->get_headers();

    if (empty($header['token']))
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

    if (!isset($parameters['pro_id'])) {
	    return new WP_Error('pro_id_missing', 'Product id is required', array(
		    'status' => 404
	    ));
    }

    $cart_items = $wpdb->get_results("SELECT * FROM 
                {$wpdb->prefix}masa_add_to_cart 
                    where 
                    user_id=" . $userid . " AND pro_id =" . $parameters['pro_id'] . "", OBJECT);

    if (!empty($cart_items))
    {
        return new WP_Error('Already In list', 'Product Already in Cart', array(
            'status' => 403
        ));
    }


    $insdata = array();

    if(isset($parameters['color']))
    {

        $insdata['color'] = $parameters['color'];;

    }


    if(isset($parameters['size']))
    {

        $insdata['size'] = $parameters['size'];;
    }



    if(isset($parameters['quantity']))
    {

        $insdata['quantity'] = $parameters['quantity'];;
    }

    $insdata['user_id'] = $userid;
    $insdata['created_at'] = current_time('mysql');
    $insdata['pro_id'] = $parameters['pro_id'];


    $table = $wpdb->prefix . 'masa_add_to_cart';

    $res = $wpdb->insert($table, $insdata);

    if($res > 0)
    {

        $response = new WP_REST_Response(array(
            "code" => "success",
            "message" => "Product Succesfully Added To Cart",
            "data" => array(
                "status" => 200
            )
        )   
        );
    return $response;
    }
    else
    {
        return masa_throw_error("Product Not added To Cart");
    }
    // $response->set_status(200);
    
}

function masa_update_cart($request)
{
    global $wpdb;

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

    if ($parameters['quantity'] == "0")
    {
        $cart_items = $wpdb->get_results("DELETE FROM 
					{$wpdb->prefix}masa_add_to_cart 
						where 
							ID=" . $parameters['cart_id'] . "", OBJECT);

    }
    else
    {
        $table = $wpdb->prefix . 'masa_add_to_cart';
        $insdata = array();

    if(isset($parameters['color']))
    {
        
        $insdata['color'] = $parameters['color'];;
        
    } 
    
    
    if(isset($parameters['size']))
    {
        
        $insdata['size'] = $parameters['size'];;
    }  

     

    if(isset($parameters['quantity']))    
    {
        
        $insdata['quantity'] = $parameters['quantity'];;
    }  
    
        $insdata['user_id'] = $userid;
        $insdata['created_at'] = current_time('mysql');
        $insdata['pro_id'] = $parameters['pro_id'];
        
        $cond = array(
            "ID" => $parameters['cart_id']
        );

        $res = $wpdb->update($table, $insdata, $cond);

    }

    if($res > 0)
    {
    $response = new WP_REST_Response(array(
        "code" => "success",
        "message" => "Cart Updated Successfully",
        "data" => array(
            "status" => 200
        )
    )
    );
    return $response;
    }

    else
    {
        return masa_throw_error("Cart Not Updated");
    }
   
}
function masa_delete_cart($request)
{
    global $wpdb;

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

    $query = "DELETE FROM 
                {$wpdb->prefix}masa_add_to_cart 
                    where 
                    user_id=" . $userid . " AND pro_id in (" . $parameters['pro_id'] . ")";

    $cart_items = $wpdb->get_results($query, OBJECT);

    $response = new WP_REST_Response(array(
        "code" => "success",
        "message" => "Product Deleted From Cart",
        "data" => array(
            "status" => 200
        )
    )
);
    //$response->set_status(200);
    return $response;

}

function masa_clear_cart($request)
{
    global $wpdb;

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

    $cart_items = $wpdb->get_results("DELETE FROM 
                {$wpdb->prefix}masa_add_to_cart 
                    where 
                    user_id=" . $userid . " ", OBJECT);

    $response = new WP_REST_Response(array(
        "code" => "success",
        "message" => "All Product Deleted From Cart",
        "data" => array(
            "status" => 200
        )
    )
);
    $response->set_status(200);
    return $response;

}

?>