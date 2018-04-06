<?php
/**
 * Functions used by plugins
 */
if ( ! class_exists( 'WC_BA_Dependencies' ) )
    require_once 'class-wc-ba-dependencies.php';

/**
 * WC Detection
 */
if ( ! function_exists( 'ba_is_woocommerce_active' ) ) {
    function ba_is_woocommerce_active() {
        return WC_BA_Dependencies::woocommerce_active_check();
    }
}

/**
 * WC Bookings Detection
 */
if ( ! function_exists( 'ba_is_woo_bookings_active' ) ) {
    function ba_is_woo_bookings_active() {
        return WC_BA_Dependencies::woocommerce_active_check();
    }
}

/**
 * WC Product Vendors Detection
 */
if ( ! function_exists( 'ba_is_woo_product_vendors_active' ) ) {
    function ba_is_woo_product_vendors_active() {
        return WC_BA_Dependencies::woocommerce_active_check();
    }
}