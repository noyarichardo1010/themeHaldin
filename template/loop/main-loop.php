<?php
$images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
$thumb = '';
if ($images) $thumb = $images[0];
?>
<div class="row mb-3 loop-item">
  <div class="col-lg-3 mb-3">
		<?php if ($thumb): ?>
      <a href="<?php the_permalink(); ?>">
        <div
          style="background-image: url(<?php echo $thumb; ?>); padding-bottom: 60%"
          class="standard-thumbnail">
        </div>
      </a>
		<?php endif; ?>
  </div>
  <div class="col-lg-9 mb-3">
    <a href="<?php the_permalink(); ?>">
      <h3 class="font-weight-bold"><?php the_title(); ?></h3>
    </a>
    <span class="date">
      <?php the_date(); ?>
    </span>
  </div>
</div>
