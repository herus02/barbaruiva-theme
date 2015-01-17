<?php get_template_part('templates/page', 'header'); ?>


<?php
// Album posts
$loop = new WP_Query(array('post_type' => 'albuns', 'posts_per_page' => '3', 
        'tax_query' => array(
            array(
                'taxonomy' => $wp_query->query_vars['taxonomy'],
                'field'    => 'slug',
                'terms'    => $wp_query->query_vars['term'],
            )
        )));

if ($loop->have_posts()) {
?>
    <!-- albuns headline -->
    <section id="albums_list">
<?php
      while ($loop->have_posts()) : $loop->the_post();
?>
        <div class="col-md-4 col-sm-6 albums">

<?php
        get_template_part('templates/content','content'); 
?>
        </div>
<?php
      endwhile;
?>
    </section>
<?php
} else {
?>
    <!-- albuns headline -->
    <section id="albums_list" class="empty">
		<h3>Não há álbuns para exibição</h3>
	</section>

<?php
}
?>

