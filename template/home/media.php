<?php

$args = [
  'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => 5,
  'category' => 2,
];
$query = new WP_Query($args);
$x = 1;
$y = 1;
if ($query->have_posts()):
while ($query->have_posts()):
$query->the_post();
if ($x == 1) {
?>
<section id="media"    style="background-image: url(<?php get_featured_image_by_post_id(get_the_id()); ?>)"
         class="full-height cover">
  <div class="container-fluid">
    <div class="row">
	
      <div
     
        class="col-lg-6 col-md-12 col-12 cover main-media-item position-relative">
        <div class="main-media-item-container mediaDev" style="padding: 10.5rem 5rem;">
          <div class="date">
						<?php the_date(); ?>
          </div>
          <a href="<?php the_permalink(); ?>">
            <h2>
							<?php the_title(); ?>
            </h2>
          </a>
          <div class="media-item-excerpt">
						<?php echo wp_trim_words(get_the_content(), 30, ''); ?>
          </div>
          <div class="col-12 text-center">
            <a
              href="<?php the_permalink(); ?>"
              class="btn btn-sm btn-see-more mx-auto" style="background-color: rgba(255,255,255,.2);">
              See More
            </a>
          </div>

        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-12 d-flex media-side-container">
        <div class="row mx-3 py-5">
					<?php
					} else {

						if ($x != 5) {
							?>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5 media-secondary-item">
                <div class="date text-white">
									<?php echo get_the_date(); ?>
                </div>
                <a href="<?php the_permalink(); ?>">
                  <h3 class="font-weight-bold media-secondary-item-title mb-4" style="height: 31%;color:white !important;">
										<?php the_title(); ?>
                  </h3>
                </a>
                <div class="col-12 text-lg-left text-md-left text-sm-center text-white text-center px-0">
                  <a
                    href="<?php the_permalink(); ?>"
                    class="btn btn-sm btn-see-more mx-auto" style="background-color: rgba(255,255,255,.2);">
                    See More
                  </a>
                </div>
              </div>
							<?php
						} else {
							?>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-5 media-secondary-item text-white">
                <a href="<?php get_site_url(); ?>/category/media">
                  <div class="date">
										&nbsp;
                  </div>
                  <h3 class="font-weight-bold media-secondary-item-title mb-4 text-white" style="height: 31%;color:white !important;">
										Archive
                  </h3>
                </a>
                <div class="col-12 text-lg-left text-md-left text-center text-white px-0">
                  <a
                    href="<?php get_site_url(); ?>/category/media"
                    class="btn btn-sm btn-see-more mx-auto" style="background-color: rgba(255,255,255,.2);">
                    See More
                  </a>
                </div>
              </div>
							<?php
						}
					}
					$x++;
					endwhile;
					?>
        </div>
      </div>
    </div>
		<?php
		else:
			?>
      <div class="col-12">
        <h4 class="font-weight-bold">
          No Content in this section
        </h4>
      </div>
		<?php
		endif;
		wp_reset_postdata();
		?>
  </div>
  </div>
</section>
