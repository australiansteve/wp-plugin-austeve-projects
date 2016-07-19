<?php
/**
 * Template part for displaying the archive of projects.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 * @package AUSteve projects
 */
?>
<div class="small-12 columns">

	<div class="container project-archive-item">

		<div class="row">

			<a href="<?php echo get_permalink(); ?>">
			
				<div class="small-12 columns project-image">

					<div class="image">

						<?php $gallery = get_field('project-gallery'); ?>
				      	<img class="" alt="" src='<?php echo $gallery[0]['sizes']['large'] ?>' />
					      
				      	<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

						<p class="project-snippet"><?php echo get_field('project-snippet'); ?></p>

					</div>

				</div>

			</a>

		</div>

	</div>

</div>
