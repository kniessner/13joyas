<?php
/**
 * Title: Product Showcase Grid
 * Slug: joyas/product-showcase
 * Categories: products, grid
 * Description: A 4-column grid to showcase featured products or collections.
 */
?>

<!-- wp:group {"layout":{"type":"constrained","justifyContent":"center"}} -->
<div class="wp-block-group">
	<!-- wp:heading {"textAlign":"center","style":{"typography":{"fontFamily":"var:preset|font-family|heading"}},"fontSize":"3xl"} -->
	<h2 class="wp-block-heading has-text-align-center has-3xl-font-size" style="font-family:var(--wp--preset--font-family--heading)">Signature Pieces</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|xl","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
	<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--xl);margin-bottom:0">
		<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|m","bottom":"var:preset|spacing|m","left":"var:preset|spacing|m","right":"var:preset|spacing|m"}},"border":{"radius":"4px"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group" style="border-radius:4px;padding-top:var(--wp--preset--spacing--m);padding-right:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m);padding-left:var(--wp--preset--spacing--m)">
			<!-- wp:image {"align":"center","aspectRatio":"4/3","scale":"cover","style":{"border":{"radius":"4px"}},"className":"wp-block-image is-style-default"} -->
			<figure class="wp-block-image aligncenter has-custom-border"><img alt="Product placeholder" style="aspect-ratio:4/3;object-fit:cover;border-radius:4px"/></figure>
			<!-- /wp:image -->

			<!-- wp:paragraph {"align":"center","style":{"typography":{"fontFamily":"var:preset|font-family|heading"}},"fontSize":"l"} -->
			<p class="has-text-align-center has-l-font-size" style="font-family:var(--wp--preset--font-family--heading)">The Obsidian Ring</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
