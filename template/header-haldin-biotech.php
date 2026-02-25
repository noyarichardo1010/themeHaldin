<?php $url = '';
if (!is_home()) {
  $url = get_site_url();
}
?>

<nav class="header_biotech navbar navbar-expand-lg main-header">
  <div class="container d-flex align-items-center justify-content-between">

    <!-- Logo -->
    <a class="navbar-brand" href="<?php bloginfo('url'); ?>">
      <img src="<?php echo get_template_directory_uri(); ?>/images/bio/logo-header.png" 
           alt="Haldin Biotech" 
           class="img-fluid header-logo">
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
      <ul class="navbar-nav header-menu">

        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url; ?>/about">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url; ?>/solutions">Solutions</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url; ?>/sustainability">Sustainability</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url; ?>/contact">Contact</a>
        </li>

      </ul>
    </div>

  </div>
</nav>