<nav class="navbar navbar-expand-lg navbar-light bg-white main-navigation pt-0">
  <div class="container">
    <button class="navbar-toggler position-fixed" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?php bloginfo('url'); ?>">
      <img src="<?php echo get_template_directory_uri(); ?>/images/Logo-haldinfoods-besar.png" class="img-fluid logo" alt="">
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav nav-fill w-100">
        <li class="nav-item">
          <a class="nav-link scroll" href="<?php echo get_site_url(); ?>/contact-us" style="font-size: 1.3rem;">Contact Us</a>
        </li>
        <!-- <div class="lang_option02">
          <?php echo do_shortcode('[gtranslate]'); ?>
        </div> -->
      </ul>
			<?php get_template_part('template/socmed-navbar'); ?>
    </div>
  </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light secondary-navbar" style="padding: 0 !important;">
  <div class="container">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav nav-fill w-100">
      <li class="nav-item">
          <a class="nav-link" href="<?php echo get_site_url(); ?>/">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo-bar-haldin.png" alt=""
                 class="img-fluid">
          </a>
        </li>
        <li class="nav-item">
					<a class="nav-link" href="<?php echo get_site_url(); ?>/haldin-natural">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logo-for-web-rev-05.png" style="margin-top:-10px" alt=""
								 class="img-fluid">
					</a>
				</li>
        <li class="nav-item">
					<a class="nav-link" href="<?php echo get_site_url(); ?>/haldin-x" style="    height: 100%;">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logo-for-web-rev-06.png" alt="" style="margin-top:-25px" class="img-fluid">
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
