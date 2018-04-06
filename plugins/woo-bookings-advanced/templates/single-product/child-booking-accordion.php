<?php
$settings = BA_Settings()->get_settings();
?>

<div class="qodef-accordion-holder clearfix qodef-accordion qodef-initial qodef-accordion-dark ">

    <?php
    $i = 0;
    foreach($child_products as $child_product) {
        //var_dump($child_product);
        $product_obj = wc_get_product($child_product->ID);

        $after = BA_Utils::booking_period_units_to_short($product_obj->wc_booking_duration_unit);

        $class = "child-service-wrapper et_pb_module et_pb_toggle et_pb_accordion_item_" . $i;
        if ($i === 0) {
            $class .= ' et_pb_toggle_open';
        } else {
            $class .= ' et_pb_toggle_close';
        }
        ?>
        <h5 class="clearfix qodef-title-holder et_pb_toggle_title" data-id="<?= $child_product->ID ?>">
            <span class="qodef-accordion-mark qodef-left-mark">
                <span class="qodef-accordion-mark-icon">
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-plus"></i>
                </span>
            </span>
            <span class="qodef-tab-title">
                <span class="qodef-tab-title-inner">
                    <?php
                    if($settings['child_display_sold_by']) {
                        $sold_by = WC_Product_Vendors_Utils::get_sold_by_link($child_product->ID);
                        echo __( 'Specialist:', 'woocommerce-bookings-advanced' ) . ' <span class="specialist-name" style="margin-right:15px">' . $sold_by['name'] . '</span>';
                    }
                    ?>
                    <span class="price"><?php echo $product_obj->get_price_html(); ?></span> /
                    <span class="duration"><i class="fa fa-clock-o"></i> <?php echo $product_obj->wc_booking_duration . ' ' . $after ?></span>
                </span>
            </span>
        </h5>

        <div class="qodef-accordion-content">
            <div class="qodef-accordion-content-inner">

                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <?php
                        if($settings['child_display_title']) {
                            ?><h5><?= $child_product->post_title ?></h5><?php
                        }
                        ?>

                        <?php
                        if($settings['child_display_short_desc']) {
                            ?><?= wpautop($child_product->post_excerpt) ?><?php
                        }
                        ?>

                        <?php
                        if($settings['child_display_full_desc']) {
                            ?><?= wpautop($child_product->post_content) ?><?php
                        }
                        ?>

                        <?php
                        if($settings['child_display_read_more']) {
                            ?>
                            <a class="qodef-btn qodef-btn-small qodef-btn-outline" target="_self" href="<?= get_permalink($child_product->ID); ?>" style="margin-top: 20px">
                                <span class="qodef-btn-text">More...</span>
                            </a>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <?php
        $i++;
    }
    ?>

</div>