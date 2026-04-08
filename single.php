<?php
get_header();

/**
 * ===============================
 * HELPER: GET IMAGE URL FROM ACF
 * ===============================
 */
function get_acf_image_url($field_name, $size = 'full') {
    $img = get_field($field_name);

    if (!$img) return '';

    if (is_array($img) && isset($img['url'])) {
        return $img['url'];
    }

    if (is_string($img)) {
        return $img;
    }

    if (is_numeric($img)) {
        $src = wp_get_attachment_image_src($img, $size);
        return $src ? $src[0] : '';
    }

    return '';
}

// PRODUCT DETAIL DATA
$is_product = function_exists('is_product') && is_product();

// Background utama product
$bg_image = $is_product ? get_acf_image_url('product_image') : '';

// Featured image (thumbnail)
$thumb = '';
$thumb_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
if ($thumb_src) {
    $thumb = $thumb_src[0];
}

// Banner section (khusus product)
$banner_bg    = $is_product ? get_acf_image_url('background_image') : '';
$title_banner = $is_product ? get_field('title_banner') : '';

// Card data
$cards = [
    [
        'icon'  => get_acf_image_url('icon_banner_1'),
        'title' => get_field('title_icon_1'),
        'desc'  => get_field('description_icon_1'),
    ],
    [
        'icon'  => get_acf_image_url('icon_banner_2'),
        'title' => get_field('title_icon_2'),
        'desc'  => get_field('description_icon_2'),
    ],
    [
        'icon'  => get_acf_image_url('icon_banner_3'),
        'title' => get_field('title_icon_3'),
        'desc'  => get_field('description_icon_3'),
    ],
];
?>

