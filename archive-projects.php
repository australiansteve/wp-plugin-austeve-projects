<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ChurchPew
 */

get_header(); ?>

<div class="row"><!-- .row start -->

	<div class="small-12 columns"><!-- .columns start -->

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<div class="row small-up-1 medium-up-2 large-up-3 align-center">

					<?php /* Start the Loop */ ?>
					<?php 
					while ( have_posts() ) : the_post(); 

						echo '<div class="column">';

		        		if (locate_template('page-templates/partials/projects-archive.php') != '') {
							// yep, load the page template
							get_template_part('page-templates/partials/projects', 'archive');
						} else {
							// nope, load the default
							include( plugin_dir_path( __FILE__ ) . 'page-templates/partials/projects-archive.php');
						}

						echo '</div>';

					endwhile; 
					?>

				</div>

				<?php the_posts_navigation(); ?>

			<?php else : ?>

				<?php get_template_part( 'page-templates/partials/content', 'none' ); ?>

			<?php endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .columns end -->

</div><!-- .row end -->

<?php get_footer(); ?>
