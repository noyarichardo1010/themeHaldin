<?php
$categories = get_terms('innovation_category', [
    'hide_empty' => false,
    'orderby' => 'id'
]);
?>

<section id="innovation-categories-landing" class="position-relative page-content landing-page">
  <!-- Header Row (Static Header) -->
  <div class="category-row header-row d-flex" data-aos="fade-up">
    <div class="row m-0 w-100 align-items-stretch">
      <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-column header-text-col d-flex align-items-center" style="background-color: #d1e050;">
        <div class="content-wrapper text-left w-100">
          <h2 class="title font-weight-bold">BUILT FOR FASTER<br>PRODUCT INNOVATION</h2>
          <p class="subtitle">Explore precision-driven natural ingredient applications that simplify formulation and commercialization.</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-12 image-column p-0">
        <img class="img-fluid w-100 h-100 object-fit-cover" src="<?php echo get_template_directory_uri(); ?>/images/new_innovation/build_for_faster.png" alt="Built for Faster Product Innovation">
      </div>
    </div>
  </div>

  <?php
  if (!is_wp_error($categories) && !empty($categories)) :
      $x = 1;
      foreach ($categories as $cat) :
          $image_id = get_term_meta($cat->term_id, 'cover_image', true);
          $image_url = $image_id ? wp_get_attachment_url($image_id) : '';
          $url = get_term_link($cat->term_id);
          if (is_wp_error($url)) $url = '#';
          
          $button_label = get_term_meta($cat->term_id, 'button_label', true);
          if (empty($button_label)) {
              $button_label = 'Explore ' . $cat->name;
          }
          ?>
          <!-- Row: <?php echo esc_html($cat->name); ?> -->
          <div class="category-row d-flex" data-aos="fade-up">
            <div class="row m-0 w-100 align-items-centerx <?php echo $x % 2 == 0 ? 'flex-row-reverse' : ''; ?>">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12 image-column p-0">
                <?php if ($image_url) : ?>
                  <img class="img-fluid w-100 h-100 object-fit-cover" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($cat->name); ?>">
                <?php else : ?>
                  <div style="background-color: #eee; width: 100%; height: 100%; min-height: 350px;"></div>
                <?php endif; ?>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-column text-center">
                <div class="content-wrapper">
                  <h3 class="title font-weight-bold"><?php echo esc_html($cat->name); ?></h3>
                  <p class="subtitle"><?php echo esc_html($cat->description); ?></p>
                  <a href="<?php echo esc_url($url); ?>" class="btn-explore"><?php echo esc_html($button_label); ?></a>
                </div>
              </div>
            </div>
          </div>
          <?php
          $x++;
      endforeach;
  endif;
  ?>
</section>
