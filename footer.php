<?php wp_footer();
if (!is_home()) {
	$url = get_site_url();
}
?>
<footer class="py-3">
  <div class="container">
    <div class="row">
      <div
        class="col-lg-6 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-0 mb-3 d-flex
        align-items-center
        justify-content-lg-start
        flex-lg-row flex-md-row flex-sm-column flex-column text-lg-right text-md-right text-center
        justify-content-center">
        <a href="<?php echo $url; ?>/terms-conditions" class="mr-2">Term & Condition</a> <a class="mx-2"
                                                        href="<?php echo get_site_url(); ?>/privacy-policy">Privacy
          Policy</a>
        <a class="nav-link scroll mx-2 p-0" href="https://haldin.com/category/media">Media</a>
        <a class="nav-link scroll mx-2 p-0" href="https://www.linkedin.com/company/pt-haldin-pacifik-semesta">Follow Us</a>
        <a class="nav-link scroll p-0 ml-2" href="https://career.haldingroup.com/">Career</a>
      </div>
      <div
        class="col-lg-6 col-md-6 col-sm-12 col-12 d-flex align-items-center justify-content-lg-end justify-content-center" style="font-size: 12px;">
        Copyright <?php echo date('Y'); ?> Haldin. All Right Reserved
      </div>
    </div>
  </div>
</footer>
</body>
</html>
