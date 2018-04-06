<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 09.08.2016
 * Time: 22:13
 */

class BA_Templates_Functions
{
    /**
     * BA_Templates_Functions constructor.
     */
    public function __construct()
    {
        $this->add_hooks();
        add_action('init', array($this, 'display_sold_by'));
        add_action('init', array($this, 'display_price'));
        add_action('init', array($this, 'display_add_to_cart'));
        add_action('init', array($this, 'display_single_parent_link'));
        add_action('init', array($this, 'display_single_meta'));
        add_action('init', array($this, 'display_after_title_single_meta'));
        add_action('init', array($this, 'display_title_single'));
    }

    /**
     * Display title single settings
     */
    public function display_title_single()
    {
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
        add_action( 'woocommerce_single_product_summary', array($this, 'add_template_single_title'), 5 );
    }

    public function add_template_single_title()
    {
        wc_get_template('single-product/title.php', array(), 'woo-bookings-advanced', BA_TEMPLATE_PATH);
    }

    /**
     * Display after title single meta settings
     */
    public function display_after_title_single_meta()
    {
        add_action('woocommerce_single_product_summary', array($this, 'add_after_title_single_meta'), 15);
    }

    public function add_after_title_single_meta()
    {
        wc_get_template('single-product/after-title-meta.php', array(), 'woo-bookings-advanced', BA_TEMPLATE_PATH);
    }
    
    /**
     * Display single meta settings
     */
    public function display_single_meta()
    {
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
        add_action('woocommerce_single_product_summary', array($this, 'add_single_meta'), 35);
    }
    
    public function add_single_meta()
    {
        global $post;
        wc_get_template('single-product/meta.php', array(), 'woo-bookings-advanced', BA_TEMPLATE_PATH);
    }

    private function add_hooks()
    {
        add_action('woocommerce_after_single_product_summary', array($this, 'display_child_bookings_services_single'), 12);
    }

    /*
     * Display child services as price list accordeon
     */
    public function display_child_bookings_services_single()
    {
        $id = get_the_ID();
        if('parent_service' == BA_Lib::get_product_type($id)) {
            if ($child_products = BA_Lib::get_child_products($id)) {
                wc_get_template('single-product/child-bookings.php', array('child_products' =>  $child_products), 'woo-bookings-advanced', BA_TEMPLATE_PATH);
            }
        }
    }

    /**
     * Display parent link on booking child product page
     */
    public function display_single_parent_link()
    {
        global $post;
        $settings = BA_Settings()->get_settings();

        if($settings['display_single_parent_link']) {
            add_action( 'woocommerce_product_after_title_meta_start', array( $this, 'add_single_parent_link' ), 10 );
        }
    }
    
    public function add_single_parent_link()
    {
        global $post;

        wc_get_template('single-product/parent-link.php', array('product' => $post), 'woo-bookings-advanced', BA_TEMPLATE_PATH);
    }

    /**
     * Display add to cart settings
     */
    public function display_add_to_cart()
    {
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        $single_add_to_cart_position = BA_Settings()->get_settings()['position_add_to_cart'];
        add_action('woocommerce_single_product_summary', array($this, 'woocommerce_template_single_add_to_cart'), $single_add_to_cart_position);
        add_action('woocommerce_parent_service_add_to_cart', array($this, 'woocommerce_parent_service_add_to_cart'));
    }

    /**
     * Trigger the single product add to cart action.
     */
    function woocommerce_template_single_add_to_cart() {
        global $product;
        do_action( 'woocommerce_' . $product->product_type . '_add_to_cart' );
    }

    /**
     * Output the parent_service product add to cart area.
     */
    function woocommerce_parent_service_add_to_cart() {
        wc_get_template('single-product/add-to-cart/parent-service.php', array(), 'woo-bookings-advanced', BA_TEMPLATE_PATH);
    }

    /**
     * Display price settings
     */
    public function display_price()
    {
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        add_action('woocommerce_single_product_summary', array($this, 'woocommerce_template_single_price'), 10);

        remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
        add_action('woocommerce_after_shop_loop_item_title', array($this, 'woocommerce_template_loop_price'), 10);
    }

