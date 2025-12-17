<?php
$page = get_page_by_slug('origin');
if ($page):
	$image = wp_get_attachment_image_src(get_post_thumbnail_id($page->ID), 'single-post-thumbnail');
	if ($image) $image = $image[0];

	$child_page = get_page_child_by_parent_id($page->ID);
	?>
  <section id="origin"
           style="background-image: url(<?php echo $image; ?>)"
           class="full-height cover d-flex">
    <div class="container">
			<div class="row py-5">
				<div
					data-aos-delay="150"
					data-aos="fade-up"
					class="col-lg-6 pt-5">
					<h2 class="origin-title">
						<?php echo $page->post_title; ?>
					</h2>
					<div class="origin-caption">
						<?php echo wpautop($page->post_content); ?>
					</div>
				</div>
			</div>
      <div class="row py-5">
				<?php if ($child_page->have_posts()): ?>
					<?php while ($child_page->have_posts()):
						$child_page->the_post(); ?>
            <div
              data-aos-delay="150"
              data-aos="fade-up"
              class="col-lg-4 col-md-12 col-sm-12 col-12 mb-3 origin-item my-5">
              <div class="origin-item-container pb-3 px-3">
                <h3 class="font-weight-bold" style="height:50px;">
									<?php echo get_the_title(); ?>
                </h3>
                <div class="origin-item-content mb-3">
									<?php echo get_the_excerpt() ?>
                </div>
                <button
									open-modal
									data-id="<?php echo get_the_id();?>"
									data-type="page"
									data-target="main-modal"
									data-job="get-detail"
									data-title-color="white"
									class="btn btn-rounded btn-origin btn-sm">
									See More
								</button>
              </div>
            </div>
					<?php endwhile; ?>
				<?php endif; ?>
      </div>
    </div>
  </section>
<?php endif; ?>
