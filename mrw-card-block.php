<?php
/**
 * Plugin Name:     MRW Card Block Variation
 * Description:     Register a Variation of the Media & Text block that acts as a "Card"
 * Author:          Mark Root-Wiley, MRW Web Design
 * Author URI:      https://MRWweb.com
 * Text Domain:     mrw-card-block
 * Version:         0.3.0
 *
 * @package         MRW_Card_Block
 */

namespace MRW\CardBlock;

require_once( 'github-updater/github-updater.php' );
use WP_GitHub_Updater;

define( 'MRW_CARD_BLOCK_VERSION', '0.3.0' );

add_filter( 'after_setup_theme', __NAMESPACE__ . '\register_block_styles' );
function register_block_styles() {
	wp_enqueue_block_style(
		"core/media-text",
		array(
			'handle' => "mrw-card-block-styles",
			'src'    => plugin_dir_url( __FILE__ ) . 'css/card-block-styles.css',
			'path'   => plugin_dir_path( __FILE__ ) . 'css/card-block-styles.css',
			'ver'	 => MRW_CARD_BLOCK_VERSION,
		)
	);
}

add_action( 'enqueue_block_assets', __NAMESPACE__ . '\editor_assets' );
function editor_assets() {
	if( is_admin() ) {
		$asset_file = include( plugin_dir_path( __FILE__ ) . 'js/card-block.asset.php');
		
		wp_enqueue_script(
			'mrw-card-block-editor-script',
			plugin_dir_url( __FILE__ ) . 'js/card-block.js',
			$asset_file['dependencies'],
			MRW_CARD_BLOCK_VERSION
		);
	
		wp_enqueue_style(
			'mrw-card-block-editor-styles',
			plugin_dir_url( __FILE__ ) . 'css/card-block-editor-styles.css',
			[],
			MRW_CARD_BLOCK_VERSION
		);
	}
}

// Initialize the plugin updater
if ( is_admin() ) {
	$config = array(
		'slug' => plugin_basename(__FILE__),
		'proper_folder_name' => 'mrw-card-block',
		'api_url' => 'https://github.com/mrwweb/mrw-card-block',
		'raw_url' => 'https://raw.githubusercontent.com/mrwweb/mrw-card-block/main',
		'github_url' => 'https://github.com/mrwweb/mrw-card-block',
		'zip_url' => 'https://github.com/mrwweb/mrw-card-block/archive/refs/heads/main.zip',
		'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
		'requires' => '5.0',
		'tested' => '5.8',
		'readme' => 'readme.txt',
	);
	new WP_GitHub_Updater($config);
}

require_once( 'github-updater/github-updater.php' );
