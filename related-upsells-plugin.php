<?php
/*
Plugin Name: Related & Upsells for Woocommerce by RMcC
Plugin URI: #
Description: Adds related & upsell products to the product page @ theme location rmcc_after_product_details
Version: 1.0.0
Author: robmccormack89
Author URI: #
Version: 1.0.0
License: GNU General Public License v2 or later
License URI: LICENSE
Text Domain: related-upsells
Domain Path: /languages/
*/

// don't run if someone access this file directly
defined('ABSPATH') || exit;

// define some constants
if (!defined('RELATED_UPSELLS_PATH')) define('RELATED_UPSELLS_PATH', plugin_dir_path( __FILE__ ));
if (!defined('RELATED_UPSELLS_URL')) define('RELATED_UPSELLS_URL', plugin_dir_url( __FILE__ ));
if (!defined('RELATED_UPSELLS_BASE')) define('RELATED_UPSELLS_BASE', dirname(plugin_basename( __FILE__ )));

// require the composer autoloader
if (file_exists($composer_autoload = __DIR__.'/vendor/autoload.php')) require_once $composer_autoload;

// then require the main plugin class. this class extends Timber/Timber which is required via composer
new Rmcc\RelatedUpsells;

// require action functions 
require_once('inc/functions.php');