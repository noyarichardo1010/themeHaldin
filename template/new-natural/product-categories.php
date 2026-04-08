
<style>
.imgclasss{
background-position-x: 1%;
}

</style>
<section id="product-categories"
         class="full-height position-relative">
	<?php

	$product_categories = get_terms('product-category',
		[
			'hide_empty' => false,
			'orderby' => 'id'
		]
	);
  $x = 1;
	foreach ($product_categories as $category) {
		$image = get_term_meta($category->term_id, 'feature_image', true);
		$url = get_term_link($category->term_id);
    $button_label = get_term_meta($category->term_id, 'button_label', true);
		?>
    <div class="container-fluid px-0 d-flex cover category-item test mb-4" >
      <div class="container-fluid px-0 d-flex">
        <div
          data-aos="fade-up"
          class="row mx-auto
        <?php echo $x % 2 == 0 ? 'flex-row-reverse' : '' ;?>
        d-flex w-100 align-items-center">
          <div class="imgclasss col-lg-6 col-sm-6 col-sm-12 col-12 unused-col unused-col-cover cover <?php echo $x % 2 == 0 ? 'bg-left' : 'bg-right' ;?>" 
          
          
          style="background-size: cover;background-position: bottom;background-image: url(<?php echo wp_get_attachment_url($image);?>); "></div>
          <div class="col-lg-6 col-sm-6 col-sm-12 col-12 col-content category-item-content" style="text-align:center"> 
						<h3 class="font-weight-bold macSizee" style="padding: 0px 75px;font-size: 35px;font-family: 'Futura Std', sans-serif !important;font-weight: 600 !important;text-transform: uppercase;"><?php echo $category->name; ?></h3>
            <div class="category-item-description macDes mb-3" style="padding: 10px 16px;font-family: 'ITC Century Std', serif;">
              <?php echo $category->description; ?>
            </div>
            <a href="<?php echo $url; ?>"
               style="width: auto"
              class="btn btn-see-more btn-sm">
              <?php echo $button_label ? $button_label : 'See More' ; ?>
            </a>
          </div>
        </div>
      </div>
    </div>
		<?php
    $x++;
	}

	?>
</section>
