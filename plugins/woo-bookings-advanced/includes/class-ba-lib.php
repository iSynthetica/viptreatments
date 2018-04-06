<?php

class BA_Lib
{
    /**
     * Get Product type
     *
     * Product types:
     *  - parent_service
     *  - booking
     *
     * @param $id
     * @return string
     */
    public static function get_product_type($id)
    {
        if (!$product = wc_get_product($id)) {
            return false;
        }
        return $product->product_type;
    }

    /**
     * Check if product type Booking
     * @param $id
     * @return bool
     */
    public static function is_booking($id)
    {
        if ('booking' == BA_Lib::get_product_type($id)) {
            return true;
        }
        return false;
    }

    /**
     * Check if product type Booking
     * @param $id
     * @return bool
     */
    public static function is_parent($id)
    {
        if ('parent_service' == BA_Lib::get_product_type($id)) {
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public static function count_child_products($id)
    {
        if ('parent_service' != BA_Lib::get_product_type($id)) {
            return false;
        }
    }

    /**
     * @param $id
     * @return array
     */
    public static function get_child_products($id)
    {
        if ('parent_service' != BA_Lib::get_product_type($id)) {
            return false;
        }
        
        $query_args = array(
            'post_type' => 'product',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => 'booking',
                ),
            ),
            'meta_query' => array(
                array(
                    'key' => 'parent_product_id',
                    'value' => $id
                ),
            )
        );

        $query = new WP_Query;

        $child_products = $query->query($query_args);

        if (count($child_products) == 0) {
            return false;
        }
        
        return $child_products;
    }

    /**
     * Get Parent product
     *
     * @param $id
     * @return bool
     */
    public static function get_parent_product($id)
    {
        if ('booking' != BA_Lib::get_product_type($id)) {
            return false;
        }

        $parent_id = get_post_meta($id, 'parent_product_id', true);

        if (!$parent_id) {
            return false;
        }

        $parent_product = wc_get_product($parent_id);
//
//        if (!$parent_product) {
//            return false;
//        }

        return $parent_product;
    }
}