<?php

if ( ! defined( 'ABSPATH' ) )
    exit;

/**
 * Booking admin
 */
class BA_Admin {

    /**
     * Constructor
     */
    public function __construct()
    {
        add_filter('product_type_selector', array($this, 'product_type_selector_remove'));
        add_filter('product_type_selector', array($this, 'product_type_selector'));
        add_filter('woocommerce_product_data_tabs', array($this, 'hide_useless_data_panel'));
        add_filter('product_type_options', array($this, 'product_type_options'));

        add_action('woocommerce_product_options_general_product_data', array($this, 'add_parent_service_select_general_product_data'));
        add_action('woocommerce_process_product_meta', array($this, 'save_parent_service_id'));

        add_action('save_post', array($this, 'save_parent_regular_price'), 10, 3);
    }

    /**
     * Remove useless product types
     *
     * @param $types
     * @return mixed
     */
    public function product_type_selector_remove($types)
    {
        //unset($types['simple']);
        //unset($types['variable']);
        unset($types['grouped']);
        unset($types['external']);

        return $types;
    }

    /**
     * Add the parent service product type available to select
     *
     * @param $types
     * @return mixed
     */
    public function product_type_selector($types)
    {
        unset($types['booking']);

        $types['parent_service'] = __('Parent service', 'divi');
        $types['booking'] = __('Bookable service', 'divi');
        return $types;
    }

    /**
     * Managing product tabs in admin
     *
     * @param $tabs
     * @return mixed
     */

    public function hide_useless_data_panel($tabs)
    {
        // Other default values for 'attribute' are; general, inventory, shipping, linked_product, variations, advanced
        $tabs['attribute']['class'][] .= ' hide_if_parent_service hide_if_booking';

        return $tabs;
    }

    /**
     * Tweak product type options
     *
     * @param  array $options
     * @return array
     */
    public function product_type_options($options)
    {
        $options['virtual']['wrapper_class'] .= ' hide_if_booking';
        $options['wc_booking_has_persons']['wrapper_class'] .= ' hide_if_booking';
        $options['wc_booking_has_resources']['wrapper_class'] .= ' hide_if_booking';

        $options['virtual']['default'] = 'yes';

        return $options;
    }

    /**
     * Add a select parent product to bookable service
     */
    public function add_parent_service_select_general_product_data() {
        $bookable_products = array( '' => __( 'select parent service', 'woocommerce-bookings-advanced' ) );

        $query_args = array(
            'post_type' => 'product',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => 'parent_service',
                ),
            ),
        );

        $query = new WP_Query;
        $parent_products = $query->query($query_args);

        foreach ($parent_products as $parent_product) {
            $parent_product_id = $parent_product->ID;
            $bookable_products[$parent_product_id] = $parent_product->post_title;
        }

        echo '<div class="show_if_booking">';

        woocommerce_wp_select(
            array(
                'id' => 'parent_product_id',
                'class' => 'wc-select',
                'label' => __( 'Parent Service', 'woocommerce-bookings-advanced' ),
                'options' => $bookable_products,
                'description' => __( 'Select parent service from the list for your booking service product', 'woocommerce-bookings-advanced' ),
                'desc_tip'    => true
            )
        );

        echo '</div>';
    }

    /**
     * Save parent service ID
     */
    public function save_parent_service_id( $post_id ){
        $parent_product_id = $_POST['parent_product_id'];
//        if(!empty($parent_product_id)) {
//            update_post_meta($post_id, 'parent_product_id', esc_attr($parent_product_id));
//        }

        update_post_meta($post_id, 'parent_product_id', esc_attr($parent_product_id));
    }

    /**
     * Save minimal price for parent booking service
     *
     * @param $post_id
     * @param $post
     * @param $update
     */
    public function save_parent_regular_price($post_id, $post, $update)
    {
        if (isset($_REQUEST['_wc_booking_cost']) && isset($_REQUEST['parent_product_id'])) {
            $parent_price = get_post_meta($_REQUEST['parent_product_id'], '_price', true);

            if ($parent_price) {
                if ((int)$parent_price > $_REQUEST['_wc_booking_cost']) {
                    update_post_meta($_REQUEST['parent_product_id'], '_price', sanitize_text_field( $_REQUEST['_wc_booking_cost']));
                }
            } else {
                update_post_meta($_REQUEST['parent_product_id'], '_price', sanitize_text_field( $_REQUEST['_wc_booking_cost']));
            }
        }
    }
}

new BA_Admin();