<?php
$post = get_page_by_slug('we-are-haldin');
if ($post):
	$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
	if ($image) $image = $image[0];
	?>

  <div class="wrap_carousel_slide">
    <?php add_revslider('slider-1'); ?>
  </div>


<?php endif; ?>
