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

    add_action('plugins_loaded', array($this, 'woo_actions'));
    add_filter('wc_get_template', array($this, 'wc_get_template'), 10, 5);

    add_filter('woocommerce_post_class', 'cart_sells_woocommerce_post_class', 10, 2);
  }
  public function wc_get_template($file, $template_name, $args, $template_path, $default_path) {

    global $woocommerce; // for getting the woocommerce plugin_path

    if (!$default_path) $default_path = $woocommerce->plugin_path() . '/templates/'; // if default_path not set, set it now
    $plugin_path = RELATED_UPSELLS_PATH . 'woocommerce/' . $template_name; // set our plugin_path

    // we wanna reset the logic when woocommerce is looking for php template-parts to use
    // we wanna have it so our plugin's location takes precedence, then the original $file(theme?), then woocommerce templates folder

    // $file = $file;
    if (@file_exists($plugin_path)) $file = $plugin_path;
    if (!@file_exists($plugin_path) && @file_exists($file)) $file = $file;
    if (!@file_exists($plugin_path) && !@file_exists($file) && @file_exists($default_path)) $file = $default_path;

    return $file;
  }

  public function woo_actions() {
    // remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
    // remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    // add_action('woocommerce_after_single_product_summary', 'get_upsells', 15);
    // add_action('woocommerce_after_single_product_summary', 'get_relateds', 20);
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
      'related-upsells',
      RELATED_UPSELLS_URL . 'public/css/related-upsells.css'
    );
    wp_enqueue_script(
      'related-upsells',
      RELATED_UPSELLS_URL . 'public/js/related-upsells.js',
      '',
      '1.0.0',
      true
    );
    wp_enqueue_style(
      'swiper',
      'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css'
    );
    wp_enqueue_script(
      'swiper',
      'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js',
      '',
      '9.0.0',
      false
    );
    wp_enqueue_style(
      'uikit',
      'https://cdn.jsdelivr.net/npm/uikit@3.15.24/dist/css/uikit.min.css'
    );
    wp_enqueue_script(
      'uikit',
      'https://cdn.jsdelivr.net/npm/uikit@3.15.24/dist/js/uikit.min.js',
      array(),
      '3.15.24',
      false
    );
    wp_enqueue_script(
      'uikit-icons',
      'https://cdn.jsdelivr.net/npm/uikit@3.15.24/dist/js/uikit-icons.min.js',
      array(),
      '3.15.24',
      false
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