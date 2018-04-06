<?php

class BA_Utils 
{
    /**
     * @param string $hook_name
     * @param string $class_name
     * @param string $method_name
     * @param int $priority
     * @return bool
     */
    public static function remove_filters_for_anonymous_class( $hook_name = '', $class_name ='', $method_name = '', $priority = 0 ) {
        global $wp_filter;

        // Take only filters on right hook name and priority
        if ( !isset($wp_filter[$hook_name][$priority]) || !is_array($wp_filter[$hook_name][$priority]) )
            return false;

        // Loop on filters registered
        foreach( (array) $wp_filter[$hook_name][$priority] as $unique_id => $filter_array ) {
            // Test if filter is an array ! (always for class/method)
            if ( isset($filter_array['function']) && is_array($filter_array['function']) ) {
                // Test if object is a class, class and method is equal to param !
                if ( is_object($filter_array['function'][0]) && get_class($filter_array['function'][0]) && get_class($filter_array['function'][0]) == $class_name && $filter_array['function'][1] == $method_name ) {
                    unset($wp_filter[$hook_name][$priority][$unique_id]);
                }
            }

        }
        return false;
    }
    
    /**
     * Get human period units
     *
     * @param $unit
     * @return string|void
     */
    public static function booking_period_units_to_short($unit)
    {
        switch ($unit) {
            case 'month' :
                $after = __( 'month(s)', 'divi' );
                break;
            case 'week' :
                $after = __( 'week(s)', 'divi' );
                break;
            case 'day' :
                if ( $product_obj->wc_booking_duration % 7 ) {
                    $after = __( 'day(s)', 'divi' );
                } else {
                    $after = __( 'week(s)', 'divi' );
                }
                break;
            case 'night' :
                $after = __( 'nights(s)', 'divi' );
                break;
            case 'hour' :
                $after = __( 'h', 'divi' );
                break;
            case 'minute' :
                $after = __( 'min', 'divi' );
                break;
        }

        return $after;
    }
}