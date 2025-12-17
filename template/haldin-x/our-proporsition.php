<?php
$post = get_page_by_slug('we-provide-total-solutions-with-the-shortest-time-to-marker');
if ($post):
	$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
	if ($image) $image = $image[0];
	?>
  <section id="our-proporsition"
           style="background-image: url(<?php echo $image; ?>)"
           class="full-height cover d-flex flex-column">
    <div class="container d-flex flex-grow-1 align-items-lg-center align-items-start py-lg-5 p-0">
      <div class="col-lg-6 col-md-6 col-sm-12 col-12 px-lg-3 px-0  position-relative d-flex align-items-center mr-auto left-column">
        <div class="home-caption-container p-lg-0 p-4" data-aos="fade-up">
          <h1>
						<?php echo $post->post_title; ?>
          </h1>
          <div class="home-caption-content">
						<?php the_excerpt(); ?>
          </div>
        </div>
      </div>
    </div>
    <div class="container d-flex flex-grow-0 align-items-center ">
      <?php 	$child_page = get_page_child_by_parent_id($post->ID); ?>
      <div class="row py-5" style="padding-bottom: 1rem !important;">
				<?php if ($child_page->have_posts()): ?>
					<?php while ($child_page->have_posts()):
						$child_page->the_post(); ?>
            <div
              data-aos-delay="150"
              data-aos="fade-up"
              class="col-lg-4 col-md-12 col-sm-12 col-12 mb-3 origin-item">
              <div class="origin-item-container pb-3 px-3">
                <h3 class="font-weight-bold">
									<?php echo get_the_title(); ?>
                </h3>
                <div class="origin-item-content mb-3">
									<?php echo get_the_excerpt() ?>
                </div>
              </div>
            </div>
					<?php endwhile; ?>
				<?php endif; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<style>
@media (max-width: 480px) {
#our-proporsition.cover {
    background-size: 185%;
    background-position: right 27%;
}
}
</style>