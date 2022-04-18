<?php

function masa_validate_api_request ($parameters) {

    $validate = false;


    if (isset($parameters['time']) && isset($parameters['secret_salt'])) {
        $secret_salt = genrateSecretSalt();
        $minutes = (strtotime(gmdate("h:i")) - strtotime($parameters['time'])) / 60;


        if ($minutes <= 1) {
            if ($secret_salt == $parameters['secret_salt']) {
                $validate = true;
            } else {
                $secret_salt = genrateSecretSalt(true);
                if ($secret_salt == $parameters['secret_salt']) {
                    $validate = true;
                }
            }

        }
    }




    return $validate;
}

function genrateSecretSalt ($plus_one = false) {
    $date_utc = gmdate("Y-m-d h:i");
    if ($plus_one) {
        $newTimesTamp = strtotime($date_utc. ' - 1 minute');
        $date_utc = date('Y-m-d H:i', $newTimesTamp);
    }
    return md5($date_utc . masa_API_SECRET_SALT);
}

function masa_get_images_link($id)
{
    global $product;
    $array = array();
    $img = array();
    $product = wc_get_product($id);
    $thumb = wp_get_attachment_image_src($product->get_image_id() , "thumbnail");
    $full = wp_get_attachment_image_src($product->get_image_id() , "full");
    $img[] = $thumb[0];
    $img[] = $full[0];
    //return $array;


    $gallery = array();
    foreach ($product->get_gallery_image_ids() as $img_id)
    {
        $g = wp_get_attachment_image_src($img_id, "full");
        $gallery[] = $g[0];
    }
    $array['image'] = $img;
    $array['gallery'] = $gallery;
    return $array;
}

function masa_get_special_product_details_helper ($type = null)
{
    $product = [];
    global $wpdb;

    if($type)
    {
        $product_meta = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key = '{$type}' AND  meta_value = 'yes' LIMIT 10", object);

        if (count($product_meta)) {

            foreach ($product_meta as $meta) {
                $data = masa_get_product_details_helper($meta->post_id);
                if ($data != []) {
                    $product[] = $data;
                }
            }
        }
    }



    return $product;
}

