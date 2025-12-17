<?php
function get_top_banner()
{
	$element = get_transient('top_banner');
	if (!$element) {
		$args = [
			'showposts' => 1,
			'post_type' => 'banner',
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'banner_category',
					'field' => 'term_id',
					'terms' => 594,
				)
			)
		];

		$posts = new WP_Query($args);
		$element = '';
		if ($posts->have_posts()) {
			$element .= '<div class="container b-container">';
			$element .= '<div class="row">';
			$element .= '<div class="col">';
			$element .= '<div class="top">';
			while ($posts->have_posts()) {
				$posts->the_post();
				$image = get_field('image', get_the_id());
				$link = get_field('link', get_the_id());
				$code = get_field('code', get_the_id());

				if ($code) {
					$element .= str_replace('<br>', '', htmlspecialchars_decode(str_replace('<br>', '', $code)));
				} else {
					$element .= '<a href="' . $link . '" target="_blank">';
					$element .= '<img src="' . $image . '" class="img-fluid" />';
					$element .= '</a>';
				}

			}
			$element .= '</div>';
			$element .= '</div>';
			$element .= '</div>';
			$element .= '</div>';
		}

		wp_reset_postdata();
		wp_reset_query();

		set_transient('top_banner', $element, 30 * DAY_IN_SECONDS);
	}
	echo $element;
}

function get_float_banner()
{
	$element = get_transient('float_banner');
	if (!$element) {
		$argsLeft = [
			'showposts' => 1,
			'post_type' => 'banner',
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'banner_category',
					'field' => 'term_id',
					'terms' => 595,
				)
			)
		];
		$argsRight = [
			'showposts' => 1,
			'post_type' => 'banner',
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'banner_category',
					'field' => 'term_id',
					'terms' => 596,
				)
			)
		];

		$postLeft = new WP_Query($argsLeft);
		$postRight = new WP_Query($argsRight);
		$element = '';
		if ($postLeft->have_posts() || $postRight->have_posts()) {
			$element .= '<div class="container b-container f-main-container">';
			$element .= '<div class="row">';
			$element .= '<div class="col">';
			if ($postLeft->have_posts()) {
				$element .= '<div class="f-container left">';
				while ($postLeft->have_posts()) {
					$linkHardcode = '#';

					$postLeft->the_post();
					$image = get_field('image', get_the_id());
					$link = get_field('link', get_the_id());
					$code = get_field('code', get_the_id());
					$video_link = get_field('video_link', get_the_id());

					if ($video_link) {
						$linkHardcode = $video_link;
					}

					if ($code) {
						$element .= str_replace('<br>', '', htmlspecialchars_decode(str_replace('<br>', '', $code)));
					} else {
						$element .= '<a href="' . $link . '" target="_blank">';
						$element .= '<img src="' . $image . '" class="img-responsive" />';
						$element .= '</a>';
					}
					$element .= '<a href="' . $linkHardcode . '" target="_blank" class="float-btn"></a>';

				}
				$element .= '</div>';
			}

			if ($postRight->have_posts()) {
				$linkHardcode = '#';
				$element .= '<div class="f-container right">';
				while ($postRight->have_posts()) {
					$postRight->the_post();
					$image = get_field('image', get_the_id());
					$link = get_field('link', get_the_id());
					$code = get_field('code', get_the_id());

					$video_link = get_field('video_link', get_the_id());

					if ($video_link) {
						$linkHardcode = $video_link;
					}

					if ($code) {
						$element .= str_replace('<br>', '', htmlspecialchars_decode(str_replace('<br>', '', $code)));
					} else {
						$element .= '<a href="' . $link . '" target="_blank">';
						$element .= '<img src="' . $image . '" class="img-responsive" />';
						$element .= '</a>';
					}
					$element .= '<a href="' . $linkHardcode . '" target="_blank" class="float-btn"></a>';
				}
				$element .= '</div>';
			}

			$element .= '</div>';
			$element .= '</div>';
			$element .= '</div>';
		}

		wp_reset_postdata();
		wp_reset_query();
		set_transient('float_banner', $element, 30 * DAY_IN_SECONDS);
	}
	echo $element;
}

