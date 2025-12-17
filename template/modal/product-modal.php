<?php
$image = get_term_meta($term->term_id, 'cover_image', true);
?>

<div class="<?php echo $term->name; ?> position-relative">
	<div
		style="background-image: url(<?php echo wp_get_attachment_url($image); ?>)"
		class="<?php echo $titleColor; ?> modal-header-container">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-12 col-12 mx-auto">
					<h1 class="modal-header-title  text-shadow">
						<?php echo $term->name; ?>
					</h1>
          <div class="modal-header-caption">
            <?php echo $term->description; ?>
          </div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-12 col-12 mx-auto p-0 body-content scrollbar-rail">
					<div class="px-5">
            <div class="row">
              <?php if($query->have_posts()): ?>
                <?php while($query->have_posts()):
                    $query->the_post();
                  ?>
                    <div class="col-4 product-item  mb-3">
                      <div
                        style="background-image: url(<?php get_featured_image_by_post_id(get_the_id());?>)"
                        class="product-item-image-container standard-thumbnail circle mb-3">
                      </div>
                      <h4 class="font-weight-bold">
                        <?php the_title();?>
                      </h4>
                      <div class="product-item-production-code mb-1">
												#<?php echo get_post_meta(get_the_id(), 'production_code', true); ?>
                      </div>
                      <div class="product-item-content mb-3">
                        <?php echo wp_trim_words(get_the_content(), 8);?>
                      </div>
                      <div class="btn btn-see-more btn-sm">
                        Request Sample
                      </div>
                    </div>
                <?php endwhile; ?>
              <?php else: ?>
                No Product in this section
              <?php endif; ?>
            </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
