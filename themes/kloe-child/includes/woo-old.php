<?php

add_action('init', 'remove_parent_woo_hooks', 1000);

function remove_parent_woo_hooks()
{
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 60);
    remove_action('woocommerce_single_product_summary', 'kloe_qodef_woocommerce_template_single_title', 5);
}

// Hook in
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );

// Our hooked in function - $address_fields is passed via the filter!
function custom_override_default_address_fields( $address_fields ) {
    $address_fields['country']['required'] = false;
    $address_fields['first_name']['required'] = false;
    $address_fields['last_name']['required'] = false;
    $address_fields['company']['required'] = false;
    $address_fields['address_1']['required'] = false;
    $address_fields['address_2']['required'] = false;
    $address_fields['city']['required'] = false;
    $address_fields['state']['required'] = false;
    $address_fields['postcode']['required'] = false;

    return $address_fields;
}
// Hook in
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
    $fields['billing']['billing_email']['required'] = false;
    $fields['billing']['billing_phone']['required'] = false;
    $fields['billing']['billing_country']['class'] = array('form-row-first');
    $fields['billing']['billing_address_1']['class'] = array('form-row-last');
    $fields['billing']['billing_address_2']['class'] = array('form-row-first');
    $fields['billing']['billing_address_2']['placeholder'] = _x('Apartment, suite, unit etc.', 'placeholder', 'kloe');
    $fields['billing']['billing_city']['class'] = array('form-row-last');
    $fields['billing']['billing_city']['placeholder'] = _x('City', 'placeholder', 'kloe');

    return $fields;
}

/**
 * Change "Billing Details" title text
 */
add_filter('vip_billing_details_text', 'vip_billing_details_text');

function vip_billing_details_text($title)
{
    $title = __( 'Regular Checkout Details', 'kloe' );
    return $title;
}

/**
 * Add the field to the checkout
 */
add_action( 'woocommerce_before_order_notes', 'my_custom_checkout_field' );

function my_custom_checkout_field( $checkout )
{
    echo '<div id="my_custom_checkout_field"><h3>' . __('Hotel Guest Checkout Details *', 'kloe') . '</h3>';

    woocommerce_form_field( 'hotel_title', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Fill in this field'),
        'placeholder'   => __('Enter your hotel title'),
    ), $checkout->get_value( 'hotel_title' ));

    woocommerce_form_field( 'guest_name', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Fill in this field'),
        'placeholder'   => __('Enter your guest name'),
    ), $checkout->get_value( 'guest_name' ));

    woocommerce_form_field( 'guest_room', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Fill in this field'),
        'placeholder'   => __('Enter your guest room number'),
    ), $checkout->get_value( 'guest_room' ));

    echo '<p><strong>*</strong> <small>Fill in this fields if you are making booking for guest of your hotel.</small></p>';

    echo '</div>';

}

/**
 * Add select payment type field
 */

function kloe_is_cart_booking() {

    $cart_content = WC()->cart->get_cart();

    foreach ($cart_content as $product) {
        if ($product['booking']) {
            return true;
        };
    }
    return false;
}

add_action('woocommerce_checkout_after_customer_details', 'my_select_payment_type_field');

function my_select_payment_type_field($checkout)
{
    if (!kloe_is_cart_booking()) {
        return;
    }

    $payment_array = array(
        'cash' => __('Cash', 'kloe'),
        'bacs' => __('Book on your room', 'kloe'),
        'creditcard' => __('Credit card', 'kloe')
    );

    echo '<div id="my_custom_checkout_field"><h3>' . __('Which type of payment do you prefer', 'kloe') . '</h3>';

    woocommerce_form_field( 'payment_type', array(
        'type'          => 'select',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Which type of payment do you prefer', 'kloe'),
        'options'       => $payment_array
    ), $checkout->get_value( 'payment_type' ));

    echo '</div>';
}

/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['hotel_title'] ) ) {
        update_post_meta( $order_id, 'Hotel title', sanitize_text_field( $_POST['hotel_title'] ) );
    }

    if ( ! empty( $_POST['guest_name'] ) ) {
        update_post_meta( $order_id, 'Guest name', sanitize_text_field( $_POST['guest_name'] ) );
    }

    if ( ! empty( $_POST['guest_room'] ) ) {
        update_post_meta( $order_id, 'Guest room', sanitize_text_field( $_POST['guest_room'] ) );
    }

    if ( ! empty( $_POST['payment_type'] ) ) {
        $payment_type = $_POST['payment_type'];
        switch($payment_type) {
            case 'cash':
                $save_payment_type = __('Cash', 'kloe');
                break;
            case 'bacs':
                $save_payment_type = __('Book on your room', 'kloe');
                break;
            case 'creditcard':
                $save_payment_type = __('Credit card', 'kloe');
                break;
        }
        update_post_meta( $order_id, 'Payment type', sanitize_text_field($save_payment_type) );
    }
}

/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Hotel title').':</strong> ' . get_post_meta( $order->id, 'Hotel title', true ) . '</p>';
    echo '<p><strong>'.__('Guest name').':</strong> ' . get_post_meta( $order->id, 'Guest name', true ) . '</p>';
    echo '<p><strong>'.__('Guest room number').':</strong> ' . get_post_meta( $order->id, 'Guest room', true ) . '</p>';
    echo '<p><strong>'.__('Preffered payment type').':</strong> ' . get_post_meta( $order->id, 'Payment type', true ) . '</p>';
}

/* To use: 
1. Add this snippet to your theme's functions.php file
2. Change the meta key names in the snippet
3. Create a custom field in the order post - e.g. key = "Tracking Code" value = abcdefg
4. When next updating the status, or during any other event which emails the user, they will see this field in their email
*/
add_filter('woocommerce_email_order_meta_keys', 'my_custom_order_meta_keys');
function my_custom_order_meta_keys( $keys ) {
    $keys[] = 'Hotel title';
    $keys[] = 'Guest name';
    $keys[] = 'Guest room';
    $keys[] = 'Payment type';
    return $keys;
}