<div class="landing-page full-height single-page">

   <!-- BACKGROUND PRODUCT SECTION -->
    <div class="wrap_background_products"
        <?php if ($bg_image): ?>
            style="background-image:url('<?php echo esc_url($bg_image); ?>');"
        <?php endif; ?>
    >
        <div class="container padding_custom">
            <div class="row">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="col-12 mb-3">

                        <?php if ($thumb): ?>
                            <div class="standard-thumbnail mb-5"
                                 style="background-image:url('<?php echo esc_url($thumb); ?>'); padding-bottom:60%;">
                            </div>
                        <?php endif; ?>

                        <h1 class="font-weight-bold"><?php the_title(); ?></h1>
                        <div class="date"><?php the_date(); ?></div>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>

                    </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>

   <!--  BANNER SECTION (PRODUCT ONLY) -->
    <?php if ($is_product): ?>
        <div class="wrap_banner_section_products"
            <?php if ($banner_bg): ?>
                style="background-image:url('<?php echo esc_url($banner_bg); ?>');"
            <?php endif; ?>
        >
            <div class="container">
                <?php if ($title_banner): ?>
                    <h3 class="title_section_banner">
                        <?php echo esc_html($title_banner); ?>
                    </h3>
                <?php endif; ?>

                <div class="row">
                    <?php foreach ($cards as $card): ?>
                        <div class="col-12 col-md-4">
                            <div class="item_card">
                                
                                <?php if ($card['icon']): ?>
                                    <img src="<?php echo esc_url($card['icon']); ?>" alt="icon">
                                <?php endif; ?>

                                <?php if ($card['title']): ?>
                                    <h6 class="title_card">
                                        <?php echo esc_html($card['title']); ?>
                                    </h6>
                                <?php endif; ?>

                                <?php if ($card['desc']): ?>
                                    <p class="desc_card">
                                        <?php echo esc_html($card['desc']); ?>
                                    </p>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <?php
    
    // INNOVATIONS (PRODUCT DETAIL ONLY)
    if ($is_product) :

        $innovations = get_field('Innovation_categories');

        if (!empty($innovations)) :
    ?>
    <div class="wrap_innovations">
        <div class="container">
            <h5>Fueling Innovation Across categories</h5>

            <div class="wrap_card_innovations">
                <div class="row">

                    <?php foreach ($innovations as $innovation_post) :

                        $post_id = $innovation_post->ID;

                        $innovation_img = get_the_post_thumbnail_url($post_id, 'medium');
                        $sub_title = get_field('sub-title-innovations', $post_id);

                        $types = wp_get_post_terms($post_id, 'innovation_type');
                        $type_name = (!empty($types) && !is_wp_error($types)) ? $types[0]->name : '';

                        $content = get_post_field('post_content', $post_id);
                    ?>
                    <div class="col-12 col-md-4">
                        <div class="card_innovations">

                            <div class="row">
                                <?php if ($innovation_img) : ?>
                                    <div class="col-12 col-md-6">
                                        <img src="<?php echo esc_url($innovation_img); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>">
                                    </div>
                                <?php endif; ?>

                                <div class="side_desc col-12 col-md-6">
                                    <?php if ($type_name) : ?>
                                        <h6 class="cat_innovations"><?php echo esc_html($type_name); ?></h6>
                                    <?php endif; ?>

                                    <h3 class="title_innovations">
                                        <?php echo esc_html(get_the_title($post_id)); ?>
                                    </h3>

                                    <?php if ($sub_title) : ?>
                                        <h4 class="sub_title_innovations">
                                            <?php echo esc_html($sub_title); ?>
                                        </h4>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="desc_inno">

                                    <?php if ($content) : ?>
                                        <p><?php echo wp_kses_post($content); ?></p>
                                    <?php endif; ?>

                                    <?php
                                    $groups = get_field('innovationproducts2', $post_id);

                                    if (!empty($groups) && isset($groups[0]) && is_array($groups[0])) :
                                    ?>
                                        <div class="tbl_inno">

                                            <?php foreach ($groups[0] as $index => $row) : ?>

                                                <div class="item">

                                                    <?php if (!empty($row['haldin-product'])) : ?>
                                                        <h5 class="<?php echo ($index <= 1) ? 'tbold' : ''; ?>">
                                                            <?php echo esc_html($row['haldin-product']); ?>
                                                        </h5>
                                                    <?php endif; ?>

                                                    <?php if (!empty($row['value_inno'])) : ?>
                                                        <h6 class="<?php echo ($index === 0) ? 'tbold' : ''; ?>">
                                                            <?php echo esc_html($row['value_inno']); ?>
                                                        </h6>
                                                    <?php endif; ?>

                                                </div>


                                            <?php endforeach; ?>

                                        </div>
                                    <?php endif; ?>

                                </div>



                            
                            </div>

                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
    <?php
        endif;
    endif;
    ?>


    <!-- Footer Products -->
    <?php if ($is_product) : 

    // FOOTER PRODUCT FIELDS
    $bg_footer            = get_acf_image_url('background_footer');
    $title_origin         = get_field('title_origin');
    $origin_desc          = get_field('origin_desc');

    $title_sustainability = get_field('title_sustainability');
    $image_sustainability = get_acf_image_url('image_sustainability');

    $desc_sus_1 = get_field('desc_sustainability_1');
    $desc_sus_2 = get_field('desc_sustainability_2');
    $desc_sus_3 = get_field('desc_sustainability_3');
    $desc_sus_4 = get_field('desc_sustainability_4');
    $desc_sus_5 = get_field('desc_sustainability_5');
    $desc_sus_6 = get_field('desc_sustainability_6');

    ?>
    <div class="wrap_footer_products"
    <?php if ($bg_footer): ?>
        style="background-image:url('<?php echo esc_url($bg_footer); ?>');"
    <?php endif; ?>
    >
    <div class="container">
        <div class="row">

            <!-- ORIGIN -->
            <div class="col-12 col-md-4">
                <?php if ($title_origin): ?>
                    <h3 class="title_footer"><?php echo esc_html($title_origin); ?></h3>
                <?php endif; ?>

                <?php if ($origin_desc): ?>
                    <p><?php echo wp_kses_post($origin_desc); ?></p>
                <?php endif; ?>
            </div>

            <!-- SUSTAINABILITY -->
            <div class="col-12 col-md-8">
                <?php if ($title_sustainability): ?>
                    <h3 class="title_footer"><?php echo esc_html($title_sustainability); ?></h3>
                <?php endif; ?>

                <div class="wrap_contains_footer">

                    <?php if ($image_sustainability): ?>
                        <img src="<?php echo esc_url($image_sustainability); ?>" alt="sustainability">
                    <?php endif; ?>

                    <?php if ($desc_sus_3): ?><h6 class="content_3"><?php echo esc_html($desc_sus_3); ?></h6><?php endif; ?>
                    <?php if ($desc_sus_4): ?><h6 class="content_4"><?php echo esc_html($desc_sus_4); ?></h6><?php endif; ?>
                    <?php if ($desc_sus_5): ?><h6 class="content_5"><?php echo esc_html($desc_sus_5); ?></h6><?php endif; ?>
                    <?php if ($desc_sus_6): ?><h6 class="content_6"><?php echo esc_html($desc_sus_6); ?></h6><?php endif; ?>
                        
                    <?php if ($desc_sus_2): ?><h6 class="content_2"><?php echo esc_html($desc_sus_2); ?></h6><?php endif; ?>
                    <?php if ($desc_sus_1): ?><h6 class="content_1"><?php echo esc_html($desc_sus_1); ?></h6><?php endif; ?>

                </div>
            </div>

        </div>
    </div>
    </div>
    <?php endif; ?>

    <div id="back_list_product" class="text-left wrap_desktop_btn_category mt-4 pb-3">	
		<a onclick="window.history.back();" class="btn-product-back">
			<img src="<?php echo get_template_directory_uri(); ?>/images/back_btn.png" alt="">
		</a>
	</div>

</div>

<?php get_footer(); ?>
