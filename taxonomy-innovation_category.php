<?php get_header();
$object = get_queried_object();
$image = get_term_meta($object->term_id, 'cover_image', true);
$title = get_term_meta($object->term_id, 'category_page_title', true);
?>
<section class="landing-page full-height innovation-category">
  <div class="container-fluid px-0">
    <div
      style="background-image: url(<?php echo wp_get_attachment_url($image); ?>)"
      class="cover page-category-header">
      <div class="container">
        <div class="col-lg-8 col-sm-11">
          <h2 class="page-header-title text-white text-shadow">
						<?php echo $title; ?>
          </h2>
          <div class="page-header-caption text-white text-shadow">
						<?php echo $object->description; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container py-5">
    <div class="row position-relative">
      <div class="col-12 text-center mb-5">
        <a href="#" onclick="window.history.back();" class="btn-product-application-mobile text-center">
          <i class="fa fa-arrow-left"></i> Back
        </a>
      </div>
      <div class="col-12 mb-5 text-left desktop-btn">
        <a onclick="window.history.back();" class="btn-product-application btn btn-rounded text-center">
          <i class="fa fa-arrow-left"></i> Back
        </a>
      </div>
			<?php if (have_posts()): ?>
				<?php
				while (have_posts()): the_post();
					$taxonomy = get_the_terms($post->ID, 'innovation_type');
					$tax_name = '';
					if (count($taxonomy) > 0) {
						$tax_name = $taxonomy[0]->name;
					}
					?>
          <div class="col-lg-3 col-md-6 col-sm-12 col-12 product-item mb-5 position-relative">
            <h5 class="text-left mb-3 font-weight-bold">
							<?php echo $tax_name; ?>
            </h5>
              <div
                style="background-image: url(<?php get_featured_image_by_post_id(get_the_id()); ?>); width: 80%; padding-bottom: 80%"
                class="product-item-image-container standard-thumbnail mx-auto mb-3">
              </div>
              <h6 class="text-center">
								<?php the_title(); ?>
              </h6>
							<?php if ($post->post_content): ?>
                <div class="innovation-description transition text-center">
                  <h4 class="text-center font-weight-bold mb-0">
										<?php the_title(); ?>
                  </h4>
									<?php the_content(); ?>
                </div>
							<?php endif; ?>
          </div>
				<?php endwhile; ?>
			<?php endif; ?>
    </div>
  </div>
</section>
<?php
get_template_part('template/component/button-whatsapp');
get_footer(); ?>
