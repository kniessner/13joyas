<?php
/**
 * Insert block-pattern content into existing WordPress pages.
 *
 * Usage: wp eval-file bin/wp-insert-patterns.php --allow-root
 *
 * Scans joyas-block-theme/patterns/page-*.php files, extracts their block
 * markup (everything after the PHP closing tag), and inserts it as post_content
 * into the corresponding WordPress page (matched by page slug).
 */

// strict_types removed because declare() is invalid inside eval()/ eval-file

$theme_dir = get_template_directory();
$patterns_dir = $theme_dir . '/patterns';

if ( ! is_dir( $patterns_dir ) ) {
	WP_CLI::error( 'Patterns directory not found: ' . $patterns_dir );
	exit( 1 );
}

$files = glob( $patterns_dir . '/page-*.php' );

if ( empty( $files ) ) {
	WP_CLI::warning( 'No page patterns found in ' . $patterns_dir );
	exit( 0 );
}

foreach ( $files as $file ) {
	$basename = basename( $file, '.php' );
	// page-startseite.php → startseite
	$page_slug = preg_replace( '/^page-/', '', $basename );

	// Execute the pattern file and capture its output so PHP expressions
	// like get_template_directory_uri() are evaluated before storage.
	ob_start();
	include $file;
	$block_markup = trim( ob_get_clean() );

	if ( empty( $block_markup ) ) {
		WP_CLI::warning( "No block markup found in {$basename}" );
		continue;
	}

	// Find page by slug
	$page = get_page_by_path( $page_slug, OBJECT, 'page' );
	if ( ! $page instanceof WP_Post ) {
		WP_CLI::warning( "Page not found for slug: {$page_slug}" );
		continue;
	}

	// Update page content
	$result = wp_update_post( [
		'ID'           => $page->ID,
		'post_content' => $block_markup,
		'post_status'  => 'publish',
	], true );

	if ( is_wp_error( $result ) ) {
		WP_CLI::warning( "Failed to update {$page_slug}: " . $result->get_error_message() );
	} else {
		WP_CLI::success( "Inserted content into page: {$page_slug} (ID: {$page->ID})" );
	}
}

WP_CLI::success( 'Pattern insertion complete.' );
