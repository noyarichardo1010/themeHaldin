<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>

<?php if ( $price_html = $product->get_price_html() ) : ?>
	<?php $price = $product->get_price(); ?>
	<?php if ($price != 0): ?>
		<span class="price"><?php echo $price_html; ?></span>
	<?php endif; ?>
<?php endif; ?>
<?php
	$desc = $product->get_description();
?>

<div class="wrap_title_product_list">
	<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>">
		<?php the_title(); ?>
	</a>
</div>



<?php
// Default Colors
$border_color = '#cacaca';

$terms = get_the_terms( get_the_ID(), 'product_cat' );

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
    // First category
    $term = $terms[0];
    // Taxonomy
    $cat_color = get_term_meta( $term->term_id, 'cat_colors', true );
    if ( ! empty( $cat_color ) ) {
        $border_color = $cat_color;
    }
}
?>

<div class="product-item-production-code mb-1 border_style"
     style="border-bottom:5px solid <?php echo esc_attr( $border_color ); ?>;">
  #<?php echo esc_html( get_post_meta( get_the_ID(), 'production_code', true ) ); ?>
</div>


<div class="product-item-content mb-3 wrap_product_list">
		<?php the_content(); ?>
		<div class="unexpand-item d-none">
			<!-- <?php echo wp_trim_words($desc, 8); ?>
			<?php if(strlen($desc) > 80): ?>
			<small class="btn-read-more-product-item">
				Read more
			</small>
			<?php endif; ?> -->
		</div>
		<div class="expand-item" style="display:none;">
			<!-- <?php echo $desc;?>
			<?php if(strlen($desc) > 100): ?>
				<small class="btn-read-less-product-item">
					Read less
				</small>
			<?php endif; ?> -->
		</div>
</div>

<?php
	get_template_part('template/component/button-whatsapp');
?>