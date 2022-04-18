<?php  
add_filter('woocommerce_product_data_tabs', function($tabs) {
	$tabs['additional_info'] = [
		'label' => __('Additional Information', 'woocommerce'),
		'target' => 'additional_product_data_tabs',
		'priority' => 25
	];
	return $tabs;
});

add_action('woocommerce_product_data_panels', function() {
	?>
    <div id="additional_product_data_tabs" class="panel woocommerce_options_panel hidden">
        <?php
            global $woocommerce, $post;
            echo '<div class="options_group">';
        
            woocommerce_wp_checkbox( array( 
                'id'            => 'masa_deal_of_the_day', 
                'wrapper_class' => '', 
                'label'         => 'Deal Of The Day'
                )
            );
            woocommerce_wp_checkbox( array( 
                'id'            => 'masa_suggested_for_you', 
                'wrapper_class' => '', 
                'label'         => 'Suggested for you', 
                )
            );
            woocommerce_wp_checkbox( array( 
                'id'            => 'masa_offer', 
                'wrapper_class' => '', 
                'label'         => 'Offers'
                )
            );
            woocommerce_wp_checkbox( array(
                'id' => 'masa_you_may_like',
                'wrapper_class' => '',
                'label' => 'You may like'
            ));
            
            echo '</div>';
        ?>
    </div>
<?php
});

function save_custom_field_in_bulk_edit_quick_edit( $post_id ){
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    $post_type = get_post_type($post_id);
    if ( 'product' !== $post_type ) return $post_id;

    if (isset($_REQUEST['masa_deal_of_the_day'])) {
        update_post_meta( $post_id, 'masa_deal_of_the_day', $_REQUEST['masa_deal_of_the_day'] );
    } else {
        delete_post_meta( $post_id, 'masa_deal_of_the_day' );
    }
    if (isset($_REQUEST['masa_suggested_for_you'])) {
        update_post_meta( $post_id, 'masa_suggested_for_you', $_REQUEST['masa_suggested_for_you'] );
    } else {
        delete_post_meta( $post_id, 'masa_suggested_for_you' );
    }
    if (isset($_REQUEST['masa_offer'])) {
        update_post_meta( $post_id, 'masa_offer', $_REQUEST['masa_offer'] );
    } else {
        delete_post_meta( $post_id, 'masa_offer' );
    }
    if (isset($_REQUEST['masa_you_may_like'])) {
        update_post_meta( $post_id, 'masa_you_may_like', $_REQUEST['masa_you_may_like'] );
    } else {
        delete_post_meta( $post_id, 'masa_you_may_like' );
    }
   

}
add_action( 'woocommerce_process_product_meta', 'save_custom_field_in_bulk_edit_quick_edit', 99, 2 );

//Product Cat creation page
function masa_taxonomy_add_new_meta_field() {
    ?>
    <div class="form-field">
        <label for="term_meta[enable]"><?php _e('Enable', 'masa'); ?></label>
        <input type="checkbox" value="check" name="term_meta[enable]" id="term_meta[enable]" checked>
        
    </div>
   
    <?php
}

add_action('product_cat_add_form_fields', 'masa_taxonomy_add_new_meta_field', 10, 2);

//Product Cat Edit page
function masa_taxonomy_edit_meta_field($term) {

    //getting term ID
     $term_id = $term->term_id;

    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option("enable_" . $term_id);
    
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[enable]"><?php _e('Enable', 'masa'); ?></label></th>
        <td>
            <?php
            
                if((isset($term_meta['enable']) && $term_meta['enable'] == 'check')) 
                {
                    $chk = 'checked';
                }
                else
                {
                    $chk = '';
                }
            ?>

            <input type="checkbox" value="check" name="term_meta[enable]" id="term_meta[enable]" <?php echo esc_attr( $chk ); ?>>
            
        </td>
    </tr>
   
    <?php
}

add_action('product_cat_edit_form_fields', 'masa_taxonomy_edit_meta_field', 10, 2);

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta($term_id) {
    $term_meta = array();
    if (isset($_POST['term_meta']) && !empty($_POST['term_meta'])) {
        $term_meta = get_option("enable_" . $term_id);
        $cat_keys = array_keys($_POST['term_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_meta'][$key])) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        // Save the option array.

        
    }
    if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
        $term_meta = [
            'enable' => 'check'
        ];
        update_option("enable_" . $term_id, $term_meta);
    }
    update_option("enable_" . $term_id, $term_meta);
}

add_action('edited_product_cat', 'save_taxonomy_custom_meta', 10, 2);
add_action('create_product_cat', 'save_taxonomy_custom_meta', 10, 2);

?>