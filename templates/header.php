<header class="banner navbar navbar-default navbar-static-top" role="banner">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><span><?php bloginfo('name'); ?></span></a>
		</div>

		<nav class="collapse navbar-collapse" role="navigation">
<?php
		if (has_nav_menu('primary_navigation')) :
			wp_nav_menu(array('theme_location' => 'primary_navigation', 'walker' => new Roots_Nav_Walker(), 'menu_class' => 'nav navbar-nav'));
		endif;
/*
?>
			<form class="navbar-form" role="search" action="<?php echo home_url( '/' ); ?>">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="<?php echo _x( 'Buscar...', 'placeholder' ) ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Buscar por:', 'label' ); ?>">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-default">
							<span class="glyphicon glyphicon-search">
								<span class="sr-only"><?php echo esc_attr_x( 'Buscar', 'button' ) ?></span>
							</span>
						</button>
					</span>
				</div>
			</form>
<?php
*/
?>

		</nav>
	</div>
</header>