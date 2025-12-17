<?php
$page = get_page_by_slug('follow-us');
if ($page):
	$image = wp_get_attachment_image_src(get_post_thumbnail_id($page->ID), 'single-post-thumbnail');
	if ($image) $image = $image[0];

	$child_page = get_page_child_by_parent_id($page->ID);
	?>
	<section id="follow-us" style="background-image: url(<?php echo $image; ?>);" class="full-height cover d-flex">
		<!--test linkeid  -->
		<?php
			// echo do_shortcode('[linkedin_feed]');
		?>
		<div class="container">
				<div class="row py-5">
					<div data-aos-delay="150" data-aos="fade-up" class="col-lg-6 pt-5">
						<h2 class="origin-title">
							<?php echo $page->post_title; ?>
						</h2>
						<div class="origin-caption">
							<?php echo wpautop($page->post_content); ?>
						</div>
					</div>
				</div>
				<div class="row mb-5">
					<div class="col-lg-4 col-md-4 col-12 mb-3 linked_in_embed">
						<?php echo get_theme_mod('linkedin_code'); ?>
					</div>

					
					
					<div class="category-facebook col-md-4 col-12 facebook_h">
						<?php echo do_shortcode('[fbig_facebook_posts]'); ?>
					</div>
					<div class="category-instagram col-md-4 col-12 instagram_h">
						<?php echo do_shortcode('[fbig_instagram_posts]'); ?>
					</div>

					
				</div>
		</div>
	</section>
<?php endif; ?>


