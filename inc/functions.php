<?php

function get_relateds()
{

  $context = Timber::context();
  $timber_post = Timber::get_post();
  $context['post'] = $timber_post;

  // get relateds
  $related_limit = 12;
  $related_ids = wc_get_related_products($timber_post->id, $related_limit);

  if ($related_ids) {
    $context['related_products'] = Timber::get_posts($related_ids);
  } else {
    $context['related_products'] = null;
  }

  Timber::render('relateds.twig', $context);
}

function get_upsells()
{
  $context = Timber::context();
  $timber_post = Timber::get_post();
  $context['post'] = $timber_post;

  // get upsells
  $upsell_ids = $timber_post->_upsell_ids;
  $context['up_sells'] = null;
  if ($upsell_ids) $context['up_sells'] = Timber::get_posts($upsell_ids);

  Timber::render('upsells.twig', $context);
}

function timber_set_product($post)
{
  global $product;

  if (is_woocommerce()) {
    $product = wc_get_product($post->ID);
  }
}

function timber_setup_postdata($post_object)
{
  setup_postdata($GLOBALS['post'] = & $post_object);
}

function cart_sells_woocommerce_post_class($classes, $product)
{
  global $woocommerce_loop;
  if ((is_cart()) || (is_product() && $woocommerce_loop['name'] == 'related' ) || (is_product() && $woocommerce_loop['name'] == 'up-sells' )) {
    $classes[] = 'swiper-slide';
  }
  return $classes;
}