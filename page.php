<?php get_header();
$images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
$thumb = '';

$category_banner = "";
if ($images) $thumb = $images[0];
if ( is_product_category() ){
    global $wp_query;

    // get the query object
    $cat = $wp_query->get_queried_object();

    // get the thumbnail id using the queried category term_id
    $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );

    // get the image URL
    $image = wp_get_attachment_url( $thumbnail_id );
	if($category_banner == "") $category_banner = $image;

	$args = array( 'taxonomy' => 'product_cat' );
	$terms = get_terms('product_cat', $args);

	$cat_desc = "";
	$count = count($terms);
	if ($count > 0) {
	   foreach ($terms as $term) {
	        $cat_desc = $term->description;
	   }
	}
}

$product_innovation = get_term_by('slug', $cat->slug, 'innovation_category');
$product_innovation_link = '#';
if ($product_innovation) $product_innovation_link = get_term_link($product_innovation->term_id);
?>

<style media="screen">
     .page-content{
         padding-top: 220px;
         margin-top: 0px !important;
     }

     @media only screen and (max-width: 600px) {
         .page-content{
             padding-top: 80px;
             margin-top: 0px !important;
         }

         .header-thank-you{
             margin-top: 80px;
         }
     }
</style>
<?php $page_title = get_the_title(); ?>
<?php if($page_title == "Thank you!"): ?>
<div class="header-thank-you" style="background: url('<?= site_url() . "/wp-content/uploads/2022/06/Ragis-Background-sumba-3.png" ?>') no-repeat center center; background-size: cover;">
	<div class="container">
		<div class="row">
			<div class="col-md-5 mx-auto request-success-container">
				<div class="request-success-icon text-center my-3">
					<i class="fas fa-check-circle"></i>
				</div>
				<div class="request-success-content text-center">
					<h4 class="font-weight-bold">
						Thank you! <br>We have received your request form
					</h4>
					<p>
						Kindly reach our assistance at sales@haldin-natural.com<br> 
						If you did not get any email within 24 hours, we will assist you in obtaining the product sample requested.
					</p>
					<p>
						Stay safe and have a great day!
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php
global $wp;
$page_class = "";
$page_style = "";
$request = explode( '/', $wp->request );
if($request[0] == "my-account"){
    $page_class = "account-page";
    $page_style = "style='background-url('".get_site_url()."/wp-content/uploads/2022/01/Background-banner-web-5.png') no-repeat center center; background-size: cover;'";
}
?>

<style media="screen">
    .account-page{
        background: url('<?= get_site_url() ?>/wp-content/uploads/2022/01/Background-banner-web-5.png') no-repeat center center;
        background-size: cover;
    }
</style>
<section class="p-relative landing-page full-height page-content <?= $page_class ?>">


	<!-- <div class="text-left wrap_desktop_btn mt-2">	
			<a onclick="window.history.back();" class="btn-product-application2 btn btn-rounded text-center">
				<i class="fas fa-arrow-circle-left"></i> Back
			</a>
	</div> -->

	<div id="back_list_product" class="text-left wrap_desktop_btn_category mt-4 pb-3">	
		<a onclick="window.history.back();" class="btn-product-back">
			<img src="<?php echo get_template_directory_uri(); ?>/images/back_btn.png" alt="">
		</a>
	</div>

	<div class="container py-5">

		<div class="row">
			

			<?php if (have_posts()): ?>
				<?php while (have_posts()): the_post(); ?>
					<div class="col-sm-12 col-12 mb-3 mx-auto">
						<?php if (!is_product_category()): ?>

						<?php if ($thumb): ?>
							<div
								style="background-image: url(<?php echo $thumb ?>); padding-bottom: 60% "
								class="standard-thumbnail mb-5"></div>
						<?php endif; ?>
						<h1 class="font-weight-bold page-header-title">
							<a href="#" class="wrap_card_products">
								<?php the_title(); ?>
							</a>
						</h1>

					<?php endif; ?>
						<div class="cstm_ entry-content">
							<?php the_content(); ?>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>

			

			<div class="wrap_btn_applications">
				<?php if ( is_product_category()): ?>
					<div class="col-12 text-right desktop-btn">
					<a href="<?php echo $product_innovation_link; ?>" class="btn-product-application btn btn-rounded text-center">
						Application
						<i class="fa fa-arrow-right"></i>
					</a>
					</div>
					<div class="col-12 text-center mb-5">
					<a href="<?php echo $product_innovation_link; ?>" class="btn-product-application-mobile text-center">
						Application
						<i class="fa fa-arrow-right"></i>
					</a>
					</div>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>

<?php get_template_part('template/component/button-whatsapp'); ?>

<?php get_footer(); ?>
