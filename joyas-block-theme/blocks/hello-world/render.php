<?php
/**
 * Render template for the Hello World block.
 *
 * @package Joyas
 */

declare( strict_types = 1 );

?>
<p <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>>
	<?php esc_html_e( 'Hello from Joyas!', 'joyas' ); ?>
</p>
