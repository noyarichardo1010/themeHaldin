<?php get_header();

?>
<section class="landing-page full-height">
  <div class="container py-5">
    <div class="row mb-5">
      <div class="col-12 mb-5">
        <form class="mb-0" method="get" action="<?php echo esc_url(home_url('/')); ?>">
          <div class="input-group">
            <input type="text" class="form-control" name="s" placeholder="Search"
                   value="<?php echo get_search_query(); ?>"
                   aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
            </div>
          </div>
        </form>
      </div>
    </div>
			<?php
				if (have_posts()): ?>
					<?php while (have_posts()):
						the_post();
						get_template_part('template/loop/main-loop');
					endwhile;
					  get_template_part('template/component/pagination');
			endif; ?>
    </div>
</section>
<?php get_footer(); ?>
