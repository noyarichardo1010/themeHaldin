<?php
$job_type = get_post_meta(get_the_ID(), 'job-type', true);
$site_type = get_post_meta(get_the_ID(), 'job-location', true);
$headline = get_post_meta(get_the_ID(), 'career_headline', true);
?>
<div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3 career-item">
  <div class="card">
    <div class="card-body">
      <a href="<?php the_permalink(); ?>">
        <h3 class="font-weight-bold"><?php the_title(); ?></h3>
      </a>
      <div class="content mb-5">
				<?php
          echo $headline;
        ?>
      </div>
      <div class="row">
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
        <div class="col-lg-6 col-md-12 col-sm-12 col-12 d-flex align-items-end justify-content-end">
          <a href="<?php the_permalink();?>" class="btn btn-sm text-danger">
            View Detail
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

