<?php $url = '';

if(!is_home()) {
  $url = get_site_url();
}
?>
	<nav class="navbar navbar-expand-lg navbar-light bg-white main-navigation pt-0">
		<div class="container">
      <button class="navbar-toggler position-fixed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
			<a class="navbar-brand" href="<?php bloginfo('url'); ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/images/Logo-Natural-Besar.png" class="img-fluid logo" alt="">
			</a>


			<div class="collapse navbar-collapse custom_header_natural" id="navbarSupportedContent">
				<ul class="navbar-nav mx-auto">
					<!--<li class="nav-item px-3">
						<a class="nav-link scroll" href="<?php echo $url;?>#our-story" style="font-size: 1.3rem;">Our Story</a>
					</li>-->
					<li class="nav-item px-4 mr-0 mr-lg-4">
						<a class="nav-link scroll px-4 mr-0 mr-lg-4" href="<?php echo $url;?>#wework" style="font-size: 1.1rem;font-weight: 600;">How We Work</a>
					</li>
				
					<li class="nav-item px-4 mr-0 mr-lg-4">
						<a class="nav-link scroll px-4 mrr-0 mr-lg-4" href="<?php echo $url;?>#buildingblocks" style="font-size: 1.1rem;font-weight: 600;">Our Building Blocks</a>
					</li>
				
					<li class="nav-item px-4 mr-lg-4 mr-0">
						<a class="nav-link px-4 mr-lg-4 mr-0" href="<?php echo get_site_url();?>/contact-us" style="font-size: 1.1rem;font-weight: 600;">Contact Us</a>
					</li>
					<div class="lang_option02">
						<!-- <?php echo do_shortcode('[lang_switcher_id_en]'); ?> -->
						<!-- <?php echo do_shortcode('[language-switcher]'); ?> -->
					</div>
				</ul>
				<!-- <div class="lang_option">
					<?php echo do_shortcode("[x-currency-switcher id=2430]"); ?>
				</div> -->
        <?php get_template_part('template/socmed-navbar'); ?>
			</div>
		</div>
	</nav>
	<nav class="navbar navbar-expand-lg navbar-light bg-light secondary-navbar">
		<div class="container">
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="nav nav-fill w-100">
							<li class="nav-item">
					<a class="nav-link" href="<?php echo get_site_url(); ?>/haldin-natural">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logo-for-web-rev-05.png" style="margin-top:-10px" alt=""
								 class="img-fluid">
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo get_site_url(); ?>/haldin-x" style="    height: 100%;">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logo-for-web-rev-06.png" alt="" style="margin-top:-10px" class="img-fluid">
					</a>
				</li>
				<li class="nav-item">
            <a class="nav-link" href="<?php echo get_site_url();?>/haldin-foods">
			<img src="<?php echo get_template_directory_uri(); ?>/images/logo-for-web-rev-07.png" alt="" style="margin-top:-10px"  class="img-fluid">

						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="<?php echo get_site_url();?>/haldin-biotech">
						<img src="<?php echo get_template_directory_uri(); ?>/images/bio/logo_haldin_bio.png" alt="" style="margin-top:-10px"  class="img-fluid">

							</a>
					</li>

				</ul>
			</div>
		</div>
	</nav>