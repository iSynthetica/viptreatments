<?php

class BA_Core
{
    /**
     * The single instance of the class.
     *
     * @var BA_Core
     */
    protected static $_instance = null;

    /**
     * Main BA_Core Instance.
     *
     * @return BA_Core - Main instance.
     */
    public static function instance()
    {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * BA_Core Constructor.
     * @since 0.0.1
     */
    private function __construct()
    {
        $this->add_hooks();
    }

    /**
     * Add hooks
     */
    public function add_hooks()
    {
        add_action('pre_get_posts', array($this, 'pre_get_products'));
        add_action('init', array($this, 'register_vendor_custom_fields'));

        add_action('woocommerce_checkout_order_processed', array($this, 'send_sms_to_vendor'));
    }

    /**
     * Filter products in loop
     */
    public function pre_get_products($query)
    {
        if(!is_admin()) {
            if ((is_shop() || is_product_category() || is_product_tag()) && $query->is_main_query()) {
                $meta_query = $query->get('meta_query');
                $meta_query[] = array(
                    'relation' => 'OR',
                    array(
                        'key'=>'parent_product_id',
                        'compare'=>'NOT EXISTS',
                    ),
                    array(
                        'key'=>'parent_product_id',
                        'value' => ''
                    )
                );
                $query->set('meta_query',$meta_query);
            }
        }
    }

    /**
     * Adding vendor custom fields
     */
    public function register_vendor_custom_fields()
    {
        add_action(WC_PRODUCT_VENDORS_TAXONOMY . '_add_form_fields', array($this, 'add_vendor_custom_fields'));
        add_action(WC_PRODUCT_VENDORS_TAXONOMY . '_edit_form_fields', array($this, 'edit_vendor_custom_fields'), 10);
        add_action('edited_' . WC_PRODUCT_VENDORS_TAXONOMY, array($this, 'save_vendor_custom_fields'));
        add_action('created_' . WC_PRODUCT_VENDORS_TAXONOMY, array($this, 'save_vendor_custom_fields'));
        add_action('wcpv_shortcode_registration_form_process', array($this, 'vendors_reg_custom_fields_save'), 10, 2 );

        // add_action('wcpv_shortcode_registration_form_validation', array($this, 'vendors_reg_custom_fields_validation'), 10, 2 );
    }

    /**
     * Add term fields form
     */
    public function add_vendor_custom_fields()
    {
        wp_nonce_field( basename( __FILE__ ), 'vendor_custom_fields_nonce' );
        ?>
        <div class="form-field">
            <label for="phone"><?php _e( 'Phone', 'woocommerce-bookings-advanced' ); ?></label>
            <input type="tel" name="vendor-phone" id="phone" value="" />
        </div>
        <?php
    }

    /**
     * Edit term fields form
     */
    public function edit_vendor_custom_fields($term) {
        wp_nonce_field( basename( __FILE__ ), 'vendor_custom_fields_nonce' );
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="vendor-phone"><?php _e( 'Phone', 'woocommerce-bookings-advanced' ); ?></label></th>
            <td>
                <input type="tel" name="vendor-phone" id="phone" value="<?php echo get_term_meta( $term->term_id, 'vendor-phone', true ); ?>" />
            </td>
        </tr>
        <?php
    }

    /**
     * Save term fields
     */
    public function save_vendor_custom_fields($term_id) {
        if ( ! wp_verify_nonce( $_POST['vendor_custom_fields_nonce'], basename( __FILE__ ) ) ) {
            return;
        }
        $old_phone = get_term_meta( $term_id, 'vendor-phone', true );
        $new_phone = $_POST['vendor-phone'];

        if ( ! empty( $old_phone ) && $new_phone === '' ) {
            delete_term_meta( $term_id, 'vendor-phone' );
        } else if ( $old_phone !== $new_phone ) {
            update_term_meta( $term_id, 'vendor-phone', $new_phone, $old_phone );
        }
    }

    /**
     * Save custom fields from registartion form
     * @param $args
     * @param $items
     */
    public function vendors_reg_custom_fields_save( $args, $items ) {
        $term = get_term_by( 'name', $items['vendor_name'], WC_PRODUCT_VENDORS_TAXONOMY );
        
        if ( isset( $items['vendor-phone'] ) && ! empty( $items['vendor-phone'] ) ) {
            $phone = $items['vendor-phone'];
            update_term_meta( $term->term_id, 'vendor-phone', $phone );
        }
    }

    //TODO Add phone number validation
    public function vendors_reg_custom_fields_validation($errors, $form_items)
    {
        if (empty( $form_items['vendor-phone'])) {
            $errors[] = __( 'Phone number is a required field.', 'woocommerce-bookings-advanced' );
        }
    }

    public function send_sms_to_vendor($order_id)
    {
        $order = new WC_Order($order_id);

        $order_items = $order->get_items();

        $vendors = WC_Product_Vendors_Utils::get_vendors_from_order($order);

        foreach ($vendors as $key => $vendor) {
            $vendor_phone = get_term_meta($key, 'vendor-phone', true) ? get_term_meta($key, 'vendor-phone', true) : false;

            if ($vendor_phone) {
                $vendor_bookings = array();

                foreach ($order_items as $order_item) {
                    $product_id = $order_item['product_id'];
                    $booking_vendor_id = WC_Product_Vendors_Utils::get_vendor_id_from_product($product_id);
                    if ($booking_vendor_id == $key) {
                        $vendor_bookings[] = $booking_id = $order_item['Booking ID'];
                    }
                }

                $bookings_str = implode(', ', $vendor_bookings);
                $body_msg = 'You have new ';
                $body_msg .= (count($vendor_bookings) > 1) ? 'bookings: ' : 'booking: ';
                $body_msg .= $bookings_str . '.';

                // send SMS
                $smsService = new BA_Sms();
                $smsService->sendSms($vendor_phone, $body_msg);
            }
        }
    }

}

/**
 * Main instance of BA_Core.
 * @return BA_Core
 */
function BA_Core() {
    return BA_Core::instance();
}

// Global for backwards compatibility.
$GLOBALS['ba_core'] = BA_Core();