<?php
$post = get_page_by_slug('our-story');
if ($post):
	$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
	if ($image) $image = $image[0];
	?>

<section id="our-story" class="our-story-bg urStor overflow-hidden mobile_v">
  <div class="wrap_our_story row position-relative row-our-story ">
      <div class="img-content col-lg-7 col-sm-12 col-md-12 col-12 p-0">
          <img class="img_profile" src="<?php echo $image; ?>" alt="img_profile" />
      </div>
      <div class="text-content text-white col-lg-5 col-sm-12 col-md-12 col-12" data-aos-delay="200" data-aos="fade-up">
          <!-- <h2 class="mb-3">
            <?php echo $post->post_title; ?>
          </h2> -->
          <?php echo $post->post_content; ?>
      </div>
  </div>
</section>

<?php endif; ?>
<?php
$second_post = get_page_by_slug('our-belief-parent');
if ($second_post):
	$child_page = get_page_child_by_parent_id($second_post->ID);
	$image = wp_get_attachment_image_src(get_post_thumbnail_id($second_post->ID), 'single-post-thumbnail');
	if ($image) $image = $image[0];
	?>
  <section id="our-story-second"
           style="background-image: url(<?php echo $image; ?>)"
           class="full-height cover d-flex">
    <div class="container d-flex align-items-center">
      <div class="row py-5 w-100">
				<?php if ($child_page->have_posts()): ?>
					<?php while ($child_page->have_posts()):
						$child_page->the_post(); ?>
            <div
              data-aos-delay="150"
              data-aos="fade-up"
              class="col-lg-4 col-md-12 col-sm-12 col-12 mb-3 origin-item align-items-center d-flex justify-content-center my-3">
              <div class="origin-item-container our-story-item text-center d-flex align-items-start justify-content-center">
                <div class="px-5">
                  <h3 class="font-weight-bold">
										<?php echo get_the_title(); ?>
                  </h3>
                  <div class="origin-item-content">
										<?php echo get_the_content() ?>
                  </div>
									<?php
									  get_child_menu_buttons_by_parent_id(get_the_ID());
									?>
                </div>
              </div>
            </div>
					<?php endwhile; ?>
				<?php endif; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

