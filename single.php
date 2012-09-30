<?php
/**
 * The Template for displaying all single posts.
 *
 * @package clarity
 * @since clarity 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>
				
				<?php comments_template( '', true ); ?>
				
				<!-- Pagination for next/previous post links -->
				<div class="arrows-container">
					<div class="left-arrow">
						<?php previous_post_link('%link', '<span class="arrow_left_alt1 iconic"></span>'); ?>
					</div>
					<div class="right-arrow">
						<?php next_post_link('%link', '<span class="arrow_right_alt1 iconic"></span>'); ?>
					</div>
				</div>
				
			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>