<?php
if (!BA_Lib::is_booking($product->ID)) {
    return;
}

if (!$parent_product = BA_Lib::get_parent_product($product->ID)) {
    return;
}
?>

<span class="parent-link" style="margin-top: 25px">
    <!-- <?= $parent_product->post->post_title ?><br> -->
    <a href="<?= get_permalink($parent_product->id); ?>" class="qodef-btn qodef-btn-small qodef-btn-outline" title="<?= $parent_product->post->post_title ?>">
        <span class="qodef-btn-text">
            <?= apply_filters( 'wcpv_single_parent_link', esc_html__( 'More variations', 'woocommerce-bookings-advanced' ) ) ?>
        </span>
    </a>
</span>