    /**
     * Output the product price.
     */
    public function woocommerce_template_single_price()
    {
        wc_get_template('single-product/price.php', array(), 'woocommerce', BA_TEMPLATE_PATH);
    }

    public function woocommerce_template_loop_price()
    {
        wc_get_template('loop/price.php', array(), 'woocommerce', BA_TEMPLATE_PATH);
    }

    /**
     * Display sold by settings
     */
    public function display_sold_by()
    {
        // Remove plugins actions
        BA_Utils::remove_filters_for_anonymous_class('woocommerce_single_product_summary', 'WC_Product_Vendors_Vendor_Frontend', 'add_sold_by_single', 39);
        BA_Utils::remove_filters_for_anonymous_class('woocommerce_after_shop_loop_item', 'WC_Product_Vendors_Vendor_Frontend', 'add_sold_by_loop', 9);
        BA_Utils::remove_filters_for_anonymous_class('woocommerce_get_item_data', 'WC_Product_Vendors_Vendor_Frontend', 'add_sold_by_cart', 10);
        BA_Utils::remove_filters_for_anonymous_class('woocommerce_order_item_meta_end', 'WC_Product_Vendors_Vendor_Frontend', 'add_sold_by_order_details', 10);

        // Add custom actions
        $settings = BA_Settings()->get_settings();

        if($settings['display_sold_by_general']) {
            if($settings['display_sold_by_loop']) {
                add_action( 'woocommerce_after_shop_loop_item', array( $this, 'add_sold_by_loop' ), 9 );
            }

            if($settings['display_sold_by_single']) {
                add_action( 'woocommerce_product_after_title_meta_start', array( $this, 'add_sold_by_single' ), 10 );
            }

            if($settings['display_sold_by_cart']) {
                add_filter( 'woocommerce_get_item_data', array( $this, 'add_sold_by_cart' ), 10, 2 );
            }

            if($settings['display_sold_by_order_details']) {
                add_action( 'woocommerce_order_item_meta_end', array( $this, 'add_sold_by_order_details' ), 10, 3 );
            }
        }
    }

    /**
     * Add sold by vendor to product archive pages
     */
    public function add_sold_by_loop() {
        global $post;

        $sold_by = WC_Product_Vendors_Utils::get_sold_by_link( $post->ID );
        wc_get_template('sold-by/sold-by-loop.php', array('sold_by' =>  $sold_by), 'woo-bookings-advanced', BA_TEMPLATE_PATH);

        return true;
    }

    /**
     * Add sold by vendor to product single pages
     */
    public function add_sold_by_single() {
        global $post;

        if ('booking' == BA_Lib::get_product_type($post->ID)) {
            $sold_by = WC_Product_Vendors_Utils::get_sold_by_link( $post->ID );
            wc_get_template('sold-by/sold-by-single.php', array('sold_by' =>  $sold_by, 'post' => $post), 'woo-bookings-advanced', BA_TEMPLATE_PATH);
        }

        return true;
    }

    /**
     * Add sold by vendor to cart page
     */
    public function add_sold_by_cart( $values, $cart_item ) {

        if ('booking' == BA_Lib::get_product_type($cart_item['data']->id)) {
            $sold_by = WC_Product_Vendors_Utils::get_sold_by_link( $cart_item['data']->id );

            ob_start();
            wc_get_template('sold-by/sold-by-cart.php', array('sold_by' =>  $sold_by), 'woo-bookings-advanced', BA_TEMPLATE_PATH);
            $display = ob_get_contents();
            ob_end_clean();

            $values[] = array(
                'name' => apply_filters( 'wcpv_sold_by_text', esc_html__( 'Sold By', 'woocommerce-product-vendors' ) ),
                'display' => $display,
            );
        }

        return $values;
    }

    /**
     * Add sold by vendor to all order details
     */
    public function add_sold_by_order_details( $item_id, $item, $order ) {

        if ('booking' == BA_Lib::get_product_type($item['product_id'])) {
            $sold_by = WC_Product_Vendors_Utils::get_sold_by_link( $item['product_id'] );
            wc_get_template('sold-by/sold-by-order-details.php', array('sold_by' =>  $sold_by), 'woo-bookings-advanced', BA_TEMPLATE_PATH);
        }
        return true;
    }
}

new BA_Templates_Functions;