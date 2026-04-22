<?php get_header();
global $wp_query;
$object = get_queried_object();
$image = get_term_meta($object->term_id, 'cover_image', true);
$product_innovation = get_term_by('slug', $object->slug, 'innovation_category');
$product_innovation_link = '#';
if ($product_innovation) $product_innovation_link = get_term_link($product_innovation->term_id);
?>
<section class="landing-page full-height">
  <div class="container-fluid px-0">
    <div
      style="background-image: url(<?php echo wp_get_attachment_url($image); ?>)"
      class="cover page-category-header">
      <div class="container">
        <div class="col-lg-12 col-sm-10">
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
            <div class="col-12 text-center mb-5">
              <a href="<?php echo $product_innovation_link; ?>" class="btn-product-application-mobile text-center">
                Application
                <i class="fa fa-arrow-right"></i>
              </a>
            </div>
			<?php endif; ?>
          <div class="col-12 mb-3 text-right desktop-btn">
            <a href="<?php echo $product_innovation_link; ?>" class="btn-product-application btn btn-rounded text-center">
              Application
              <i class="fa fa-arrow-right"></i>
            </a>
          </div>
					<?php if (have_posts()): ?>
						<?php while (have_posts()): the_post(); ?>
              <div class="col-lg-4 col-md-6 col-sm-12 col-12 product-item mb-5">
                <div
                  style="background-image: url(<?php get_featured_image_by_post_id(get_the_id()); ?>)"
                  class="product-item-image-container standard-thumbnail circle mb-3">
                </div>
                <h4 class="font-weight-bold">
									<?php the_title(); ?>
                </h4>
                <div class="product-item-production-code mb-1">
                  #<?php echo get_post_meta(get_the_id(), 'production_code', true); ?>
                </div>
                <div class="product-item-content mb-3 test">
                  <div class="unexpand-item">
                    <?php echo wp_trim_words(get_the_content(), 8); ?>
										<?php if(strlen(get_the_content()) > 80): ?>
                      <small class="btn-read-more-product-item">
                        Read more
                      </small>
										<?php endif; ?>
                  </div>
                  <div class="expand-item" style="display:none;">
                    <?php echo get_the_content();?>
										<?php if(strlen(get_the_content()) > 100): ?>
                      <small class="btn-read-less-product-item">
                        Read less
                      </small>
										<?php endif; ?>
                  </div>
                </div>

                <a
                  href="<?php echo get_site_url() ?>/request-sample?product_id=<?php echo get_the_ID() ?>&cat_id=<?php echo $object->term_id; ?>"
                  class="btn btn-see-more btn-sm">
                  Request Sample
                </a>
              </div>
						<?php endwhile; ?>
					<?php else: ?>
            <div class="col-12">
              No Product Here
            </div>
					<?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php

get_template_part('template/component/button-whatsapp');
get_footer(); ?>