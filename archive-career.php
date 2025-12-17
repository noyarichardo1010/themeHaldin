<?php get_header() ?>
<section class="landing-page full-height career-page">
  <div class="container py-5">
    <div class="row mb-5">
      <div class="col-12">
        <h1 class="text-center font-weight-bold">
          Career Opportunity
        </h1>
      </div>
    </div>
    <div class="row mb-5">
			<?php
			if (have_posts()): ?>
				<?php while (have_posts()):
					the_post();
					get_template_part('template/loop/career-loop');
				endwhile;
				get_template_part('template/component/pagination');
			endif; ?>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <h3 class="font-weight-bold">
          Employee Outlook
        </h3>
      </div>
    </div>
		<?php
		$args = [
			"posts_per_page" => -1,
			"post_type" => "employee_outlook",
			"post_status" => "publish"
		];

		$query = new WP_Query($args);

		if ($query->have_posts()) {
		while ($query->have_posts()) {
		$query->the_post();
		$image = wp_get_attachment_image_src(get_post_thumbnail_id($query->ID), 'single-post-thumbnail');
		if ($image) $image = $image[0];
		?>
    <div class="row border-bottom">
      <div class="col-lg-2 col-md-3 col-sm-4 col-4 my-3 mx-auto">
        <div class="standard-thumbnail circle"
             style="background-image: url(<?php echo $image ?>)"></div>
      </div>
      <div class="col-12 mx-auto mb-3">
        <div class="row">
          <div class="col-8 mx-auto">
						<?php echo get_the_content() ?>
          </div>
        </div>
      </div>
    </div>
  </div>
	<?php
	}
	}
	?>

</section>
<?php get_footer() ?>
