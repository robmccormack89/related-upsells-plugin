<?php

function get_relateds_upsells() {
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
  
  // get upsells
  $upsell_ids = $timber_post->_upsell_ids;
  $context['up_sells'] = null;
  if ($upsell_ids) $context['up_sells'] = Timber::get_posts($upsell_ids);
  
  Timber::render('relateds-upsells.twig', $context);
}