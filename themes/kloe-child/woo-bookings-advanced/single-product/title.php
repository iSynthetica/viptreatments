<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post, $product;

$tag = kloe_qodef_options()->getOptionValue('qodef_single_product_title_tag');

if(BA_Lib::is_booking($post->ID) && $parent_product = BA_Lib::get_parent_product($post->ID)) {
	?>
	<div style="height: 15px" class="vc_empty_space">
		<span class="vc_empty_space_inner"></span>
	</div>
	<<?= $tag ?> class="qodef-single-product-title"><?= $parent_product->post->post_title ?></<?= $tag ?>>
	<?php
	the_title('<h3  itemprop="name" class="single-product-sub-title">', '</h3>');
	?>
	<div style="height: 15px" class="vc_empty_space">
		<span class="vc_empty_space_inner"></span>
	</div>
	<?php
} else {
	the_title('<' . $tag . '  itemprop="name" class="qodef-single-product-title">', '</' . $tag . '>');
}

