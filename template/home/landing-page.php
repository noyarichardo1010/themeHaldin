<?php
$post = get_page_by_slug('we-are-haldin');
if ($post):
	$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
	if ($image) $image = $image[0];
	?>
  <section id="home"
           style="background-image: url(<?php echo $image; ?>)"
           class="full-height cover d-flex landing-page">
    <div class="container d-flex align-items-center">
      <div class="col-12 position-relative d-flex align-items-center">
          <div class="home-caption-container" data-aos="fade-up">
            <h1 class="text-shadow">
              <?php echo $post->post_title;?>
            </h1>
            <div class="home-caption-content text-shadow">
              <?php echo $post->post_content; ?>
            </div>
          </div>
      </div>
    </div>
  </section>
<?php endif; ?>
