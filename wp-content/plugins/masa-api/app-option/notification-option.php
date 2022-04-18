<?php
/*
 * notification Options
 */
$app_opt_name;
Redux::setSection( $app_opt_name, array(
    'title' => esc_html__( 'Notification', 'woobox' ),
    'id'    => 'notification',
    'icon'  => 'el el-bell',
    'subsection' => false,
    'desc'  => esc_html__( '', 'woobox' ),
    'fields'           => array(
        
        array(
            'id'       => 'masa_notification_switch',
            'type'     => 'button_set',
            'title'    => __('Enable Notification', 'woobox'),
            
            'desc'     => __('Choose this option for Enable/Disable Push Notification', 'woobox'),
            //Must provide key => value pairs for options
            'options' => array(
                '1' => 'Enable', 
                '0' => 'Disable',                 
             ), 
            'default' => '1'
            ),
            array(
                'id'       => 'one_app_id',
                'type'     => 'text',
                'title'    => __('One Signal App ID', 'woobox'),                
                'desc'     => __('<p>Enter Your <strong>One Signal App ID</strong></p><br>
                                    <p>
                                        Get Your App ID <a href="'.esc_url('https://www.onesignal.com/').'" target="_blank">Click Here</a>
                                    </p>', 'woobox'),
                'required' => array('masa_notification_switch', '=' , '1')
                
            ),

            array(
                'id'       => 'one_rest_api_key',
                'type'     => 'text',
                'title'    => __('One Signal REST API KEY', 'woobox'),                
                'desc'     => __('<p>Enter Your <strong>One Signal REST API KEY</strong></p><br>
                                    <p>
                                        Get Your REST API KEY  <a href="'.esc_url('https://www.onesignal.com/').'" target="_blank">Click Here</a>
                                    </p>', 'woobox'),
                'required' => array('masa_notification_switch', '=' , '1')
                
            ),

          
    )
    
) );