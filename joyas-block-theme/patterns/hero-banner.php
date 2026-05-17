<?php
/**
 * Title: Hero Banner
 * Slug: joyas/hero-banner
 * Categories: header, banner
 * Description: A full-width hero section with a large heading and call-to-action.
 */
?>

<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-default.jpg","dimRatio":60,"overlayColor":"obsidian","align":"full","layout":{"type":"constrained","justifyContent":"center"}} -->
<div class="wp-block-cover alignfull">
	<span aria-hidden="true" class="wp-block-cover__background has-background-dim-60 has-obsidian-background-color has-background-dim"></span>
	<img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-default.jpg" data-object-fit="cover"/>
	<div class="wp-block-cover__inner-container">
		<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|3xl","bottom":"var:preset|spacing|3xl"},"blockGap":"var:preset|spacing|m"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
		<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--3xl);padding-bottom:var(--wp--preset--spacing--3xl)">
			<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"clamp(2.5rem, 6vw, 5rem)","fontFamily":"var:preset|font-family|heading"}},"textColor":"white"} -->
			<h1 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="font-family:var(--wp--preset--font-family--heading);font-size:clamp(2.5rem, 6vw, 5rem)">Timeless Elegance</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center","textColor":"sand","fontSize":"l"} -->
			<p class="has-text-align-center has-sand-color has-text-color has-l-font-size">Discover the art of fine jewelry, crafted to stand the test of time.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
			<div class="wp-block-buttons">
				<!-- wp:button {"backgroundColor":"gold","textColor":"white","style":{"border":{"radius":"2px"},"spacing":{"padding":{"top":"var:preset|spacing|s","bottom":"var:preset|spacing|s","left":"var:preset|spacing|l","right":"var:preset|spacing|l"}}},"fontSize":"m"} -->
				<div class="wp-block-button has-custom-font-size has-m-font-size"><a class="wp-block-button__link has-white-color has-gold-background-color has-text-color has-background wp-element-button" style="border-radius:2px;padding-top:var(--wp--preset--spacing--s);padding-right:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--s);padding-left:var(--wp--preset--spacing--l)">Explore Collection</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
	</div>
</div>
<!-- /wp:cover -->
