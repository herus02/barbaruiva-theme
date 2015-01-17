	<section id="about">
		<article <?php post_class(); ?>>
			<div class="row">
				<div class="col-md-4">
					<?php the_post_thumbnail('post-thumb', 'img-responsive'); ?>
				</div>
				<div class="entry-content col-md-8">
					<?php the_content(); ?>
				</div>
			</div>
	   	</article>
	</section>
 