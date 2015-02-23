<?php get_template_part('templates/page', 'header'); ?>

<?php 
// Home banner posts
$loop = new WP_Query(array('post_type' => 'home_banner', 'posts_per_page' => '3'));
$total_posts = $loop->found_posts;
if (have_posts()) : 
?>
<!-- Carousel -->
<div id="slider" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
<?php
    for ($i = 0; $i < $total_posts; $i++) {
        $active = ($i == 0) ? ' class="active"' : "";
?> 
        <li data-target="#slider" data-slide-to="<?php echo $i;?>"<?php echo ($i == 0) ? $active : ""; ?>></li>
<?php
    }
?> 
    </ol>

    <div class="carousel-inner" role="listbox">
<?php
    $i = 0;
    $loop = new WP_Query(array('post_type' => 'home_banner', 'posts_per_page' => '3'));
    while ($loop->have_posts()) : $loop->the_post();
        $active = ($i == 0) ? ' active' : "";

?>
        <div class="item<?php echo $active; ?>">
            <?php the_post_thumbnail(array('class' => 'img-responsive')); ?>
            <div class="carousel-caption">
                <h2><?php the_title(); ?></h2>
                <p class="hidden-xs"><?php echo(get_the_excerpt());?> </p>
            </div>
        </div>
<?php
        $i++;
      endwhile;
?>
    </div>

    <a class="left carousel-control" href="#slider" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>

    <a class="right carousel-control" href="#slider" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel -->
<?php
endif; 
?>

<?php 
// Album posts
$loop = new WP_Query(array('post_type' => 'albuns', 'posts_per_page' => '3'));
?>

<?php
if (have_posts()) : 
?>
    <!-- albuns headline -->
    <section id="albums_list">
<?php
      while ($loop->have_posts()) : $loop->the_post();
?>
        <div class="col-md-4 col-xs-12 albums">

<?php
        get_template_part('templates/content','content'); 
?>
        </div>
<?php
      endwhile;
?>
    </section>
<?php
endif; 

// Blog posts
$loop = new WP_Query(array('post_type' => 'post', 'posts_per_page' => '3'));
if (have_posts()) : 
?>
<?php 
$post_type_url = get_post_type_archive_link( 'post' );
?>
    <header id="blog_list_title">
        <h5><a href="<?php echo $post_type_url;?>">O Blog</a></h5>
        <h2><a href="<?php echo $post_type_url;?>">Novidades sobre esporte</a></h2>
    </header>

    <!-- blog headline -->
    <section id="blog_list">
<?php
      while ($loop->have_posts()) : $loop->the_post();
?>
        <div class="col-md-4 col-xs-12 posts">
<?php
        get_template_part('templates/content','posts'); 
?>
        </div>
<?php
      endwhile;
?>
    </section>

<?php
endif;
?>