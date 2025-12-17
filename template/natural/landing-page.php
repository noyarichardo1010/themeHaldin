<style>
	/* @media(max-width: 768px) {
		min-height: 50vh;
	} */
  </style>
<?php
$post = get_page_by_slug('from-indonesian-farmlands-to-60-countries');
if ($post):
	$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
	if ($image) $image = $image[0];
	?>
	<section id="haldin-natural"
					 style="background-image: url(<?php echo $image; ?>)"
					 class="full-height cover d-flex landing-page">
		<div class="container d-flex align-items-center">
      <div class="row flex-lg-row-reverse flex-row-reverse d-flex align-items-center">
        <div
          style="background-image: url(<?php echo $image; ?>)"
          class="col-lg-2 col-md-12 col-sm-12 col-12 position-relative d-flex align-items-center image-container">
        </div>
        <div class="col-lg-10 col-md-12 col-sm-12 col-12 position-relative d-flex align-items-center">
          <div class="home-caption-container w-50" data-aos="fade-up">
            <h1>
							<?php echo $post->post_title;?>
            </h1>
            <div class="home-caption-content">
							<?php the_excerpt(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
	</section>
<?php endif; ?>
