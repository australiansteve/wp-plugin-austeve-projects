<?php
/**
 * Template part for displaying single projects.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 * @package AUSteve Projects
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php 
		$gallery_images = get_field('gallery'); 

		?>

		<div class="cover-image">
			<img class="project-gallery-image" src="<?php echo $gallery_images[0]['sizes']['large'];?>" height="<?php echo $gallery_images[0]['sizes']['large-height'];?>" width="<?php echo $gallery_images[0]['sizes']['large-width'];?>"/>
		</div>

		<?php if (get_field('client')) : ?>
		<div class="client">
			Client: <?php echo get_field('client'); ?>
		</div>
		<?php endif; ?>

		<?php if (get_field('date')) : ?>
		<div class="date">
		<?php 
			$date = get_field('date');
			// $date = 19881123 (23/11/1988)

			// extract Y,M,D
			$y = substr($date, 0, 4);
			$m = substr($date, 4, 2);
			$d = substr($date, 6, 2);

			// create UNIX
			$time = strtotime("{$d}-{$m}-{$y}");

			//Time right now
			$now = new DateTime();
			$currentTime = $now->getTimestamp();

			if ($currentTime < $time) {
				echo "Coming: ";
			}
			else {
				echo "Completion: ";
			}

			// format date (November 11th 1988)
			echo date('F Y', $time);
		?>
		</div>
		<?php endif; ?>

		<div class="description">
		<?php echo get_field('description'); ?>
		</div>

		<div class="materials">
		<?php echo get_field('materials'); ?>
		</div>

		<?php if (count($gallery_images) > 1) { ?>
		<div class="gallery">	

			<div class="row small-up-1 medium-up-3 align-center align-middle">
			<?php
				foreach($gallery_images as $image)
				{
					?>
					<div class="column">
						<img class="project-gallery-image" src="<?php echo $image['sizes']['medium'];?>" height="<?php echo $image['sizes']['medium-height'];?>" width="<?php echo $image['sizes']['medium-width'];?>"/>
					</div>
					<?php
				}
			?>
			</div>
		</div>
		<?php } ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'austeve-projects' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php austeve_projects_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
