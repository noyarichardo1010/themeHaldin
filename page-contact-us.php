<?php
$is_success = false;

if (isset($_POST['submit'])) {
	$data = [
		'first_name' => $_POST['first_name'],
		'last_name' => $_POST['last_name'] ?? '',
		'email' => $_POST['email'],
		'description' => $_POST['description']
	];

	send_email_contact_us($data);
	$is_success = true;
}

get_header();

?>
<?php if (have_posts()): ?>
	<?php while (have_posts()): the_post();

		$images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
		$thumb = '';
		if ($images) $thumb = $images[0];
		?>
    <style>
.wp-block-columns{
  margin-bottom: 0.75em;
}
      </style>
    <section style="background-image: url(<?php echo $thumb ?>)" class="cover"
    >
      <div
        class="container full-height landing-page py-5">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3 text-white">
            <h1 class="font-weight-bold mb-5">
							<?php the_title(); ?>
            </h1>
            <div>
							<?php the_content(); ?>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
						<?php if ($is_success): ?>
              <div class="alert alert-success text-center">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                Thank you for contacting us, our team will answer your question right away.

              </div>
						<?php endif; ?>
            <div class="card contact-form">
              <div class="card-body">
                <form method="post">
                  <div class="form-group" style="text-align: left;">
                    <label for="">
                      Name
                    </label>
                    <input type="text" name="first_name" class="form-control" value="" required="true"/>
                  </div>
                  <div class="form-group mb-3" style="text-align: left;">
                    <label for="">
                      Email
                    </label>
                    <input type="email" name="email" class="form-control" required="true">
                  </div>
                  <div class="form-group" style="text-align: left;">
                    <label for="">
                      Message
                    </label>
                    <textarea name="message" rows="5" class="form-control" required></textarea>
                  </div>
                  <div class="form-group" style="text-align: left;">
                    <input type="submit" name="submit" value="Submit" class="btn btn-white btn-rounded px-5">
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
