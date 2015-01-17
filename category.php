<?php get_template_part('templates/page', 'header'); 

// Blog posts
$loop = new WP_Query(array('post_type' => 'post'));
if (have_posts()) : 
?>
    <!-- blog headline -->
    <section id="blog_list">
<?php
      while ($loop->have_posts()) : $loop->the_post();
?>
        <div class="col-md-4 col-sm-6 posts">
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