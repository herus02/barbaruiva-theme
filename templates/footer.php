<footer class="content-info" role="contentinfo">
  <div class="container-fluid">
    <div class="col-md-3">
    	<h4>Links</h4>
<?php
		if (has_nav_menu('footer')) :
			wp_nav_menu(array('theme_location' => 'footer', 'walker' => new Roots_Nav_Walker(), 'menu_class' => 'menu-footer'));
		endif;
?>
    </div>
    <div class="col-md-3">
<?php
			dynamic_sidebar('footer-1'); 
?>
    </div>
    <div class="col-md-3">
    	<h4>Redes sociais</h4>
<?php
		if (has_nav_menu('footer')) :
			wp_nav_menu(array('theme_location' => 'social', 'walker' => new Roots_Nav_Walker(), 'menu_class' => 'menu-social'));
		endif;
?>
    	<address>
<?php
			dynamic_sidebar('footer-2'); 
?>
    	</address>

    </div>
    <div class="col-md-3 logo_footer">
    	<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo_footer.svg" class="img-responsive" alt=""></a>
    	<p>Fotografia esportiva.</p>
    </div>
  </div>
</footer>
	