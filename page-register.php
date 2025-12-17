<?php
$success = false;
$error = '';

if (is_user_logged_in()) wp_redirect('/dashboard');

if (isset($_POST['submit'])) {
	$password = esc_html($_POST['user_password']);
	$user_data = [
		'user_pass' => $password,
		'user_login' => esc_html(sanitize_title($_POST['first_name'] .' '.$_POST['last_name'])),
		'first_name' => esc_html($_POST['first_name']),
		'last_name' => esc_html($_POST['last_name']),
		'user_email' => esc_html($_POST['user_email']),
		'role' => 'user'
	];

	if (!filter_var($user_data['user_email'], FILTER_VALIDATE_EMAIL))
		$error = 'Please input Valid email';
  elseif (email_exists($user_data['user_email']))
		$error = 'Sorry email is already registered';
	else if (!validate_username($user_data['user_login']))
		$error = 'Username format is invalid please only use alphanumeric with _ or -';
	else if (username_exists($user_data['user_login']))
		$error = 'Sorry username is taken';
  elseif (esc_html($_POST['user_password']) != esc_html($_POST['user_confirm_password']))
		$error = 'Confirmation password not match!';
	else {
		$new_user = wp_insert_user($user_data);
		$user = get_user_by('id', $new_user);
		update_user_meta($new_user, 'show_admin_bar_front', 'false');
		add_user_meta($new_user, 'phone', $_POST['phone']);
		add_user_meta($new_user, 'full_name', $_POST['first_name'].' '.$_POST['last_name']);
		add_user_meta($new_user, 'linkedin_profile', $_POST['linkedin_profile']);
		add_user_meta($new_user, 'company_name', $_POST['company_name']);
		add_user_meta($new_user, 'industry', $_POST['industry']);
		add_user_meta($new_user, 'department', $_POST['department']);
		$success = true;

	  agile_create_contact(array_merge($_POST, [
	    "first_name" => $_POST['first_name'],
      "last_name" => $_POST['last_name']
    ]));

	}
}

get_header(); ?>
<section style="background-image: url(http://develop.haldin.com/wp-content/uploads/2022/01/Background-banner-web-5.png)" class="cover">
<div
  class="container full-height landing-page">
  <div class="row py-5">
    <div class="col-lg-5 col-md-5 col-md-6 col-sm-10 mx-auto my-5">
			<?php if ($error): ?>
        <div class="alert alert-danger text-center mb-3">
          <strong>Registration Failed !</strong>
          <br>
          <small><?php echo $error; ?></small>
        </div>
			<?php endif; ?>
			<?php if ($success) : ?>
        <div class="alert alert-success text-center">
          <strong>Registration Success!</strong>
          <br>
          Please Login <a href="<?php echo get_site_url(); ?>/login">
            Login
          </a>
        </div>
			<?php endif; ?>
      <!-- <div class="card login-form">
        <div class="card-body">
          <h4 class="mb-3">
            User Registration
          </h4>
          <form action="" method="post">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="">
                    First Name
                  </label>
                  <input type="text" name="first_name" class="form-control" required>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="">
                    Last Name
                  </label>
                  <input type="text" name="last_name" class="form-control" required>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="">
                    Company
                  </label>
                  <input type="text" name="company_name" class="form-control" required>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="">
                    Department
                  </label>
                  <input type="text" name="departement" class="form-control">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="">Industry</label>
              <select name="industry" class="form-control" id="" required>
                <option value="">- Select -</option>
                <option value="Beverage">Beverage</option>
                <option value="Bakery">Bakery</option>
                <option value="Confectionary">Confectionary</option>
                <option value="Dairy">Dairy</option>
                <option value="Food Seasoning">Food Seasoning</option>
                <option value="Flavour & Fragrances">Flavour & Fragrances</option>
                <option value="Household">Household</option>
                <option value="Personal Care">Personal Care</option>
                <option value="Alcoholic/Spirit drinks">Alcoholic/Spirit drinks</option>
                <option value="Pharmacy">Pharmacy</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="form-group">
              <label for="">
                Email
              </label>
              <input type="email" name="user_email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">
                Password
              </label>
              <input type="password" name="user_password" minlength="6" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">
                Retype Password
              </label>
              <input type="password" name="user_confirm_password" minlength="6" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">Phone Number</label>
              <input type="number" name="phone" class="form-control">
            </div>
            <div class="form-group">
              <label for="">Linkedin Profile</label>
              <input type="text" name="linkedin_profile" class="form-control">
            </div>
            <div class="form-group text-center">
              <input type="submit" name="submit" value="Signup" class="btn btn-blue btn-rounded px-5 btn-sm">
            </div>
            <div class="form-group text-center">
              Have an account ? <a href="<?php echo get_site_url(); ?>/login">
                Login
              </a>
            </div>
          </form>
        </div>
      </div> -->

      <div class="card contact-form" style="margin-top: -50px;">
        <div class="card-body">
          <h4 class="mb-3 text-white">
            User Registration
          </h4>
          <form action="" method="post">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="">
                    First Name
                  </label>
                  <input type="text" name="first_name" class="form-control" required>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="">
                    Last Name
                  </label>
                  <input type="text" name="last_name" class="form-control" required>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="">
                    Company
                  </label>
                  <input type="text" name="company_name" class="form-control" required>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="">
                    Department (Optional)
                  </label>
                  <input type="text" name="departement" class="form-control">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="">Industry</label>
              <select name="industry" class="form-control" id="" required>
                <option value="">- Select -</option>
                <option value="Beverage">Beverage</option>
                <option value="Bakery">Bakery</option>
                <option value="Confectionary">Confectionary</option>
                <option value="Dairy">Dairy</option>
                <option value="Food Seasoning">Food Seasoning</option>
                <option value="Flavour & Fragrances">Flavour & Fragrances</option>
                <option value="Household">Household</option>
                <option value="Personal Care">Personal Care</option>
                <option value="Alcoholic/Spirit drinks">Alcoholic/Spirit drinks</option>
                <option value="Pharmacy">Pharmacy</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="form-group">
              <label for="">
                Email
              </label>
              <input type="email" name="user_email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">
                Password
              </label>
              <input type="password" name="user_password" minlength="6" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">
                Retype Password
              </label>
              <input type="password" name="user_confirm_password" minlength="6" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">Phone Number</label>
              <input type="number" name="phone" class="form-control">
            </div>
            <div class="form-group">
              <label for="">LinkedIn Profile (Optional)</label>
              <input type="text" name="linkedin_profile" class="form-control">
            </div>
            <div class="form-group text-center">
              <input type="submit" name="submit" value="Signup" class="btn btn-white btn-rounded px-5 btn-sm">
            </div>
            <div class="form-group text-center text-white">
              Have an account ? <a href="<?php echo get_site_url(); ?>/login">
                Login
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php get_footer(); ?>
