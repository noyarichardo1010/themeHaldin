<?php
$success = false;
global $wp;
if (!is_user_logged_in()) wp_redirect('/login?redirect_url='. home_url(add_query_arg($wp->request)));

if (isset($_POST['submit'])) {
	send_request_email_haldin_x($_POST);
	$success = true;
}

get_header();

$user = wp_get_current_user();
$email = '';
$name = '';
$company = '';
$address = '';

if ($user) {
	$email = $user->user_email;
	$name = get_user_meta($user->ID, 'full_name', true);
	$address = get_user_meta($user->ID, 'address', true);
	$company = get_user_meta($user->ID, 'company_name', true);
}

?>
<div
	class="container full-height landing-page">
	<div class="row py-5">
		<?php if($success): ?>
			<div class="col-lg-5 col-md-5 col-sm-10 mx-auto my-5 request-success-container">
				<div class="request-success-icon text-center my-3">
					<i class="fas fa-check-circle"></i>
				</div>
				<div class="request-success-content text-center">
					<h4 class="font-weight-bold">
						Thank you! We have received your request form
					</h4>
					<p class="font-weight-bold">
						We will update you regarding the delivery status of your product samples to this email: <?php echo $email; ?>
					</p>
					<p>
						Kindly reach our assistance at 021-4447878 if you did not get any email within 24 hours, and we will gladly assist you in obtaining the product sample that you requested.
					</p>
					<p>
						Stay safe and have a great day!
					</p>
				</div>
			</div>
		<?php else: ?>
			<div class="col-lg-5 col-md-5col-sm-10 mx-auto my-5">
				<div class="card login-form">
					<div class="card-body">
						<h4 class="mb-3">
							Request Sample Form
						</h4>
						<form action="" method="post">
							<div class="form-group">
								<input type="text" name="request_user_name" value="<?php echo $name;?>" class="form-control" required placeholder="Name/Company">
							</div>
							<div class="form-group">
								<input type="email" name="request_user_email" value=<?php echo $email;?> class="form-control" required placeholder="Email">
							</div>
							<div class="form-group">
								<input type="text" name="request_user_address" value="<?php echo $address;?>" class="form-control" required placeholder="Address">
							</div>
							<hr>
							<div class="mb-3">
								Item Needed
							</div>
							<div class="item-container">
								<div class="item-category">
									<div class="form-group">
										<select name="_prod_cat[]" class="form-control" required>
											<option value="haldin-x" selected>HaldinX</option>
										</select>
									</div>
									<div class="form-group">
										<select name="_product_id[]" class="form-control" required>
											<option value="">-- Select Product --</option>
                      <option value="Cascara Sugarcane">Cascara Sugarcane</option>
                      <option value="Coffee 10 in 1">Cofee 10 in 1</option>
										</select>
									</div>
									<hr>
								</div>
							</div>
							<div class="text-right add-product-container text-white mb-3">
								<div class="btn add-more-item btn-sm text-white"> Add more item <i class="fa fa-plus-circle"></i></div> <div class="btn hidden remove-product btn-sm text-white"><i class="fa fa-trash"></i></div>
							</div>
							<div class="form-group text-center">
								<input type="submit" name="submit" value="Submit" class="btn btn-blue btn-rounded px-5 btn-sm text-white">
							</div>
						</form>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="item-category-clone hidden">
		<div class="item-category">
			<div class="form-group">
				<select name="_prod_cat[]" class="form-control" required>
					<option value="">-- Select Category --</option>
					<?php foreach ($product_categories as $cat): ?>
						<option value="<?php echo $cat->term_id ?>"><?php echo $cat->name; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<select name="_product_id[]" class="form-control" required>
					<option value="">-- Select Product --</option>
				</select>
			</div>
			<hr>
		</div>
	</div>
</div>
<?php get_footer(); ?>
