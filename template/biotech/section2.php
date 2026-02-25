<?php
$page = get_page_by_slug('innovations-biotech');
if ($page):
	$image = wp_get_attachment_image_src(get_post_thumbnail_id($page->ID), 'single-post-thumbnail');
	if ($image) $image = $image[0];

	$child_page = get_page_child_by_parent_id($page->ID);
	?>
  <section id="innovations-biotech" style="background-image: url(<?php echo $image; ?>)" class="about_biotech full-heightx cover">
            <!-- <div
					data-aos-delay="150"
					data-aos="fade-up"
					class="col-lg-6 pt-5">
					<h2 class="origin-title text-white">
						<?php echo $page->post_title; ?>
					</h2>
					<div class="origin-caption">
						<?php echo wpautop($page->post_content); ?>
					</div>
            </div> -->
        <div class="wrap_this_about">
            <?php if ($child_page->have_posts()): ?>
              <?php 
              $no = 1;
              while ($child_page->have_posts()):
                $child_page->the_post(); 

                $bg_class = ($no == 1) ? 'green_bg_' : 'blue_bg_';
              ?>
              
              <div
                data-aos-delay="150"
                data-aos="fade-up"
                class="col-12 col-md-6 mb-3 origin-item">

                <div class="wrap_card_biotech row">

                  <?php if (has_post_thumbnail()): ?>
                    <img 
                      src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" 
                      alt="<?php echo esc_attr(get_the_title()); ?>" 
                      class="col-12 col-md-7 img-fluid p-0"
                    >
                  <?php endif; ?>

                  <div class="col-12 col-md-5 wrap_content <?php echo $bg_class; ?>">
                    <h3 class="font-weight-bold">
                      <?php echo get_the_title(); ?>
                    </h3>
                 
                    <?php
                      $content = get_the_content();
                      $content = apply_filters('the_content', $content);
                      $blocks = explode('</p>', $content);
                      $first_paragraph = strip_tags($blocks[0]);
                      $limited_text = wp_trim_words($first_paragraph, 30, '...');
                      ?>

                      <p>
                        <?php echo esc_html($limited_text); ?>
                      </p>

                    <!-- <button class="btn btn-rounded btn-origin btn-sm">Read More</button> -->
                    <button 
                      class="btn btn-rounded btn-origin btn-sm"
                      data-toggle="modal"
                      data-target="#modal-<?php echo get_the_ID(); ?>">
                      Read More
                    </button>
                  </div>

                </div>
              </div>


              <!-- Modal -->
              <div class="modal modal_biotech fade" id="modal-<?php echo get_the_ID(); ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h5 class="modal-title">
                        <?php echo get_the_title(); ?>
                      </h5>
                      <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <?php
                        echo apply_filters('the_content', get_the_content());
                      ?>
                    </div>

                  </div>
                </div>
              </div>

              <?php 
                $no++;
              endwhile; 
              ?>
            <?php endif; ?>
          </div>
  </section>
<?php endif; ?>
