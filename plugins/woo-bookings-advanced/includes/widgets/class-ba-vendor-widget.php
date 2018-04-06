<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Vendors Widget.
 *
 * Displays vendor context widget.
 *
 * @category Widgets
 * @package  WooCommerce Product Vendors/Widgets/Widget
 * @version  2.0.0
 * @extends  WP_Widget
 */
class BA_Product_Vendor_Widget extends WP_Widget {
    public function __construct() {

        // Instantiate the parent object
        parent::__construct(
            'ba_vendor_widget',
            __( 'BA Vendors Advanced', 'woocommerce-bookings-advanced' ),
            array( 'description' => __( 'Adavanced widget to display vendor information in context.', 'woocommerce-bookings-advanced' ) )
        );
    }

    public function widget( $args, $instance ) {
        global $post;

        $display_widget = false;
        if (is_product_taxonomy()) {
            $term = get_queried_object();

            if ( is_tax('wcpv_product_vendors') ) {
                $display_widget = true;
            }
        }

        $vendor = WC_Product_Vendors_Utils::get_vendor_data_by_id($term->term_id);

        if ( $display_widget && $vendor ) {
            $html = '';

            $html .= $args['before_widget'];

            if ( ! empty( $instance['title'] ) ) {
                $html .= $args['before_title'] . apply_filters( 'widget_title', esc_html( $instance['title'] ) ) . $args['after_title'];
            }

            $logo = wp_get_attachment_image( absint( $vendor['logo'] ), 'medium' );

            if ( $logo ) {
                $html .= '<p class="wcpv-widget-vendor-logo">' . $logo . '</p>' . PHP_EOL;
            }

            $html .= '<h3 class="wcpv-widget-vendor-title">' . esc_html( $vendor['name'] ) . '</h3>' . PHP_EOL;

            $rating = WC_Product_Vendors_Utils::get_vendor_rating($term->term_id);

            $html .= '<p class="wcpv-widget-vendor-rating">
                        <span style="width:' . ( ( $rating / 5 ) * 100 ) . '%">
                            <strong class="rating">' . __('Rating:', 'woocommerce-bookings-advanced' ) . $rating . '</strong>'
                . esc_html__( 'out of 5', 'woocommerce-bookings-advanced' ) . '
                        </span>
                     </p>';

            $html .= '<p>' . esc_html( $vendor['profile'] ) . '</p>' . PHP_EOL;

            $html .= $args['after_widget'];

            echo apply_filters( 'wcpv_vendor_widget_content', $html, $args, $vendor );
        }
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance['title']  = ! empty( $new_instance['title'] ) ? strip_tags( sanitize_text_field( $new_instance['title'] ) ) : '';
        $instance['vendor'] = ! empty( $new_instance['vendor'] ) ? sanitize_text_field( $new_instance['vendor'] ) : 'current';

        return $instance;
    }

    public function form( $instance ) {
        $vendors = WC_Product_Vendors_Utils::get_vendors();

        $defaults = array(
            'title'  => '',
            'vendor' => 'current',
        );

        $instance = wp_parse_args( $instance, $defaults );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'woocommerce-product-vendors' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'vendor' ) ); ?>"><?php esc_html_e( 'Vendor', 'woocommerce-product-vendors' ); ?></label><br />
            <select name="<?php echo esc_attr( $this->get_field_name( 'vendor' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'vendor' ) ); ?>" class="widefat">
                <option value="current" <?php selected( 'current', $instance['vendor'] ); ?>><?php esc_html_e( 'Current Vendor', 'woocommerce-product-vendors' ); ?></option>

                <?php
                foreach( $vendors as $vendor ) {
                    ?>
                    <option value="<?php echo esc_attr( $vendor->term_id ); ?>" <?php selected( $vendor->term_id, $instance['vendor'] ); ?>><?php echo esc_html( $vendor->name ); ?></option>
                    <?php
                }
                ?>
            </select><br /><br />

            <span><?php esc_html_e( 'Selecting "Current Vendor", will display the details of the vendors whose product(s) are being viewed at the time. It will not show on other pages.', 'woocommerce-product-vendors' ); ?></span>
        </p>
        <?php
    }
}
