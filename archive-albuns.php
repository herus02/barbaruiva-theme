<?php get_template_part('templates/page', 'header'); ?>


<?php 
$args = array('order' => 'ASC');
$terms = get_terms('esportes', $args);

if (count($cat) > 0) {
?>
    <!-- albuns headline -->
    <section id="albums_list">
<?php
	foreach($terms as $term) {
		$taxonomy = $term->taxonomy;
		$term_id = $term->term_id;
        $term_name = $term->slug;

		$img_cat = get_field('category_image', $taxonomy."_".$term_id);
		$url = get_term_link($term->slug, $taxonomy);
?>

        <div class="col-md-4 albums">
            <article>
                <figure>
                    <a href="<?php echo $url; ?>"><img src="<?php echo($img_cat['sizes']['album-thumb']); ?>" alt="<?php echo($term->name); ?>"></a>
                </figure>
                <header>
                    <h2 class="entry-title"><a href="<?php echo $url; ?>"><?php echo($term->name); ?></a></h2>
                </header>
                <div class="entry-summary">
                    <p><?php echo($term->description); ?></p>
                </div>
            </article>
        </div>
<?php
	}
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
