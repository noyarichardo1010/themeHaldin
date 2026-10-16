<?php get_header();
$object = get_queried_object();
$title = get_term_meta($object->term_id, 'category_page_title', true);
$display_title = $title ? $title : $object->name;
?>
<section class="landing-page full-height innovation-category new_app_innovation">
  <div class="container py-5 wrap_innovations">
    
    <div class="row mb-3">
      <div class="col-12 text-left mt-4">
        <h2 class="font-weight-bold mb-3" style="color: #242424; font-size: 36px; text-transform: uppercase;">
          <?php echo esc_html($object->name); ?>
        </h2>
        <!-- <?php if ($object->description) : ?>
          <div class="category-description" style="color: #666; font-size: 16px; max-width: 800px; margin: 0 auto;">
            <?php echo wp_kses_post($object->description); ?>
          </div>
        <?php endif; ?> -->
      </div>
    </div>

    <div class="row position-relative">
      <div class="col-12 wrap_card_innovations">
        <div class="row">
          <?php if (have_posts()): ?>
            <?php
            while (have_posts()): the_post();
              $post_id = get_the_ID();

              $innovation_img = get_the_post_thumbnail_url($post_id, 'medium');
              $sub_title = get_field('sub-title-innovations', $post_id);

              $types = wp_get_post_terms($post_id, 'innovation_type');
              $type_name = (!empty($types) && !is_wp_error($types)) ? $types[0]->name : '';

              $content = get_post_field('post_content', $post_id);
              ?>
              <div class="col-12 col-md-4 mb-5">
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
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div id="back_list_product" class="text-left wrap_desktop_btn_category mt-4 pb-3">	
    <a onclick="window.history.back();" class="btn-product-back">
      <img src="<?php echo get_template_directory_uri(); ?>/images/back_btn.png" alt="">
    </a>
  </div>
</section>
<?php
get_template_part('template/component/button-whatsapp');
get_footer(); ?>