function masa_get_product_details_helper ($product_id, $user_id = "", $bookDownloadsDetails = false)
{
    global $product;
    $product = wc_get_product($product_id);
    $comm_arr = array();
    $comm_arr_master = array();

    if ($product === false) {
        return [];
    }
    $comments = get_approved_comments( $product_id , array('number' => 5) );
    foreach($comments as $comment)
    {
        $com_arr['comment_ID'] = $comment->comment_ID;
        $com_arr['comment_post_ID'] = $comment->comment_post_ID;
        $com_arr['comment_author'] = $comment->comment_author;
        $com_arr['comment_author_email'] = $comment->comment_author_email;
        $com_arr['comment_author_url'] = $comment->comment_author_url;
        $com_arr['comment_author_IP'] = $comment->comment_author_IP;
        $com_arr['comment_date'] = $comment->comment_date;
        $com_arr['comment_date_gmt'] = $comment->comment_date_gmt;
        $com_arr['comment_content'] = $comment->comment_content;
        $com_arr['comment_karma'] = $comment->comment_karma;
        $com_arr['comment_approved'] = $comment->comment_approved;
        $com_arr['comment_agent'] = $comment->comment_agent;
        $com_arr['comment_type'] = $comment->comment_type;
        $com_arr['comment_parent'] = $comment->comment_parent;
        $com_arr['user_id'] = $comment->user_id;
        $com_arr['rating_num'] = get_comment_meta( $comment->comment_ID, 'rating', true);

        array_push($comm_arr_master, $com_arr);
    }


    $temp = array(
        'id'                    => $product->get_id(),
        'name'                  => $product->get_name(),
        'slug'                  => $product->get_slug(),
        'permalink'             => $product->get_permalink(),
        'date_created'          => wc_rest_prepare_date_response( $product->get_date_created() ),
        'date_modified'         => wc_rest_prepare_date_response( $product->get_date_modified() ),
        'type'                  => $product->get_type(),
        'status'                => $product->get_status(),
        'featured'              => $product->is_featured(),
        'catalog_visibility'    => $product->get_catalog_visibility(),
        'description'           => wpautop( do_shortcode( $product->get_description() ) ),
        'short_description'     => apply_filters( 'woocommerce_short_description', $product->get_short_description() ),
        'sku'                   => $product->get_sku(),
        'price'                 => $product->get_price(),
        'regular_price'         => $product->get_regular_price(),
        'sale_price'            => $product->get_sale_price() ? $product->get_sale_price() : '',
        'date_on_sale_from'     => $product->get_date_on_sale_from() ? date( 'Y-m-d', $product->get_date_on_sale_from()->getTimestamp() ) : '',
        'date_on_sale_to'       => $product->get_date_on_sale_to() ? date( 'Y-m-d', $product->get_date_on_sale_to()->getTimestamp() ) : '',
        'price_html'            => $product->get_price_html(),
        'on_sale'               => $product->is_on_sale(),
        'purchasable'           => $product->is_purchasable(),
        'total_sales'           => $product->get_total_sales(),
        'virtual'               => $product->is_virtual(),
        'downloadable'          => $product->is_downloadable(),
        'downloads'             => [],
        'download_limit'        => $product->get_download_limit(),
        'download_expiry'       => $product->get_download_expiry(),
        'download_type'         => 'standard',
        'external_url'          => $product->is_type( 'external' ) ? $product->get_product_url() : '',
        'button_text'           => $product->is_type( 'external' ) ? $product->get_button_text() : '',
        'tax_status'            => $product->get_tax_status(),
        'tax_class'             => $product->get_tax_class(),
        'manage_stock'          => $product->managing_stock(),
        'stock_quantity'        => $product->get_stock_quantity(),
        'in_stock'              => $product->is_in_stock(),
        'backorders'            => $product->get_backorders(),
        'backorders_allowed'    => $product->backorders_allowed(),
        'backordered'           => $product->is_on_backorder(),
        'sold_individually'     => $product->is_sold_individually(),
        'weight'                => $product->get_weight(),
        'dimensions'            => array(
            'length' => $product->get_length(),
            'width'  => $product->get_width(),
            'height' => $product->get_height(),
        ),
        'shipping_required'     => $product->needs_shipping(),
        'shipping_taxable'      => $product->is_shipping_taxable(),
        'shipping_class'        => $product->get_shipping_class(),
        'shipping_class_id'     => $product->get_shipping_class_id(),
        'reviews_allowed'       => $product->get_reviews_allowed(),
        'average_rating'        => wc_format_decimal( $product->get_average_rating(), 2 ),
        'rating_count'          => $product->get_rating_count(),
        'related_ids'           => array_map( 'absint', array_values( wc_get_related_products( $product->get_id() ) ) ),
        'upsell_ids'            => array_map( 'absint', $product->get_upsell_ids() ),
        'cross_sell_ids'        => array_map( 'absint', $product->get_cross_sell_ids() ),
        'parent_id'             => $product->get_parent_id(),
        'purchase_note'         => wpautop( do_shortcode( wp_kses_post( $product->get_purchase_note() ) ) ),
        'categories'            => masa_get_taxonomy_terms_helper( $product ),
        'tags'                  => masa_get_taxonomy_terms_helper( $product, 'tag' ),
        'images'                => masa_get_product_images_helper( $product ),
        'attributes'            => masa_get_product_attributes( $product ),
        'default_attributes'    => masa_get_product_default_attributes( $product ),
        'variations'            => $product->get_children(),
        'grouped_products'      => array(),
        'upsell_id'      => array(),
        'menu_order'            => $product->get_menu_order(),


        'reviews' =>  $comm_arr_master

    );

    $temp['is_purchased'] = false;


    if ($user_id != "") {
        $customer_orders = get_posts( array(
            'numberposts' => -1,
            'meta_key'    => '_customer_user',
            'meta_value'  => $user_id,
            'post_type'   => 'shop_order', // WC orders post type
            'post_status' => 'wc-completed' // Only orders with status "completed"
        ) );

        if (count($customer_orders)) {
            foreach ($customer_orders as $customer_order) {
                $order = wc_get_order($customer_order);

                $order_items = $order->get_items();

                $order_items = array_values($order_items);

                for ($i = 0; $i <= count($order_items); $i++) {

                    if (isset($order_items[$i])) {
                        if ( version_compare( WC_VERSION, '3.0', '<' ) )
                            $new_product_id = $order_items[$i]['product_id'];
                        else
                            $new_product_id = $order_items[$i]->get_product_id();

                        if ($new_product_id == $product->get_id()) {
                            $temp['is_purchased'] = true;
                            break;
                        }
                    }
                }

            }
        }
    }

    if  ($bookDownloadsDetails) {
        if (($temp['price'] === "" && $temp['regular_price'] === "" && $temp['sale_price'] === "") || $temp['is_purchased'] == true) {
            $temp['downloads'] = masa_get_product_downloads( $product );
        }
    }



    $author_id = get_post_field( 'post_author', $product_id );

    $store = dokan()->vendor->get( $author_id );



    $temp['store'] = array(
        'id'        => $store->get_id(),
        'name'      => $store->get_name(),
        'shop_name' => $store->get_shop_name(),
        'url'       => $store->get_shop_url(),
        'image'   => get_avatar_url($author_id),
        'address'   => $store->get_address(),

    );

    /*if ($temp['']) {

    }*/

    if (isset($temp['upsell_ids']) && count($temp['upsell_ids'])) {
        $upsell_products = [];

        foreach ($temp['upsell_ids'] as $key => $p_id) {

            $upsell_product = wc_get_product($p_id);

            if ($upsell_product != null) {
                $upsell_products[] = [
                    'id'                    => $upsell_product->get_id(),
                    'name'                  => $upsell_product->get_name(),
                    'slug'                  => $upsell_product->get_slug(),
                    'price'                 => $upsell_product->get_price(),
                    'regular_price'         => $upsell_product->get_regular_price(),
                    'sale_price'            => $upsell_product->get_sale_price() ? $upsell_product->get_sale_price() : '',
                    'images'                => masa_get_product_images_helper( $upsell_product ),
                ];
            }
        }

        if (count($upsell_products)) {
            $temp['upsell_id'] = $upsell_products;
        }
    }

    return $temp;

}

