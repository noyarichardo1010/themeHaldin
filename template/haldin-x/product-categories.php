<?php
$post = get_page_by_slug('delicious-way-to-detox');
if ($post):
	$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
	if ($image) $image = $image[0];
	?>
  <section id="product-categories"
           style="background-image: url(<?php echo $image; ?>)"
           class="full-height cover d-flex product-categories-x bg-part-1">
    <div class="container d-flex align-items-lg-center align-items-start position-relative">
      <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-lg-0 py-5 d-flex align-items-center ml-auto">
        <div class="home-caption-container " data-aos="fade-up">
          <h1 class="titleH1">
						<?php echo $post->post_title; ?>
          </h1>
          <div class="home-caption-content">
						<?php the_excerpt(); ?>
          </div>
          <div class="mb-3">
						<?php the_content(); ?>
          </div>
          <div class="text-lg-left text-center un-flying-button">
            <a href="<?php echo get_site_url() ?>/haldin-x-product-request" class="btn btn-sm btn-rounded btn-request">
              Request Product
            </a>
          </div>
        </div>
      </div>
      <div class="text-lg-left text-center flying-button py-3">
        <a href="<?php echo get_site_url() ?>/haldin-x-product-request" class="btn btn-sm btn-rounded btn-request">
          Request Product
        </a>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php
$post = get_page_by_slug('spice-up-your-coffee-breaks');
if ($post):
	$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
	if ($image) $image = $image[0];
	?>
  <section style="background-image: url(<?php echo $image; ?>)"
           class="full-height cover d-flex product-categories-x bg-part-2">
    <div class="container d-flex align-items-lg-center align-items-end">
      <div class="col-lg-6 col-md-6 col-sm-12 col-12  py-lg-0 py-5 d-flex align-items-center ml-auto">
        <div class="home-caption-container" data-aos="fade-up">
          <h1 class="titleH1">
						<?php echo $post->post_title; ?>
          </h1>
          <div class="home-caption-content">
						<?php the_excerpt(); ?>
          </div>
          <div class="mb-3">
						<?php the_content(); ?>
          </div>
          <!-- <div class="text-lg-left text-center">
            <a href="<?php echo get_site_url() ?>/haldin-x-product-request" class="btn btn-sm btn-rounded btn-request">
              Request Product
            </a>
          </div> -->
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<style>

@media (max-width: 480px) {
  .product-categories-x.bg-part-2 {
      background-color: #3f7f92;
      background-size: 140%;
      background-position: -38% -47%;
  }
  .titleH1 {
    margin-top: 140px;
  }
}
@media (max-width: 375px) {
	.titleH1 {
		margin-top: 117px;
	}
  .product-categories-x.bg-part-2 {
    background-color: #3f7f92;
    background-size: 140%;
    background-position: -35% -40% !important;
  }
}
@media (max-width: 320px) {
	.titleH1 {
		margin-top: 104px;
	}
  .product-categories-x.bg-part-2 {
      background-color: #3f7f92;
      background-size: 140%;
      background-position: -35% -20% !important;
  }
}


</style>