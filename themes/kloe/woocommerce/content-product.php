<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<?php
//Get product gallery images and take first for displaying on single product hover
$product_gallery_ids = $product->get_gallery_attachment_ids();
if (!empty($product_gallery_ids)) {
	//get product image url, shop catalog size
	$product_hover_image = wp_get_attachment_image_src( $product_gallery_ids[0], 'shop_catalog' );
}
?>

<li <?php post_class(); ?>>

	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>
	<?php do_action('kloe_qodef_woocommerce_out_of_stock'); ?>
	<div class="qodef-product-list-image-holder">
		<a class="qodef-product-list-image-wrapper" href="<?php the_permalink(); ?>">

			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */

				do_action( 'woocommerce_before_shop_loop_item_title' );


			if (isset($product_hover_image)) { ?>

				<span class="qodef-single-product-hover-image" style="background-image: url(<?php echo esc_url( $product_hover_image[0] );?>)"></span>

				<?php
			}
			?>

		</a>
		<?php
		/**
		 * woocommerce_after_shop_loop_item hook
		 *
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
		?>
	</div>

	<a href="<?php the_permalink(); ?>">
	<?php

		/**
		 * woocommerce_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );

	?>
	</a>
	<?php
		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );


	?>

</li>
