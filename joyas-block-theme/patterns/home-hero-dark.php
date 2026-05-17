<?php
/**
 * Title: Home Hero — Dark Full-Viewport
 * Slug: joyas/home-hero-dark
 * Categories: header, banner, hero
 * Description: A dark, full-viewport hero with dramatic jewelry imagery and minimal, bold typography.
 */
?>

<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-jewelry-dark.jpg","dimRatio":40,"overlayColor":"obsidian","focalPoint":{"x":0.5,"y":0.35},"minHeight":100,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","justifyContent":"center"}} -->
<div class="wp-block-cover alignfull" style="min-height:100vh;padding-top:0;padding-bottom:0">
	<span aria-hidden="true" class="wp-block-cover__background has-background-dim-40 has-obsidian-background-color has-background-dim"></span>
	<img class="wp-block-cover__image-background" alt="Handgefertigter Silberschmuck" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-jewelry-dark.jpg" style="object-position:50% 35%" data-object-fit="cover" data-object-position="50% 35%"/>
	<div class="wp-block-cover__inner-container">
		<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|3xl","bottom":"var:preset|spacing|3xl"},"blockGap":"var:preset|spacing|l"},"dimensions":{"minHeight":"100vh"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
		<div class="wp-block-group" style="min-height:100vh;padding-top:var(--wp--preset--spacing--3xl);padding-bottom:var(--wp--preset--spacing--3xl)">
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|m"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"align":"center","textColor":"gold","fontSize":"xs","style":{"typography":{"letterSpacing":"0.2em","textTransform":"uppercase","fontFamily":"var:preset|font-family|body","fontWeight":"500"}}} -->
				<p class="has-text-align-center has-gold-color has-text-color has-xs-font-size" style="font-family:var(--wp--preset--font-family--body);letter-spacing:0.2em;text-transform:uppercase;font-weight:500">Silber-Schmiede · Berlin-Mitte · Seit 2015</p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"clamp(3rem, 9vw, 7rem)","fontFamily":"var:preset|font-family|heading","lineHeight":"0.95","textTransform":"uppercase","letterSpacing":"0.03em"}},"textColor":"white"} -->
				<h1 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="font-family:var(--wp--preset--font-family--heading);font-size:clamp(3rem, 9vw, 7rem);line-height:0.95;text-transform:uppercase;letter-spacing:0.03em">Silber.<br>Handgefertigt.<br>Unvergänglich.</h1>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"align":"center","textColor":"sand","fontSize":"l","style":{"typography":{"fontFamily":"var:preset|font-family|accent","fontStyle":"italic"},"spacing":{"margin":{"top":"var:preset|spacing|m"}}}} -->
				<p class="has-text-align-center has-sand-color has-text-color has-l-font-size" style="font-family:var(--wp--preset--font-family--accent);font-style:italic;margin-top:var(--wp--preset--spacing--m)">Individueller Schmuck aus Meisterhand. Maßgefertigt für ein Leben lang.</p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|xl"}}}} -->
				<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--xl)">
					<!-- wp:button {"backgroundColor":"gold","textColor":"white","style":{"border":{"radius":"2px","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|s","bottom":"var:preset|spacing|s","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}},"fontSize":"m","className":"is-style-joyas-gold","borderColor":"gold"} -->
					<div class="wp-block-button has-custom-font-size is-style-joyas-gold has-m-font-size"><a class="wp-block-button__link has-white-color has-gold-background-color has-text-color has-background wp-element-button" href="/kontakt/" style="border-radius:2px;border-width:1px;padding-top:var(--wp--preset--spacing--s);padding-right:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--s);padding-left:var(--wp--preset--spacing--xl)">Termin vereinbaren</a></div>
					<!-- /wp:button -->

					<!-- wp:button {"backgroundColor":"charcoal","textColor":"white","style":{"border":{"radius":"2px","color":"#C9A96E","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|s","bottom":"var:preset|spacing|s","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}},"fontSize":"m","borderColor":"gold"} -->
					<div class="wp-block-button has-custom-font-size has-m-font-size"><a class="wp-block-button__link has-white-color has-charcoal-background-color has-text-color has-background wp-element-button" href="/galerie/" style="border-radius:2px;border-color:#C9A96E;border-width:1px;padding-top:var(--wp--preset--spacing--s);padding-right:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--s);padding-left:var(--wp--preset--spacing--xl)">Werke entdecken</a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
</div>
<!-- /wp:cover -->
