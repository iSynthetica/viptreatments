<div id="child-bookings-wrapper" style="margin-bottom: 45px;">
    <!-- Title -->
    <div class=" et_pb_row et_pb_row_0">
        <div class="et_pb_column et_pb_column_4_4  et_pb_column_0">
            <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_center  et_pb_text_0">
                <h2><?= __('Price List', 'woocommerce-bookings-advanced') ?></h2>
            </div> <!-- .et_pb_text -->
        </div> <!-- .et_pb_column -->
    </div>

    <!-- List of child services -->
    <div class=" et_pb_row et_pb_row_0" style="width:100%">
        <div class="et_pb_column et_pb_column_2_3  et_pb_column_3">
            <?php wc_get_template( 'single-product/child-booking-accordion.php', array('child_products' =>  $child_products), 'templates', BA_TEMPLATE_PATH ); ?>
        </div>

        <div class="et_pb_column et_pb_column_1_3  et_pb_column_4">
            <?php wc_get_template( 'single-product/child-booking-forms.php', array('child_products' =>  $child_products), 'templates', BA_TEMPLATE_PATH ); ?>
        </div>
    </div>
</div>