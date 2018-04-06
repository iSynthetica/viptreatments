<?php
/**
 * Booking product add to cart
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! $product->is_purchasable() ) {
    return;
}

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<?php //var_dump($booking_form_ba); ?>
<?php
//$booking_form_ba->output();
?>

<noscript><?php _e( 'Your browser must support JavaScript in order to make a booking.', 'woocommerce-bookings-advanced' ); ?></noscript>

<form class="cart" method="post" enctype='multipart/form-data'>

    <div id="wc-bookings-booking-form" class="wc-bookings-booking-form" style="display:none">

        <?php do_action( 'woocommerce_before_booking_form' ); ?>

        <?php $booking_form_ba->output(); ?>

        <?php //var_dump($booking_form_ba); ?>

        <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

        <div class="wc-bookings-booking-cost" style="display:none"></div>

    </div>

    <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

    <button type="submit" class="wc-bookings-booking-form-button single_add_to_cart_button button alt disabled qodef-btn qodef-btn-large qodef-btn-solid" style="display:none"><?php echo $product->single_add_to_cart_text(); ?></button>

    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
