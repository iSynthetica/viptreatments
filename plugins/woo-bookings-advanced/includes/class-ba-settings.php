<?php

class BA_Settings
{
    /**
     * The single instance of the class.
     *
     * @var BA_Settings
     */
    protected static $_instance = null;

    /**
     * Settings of BA Plugin
     * @var array
     */
    protected static $_settings = array();

    /**
     * Main BA_Settings Instance.
     *
     * Ensures only one instance of WooCommerce is loaded or can be loaded.
     *
     * @since 0.0.1
     * @static
     * @return BA_Settings - Main instance.
     */
    public static function instance()
    {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * BA_Settings Constructor.
     * @since 0.0.1
     */
    private function __construct()
    {
        $this->set_default_settings();
    }
    
    public function set_settings()
    {
        
    }

    /**
     * Set default plugin settings
     */
    private function set_default_settings()
    {
        // General settings
        self::$_settings['general'] = array (
            'admin_emails' => 'syntheticafreon@gmail.com'
        );

        // Specialist registartion
        self::$_settings['register_form_display_title'] = false;
        self::$_settings['register_form_display_before_form_text'] = false;
        self::$_settings['register_form_display_labels'] = false;
        
        // Child products
        self::$_settings['child_display_sold_by'] = false;
        self::$_settings['child_display_title'] = true;
        self::$_settings['child_display_short_desc'] = true;
        self::$_settings['child_display_full_desc'] = false;
        self::$_settings['child_display_read_more'] = true;
        
        // Single product
        self::$_settings['display_single_parent_link'] = true;

        // Sold By
        self::$_settings['display_sold_by_general'] = true;
        self::$_settings['display_sold_by_loop'] = false;
        self::$_settings['display_sold_by_single'] = true;
        self::$_settings['display_sold_by_cart'] = true;
        self::$_settings['display_sold_by_order_details'] = true;
        
        // Add to cart options
        self::$_settings['position_add_to_cart'] = 40;

        // Send SMS
        self::$_settings['sms'] = array(
            'sendSms' => true,
            'AccountSid' => 'AC760d28176cb3e196f79e6b55590398e3',
            'AuthToken' => '29f1ecdc27c1ccb53106a24d3501ed98',
            'from' => 'VIPTreat'
        );
    }
    
    public function get_settings()
    {
        return self::$_settings;
    }

}

/**
 * Main instance of BA_Settings.
 *
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @since  2.1
 * @return BA_Settings
 */
function BA_Settings() {
    return BA_Settings::instance();
}

// Global for backwards compatibility.
$GLOBALS['ba_settings'] = BA_Settings();

