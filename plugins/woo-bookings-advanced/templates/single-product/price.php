<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

$before_price_text = '';
$after_price_text = '';

if (BA_Lib::is_booking($product->id)) {
    $after = BA_Utils::booking_period_units_to_short($product->wc_booking_duration_unit);
    $after_price_text = ' / <span class="duration"><i class="fa fa-clock-o"></i> ' . $product->wc_booking_duration . ' ' . $after . '</span>';
}

if (BA_Lib::is_parent($product->id)) {
    $before_price_text = apply_filters('pre_template_single_price', __('From: ', 'woocommerce-bookings-advanced'));
}

// var_dump($product);

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

    <p class="price"><?= $before_price_text ?><?php echo $product->get_price_html(); ?><?= $after_price_text ?></p>

    <meta itemprop="price" content="<?php echo esc_attr( $product->get_display_price() ); ?>" />
    <meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
    <link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>
