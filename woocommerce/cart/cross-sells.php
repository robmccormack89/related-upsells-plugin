<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * custom orderby template rendered with timber/twig. 
 * this template overwrites woocommerce/templates/loop/orderby.php
 *
**/

if ( $cross_sells ) : 

	$context = Timber::context();
	$context['heading'] = apply_filters( 'woocommerce_product_cross_sells_products_heading', __( 'You may be interested in&hellip;', 'related-upsells' ) );
	$context['cross_sells'] = $cross_sells;
	$context['cols'] = wc_get_loop_prop('columns');
	Timber::render( 'cross-sells.twig', $context );

endif;

wp_reset_postdata();
