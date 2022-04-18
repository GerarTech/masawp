<?php
class masa_Api
{
    private $plugin_name, $version;
    public function __construct()
    {
        $this->plugin_name = 'masa-api';
        $this->version = '1.0';
        $this->load_dependancies();
        $this->set_locale();
        add_action( 'admin_notices', [ $this , 'check_plugin_active'] );
    }

    private function load_dependancies()
    {

        require_once MASA_API_DIR . 'includes/api/helperfunction/helperfunction.php';


        require_once MASA_API_DIR . 'includes/api/v1/class.masa.api.authentication.php';
        require_once MASA_API_DIR . 'includes/db/class.masa.db.php';
        require_once MASA_API_DIR . 'includes/api/v1/class.masa.api.wishlist.route.php';
        require_once MASA_API_DIR . 'includes/class-masa-api-i18n.php';
        require_once MASA_API_DIR . 'includes/api/v1/class.masa.api.cart.route.php';
        require_once MASA_API_DIR . 'includes/api/v1/class.masa.api.slider.route.php';
        require_once MASA_API_DIR . 'includes/api/v1/class.masa.api.woocommerce.route.php';
        require_once MASA_API_DIR . 'includes/api/v1/class.masa.api.customer.route.php';
        

       // require_once MASA_API_DIR . 'includes/api/v1/class.masa.api.payment.route.php';

       
        require_once MASA_API_DIR . 'includes/ajax/class.masa.request_ajax.php';
        
        require_once MASA_API_DIR . 'includes/notification/class.sendnotification.php';

        require_once MASA_API_DIR . 'includes/custom-filed_wc/masa_custom_filed_wc.php';
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the masa_Api_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     */
    private function set_locale()
    {
        // $plugin_i18n = new masa_Api_i18n();
        // $plugin_i18n->set_domain($this->get_plugin_name());
        // add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
        
    }

    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    public function check_plugin_active()
    {
        if (!function_exists('get_plugins')) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
	
		$plugins = get_plugins();
		foreach ($plugins as $key => $value) {
			if($value['TextDomain'] === 'jwt-auth') {
                if(is_plugin_active($key) === false){
                    $message = __( 'Warning: <b> <i> JWT Authentication for WP-API </i></b> is Inactive.', 'kc-lang' );
                    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( 'notice notice-warning' ), $message );
                }
			}
            if($value['TextDomain'] === 'redux-framework') {
				if(is_plugin_active($key) === false){
                    $message = __( 'Warning: <b> <i> Redux – Gutenberg Blocks Library & Framework </i></b> is Inactive.', 'kc-lang' );
                    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( 'notice notice-warning' ), $message );
                }
            }
		}

        $jwt_plugin = array_search('jwt-auth', array_column($plugins, 'TextDomain'));

        if(empty($jwt_plugin)){
            $message = __( 'Warning: <b> Install<i> JWT Authentication for WP-API </i></b>.', 'kc-lang' );
            printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( 'notice notice-warning' ), $message );
        }

        $redux_plugin = array_search('redux-framework', array_column($plugins, 'TextDomain'));
        if(empty($redux_plugin)){
            $message = __( 'Warning: <b> Install<i> Redux – Gutenberg Blocks Library & Framework </i></b>.', 'kc-lang' );
            printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( 'notice notice-warning' ), $message );
        }
    }
}
?>