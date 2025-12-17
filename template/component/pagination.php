<div class="text-center">
	<?php

	global $wp_query;
	$big = 999999999;
	$args = array(
		'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages,
		'show_all' => false,
		'end_size' => 1,
		'mid_size' => 2,
		'prev_next' => true,
		'prev_text' => __('«'),
		'next_text' => __('»'),
		'type' => 'array',
		'before_page_number' => '',
		'after_page_number' => ''
	);

	$paginate = paginate_links($args);
	$element = '';
	if ($paginate) {
		$element .= '<nav class="d-flex justify-content-center">';
		$element .= ' <ul class="pagination mx-auto">';
		foreach ($paginate as $key => $value) {
			$element .= '<li class="page-item">' . str_replace('page-numbers', 'page-link', $value) . '</li>';
		}
		$element .= ' </ul>';
		$element .= '</nav>';
	}
	echo $element;
	?>
</div>
