<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package clarity
 * @since clarity 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h3 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'clarity' ); ?></h3>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'It looks like nothing was found at this location.', 'clarity' ); ?></p>

					<a href="<?php echo home_url('/'); ?>"><h3 class="entry-title"><?php _e( 'Go Home', 'clarity' ); ?></h3></a>

				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<hr />

<?php get_footer(); ?>