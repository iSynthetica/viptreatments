<div id="display-booking-data-wrapper">
    <?php
    $i = 0;
    foreach($child_products as $child_product) {
        $product_obj = wc_get_product($child_product->ID);
        $booking_form = new WC_Booking_Form($product_obj);
        $booking_form_ba = new BA_Booking_Form($product_obj);
        $after = BA_Utils::booking_period_units_to_short($product_obj->wc_booking_duration_unit);

        $dataClass = "child-prod-data-wrapper child-prod-data-wrapper-" . $child_product->ID;
        if ($i === 0) {
            $dataClass .= ' child-prod-data-wrapper-open';
        } else {
            $dataClass .= ' child-prod-data-wrapper-closed';
        }
        ?>
        <div id="child-prod-<?= $child_product->ID ?>-data" class="<?= $dataClass ?>">
            <div class="">
                <div class="child-prod-data-title">
                    <h5><?= $child_product->post_title ?></h5>
                    <span class="price"><?php echo $product_obj->get_price_html(); ?></span> /
                    <span class="duration"><i class="fa fa-clock-o"></i> <?php echo $product_obj->wc_booking_duration . ' ' . $after ?></span><br>
                    <?php
                    $sold_by = WC_Product_Vendors_Utils::get_sold_by_link($child_product->ID);
                    echo __( 'Specialist:', 'woocommerce-bookings-advanced' ) . ' <span class="specialist-name">' . $sold_by['name'] . '</span>';
                    ?>
                </div>
                <?php wc_get_template( 'single-product/add-to-cart/booking-loop.php', array( 'booking_form' => $booking_form, 'product' =>  $product_obj, 'booking_form_ba' => $booking_form_ba), 'woo-bookings-advanced', BA_TEMPLATE_PATH ); ?>
            </div>
        </div>
        <?php
        $i++;
    }
    ?>
</div>