<em class="wcpv-sold-by-single">
    <?= apply_filters( 'wcpv_sold_by_text', esc_html__( 'Sold By:', 'woocommerce-bookings-advanced' ) ) ?>
    <a href="<?= esc_url( $sold_by['link'] ) ?>" title="<?= esc_attr( $sold_by['name'] )?>">
        <?= $sold_by['name'] ?>
    </a>
</em>