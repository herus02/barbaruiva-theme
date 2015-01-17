<?php
$tax = get_object_taxonomies(get_post_type());
$terms = get_the_term_list(get_the_id(), $tax, '',' / ');
?>

<h5><?php echo $terms; ?></h5>  <time class="updated" datetime="<?php echo get_the_time('c'); ?>">/ <?php echo get_the_date(); ?></time>
