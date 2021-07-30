<?php
/**
 * Plugin Name:     MRW Card Block Variation
 * Description:     Register a Variation of the Media & Text block that acts as a "Card"
 * Author:          Mark Root-Wiley, MRW Web Design
 * Author URI:      https://MRWweb.com
 * Text Domain:     mrw-card-block
 * Version:         0.1.0
 *
 * @package         Mrw_Card_Block
 */

namespace MRW\CardBlock;

define( 'MRW_CARD_BLOCK_VERSION', '0.1.0' );

add_action( 'wp_enqueue_scripts', 'MRW\CardBlock\front_end_assets', 9 );
function front_end_assets() {

	wp_enqueue_style(
		'mrw-card-block-styles',
		plugin_dir_url( __FILE__ ) . 'css/card-block-styles.css',
		[],
		MRW_CARD_BLOCK_VERSION
	);

}

add_action( 'enqueue_block_editor_assets', 'MRW\CardBlock\editor_assets' );
function editor_assets() {

	wp_enqueue_script(
		'mrw-card-block-editor-script',
		plugin_dir_url( __FILE__ ) . 'js/card-block.js',
		[],
		MRW_CARD_BLOCK_VERSION
	);

	wp_enqueue_style(
		'mrw-card-block-editor-styles',
		plugin_dir_url( __FILE__ ) . 'css/card-block-editor-styles.css',
		[],
		MRW_CARD_BLOCK_VERSION
	);

}
