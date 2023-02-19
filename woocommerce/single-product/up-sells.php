<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : 

	$context = Timber::context();
	$context['heading'] = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'You may also like&hellip;', 'related-upsells' ) );
	$context['upsells'] = $upsells;
	$context['cols'] = wc_get_loop_prop('columns');
	Timber::render( 'up-sells.twig', $context );

endif;

wp_reset_postdata();
