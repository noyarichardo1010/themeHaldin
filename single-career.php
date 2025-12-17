<?php get_header(); ?>
<section class="landing-page full-height career-page">
  <div class="container py-5">
    <div class="row">
			<?php if (have_posts()): ?>
				<?php while (have_posts()):
					the_post();
					$job_type = get_post_meta(get_the_ID(), 'job-type', true);
					$site_type = get_post_meta(get_the_ID(), 'job-location', true);
					$link = get_post_meta(get_the_ID(), 'link', true);
					?>
          <div class="col-10 mx-auto">
            <h1 class="mb-5">
							<?php the_title(); ?>
            </h1>
            <div class="row mb-5">
              <div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-3 job-meta">
                <div class="row mb-3">
                  <div class="col-6 font-weight-bold">
                    <i class="fa fa-clock text-primary"></i> Job Type
                  </div>
                  <div class="col-6 font-weight-bold">
                    Publish Date
                  </div>
                  <div class="col-6">
										<?php echo $job_type; ?>
                  </div>
                  <div class="col-6">
										<?php the_date(); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="content">
							<?php the_content(); ?>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <a href="<?php echo get_site_url(); ?>/career" class="text-danger">
                    Back to All Job
                  </a>
                </div>
                <div>
									<?php if ($link): ?>
                    <a href="<?php echo $link; ?>" class="btn btn-sm btn-dark" target="_blank">
                      Apply
                    </a>
									<?php endif ?>
                </div>
              </div>
            </div>
          </div>
				<?php endwhile; ?>
			<?php endif; ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
