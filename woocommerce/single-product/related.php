<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : 

	$context = Timber::context();
	$context['heading'] = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'related-upsells' ) );
	$context['related_products'] = $related_products;
	$context['cols'] = wc_get_loop_prop('columns');
	Timber::render( 'related.twig', $context );

endif;

wp_reset_postdata();