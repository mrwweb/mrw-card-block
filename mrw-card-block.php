<?php
/**
 * Plugin Name:     MRW Card Block Variation
 * Description:     A variation of the Media & Text block that acts as a "Card"
 * Author:          Mark Root-Wiley, MRW Web Design
 * Author URI:      https://MRWweb.com
 * Requires at least: 6.6
 * Requires PHP: 	7.0
 * Text Domain:     mrw-card-block
 * Version:         0.4.3
 * Plugin URI: 		https://github.com/mrwweb/mrw-card-block
 *
 * @package         MRW_Card_Block
 */

namespace MRW\CardBlock;

require_once( 'github-updater/github-updater.php' );
use WP_GitHub_Updater;

define( 'MRW_CARD_BLOCK_VERSION', '0.4.3' );

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

add_filter( 'render_block', __NAMESPACE__ . '\render_card_block', 10, 2 );
/**
 * Modify the Media & Text output to use the Card Block aspect ratio, if set
 *
 * @param string $block_content block's HTML
 * @param array $block all properties of the block
 * @return void
 */
function render_card_block( $block_content, $block ) {
	$classes = $block['attrs']['className'] ?? '';
	$ratio = $block['attrs']['aspectRatio'] ?? '';
	
	if (
		'core/media-text' === $block['blockName'] &&
		str_contains( $classes, 'mrw-card-block' ) &&
		! empty( $ratio )
	) {
		$block_content = str_replace( 'class="wp-block-media-text ', 'style="--mrw-card--ratio:' . esc_attr($ratio) . '" class="wp-block-media-text ', $block_content );
	}
	return $block_content;
}

// Initialize the plugin updater
add_action( 'admin_init', function() {
	if ( is_admin() ) {
		$config = array(
			'slug' => plugin_basename(__FILE__),
			'proper_folder_name' => 'mrw-card-block',
			'api_url' => 'https://github.com/mrwweb/mrw-card-block',
			'raw_url' => 'https://raw.githubusercontent.com/mrwweb/mrw-card-block/main',
			'github_url' => 'https://github.com/mrwweb/mrw-card-block',
			'zip_url' => 'https://github.com/mrwweb/mrw-card-block/archive/refs/heads/main.zip',
			'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
			'requires' => '6.6',
			'tested' => '6.6',
			'readme' => 'readme.txt',
		);
		new WP_GitHub_Updater($config);
	}
} );