function masa_get_product_variation_id( $product )
{

}

function masa_get_product_downloads( $product ) {
    $downloads = array();

    if ( $product->is_downloadable() ) {
        foreach ( $product->get_downloads() as $file_id => $file ) {
            $downloads[] = array(
                'id'   => $file_id, // MD5 hash.
                'name' => $file['name'],
                'file' => $file['file'],
            );
        }
    }

    return $downloads;
}

function masa_get_taxonomy_terms_helper( $product, $taxonomy = 'cat' ) {
    $terms = array();

    foreach ( wc_get_object_terms( $product->get_id(), 'product_' . $taxonomy ) as $term ) {
        $terms[] = array(
            'id'   => $term->term_id,
            'name' => $term->name,
            'slug' => $term->slug,
        );
    }

    return $terms;
}

function masa_get_product_images_helper( $product ) {
    $images = array();
    $attachment_ids = array();

    // Add featured image.
    if ( $product->get_image_id() ) {
        $attachment_ids[] = $product->get_image_id();
    }

    $attachment_ids = array_merge( $attachment_ids, $product->get_gallery_image_ids() );

    foreach ( $attachment_ids as $position => $attachment_id ) {
        $attachment_post = get_post( $attachment_id );
        if ( is_null( $attachment_post ) ) {
            continue;
        }

        $attachment = wp_get_attachment_image_src( $attachment_id, 'full' );
        if ( ! is_array( $attachment ) ) {
            continue;
        }

        $images[] = array(
            'id'            => (int) $attachment_id,
            'date_created'  => wc_rest_prepare_date_response( $attachment_post->post_date_gmt ),
            'date_modified' => wc_rest_prepare_date_response( $attachment_post->post_modified_gmt ),
            'src'           => current( $attachment ),
            'name'          => get_the_title( $attachment_id ),
            'alt'           => get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ),
            'position'      => (int) $position,
        );
    }

    if ( empty( $images ) ) {
        $images[] = array(
            'id'            => 0,
            'date_created'  => wc_rest_prepare_date_response( current_time( 'mysql' ) ), // Default to now.
            'date_modified' => wc_rest_prepare_date_response( current_time( 'mysql' ) ),
            'src'           => wc_placeholder_img_src(),
            'name'          => __( 'Placeholder', 'woocommerce' ),
            'alt'           => __( 'Placeholder', 'woocommerce' ),
            'position'      => 0,
        );
    }

    return $images;
}

