<?php
  get_header();
?>
<section class="landing-page full-height">
  <div class="container py-5">
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
<?php get_footer();?>
