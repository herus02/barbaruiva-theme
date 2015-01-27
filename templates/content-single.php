<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <figure>
        <?php the_post_thumbnail('post-thumb', 'img-responsive'); ?>
      </figure>
    
      <div class="content">
        <?php the_content(); ?>       
      </div>
    </div>
    <?php //comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