function masa_get_product_attributes( $product ) {
    $attributes = array();

    if ( $product->is_type( 'variation' ) ) {
        // Variation attributes.
        foreach ( $product->get_variation_attributes() as $attribute_name => $attribute ) {
            $name = str_replace( 'attribute_', '', $attribute_name );

            if ( ! $attribute ) {
                continue;
            }

            // Taxonomy-based attributes are prefixed with `pa_`, otherwise simply `attribute_`.
            if ( 0 === strpos( $attribute_name, 'attribute_pa_' ) ) {
                $option_term = get_term_by( 'slug', $attribute, $name );
                $attributes[] = array(
                    'id'     => wc_attribute_taxonomy_id_by_name( $name ),
                    'name'   => masa_get_product_attribute_taxonomy_label( $name ),
                    'option' => $option_term && ! is_wp_error( $option_term ) ? $option_term->name : $attribute,
                );
            } else {
                $attributes[] = array(
                    'id'     => 0,
                    'name'   => $name,
                    'option' => $attribute,
                );
            }
        }
    } else {
        foreach ( $product->get_attributes() as $attribute ) {
            if ( $attribute['is_taxonomy'] ) {
                $attributes[] = array(
                    'id'        => wc_attribute_taxonomy_id_by_name( $attribute['name'] ),
                    'name'      => masa_get_product_attribute_taxonomy_label( $attribute['name'] ),
                    'position'  => (int) $attribute['position'],
                    'visible'   => (bool) $attribute['is_visible'],
                    'variation' => (bool) $attribute['is_variation'],
                    'options'   => masa_get_product_attribute_options( $product->get_id(), $attribute ),
                );
            } else {
                $attributes[] = array(
                    'id'        => 0,
                    'name'      => $attribute['name'],
                    'position'  => (int) $attribute['position'],
                    'visible'   => (bool) $attribute['is_visible'],
                    'variation' => (bool) $attribute['is_variation'],
                    'options'   => masa_get_product_attribute_options( $product->get_id(), $attribute ),
                );
            }
        }
    }

    return $attributes;
}

function masa_get_product_attribute_taxonomy_label( $name ) {
    $tax    = get_taxonomy( $name );
    $labels = get_taxonomy_labels( $tax );

    return $labels->singular_name;
}


function masa_get_product_attribute_options( $product_id, $attribute ) {
    if ( isset( $attribute['is_taxonomy'] ) && $attribute['is_taxonomy'] ) {
        return wc_get_product_terms( $product_id, $attribute['name'], array( 'fields' => 'names' ) );
    } elseif ( isset( $attribute['value'] ) ) {
        return array_map( 'trim', explode( '|', $attribute['value'] ) );
    }

    return array();
}

function masa_get_product_default_attributes( $product ) {
    $default = array();

    if ( $product->is_type( 'variable' ) ) {
        foreach ( array_filter( (array) $product->get_default_attributes(), 'strlen' ) as $key => $value ) {
            if ( 0 === strpos( $key, 'pa_' ) ) {
                $default[] = array(
                    'id'     => wc_attribute_taxonomy_id_by_name( $key ),
                    'name'   => masa_get_product_attribute_taxonomy_label( $key ),
                    'option' => $value,
                );
            } else {
                $default[] = array(
                    'id'     => 0,
                    'name'   => wc_attribute_taxonomy_slug( $key ),
                    'option' => $value,
                );
            }
        }
    }

    return $default;
}

