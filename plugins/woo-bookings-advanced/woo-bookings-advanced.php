<?php
/*
Plugin Name: WooCommerce Bookings Advanced
Plugin URI:
Description: Setup bookable products such as for reservations, services and hires.
Version: 1.0.0
Author: Synthetica
Author URI:
Text Domain: woocommerce-bookings-advanced
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Required functions
 */
if (! function_exists( 'ba_is_woocommerce_active')) {
    require_once('woo-includes/woo-ba-functions.php');
}

if (ba_is_woocommerce_active() && ba_is_woo_bookings_active()) {
    /**
     * WC Bookings Advanced class
     */
    class BA_Bookings_Advanced
    {
        public function __construct()
        {
            define('BA_VERSION', '1.0.0');
            define('BA_MAIN_FILE', __FILE__);
            define('BA_TEMPLATE_PATH', untrailingslashit(plugin_dir_path(__FILE__)) . '/templates/');
            define('BA_INCLUDES_PATH', untrailingslashit(plugin_dir_path(__FILE__)) . '/includes');
            define('BA_PLUGIN_URL', untrailingslashit(plugins_url(basename(plugin_dir_path(__FILE__)), basename(__FILE__))));
            define('BA_PLUGIN_ASSETS', BA_PLUGIN_URL . '/assets');
            define('BA_PLUGIN_CSS', BA_PLUGIN_ASSETS . '/css');
            define('BA_PLUGIN_JS', BA_PLUGIN_ASSETS . '/js');
            define('BA_PLUGIN_IMG', BA_PLUGIN_ASSETS . '/img');
            define('BA_PLUGIN_VENDORS', BA_PLUGIN_ASSETS . '/vendors');

            add_action('init', array($this, 'load_plugin_textdomain'));
            add_action('woocommerce_loaded', array($this, 'includes'));
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

            if ( is_admin() ) {
                $this->admin_includes();
            }
        }

        /**
         * Localisation
         */
        public function load_plugin_textdomain()
        {
            $locale = apply_filters('plugin_locale', get_locale(), 'woocommerce-bookings-advanced');
            $dir = trailingslashit(WP_LANG_DIR);

            load_textdomain('woocommerce-bookings-advanced', $dir . 'woocommerce-bookings-advanced/woocommerce-bookings-advanced-' . $locale . '.mo');
            load_plugin_textdomain('woocommerce-bookings-advanced', false, dirname(plugin_basename(__FILE__)) . '/languages/');
        }

        /**
         * Load Classes
         */
        public function includes()
        {
            // Useful functions library
            include('includes/class-ba-core.php');
            include('includes/class-ba-lib.php');
            include('includes/class-ba-utils.php');
            include('includes/class-ba-settings.php');
            include('includes/class-ba-sms.php');
            include('includes/widgets/class-ba-vendor-widget.php');
            include('includes/class-ba-widgets.php');
            include('includes/class-ba-templates-functions.php');
            include('includes/booking-form/class-ba-booking-form.php');

            // Products
            include('includes/class-ba-product-parent-service.php');
        }

        /**
         * Include admin
         */
        public function admin_includes() {
            include( 'includes/admin/class-ba-admin.php' );
        }

        /**
         * Frontend booking form scripts
         */
        public function enqueue_scripts() {
            wp_register_script('main', BA_PLUGIN_JS . '/main.js', array('jquery'), BA_VERSION, true);
            wp_enqueue_script('main');

            wp_register_script('star-rating', BA_PLUGIN_VENDORS . '/bootstrap-star-rating-master/bootstrap-star-rating.js', array('jquery'), BA_VERSION, true);
            wp_enqueue_script('star-rating');

            wp_localize_script( 'main', 'booking', array(
                'ajax_url' => admin_url('admin-ajax.php')
            ));

            wp_register_style('font-awesome', BA_PLUGIN_VENDORS . '/font-awesome/css/font-awesome.min.css');
            wp_enqueue_style('font-awesome');

            wp_register_style('glyph', BA_PLUGIN_VENDORS . '/bootstrap/css/bootstrap.css');
            wp_enqueue_style('glyph');
        }
    }

    $GLOBALS['ba_bookings'] = new BA_Bookings_Advanced();
}