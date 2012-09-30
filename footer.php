<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package clarity
 * @since clarity 1.0
 */
?>

	</div><!-- #main .site-main -->
	
	<?php get_sidebar(); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
		
			<div class="goup">
				<a href="#masthead"><span class="iconic arrow_up_alt1"></span></a>
			</div>
			
			<?php do_action( 'clarity_credits' ); ?>
							
			<?php
				if ( of_get_option( 'clarity_footer' ) != '' ) {
					echo of_get_option( 'clarity_footer' );
				} else { ?>
					<a href="http://wordpress.org/" title="A Semantic Personal Publishing Platform" rel="generator">Proudly powered by Wordpress</a>
			<span class="sep"> | </span>Clarity by <a href="http://captaintheme.com/">Captain Theme</a>
				<?php } ?>
			
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->

</div><!-- .row.container -->

<?php wp_footer(); ?>

</body>
</html>