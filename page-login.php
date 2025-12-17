<?php

$redirect_url = get_site_url() . "/dashboard";
if (isset($_GET['redirect_url']) && $_GET['redirect_url'] != "") {
	$redirect_url = $_GET['redirect_url'];
}

if (is_user_logged_in()) wp_redirect('/dashboard');

get_header(); ?>
<section style="background-image: url(http://develop.haldin.com/wp-content/uploads/2022/01/Background-banner-web-5.png)" class="cover">
<div class="container full-height landing-page">
  <div class="row py-5">
    <div class="col-lg-5 col-md-5 col-md-6 col-sm-10 mx-auto my-5">
			<?php if (isset($_GET['login']) && $_GET['login'] == 'failed'): ?>
        <div class="alert alert-danger text-center mb-4 animate__animated animate__bounce">
          <strong>Login Failed !</strong>
          <br>
          <small>Please check your email or password</small>
        </div>
			<?php endif; ?>

      <div class="card contact-form" style="margin-top: -25px;">

      <!-- <div class="card login-form"> -->
        <!-- <div class="card-body">
          <div class="form-group text-center mb-4">
            <h4>Don`t have account ? <a href="<?php echo get_site_url(); ?>/register">
                <strong>Register</strong>
              </a>
            </h4>
          </div>
          <h5 class="mb-3 text-left">
            Login
          </h5>
          <form name="loginform" id="loginform" action="<?php bloginfo('url'); ?>/wp-login.php" method="post">
            <div class="form-group">
              <input type="email" class="form-control" name="log" required placeholder="Email">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="pwd" required placeholder="Password">
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div>
						<?php if (function_exists('gglcptch_display')) {
							echo '<div class="form-group">' . gglcptch_display() . '</div>';
						}; ?>
            <div class="form-group text-center">
              <input type="hidden" name="redirect_to" value="<?php echo $redirect_url ?>">
              <input type="submit" name="wp-submit" value="Login"
                     class="btn btn-blue btn-rounded px-5 btn-sm drop-shadow">
            </div>

          </form>
        </div> -->

        <div class="card-body">
        <div class="form-group text-center mb-4 text-white">
            <h4>Don`t have account? <a href="<?php echo get_site_url(); ?>/register">
                <strong class="text-white">Register</strong>
              </a>
            </h4>
          </div>
          <form name="loginform" id="loginform" action="<?php bloginfo('url'); ?>/wp-login.php" method="post">
<div class="form-group">
<label for="">
Email
</label>
<input type="email" class="form-control" name="log" required>
</div>
<div class="form-group">
<label for="">
Password
</label>
<input type="password" class="form-control" name="pwd" required>
</div>

<div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div>
						<?php if (function_exists('gglcptch_display')) {
							echo '<div class="form-group">' . gglcptch_display() . '</div>';
						}; ?>
            <div class="form-group text-center">
              <input type="hidden" name="redirect_to" value="<?php echo $redirect_url ?>">
              <input type="submit" name="wp-submit" value="Login"
                     class="btn btn-white btn-rounded px-5 btn-sm drop-shadow">
            </div>
</form>
</div>
      </div>
    </div>
  </div>
</div>
          </section>
<?php get_footer(); ?>
