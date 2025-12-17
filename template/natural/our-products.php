<?php
$args = [
	"post_type" => "page",
	"post_status" => "publish",
	"post_parent" => 99,
	"post_per_page" => 1
];
$query = new WP_Query($args);
?>
<section id="our-products"
         class="position-relative">
  <div class="container-fluid px-0 overflow-hidden position-relative">
    <div class="row px-0 slider-container">
			<?php if ($query->have_posts()): ?>
				<?php while ($query->have_posts()):

					$query->the_post();
					$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
					$button_meta = get_post_meta(get_the_ID(), 'page_button', true)[0];
					$link = $button_meta['button_url'];
					if ($image) $image = $image[0]; ?>
          <div
            style="background-image: url(<?php echo $image; ?>)"
            class="col-12 full-height position-relative cover d-flex align-items-center slider-item">
            <div class="container">
              <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-10 col-10">
                  <div class="home-caption-container" data-aos="fade-up">
                    <h1>
											<?php echo get_the_title() ?>
                    </h1>
                    <div class="home-caption-content">
											<?php the_content(); ?>
                    </div>
                    <a href="<?php echo $link; ?>" class="btn btn-rounded btn-sm btn-see-more scroll">
                      See Products
                    </a>

                  </div>
                </div>
              </div>
            </div>
          </div>
				<?php endwhile; ?>
			<?php endif; ?>
    </div>
    <div class="dots-container text-center">
    </div>
    <div class="slider-navigation slider-left">
      <i class="fa fa-arrow-left"></i>
    </div>
    <div class="slider-navigation slider-right">
      <i class="fa fa-arrow-right"></i>
    </div>
  </div>
	<?php wp_reset_postdata(); ?>
</section>

<section id="our-product-mobile">
  <div class="container py-5">
    <div class="col-10 text-center mx-auto">

      <h3 class="mb-3 font-weight-bold">
        Our Products
      </h3>
      <div class="home-caption-content mb-3">
        We combine Indonesia Finest natural ingredients into unique, good quality, ready-to-consume products
      </div>
      <a href="#product-categories" class="btn btn-rounded btn-sm btn-see-more scroll">
        See Products
      </a>

    </div>
  </div>
</section>
