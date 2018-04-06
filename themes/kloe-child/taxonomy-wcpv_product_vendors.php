<?php
/*
Template Name: WooCommerce
*/
?>
<?php

global $woocommerce;

$id = get_option('woocommerce_shop_page_id');
$shop = get_post($id);

// $sidebar = 'sidebar-33-right';
// $sidebar = 'sidebar-25-right';
// $sidebar = 'sidebar-33-left';
$sidebar = 'sidebar-25-left';

if(get_post_meta($id, 'qode_page_background_color', true) != ''){
    $background_color = 'background-color: '.esc_attr(get_post_meta($id, 'qode_page_background_color', true));
}else{
    $background_color = '';
}

$content_style = '';
if(get_post_meta($id, 'qode_content-top-padding', true) != '') {
    if(get_post_meta($id, 'qode_content-top-padding-mobile', true) == 'yes') {
        $content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'qode_content-top-padding', true)).'px !important';
    } else {
        $content_style = 'padding-top:'.esc_attr(get_post_meta($id, 'qode_content-top-padding', true)).'px';
    }
}

if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

get_header();

get_template_part('title');
?>

<div class="qodef-container" <?php kloe_qodef_inline_style($background_color); ?>>
    <div class="qodef-container-inner clearfix" <?php kloe_qodef_inline_style($content_style); ?>>
        <?php
        switch( $sidebar ) {

            case 'sidebar-33-right': ?>
                <div class="qodef-two-columns-66-33 grid2 qodef-woocommerce-with-sidebar clearfix">
                    <div class="qodef-column1">
                        <div class="qodef-column-inner">
                            <?php kloe_qodef_woocommerce_content(); ?>
                        </div>
                    </div>
                    <div class="qodef-column2">
                        <?php get_sidebar('vendor');?>
                    </div>
                </div>
                <?php
                break;
            case 'sidebar-25-right': ?>
                <div class="qodef-two-columns-75-25 grid2 qodef-woocommerce-with-sidebar clearfix">
                    <div class="qodef-column1 qodef-content-left-from-sidebar">
                        <div class="qodef-column-inner">
                            <?php kloe_qodef_woocommerce_content(); ?>
                        </div>
                    </div>
                    <div class="qodef-column2">
                        <?php get_sidebar('vendor');?>
                    </div>
                </div>
                <?php
                break;
            case 'sidebar-33-left': ?>
                <div class="qodef-two-columns-33-66 grid2 qodef-woocommerce-with-sidebar clearfix">
                    <div class="qodef-column1">
                        <?php get_sidebar('vendor');?>
                    </div>
                    <div class="qodef-column2">
                        <div class="qodef-column-inner">
                            <?php kloe_qodef_woocommerce_content(); ?>
                        </div>
                    </div>
                </div>
                <?php
                break;
            case 'sidebar-25-left': ?>
                <div class="qodef-two-columns-25-75 grid2 qodef-woocommerce-with-sidebar clearfix">
                    <div class="qodef-column1">
                        <?php get_sidebar('vendor');?>
                    </div>
                    <div class="qodef-column2 qodef-content-right-from-sidebar">
                        <div class="qodef-column-inner">
                            <?php kloe_qodef_woocommerce_content(); ?>
                        </div>
                    </div>
                </div>
                <?php
                break;
            default:
                kloe_qodef_woocommerce_content();
        }
        ?>
    </div>
</div>
<?php get_footer(); ?>
