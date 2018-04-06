<?php
$parent_id = get_the_ID();
?>

<div id="child-bookings-wrapper">
    <div class="vc_row wpb_row vc_row-fluid qodef-section qodef-content-aligment-left">
        <div class="clearfix qodef-full-section-inner">
            <div class="wpb_column vc_column_container vc_col-sm-12">
                <div class="vc_column-inner ">
                    <div class="wpb_wrapper">
                        <div style="height: 32px" class="vc_empty_space">
                            <span class="vc_empty_space_inner"></span>
                        </div>
                        <div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_sep_color_grey vc_separator-has-text">
                            <span class="vc_sep_holder vc_sep_holder_l">
                                <span class="vc_sep_line"></span>
                            </span>

                            <h2><?= __('Price List', 'kloe') ?></h2>

                            <span class="vc_sep_holder vc_sep_holder_r">
                                <span class="vc_sep_line"></span>
                            </span>
                        </div>
                        <div style="height: 32px" class="vc_empty_space">
                            <span class="vc_empty_space_inner"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="" class="vc_row wpb_row vc_row-fluid qodef-section qodef-content-aligment-left">
        <div class="clearfix qodef-full-section-inner">
            <div class="wpb_column vc_column_container vc_col-sm-8">
                <div class="vc_column-inner ">
                    <div class="wpb_wrapper">
                        <?php wc_get_template( 'single-product/child-booking-accordion.php', array('child_products' =>  $child_products), 'woo-bookings-advanced', BA_TEMPLATE_PATH ); ?>
                    </div>
                </div>
            </div>
            <div class="wpb_column vc_column_container vc_col-sm-4">
                <div class="vc_column-inner ">
                    <div class="wpb_wrapper">
                        <?php wc_get_template( 'single-product/child-booking-forms.php', array('child_products' =>  $child_products), 'woo-bookings-advanced', BA_TEMPLATE_PATH ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- #child-bookings-wrapper -->