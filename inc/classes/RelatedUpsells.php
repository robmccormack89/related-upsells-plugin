<?php
namespace Rmcc;
use Timber\Timber;

class RelatedUpsells extends Timber {

  public function __construct() {
    parent::__construct();
    
    // timber stuff. the usual stuff
    add_filter('timber/twig', array($this, 'add_to_twig'));
    add_filter('timber/context', array($this, 'add_to_context'));
    
    // enqueue plugin assets
    add_action('wp_enqueue_scripts', array($this, 'relateds_upsells_assets'));
    
    // add the relateds & upsells function to rmcc_after_product_details theme location
    add_action('rmcc_after_product_details', 'get_relateds_upsells', 10);
  }
  
  public function relateds_upsells_assets() {
    wp_enqueue_style(
      'swiper-js',
      RELATED_UPSELLS_URL . 'public/css/swiper-bundle.min.css'
    );
    wp_enqueue_script(
      'swiper-js',
      RELATED_UPSELLS_URL . 'public/js/swiper-bundle.min.js',
      '',
      '1.0.0',
      true
    );
    wp_enqueue_style(
      'related-upsells',
      RELATED_UPSELLS_URL . 'public/css/related-upsells.css',
      array('swiper-js')
    );
    wp_enqueue_script(
      'related-upsells',
      RELATED_UPSELLS_URL . 'public/js/related-upsells.js',
      array('jquery', 'swiper-js'),
      '1.0.0',
      true
    );
  }
  
  public function add_to_twig($twig) { 
    $twig->addExtension(new \Twig_Extension_StringLoader());
    return $twig;
  }

  public function add_to_context($context) {
    return $context;    
  }

}