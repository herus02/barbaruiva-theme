<?php
$obj = get_post();
      $p_type = get_post_type_object($obj->post_type);
      //print_r($obj);
?>
	<article <?php post_class(); ?>>
		<header>
			<?php if (!is_archive()) { get_template_part('templates/entry-meta'); } ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header>
		<figure>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumb', 'img-responsive'); ?></a>
		</figure>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<a href="<?php the_permalink();?>">Veja mais</a>
		</div>
	</article>
