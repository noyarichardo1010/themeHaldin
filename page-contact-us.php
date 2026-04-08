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
      <div class="container full-height landing-page py-5" style="margin-top: 10rem;">
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
    <!-- Others Sections -->
    <div class="wrap_bottom_contact_us">
      <div class="container">
        <h3 class="title">Production Facilities</h3>
          <p>Our facilities are designed to support diverse processing capabilities including spray drying, vacuum extraction, fermentation, and
          concentration. This allows us to transform raw botanicals into high-performance, ready-to-use natural ingredients.</p>

          <div class="row">
            <div class="col-12 col-md-3">
              <div class="card_contact">
                <h5>Plant Cibitung</h5>
                <h6>Jl. Irian V Blok MM-2 Cibitung Industrial Town MM2100 Cibitung, Bekasi 17520</h6>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15862.533517179261!2d107.08747839457439!3d-6.311799721085247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699076b258ca17%3A0x582d15392dee08cc!2sPT.%20Haldin%20Pacific%20Semesta!5e0!3m2!1sid!2sid!4v1766986961352!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
            <div class="col-12 col-md-3">
              <div class="card_contact">
                <h5>Plant Cikarang</h5>
                <h6>Kawasan Industri Cikarang Blok C/3-A, Jl Jababeka IV, Cikarang Utara, Bekasi, West Java 17530</h6>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63450.147341717624!2d107.05657824828866!3d-6.311691360700698!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69852c87b63b2b%3A0x65901ff064fe0957!2sPT%20Haldin%20Pacific%20Semesta%20-%20Plant%20Cikarang!5e0!3m2!1sid!2sid!4v1766987378213!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
            <div class="col-12 col-md-3">
              <div class="card_contact">
                <h5>Plant Setu</h5>
                <h6>Jl. Metro-Telajung RT 02/RW 06, Desa Telajung, Cikarang Barat, Bekasi 17530, West Java</h6>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15862.142597732058!2d107.04426763955078!3d-6.324552599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69905109850427%3A0x7365441b11b5d161!2sPT%20Haldin%20Pacific%20Semesta!5e0!3m2!1sid!2sid!4v1766987426596!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
            <div class="col-12 col-md-3">
              <div class="card_contact">
                <h5>Plant Lampung</h5>
                <h6>Jl. Lintas Sumatra, Bumiagung, Kec. Tegineneng, Kabupaten Pesawaran, Lampung 35363</h6>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.522266275873!2d105.17698697478387!3d-5.180244152280235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40b7b009996e35%3A0xd7bbfe0a1240a82b!2sPT%20Haldin%20Pacific%20Semesta%20-%20Plant%20Lampung!5e0!3m2!1sid!2sid!4v1766987451896!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
          </div>
      </div>

    </div>


	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
