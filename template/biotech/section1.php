<?php
$post = get_page_by_slug('innovating-life-sciences-for-a-healthier-tomorrow');
if ($post):
	$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
	if ($image) $image = $image[0];
	?>
	<section id="haldin-biotech" style="margin-top: 100px !important;background-image: url(<?php echo $image; ?>)"
					 class="biotech_banner full-height cover d-flex landing-page">
		<div class="container d-flex align-items-lg-center align-items-start">
			<div class="col-lg-6 col-md-6 col-sm-12 col-12 py-lg-0 py-5 position-relative d-flex align-items-center haldin-x-content">
				<div class="home-caption-container" data-aos="fade-up">
					<h1>
						<?php echo $post->post_title;?>
					</h1>
                    <div class="wrap_btn_landing">
                        <a href="#" class="btn_link">Check Out Our Products <i class="fas fa-chevron-right"></i></a>
                    </div>
					<div class="home-caption-content">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

