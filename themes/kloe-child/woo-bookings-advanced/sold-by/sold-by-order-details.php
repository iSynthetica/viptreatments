<dl class="variation">
    <dt class="variation-BookingID"><?= apply_filters( 'wcpv_sold_by_text', esc_html__( 'Sold By:', 'kloe' ) ) ?></dt>
    <dd class="variation-BookingID">
        <p>
            <a href="<?= esc_url( $sold_by['link'] ) ?>" title="<?= esc_attr( $sold_by['name'] )?>">
                <?= $sold_by['name'] ?>
            </a>
        </p>
    </dd>
</dl>