<?php get_header();
$object = get_queried_object();
$image = get_term_meta($object->term_id, 'cover_image', true);

?>
<section class="landing-page">
  <div class="container-fluid px-0">
    <div
      style="background-image: url(<?php echo wp_get_attachment_url($image); ?>)"
      class="cover page-category-header">
      <div class="container">
        <div class="col-lg-6 col-sm-10">
          <h1 class="page-header-title text-shadow">
						<?php echo $object->name; ?>
          </h1>
          <div class="page-header-caption text-white text-shadow">
						<?php echo $object->description; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container py-5">
    <div class="row position-relative">
      <div class="col-11 body-content scrollbar-rail mx-auto">
        <div class="row">
					<?php if (have_posts()): ?>
						<?php while (have_posts()): the_post(); ?>
              <div class="col-4 product-item mb-5">
                <div
                  style="background-image: url(<?php get_featured_image_by_post_id(get_the_id()); ?>)"
                  class="product-item-image-container standard-thumbnail circle mb-3">
                </div>
                <h4 class="font-weight-bold w-50">
									<?php the_title(); ?>
                </h4>
                <div class="product-item-production-code mb-1">
                  #<?php echo get_post_meta(get_the_id(), 'production_code', true); ?>
                </div>
                <div class="product-item-content mb-3">
									<?php echo wp_trim_words(get_the_content(), 8); ?>
                </div>
                <div class="btn btn-see-more btn-sm">
                  Request Sample
                </div>
              </div>
						<?php endwhile; ?>
					<?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>
