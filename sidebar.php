<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Spiritualized
 * @since Spiritualized 1.0
 */
?>

<div id="secondary sidebar" class="widget-area sidebar1" role="complementary">
			
	<?php do_action( 'before_sidebar' ); ?>
	<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>
	<!-- Nothing here because I would rather not have a sidebar available at all in this theme but I'm being forced too by WP -->
	<?php endif; // end sidebar widget area ?>
</div><!-- #secondary#sidebar .widget-area.sidebar1 -->