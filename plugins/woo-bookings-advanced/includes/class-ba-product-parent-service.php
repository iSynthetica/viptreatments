<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class for the booking product type
 */
class WC_Product_Parent_Service extends WC_Product {
    /**
     * Constructor
     */
    public function __construct( $product ) {
        if ( empty ( $this->product_type ) ) {
            $this->product_type = 'parent_service';
        }

        parent::__construct( $product );
    }

}