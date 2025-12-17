<nav class="navbar navbar-expand-lg navbar-light bg-white main-navigation pt-0">
	<div class="container">
		<a class="navbar-brand" href="<?php bloginfo('url'); ?>">
			<img src="<?php echo get_template_directory_uri(); ?>/images/logo-haldin-x.png" class="img-fluid logo" alt="">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
						aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav nav-fill w-100">
				<li class="nav-item">
					<a class="nav-link scroll" href="#our-products">Our Products</a>
				</li>
				<li class="nav-item">
					<a class="nav-link scroll" href="#product-categories">Product Categories</a>
				</li>
				<li class="nav-item">
					<a class="nav-link scroll" href="#">Contact Us</a>
				</li>
			</ul>
			<?php get_template_part('template/socmed-navbar'); ?>
		</div>
	</div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light secondary-navbar">
	<div class="container">
		<div class="collapse navbar-collapse">
			<ul class="nav nav-fill w-100">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo get_site_url(); ?>/">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt=""
								 class="img-fluid">
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo get_site_url(); ?>/haldin-natural">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="" class="img-fluid">
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="https://www.haldinfoods.com/" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logo-haldin-foods.png" alt=""
								 class="img-fluid">
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
