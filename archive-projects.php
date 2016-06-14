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

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

				<div class="row project-archive-item">

					<div class="small-12 columns">

			            <a href='<?php echo get_permalink(); ?>' class=''>

	            			<div class="row columns">
								<?php 
									$gallery = get_field('project_gallery', $post->ID); 
									//var_dump($gallery);
									if ($gallery) {
										//Use the first image in the gallery
										echo "<div class='gallery'><img src='".$gallery[0]['url']."'/></div>";
									}
									else {
										//Shouldn't happen
										echo "<div class='gallery-placeholder'>Placeholder</div>";
									}
								?>
							</div>
				
	            			<div class="row columns">
								<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
								<p><?php echo get_field('project_snippet', $post->ID); ?></p>
							</div>
				
			            </a>

					</div>

				</div> <!-- .project-archive-item.image -->

				<?php endwhile; ?>

				<?php the_posts_navigation(); ?>

			<?php else : ?>

				<?php get_template_part( 'page-templates/partials/content', 'none' ); ?>

			<?php endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .columns end -->

</div><!-- .row end -->

<?php get_footer(); ?>
