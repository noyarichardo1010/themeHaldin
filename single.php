<?php get_header();
$images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
$thumb = '';
if ($images) $thumb = $images[0];

?>
<div class="landing-page full-height single-page">
  <div class="container py-5">
    <div class="row">
			<?php if (have_posts()): ?>
				<?php while (have_posts()): the_post(); ?>
          <div class="col-lg-8 col-md-10 col-sm-12 col-12 mb-3 mx-auto">
						<?php if ($thumb): ?>
              <div
                style="background-image: url(<?php echo $thumb ?>); padding-bottom: 60% "
                class="standard-thumbnail mb-5"></div>
						<?php endif; ?>
            <h1 class="font-weight-bold">
							<?php the_title(); ?>
            </h1>
            <div class="date">
							<?php the_date(); ?>
            </div>
            <div class="entry-content">
							<?php the_content(); ?>
            </div>
          </div>
				<?php endwhile; ?>
			<?php endif; ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
