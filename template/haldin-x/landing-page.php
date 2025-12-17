<?php
$post = get_page_by_slug('expand-your-business-with-creative-natural-products');
if ($post):
	$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
	if ($image) $image = $image[0];
	?>
	<section id="haldin-x" style="margin-top: 165px !important;background-image: url(<?php echo $image; ?>)"
					 class="full-height cover d-flex landing-page">
		<div class="container d-flex align-items-lg-center align-items-start">
			<div class="col-lg-6 col-md-6 col-sm-12 col-12 py-lg-0 py-5 position-relative d-flex align-items-center haldin-x-content">
				<div class="home-caption-container" data-aos="fade-up">
					<h1>
						<?php echo $post->post_title;?>
					</h1>
					<div class="home-caption-content">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<style>
@media (max-width: 1024px) {
  .full-height {
    min-height: 41vh !important;
  }  
  #haldin-x {
	background-position: 76% 0%;
	margin-top: 140px !important;
  }
}

@media (max-width: 480px) {
	#haldin-x.landing-page {
	    background-color: #f0ea79;
	    background-position: 104% 117%;
	    background-size: 180%;
	    height: 126% !important;
	}
}




@media (max-width: 414px) {
	#haldin-x.landing-page {
	    background-color: #f0ea79;
	    background-position: 108% 125%;
	    background-size: 180%;
	    height: 91% !important;
	}
}

@media (max-width: 412px) {
	#haldin-x.landing-page {
	    background-color: #f0ea79;
	    background-position: 108% 125%;
	    background-size: 180%;
	    height: 88% !important;
	}
}
@media (max-width: 375px) {
	#haldin-x.landing-page {
	    background-color: #f0ea79;
	    background-position: 104% 117%;
	    background-size: 180%;
	    height: 91% !important;
	}
}

@media (max-width: 375px) {
#haldin-x.landing-page {
    background-color: #f0ea79;
    background-position: 109% 117%;
    background-size: 180%;
    height: 93% !important;
}
}

@media (max-width: 360px) {
	#haldin-x.landing-page {
	    background-color: #f0ea79;
	    background-position: 109% 116%;
	    background-size: 180%;
	    height: 94% !important;
	}
}


@media (max-width: 320px) {
	#haldin-x.landing-page {
	    background-color: #f0ea79;
	    background-position: 109% 116%;
	    background-size: 180%;
	    height: 109% !important;
	}
}

@media screen and (device-aspect-ratio: 2/3) {
	#haldin-x.landing-page {
		background-color: #f0ea79;
    	background-position: 109% 115%;
    	background-size: 180%;
    	height: 129% !important;
	}
}
</style>
