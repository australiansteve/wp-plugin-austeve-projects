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

		<a href="<?php echo get_permalink(); ?>">
		
		    <div class="project">

				<?php $gallery = get_field('project-gallery'); ?>
				<div class="bg-image" style="background-image: url('<?php echo $gallery[0]['sizes']['large'] ?>');">
				</div>
				
				<div class="content">

		         	<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		         	<p class="project-snippet"><?php echo get_field('project-snippet'); ?></p>

				</div>

			</div>

		</a>

	</div>

</div>
