<?php
/**
 * @package clarity
 * @since clarity 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
			if ( has_post_format( 'aside' )) {
				echo the_content();
			}

			elseif ( has_post_format( 'gallery' )) { ?>
			
				<header class="entry-header">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'clarity' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				</header><!-- .entry-header -->
				
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'clarity' ) ); ?>
				</div><!-- .entry-content -->

			<?php }

			elseif ( has_post_format( 'image' )) { ?>
				
				<header class="entry-header">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'clarity' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				</header><!-- .entry-header -->
				
 				<?php echo the_post_thumbnail('singlepost'); ?>
				
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'clarity' ) ); ?>
				</div><!-- .entry-content -->
				
			<?php }

			elseif ( has_post_format( 'link' )) { ?>
				
				<header class="entry-header">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'clarity' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				</header><!-- .entry-header -->
				
				<div class="entry-content">
				<span class="iconic link"></span>
				    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'clarity' ) ); ?>
				</div><!-- .entry-content -->
				
			<?php }

			elseif ( has_post_format( 'quote' )) { ?>
			
				<div class="row">
					<div class="one columns">
						<span class="iconic right_quote_alt"></span>
					</div>
					<div class="eleven columns">
						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'clarity' ) ); ?>
						</div><!-- .entry-content -->
					</div>
				</div>
				
			<?php }

			elseif ( has_post_format( 'status' )) { ?>
  				
  				<div class="row">
					<div class="one columns">
						<span class="iconic document_alt_stroke"></span>
					</div>
					<div class="eleven columns">
						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'clarity' ) ); ?>
						</div><!-- .entry-content -->
					</div>
				</div>
				
			<?php }

			elseif ( has_post_format( 'video' )) { ?>
				
				<header class="entry-header">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'clarity' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				</header><!-- .entry-header -->
				
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'clarity' ) ); ?>
				</div><!-- .entry-content -->
				
			<?php }

			elseif ( has_post_format( 'audio' )) { ?>
				
				<header class="entry-header">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'clarity' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				</header><!-- .entry-header -->
				
				<div class="entry-content">
				<span class="iconic volume"></span>
				    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'clarity' ) ); ?>
				</div><!-- .entry-content -->
				
			<?php }

			else { ?>
				
				<header class="entry-header">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'clarity' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				</header><!-- .entry-header -->
				
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'clarity' ) ); ?>
				</div><!-- .entry-content -->
				
			<?php }
		?>
	
	<?php wp_link_pages(); ?>
		
	<footer class="entry-meta">	
	
	<?php
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list(', ');
		$tag_list = get_the_tag_list('<span class="iconic tag_stroke"></span> ',', ','');
	?>
	
		<div class="the-meta"><span class="iconic folder_stroke"></span> <?php echo $categories_list; ?> &nbsp; <?php if( get_the_tag_list() ) { echo $tag_list; } ?></div>
		<div><a href="<?php the_permalink(); ?>" class="perma">#</a> <em><?php the_time(); ?></em> - <?php if( function_exists('zilla_likes') ) zilla_likes(); ?></div>
	</footer>

<hr />

</article><!-- #post-<?php the_ID(); ?> -->