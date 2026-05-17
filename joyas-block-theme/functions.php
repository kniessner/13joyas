<?php
/**
 * Joyas Block Theme functions and definitions.
 *
 * @package Joyas
 */

declare( strict_types = 1 );

namespace Joyas;

/**
 * Read and cache the Vite manifest so we don't hit disk on every hook.
 *
 * @return array<string, mixed>|null
 */
function joyas_vite_manifest(): ?array {
	static $manifest = null;
	if ( $manifest !== null ) {
		return $manifest;
	}
	$path = get_template_directory() . '/dist/manifest.json';
	if ( ! is_readable( $path ) ) {
		return null;
	}
	$manifest = json_decode( (string) file_get_contents( $path ), true, 512, JSON_THROW_ON_ERROR );
	return $manifest;
}

// ------------------------------------------------------------------------
// Theme Setup
// ------------------------------------------------------------------------

add_action(
	'after_setup_theme',
	function (): void {
		load_theme_textdomain( 'joyas', get_template_directory() . '/languages' );

		$manifest = joyas_vite_manifest();
		$main_css = $manifest['src/ts/main.ts']['css'][0] ?? null;
		if ( $main_css ) {
			add_editor_style( 'dist/' . $main_css );
		}
	},
	100
);

// ------------------------------------------------------------------------
// Enqueue / Vite
// ------------------------------------------------------------------------

add_action(
	'wp_enqueue_scripts',
	function (): void {
		$manifest = joyas_vite_manifest();
		if ( $manifest === null ) {
			return;
		}

		$main = $manifest['src/ts/main.ts'] ?? null;
		if ( isset( $main['file'] ) ) {
			foreach ( $main['css'] ?? [] as $css_file ) {
				wp_enqueue_style(
					'joyas-' . sanitize_title( basename( $css_file ) ),
					get_template_directory_uri() . '/dist/' . $css_file,
					[],
					null
				);
			}
			wp_enqueue_script(
				'joyas-main',
				get_template_directory_uri() . '/dist/' . $main['file'],
				[],
				null,
				true
			);
			wp_script_add_data( 'joyas-main', 'type', 'module' );
		}

		wp_enqueue_style(
			'joyas-google-fonts',
			'https://fonts.googleapis.com/css2?family=Marcellus&family=Inter+Tight:wght@300;400;500;600&family=Playfair+Display:wght@400;700&family=Cormorant+Garamond:ital@0;1&display=swap',
			[],
			null
		);
	}
);

add_action(
	'enqueue_block_editor_assets',
	function (): void {
		$manifest = joyas_vite_manifest();
		if ( $manifest === null ) {
			return;
		}

		$editor = $manifest['src/ts/editor.ts'] ?? null;
		if ( isset( $editor['file'] ) ) {
			wp_enqueue_script(
				'joyas-editor',
				get_template_directory_uri() . '/dist/' . $editor['file'],
				[ 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ],
				null,
				true
			);
			wp_script_add_data( 'joyas-editor', 'type', 'module' );
		}

		$editor_css = $editor['css'][0] ?? null;
		if ( $editor_css ) {
			wp_enqueue_style( 'joyas-editor-css', get_template_directory_uri() . '/dist/' . $editor_css );
		}
	}
);

// ------------------------------------------------------------------------
// Block registration (auto-discover from /blocks)
// ------------------------------------------------------------------------

add_action(
	'init',
	function (): void {
		$blocksDir = get_template_directory() . '/blocks';
		if ( is_dir( $blocksDir ) ) {
			foreach ( new \FilesystemIterator( $blocksDir, \FilesystemIterator::SKIP_DOTS ) as $dir ) {
				if ( $dir->isDir() && is_file( $dir->getPathname() . '/block.json' ) ) {
					register_block_type( $dir->getPathname() );
				}
			}
		}
	}
);

// ------------------------------------------------------------------------
// Performance - Dequeue unused assets
// ------------------------------------------------------------------------

add_action(
	'wp_enqueue_scripts',
	function (): void {
		wp_dequeue_style( 'classic-theme-styles' );
		wp_dequeue_style( 'global-styles' );

		// Remove emoji scripts/styles
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		wp_dequeue_style( 'wp-block-library-theme' );
	},
	100
);

// ------------------------------------------------------------------------
// Speculation Rules API
// ------------------------------------------------------------------------

if ( function_exists( 'wp_add_speculation_rules' ) ) {
	add_action(
		'wp_head',
		function (): void {
			wp_add_speculation_rules( [
				'eagerness' => 'moderate',
				'urls'      => 'cross-origin',
				'href'      => [
					'exclude' => '/wp-admin/*',
				],
			] );
		},
		100
	);
}

// ------------------------------------------------------------------------
// Image optimization
// ------------------------------------------------------------------------

add_filter(
	'wp_get_attachment_image_attributes',
	function ( array $attrs ): array {
		if ( empty( $attrs['loading'] ) ) {
			$attrs['loading'] = 'lazy';
		}
		return $attrs;
	}
);

// ------------------------------------------------------------------------
// Disable XML-RPC
// ------------------------------------------------------------------------

add_filter( 'xmlrpc_enabled', '__return_false' );
