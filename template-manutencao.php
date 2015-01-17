<?php
/*
Template Name: Template de 'Manutenção'
*/
?>
<div style="margin-top: 8%; margin-left: auto; margin-right: auto; width: 300px; height: 300px;">
	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="" class="img-responsive" style="margin-bottom: 30px;">
	<?php while (have_posts()) : the_post(); ?>

    <?php get_template_part('templates/content', 'page'); ?>
	<?php endwhile; ?>
</div>