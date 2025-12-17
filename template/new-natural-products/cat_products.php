<?php
$args = [
    'post_type'      => 'setup-category',
    'posts_per_page' => -1,
];

$query = new WP_Query($args);

if ($query->have_posts()) : ?>
    
<section class="general_category_products mt-20">
    <div class="container">
        <div class="wrap_gen_cat">
            <ul>
                <?php
                while ($query->have_posts()) : $query->the_post();

                    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    ?>
                    
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <?php if ($featured_img_url) : ?>
                                <img src="<?php echo esc_url($featured_img_url); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                        </a>
                    </li>

                <?php endwhile; ?>
            </ul>
        </div>
        <div class="text_free">
            <h6>
                Natural building blocks for today's consumer preferences and tomorrow's innovations.
                <br>Haldin provides nature's purest building blocks, delivered to over 65 countries
                <br>and consumed by billions of people worldwide.
            </h6>
        </div>
    </div>
</section>

<?php
    wp_reset_postdata();
endif;
?>
