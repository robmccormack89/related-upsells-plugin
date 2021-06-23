<?php

function get_relateds_upsells() {
  // if timber::locations is empty (another plugin hasn't already added to it), make it an array
  if(!Timber::$locations) Timber::$locations = array();
  // add a new views path to the locations array
  array_push(
    Timber::$locations, 
    RELATED_UPSELLS_PATH . 'views'
  );
  $context = Timber::context();

  // get relateds
  $related_limit = 12;
  $related_ids = wc_get_related_products($context['post']->id, $related_limit);
  $context['related_products'] = null;
  if ($related_ids) $context['related_products'] = Timber::get_posts($related_ids);
  
  // get upsells
  $upsell_ids = $context['post']->_upsell_ids;
  $context['up_sells'] = null;
  if ($upsell_ids) $context['up_sells'] = Timber::get_posts($upsell_ids);
  
  Timber::render('relateds-upsells.twig', $context);
}