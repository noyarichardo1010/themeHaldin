<?php
defined('ABSPATH') || exit;
global $product;
?>

<style>
    .standard-thumbnail.mb-5{
        display: none !important;
    }
    .date{
        display: none !important;
    }
    .font-weight-bold {
        display: none !important;
    }
</style>

<section class="custom_product_details_noya product-hero container">
    <div class="row">
        <div class="col-4 col-md-2">
			<div class="product-image">
				<?php echo $product->get_image('large'); ?>
			</div>
        </div>
        <div class="col-12 col-md-4">
			<?php
				$category_image = get_field('category_image');

				if ($category_image) : ?>
					<img 
						src="<?php echo esc_url($category_image); ?>" 
						alt="category_image"
						class="img-fluid category-image"
					>
			<?php endif; ?>
            <h1 class="product-title"><?php the_title(); ?></h1>
            <?php if ($product->get_sku()) : ?>
                <div class="product-sku">
                    Product Code: #<?php echo esc_html($product->get_sku()); ?>
                </div>
            <?php endif; ?>

			<div class="desc_products">
				<?php the_content(); ?>
			</div>

			<div class="certification_products">
				<h6>Certification</h6>
				<?php
				$certification = get_field('certification_products');

				if ($certification) : ?>
					<img 
						src="<?php echo esc_url($certification); ?>" 
						alt="Certification"
						class="img-fluid certification-image"
					>
				<?php endif; ?>
			</div>

			<div class="product-summary">
				<div class="product-price">
					<?php wc_get_template('single-product/price.php'); ?>
				</div>

				<div class="product-short-desc">
					<?php echo $product->get_short_description(); ?>
				</div>

				<!-- ADD TO CART -->
				<div class="product-add-to-cart">
					<?php woocommerce_template_single_add_to_cart(); ?>
				</div>
			</div>

        </div>
    </div>
	

</section>

<?php
	get_template_part('template/component/button-whatsapp');
?>