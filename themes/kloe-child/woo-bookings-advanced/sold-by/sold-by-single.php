<div class="product_meta" style="margin-bottom: 0">
    <span class="posted_in"><?= apply_filters( 'wcpv_sold_by_text', esc_html__( 'Sold By:', 'kloe' ) ) ?> <a href="<?= esc_url( $sold_by['link'] ) ?>" title="<?= esc_attr( $sold_by['name'] )?>">
            <?= $sold_by['name'] ?>
        </a></span>
</div>