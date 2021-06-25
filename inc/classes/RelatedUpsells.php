<?php
namespace Rmcc;
use Timber\Timber;

class RelatedUpsells extends Timber {

  public function __construct() {
    parent::__construct();
    add_filter('timber/twig', array($this, 'add_to_twig'));
    add_filter('timber/context', array($this, 'add_to_context'));
    
    add_action('plugins_loaded', array($this, 'plugin_timber_locations'));
    add_action('plugins_loaded', array($this, 'plugin_text_domain_init')); 
    add_action('wp_enqueue_scripts', array($this, 'plugin_enqueue_assets'));

    add_action('rmcc_after_product_details', 'get_relateds_upsells', 10);
  }
  
  public function plugin_timber_locations() {
    // if timber::locations is empty (another plugin hasn't already added to it), make it an array
    if(!Timber::$locations) Timber::$locations = array();
    // add a new views path to the locations array
    array_push(
      Timber::$locations, 
      RELATED_UPSELLS_PATH . 'views'
    );
  }
  public function plugin_text_domain_init() {
    load_plugin_textdomain('related-upsells', false, RELATED_UPSELLS_BASE. '/languages');
  }
  public function plugin_enqueue_assets() {
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
    if(!class_exists('Twig_Extension_StringLoader')){
      $twig->addExtension(new Twig_Extension_StringLoader());
    }
    return $twig;
  }
  public function add_to_context($context) {
    return $context;    
  }
}