function right_box_banner($num)
{

	$cat = 604;
	if ($num == 1) {
		$cat = 604;
	} else if ($num == 2) {
		$cat = 605;
	} else if ($num == 3) {
		$cat = 606;
	} else if ($num == 4) {
		$cat = 607;
	}
	$element = get_transient('right_banner_' . $num);
	if (!$element) {
		$args = [
			'showposts' => 1,
			'post_type' => 'banner',
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'banner_category',
					'field' => 'term_id',
					'terms' => $cat,
				)
			)
		];

		$posts = new WP_Query($args);
		$element = '';
		if ($posts->have_posts()) {
			$element = '<div class="box box-r-container">';
			while ($posts->have_posts()) {
				$posts->the_post();
				$image = get_field('image', get_the_id());
				$link = get_field('link', get_the_id());
				$code = get_field('code', get_the_id());

				if ($code) {
					$element .= str_replace('<br>', '', htmlspecialchars_decode(str_replace('<br>', '', $code)));
				} else {
					$element .= '<a href="' . $link . '"sidebar target="_blank">';
					$element .= '<img src="' . $image . '" class="img-responsive" />';
					$element .= '</a>';
				}

			}
			$element .= '</div>';
		}

		wp_reset_postdata();
		wp_reset_query();

		set_transient('right_banner_' . $num, $element, 30 * DAY_IN_SECONDS);
	}
	echo $element;
}

function mid_banner($num)
{
	$cat = [598, 599];
	if ($num == 1) {
		$cat = [598, 599];
	} else if ($num == 2) {
		$cat = [601, 602];
	}
	$element = get_transient('mid_banner_' . $num);
	if (!$element) {
		$i = 0;
		$element .= '<div class="row main-content b-container">';
		foreach ($cat as $key => $value) {
			$args = [
				'showposts' => 1,
				'post_type' => 'banner',
				'post_status' => 'publish',
				'tax_query' => array(
					array(
						'taxonomy' => 'banner_category',
						'field' => 'term_id',
						'terms' => $value,
					)
				)
			];

			$posts = new WP_Query($args);
			if ($posts->have_posts()) {
				$class = 'col-md-8 col-sm-12 col-12 left-container';
				if ($i == 1) {
					$class = 'col-md-4 col-sm-12 col-12 right-container right-small-hide';
				}
				$element .= '<div class="' . $class . '">';
				$element .= '<div class="m-container">';
				while ($posts->have_posts()) {
					$posts->the_post();
					$image = get_field('image', get_the_id());
					$link = get_field('link', get_the_id());
					$code = get_field('code', get_the_id());

					if ($code) {
						$element .= str_replace('<br>', '', htmlspecialchars_decode(str_replace('<br>', '', $code)));
					} else {
						$element .= '<a href="' . $link . '" target="_blank">';
						$element .= '<img src="' . $image . '" class="img-responsive" />';
						$element .= '</a>';
					}

				}
				$element .= '</div>';
				$element .= '</div>';
			}

			wp_reset_postdata();
			wp_reset_query();
			$i++;
		}
		$element .= '</div>';
		set_transient('mid_banner_' . $num, $element, 30 * DAY_IN_SECONDS);
	}
	echo $element;
}

function mid_long_banner($num)
{
	$cat = 597;
	if ($num == 1) {
		$cat = 597;
	} else if ($num == 2) {
		$cat = 600;
	} else if ($num == 3) {
		$cat = 603;
	}

	$element = get_transient('mid_long_banner_' . $num);
	if (!$element) {
		$args = [
			'showposts' => 1,
			'post_type' => 'banner',
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'banner_category',
					'field' => 'term_id',
					'terms' => $cat,
				)
			)
		];

		$posts = new WP_Query($args);
		$element = '';
		if ($posts->have_posts()) {
			$element .= '<div class="row main-content b-container">';
			$element .= '<div class="col">';
			$element .= '<div class="m-container">';
			while ($posts->have_posts()) {
				$posts->the_post();
				$image = get_field('image', get_the_id());
				$link = get_field('link', get_the_id());
				$code = get_field('code', get_the_id());

				if ($code) {
					$element .= str_replace('<br>', '', htmlspecialchars_decode(str_replace('<br>', '', $code)));
				} else {
					$element .= '<a href="' . $link . '" target="_blank">';
					$element .= '<img src="' . $image . '" class="img-responsive" />';
					$element .= '</a>';
				}

			}
			$element .= '</div>';
			$element .= '</div>';
			$element .= '</div>';
		}

		wp_reset_postdata();
		wp_reset_query();

		set_transient('mid_long_banner_' . $num, $element, 30 * DAY_IN_SECONDS);
	}
	echo $element;
}
