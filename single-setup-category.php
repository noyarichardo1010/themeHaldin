<?php
get_header();
?>

<main id="primary" class="site-main single-setup-category landing-page full-height single-pagex">

    <div class="container mt-5">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            ?>
            <section class="single_category_hero pt-5">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <?php if ($featured_img_url) : ?>
                            <div class="hero_image">
                                <img src="<?php echo esc_url($featured_img_url); ?>" alt="<?php the_title_attribute(); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-12 col-md-9">
                        <?php
                        $link_categories = get_field('link_category');

                        if ($link_categories) : ?>
                            <ul class="menu-grid">
                                <?php
                    
                                $terms = is_array($link_categories) ? $link_categories : [$link_categories];

                                foreach ($terms as $term_item) :

                                    if (is_numeric($term_item)) {
                                        $term = get_term($term_item);
                                    }
                                  
                                    elseif (is_object($term_item)) {
                                        $term = $term_item;
                                    }
                                    // Jika array (return array ACF)
                                    elseif (is_array($term_item) && isset($term_item['term_id'])) {
                                        $term = get_term($term_item['term_id']);
                                    } else {
                                        continue;
                                    }

                                    if (!$term || is_wp_error($term)) {
                                        continue;
                                    }

                                    $term_link = get_term_link($term);
                                    if (is_wp_error($term_link)) {
                                        continue;
                                    }
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url($term_link); ?>">
                                            <?php echo esc_html($term->name); ?>
                                        </a>
                                    </li>
                                    <?php
                                endforeach;
                                ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                </div>
                
            </section>
            <section class="single_category_content">
                <div class="pl-0 container">
                    <?php the_content(); ?>
                </div>
            </section>
            
            <section class="wrap_target_industry">
                <h5>Target industry</h5>

                <?php
                $target_industry = get_field('target_industry');
                ?>

                <?php if ($target_industry) : ?>
                    <h6><?php echo esc_html($target_industry); ?></h6>
                <?php else : ?>
                    <h6>-</h6>
                <?php endif; ?>
            </section>

            <?php
        endwhile;
    endif;
    ?>

    <div class="text-left wrap_desktop_btn_category mt-4 pb-3">	
			<a onclick="window.history.back();" class="btn-product-back">
				<img src="<?php echo get_template_directory_uri(); ?>/images/back_btn.png" alt="">
			</a>
	</div>

    </div>

</main>

<?php
get_footer();