function masa_get_date_timestamp_helper($date)
{
    $new_date = null;

    if ($date != null) {
        $new_date = gmdate( 'Y-m-d H:i:s', $date->getTimestamp());
    }

    return $new_date;
}
function masa_get_product_helper($id,$num_pages = '',$i='')
{
    global $product;
    $product = wc_get_product($id);
    $array['num_pages'] = $num_pages;
    $array['srno'] = $i;

    $array['pro_id'] = $product->get_id();
    $array['categories'] = $product->get_category_ids();

    $array['name'] = $product->get_name();

    $array['type'] = $product->get_type();
    $array['slug'] = $product->get_slug();
    $array['date_created'] = $product->get_date_created();
    $array['date_modified'] = $product->get_date_modified();
    $array['status'] = $product->get_status();
    $array['featured'] = $product->get_featured();
    $array['catalog_visibility'] = $product->get_catalog_visibility();
    $array['description'] = $product->get_description();
    $array['short_description'] = $product->get_short_description();
    $array['sku'] = $product->get_sku();

    $array['virtual'] = $product->get_virtual();
    $array['permalink'] = get_permalink($product->get_id());
    $array['price'] = $product->get_price();
    $array['regular_price'] = $product->get_regular_price();
    $array['sale_price'] = $product->get_sale_price();
    $array['brand'] = $product->get_attribute('brand');
    $array['size'] = $product->get_attribute('size');
    $array['color'] = $product->get_attribute('color');

    $array['weight_attribute'] = $product->get_attribute('weight');

    $array['tax_status'] = $product->get_tax_status();
    $array['tax_class'] = $product->get_tax_class();
    $array['manage_stock'] = $product->get_manage_stock();
    $array['stock_quantity'] = $product->get_stock_quantity();
    $array['stock_status'] = $product->get_stock_status();
    $array['backorders'] = $product->get_backorders();
    $array['sold_individually'] = $product->get_sold_individually();
    $array['get_purchase_note'] = $product->get_purchase_note();
    $array['shipping_class_id'] = $product->get_shipping_class_id();

    $array['weight'] = $product->get_weight();
    $array['length'] = $product->get_length();
    $array['width'] = $product->get_width();
    $array['height'] = $product->get_height();
    $array['dimensions'] = html_entity_decode($product->get_dimensions());

    // Get Linked Products
    $array['upsell_ids'] = $product->get_upsell_ids();
    $array['cross_sell_ids'] = $product->get_cross_sell_ids();
    $array['parent_id'] = $product->get_parent_id();

    $array['reviews_allowed'] = $product->get_reviews_allowed();
    $array['rating_counts'] = $product->get_rating_counts();
    $array['average_rating'] = $product->get_average_rating();
    $array['review_count'] = $product->get_review_count();

    $thumb = wp_get_attachment_image_src($product->get_image_id() , "thumbnail");
    $full = wp_get_attachment_image_src($product->get_image_id() , "full");
    $array['thumbnail'] = $thumb[0];
    $array['full'] = $full[0];
    $gallery = array();
    foreach ($product->get_gallery_image_ids() as $img_id)
    {
        $g = wp_get_attachment_image_src($img_id, "full");
        $gallery[] = $g[0];
    }
    $array['gallery'] = $gallery;
    $gallery = array();


    return $array;


}

function masa_throw_error($msg)
{
    $response = new WP_REST_Response(array(
            "code" => "Error",
            "message" => $msg,
            "data" => array(
                "status" => 404
            )
        )
    );
    $response->set_status(404);
    return $response;
}

function allow_payment_without_login( $allcaps, $caps, $args ) {
    // Check we are looking at the WooCommerce Pay For Order Page
    if ( !isset( $caps[0] ) || $caps[0] != 'pay_for_order' )
        return $allcaps;
    // Check that a Key is provided
    if ( !isset( $_GET['key'] ) )
        return $allcaps;

    // Find the Related Order
    $order = wc_get_order( $args[2] );
    if( !$order )
        return $allcaps; # Invalid Order

    // Get the Order Key from the WooCommerce Order
    $order_key = $order->get_order_key();
    // Get the Order Key from the URL Query String
    $order_key_check = $_GET['key'];

    // Set the Permission to TRUE if the Order Keys Match
    $allcaps['pay_for_order'] = ( $order_key == $order_key_check );

    return $allcaps;
}
add_filter( 'user_has_cap', 'allow_payment_without_login', 10, 3 );

function get_enable_category($arr)
{
    $a = (array) $arr;

    $term_meta = get_option("enable_" . $a['term_id']);

    if(!empty($term_meta['enable']))
    {
        return $a;
    }

}

function get_category_child($arr)
{
    $a = (array) $arr;
    if($a)
    {
        $child_terms_ids = get_term_children( $a['term_id'], 'product_cat' );

        $temp = array_map('get_enable_subcategory',$child_terms_ids);

        // $temp = array_filter($temp,function($var)
        // {
        //     return $var !== null;
        // });

        $a['subcategory'] = masa_filter_array($temp);

        return $a;
    }
}

function masa_attach_category_image($arr)
{
    $a = (array) $arr;
    $taxargs = array();
    $tax_query = array();
    $masterarray = array();
    if($a)
    {
        $thumb_id = get_term_meta( $a['term_id'], 'thumbnail_id', true );
        $term_img = wp_get_attachment_url(  $thumb_id );

        $tax_query['taxonomy'] = 'product_cat';
        $tax_query['field']    = 'term_id';
        $tax_query['terms']    = $a['term_id'];
        $tax_query['operator'] = 'IN';
        array_push( $taxargs, $tax_query );

        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 5,
            'paged'          => 1,

        );
        if ( ! empty( $taxargs ) ) {
            $args['tax_query'] = $taxargs;
        }
        $wp_query  = new WP_Query( $args );

        while ( $wp_query->have_posts() )
        {

            $wp_query->the_post();
            array_push($masterarray, masa_get_product_details_helper( get_the_ID() ));


        }
        $a['product'] = $masterarray;
        if($term_img)
        {
            $a['image'] = $term_img;
        }
        else
        {
            $a['image'] = "";
        }
        return $a;
    }
}

function masa_product_by_category($arr)
{

    $a = (array) $arr;
    $masterarray = array();
    if($a)
    {
        $args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 5,
            'paged'          => 1,
            'cat' => $a['term_id']
        );
        $wp_query  = new WP_Query( $args );

        while ( $wp_query->have_posts() )
        {

            $wp_query->the_post();

            $a['product'] = masa_get_product_details_helper( get_the_ID() );

        }

        return $masterarray;
    }
}

if(!function_exists('comman_custom_response')){
	function comman_custom_response( $res, $status_code = 200 )
	{
		$response = new WP_REST_Response($res);
		$response->set_status($status_code);
		return $response;
	}
}


function get_enable_subcategory($arr)
{
    $a = (array) $arr;
    foreach($a as $val)
    {
        $term_meta = get_option("enable_" . $val);
        if($term_meta)
        {
            return $val;
        }
    }
}

function masa_filter_array($arr)
{
    $res = array();
    foreach($arr as $key=>$val)
    {
        if($val != null)
        {
            array_push($res,$val);
        }
    }
    return $res;

}
function masa_title_filter( $where, $wp_query ){
    global $wpdb;
    if( $search_term = $wp_query->get( 'masa_title_filter' ) ) :
        $search_term = $wpdb->esc_like( $search_term );
        $search_term = ' \'%' . $search_term . '%\'';
        $title_filter_relation = ( strtoupper( $wp_query->get( 'title_filter_relation' ) ) == 'OR' ? 'OR' : 'AND' );
        $where .= ' '.$title_filter_relation.' ' . $wpdb->posts . '.post_title LIKE ' . $search_term;
    endif;
    return $where;
}
add_filter( 'posts_where', 'masa_title_filter', 10, 2 );



function masa_maybe_add_multiple_products_to_cart( $url = false ) {
    // Make sure WC is installed, and add-to-cart qauery arg exists, and contains at least one comma.
    if ( ! class_exists( 'WC_Form_Handler' ) || empty( $_REQUEST['add-to-cart'] ) || false === strpos( $_REQUEST['add-to-cart'], ',' ) ) {
        return;
    }

    // Remove WooCommerce's hook, as it's useless (doesn't handle multiple products).
    remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

    $product_ids = explode( ',', $_REQUEST['add-to-cart'] );
    $count       = count( $product_ids );
    $number      = 0;

    foreach ( $product_ids as $id_and_quantity ) {
        // Check for quantities defined in curie notation (<product_id>:<product_quantity>)
        // https://dsgnwrks.pro/snippets/woocommerce-allow-adding-multiple-products-to-the-cart-via-the-add-to-cart-query-string/#comment-12236
        $id_and_quantity = explode( ':', $id_and_quantity );
        $product_id = $id_and_quantity[0];

        $_REQUEST['quantity'] = ! empty( $id_and_quantity[1] ) ? absint( $id_and_quantity[1] ) : 1;

        if ( ++$number === $count ) {
            // Ok, final item, let's send it back to woocommerce's add_to_cart_action method for handling.
            $_REQUEST['add-to-cart'] = $product_id;

            return WC_Form_Handler::add_to_cart_action( $url );
        }

        $product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $product_id ) );
        $was_added_to_cart = false;
        $adding_to_cart    = wc_get_product( $product_id );


        if ( ! $adding_to_cart ) {
            continue;
        }

        $add_to_cart_handler = apply_filters( 'woocommerce_add_to_cart_handler', $adding_to_cart->get_type(), $adding_to_cart );

        if ( 'simple' !== $add_to_cart_handler ) {
            continue;
        }

        // For now, quantity applies to all products.. This could be changed easily enough, but I didn't need this feature.
        $quantity = empty( $_REQUEST['quantity'] ) ? 1 : wc_stock_amount( $_REQUEST['quantity'] );
        $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

        if ( false !== WC()->cart->add_to_cart( $product_id, $quantity ) ) {
            wc_add_to_cart_message( array( $product_id => $quantity ), true );
        }
    }
}

// Fire before the WC_Form_Handler::add_to_cart_action callback.
add_action( 'wp_loaded', 'masa_maybe_add_multiple_products_to_cart', 15 );


/**
 * Change a currency symbol
 */
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
    switch( $currency ) {
        case 'HKD': $currency_symbol = 'HK$'; break;
    }
    return $currency_symbol;
}

?>