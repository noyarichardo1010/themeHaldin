  <?php
  $user = wp_get_current_user();
  $success = false;
  if (!is_user_logged_in()) wp_redirect('/login');
  get_header();

  if (isset($_POST['submit'])) {
    $userData = [
      'ID' => $user->ID,
      'first_name' => esc_html($_POST['current_user_first_name']),
    ];
    if (isset($_FILES['file_avatar']) && count($_FILES['file_avatar']) > 0 && $_FILES['file_avatar']['name'] != "") {
      $attachment_id = upload_file($_FILES['file_avatar']);
      update_user_meta($user->ID, 'avatar', $attachment_id);
    }

    if ($_POST['current_user_first_name']) update_user_meta($user->ID, 'first_name', $_POST['current_user_first_name']);
    if ($_POST['current_user_last_name']) update_user_meta($user->ID, 'last_name', $_POST['current_user_last_name']);
    if ($_POST['department']) update_user_meta($user->ID, 'department', $_POST['department']);
    if ($_POST['address']) update_user_meta($user->ID, 'address', $_POST['address']);
    if ($_POST['town']) update_user_meta($user->ID, 'town', $_POST['town']);
    if ($_POST['region']) update_user_meta($user->ID, 'region', $_POST['region']);
    if ($_POST['country']) update_user_meta($user->ID, 'country', $_POST['country']);
    if ($_POST['zip']) update_user_meta($user->ID, 'zip', $_POST['zip']);
    if ($_POST['company_name']) update_user_meta($user->ID, 'company_name', $_POST['company_name']);
    if ($_POST['phone']) update_user_meta($user->ID, 'phone', $_POST['phone']);
    if ($_POST['linkedin_profile']) update_user_meta($user->ID, 'linkedin_profile', $_POST['linkedin_profile']);


    if ($_POST['current_user_password']) {
      wp_generate_password();
      $userData['user_pass'] = $_POST['current_user_password'];
      wp_update_user($userData);
    }
    $success = true;
  }

  $first_name = get_user_meta($user->ID, 'first_name', true);
  $last_name = get_user_meta($user->ID, 'last_name', true);
  $avatar_id = get_user_meta($user->ID, 'avatar', true);
  $avatar_url = get_template_directory_uri() . '/images/user-image.png';
  $company_name = get_user_meta($user->ID, 'company_name', true);
  $linkedin_profile = get_user_meta($user->ID, 'linkedin_profile', true);
  $address = get_user_meta($user->ID, 'address', true);
  $industry = get_user_meta($user->ID, 'industry', true);
  $town = get_user_meta($user->ID, 'town', true);
  $region = get_user_meta($user->ID, 'region', true);
  $zip = get_user_meta($user->ID, 'zip', true);
  $country = get_user_meta($user->ID, 'country', true);
  $department = get_user_meta($user->ID, 'department', true);
  $phone = get_user_meta($user->ID, 'phone', true);
  if ($avatar_id) {
    $avatar_url = wp_get_attachment_image_src($avatar_id)[0];
  }
  ?>
  <section style="background-image: url(http://develop.haldin.com/wp-content/uploads/2022/01/Background-banner-web-5.png)" class="cover">
  <div class="container full-height landing-page">
    <div class="row py-5">
      <div class="col-lg-12 mx-auto">
        <!-- <div class="card" style="background: rgba(255, 255, 255, 0.5);"> -->
        <div class="card" style="background: transparent;border: 0px solid rgba(0,0,0,.125);">

          <div class="card-body">
            <?php if ($success): ?>
              <div class="alert alert-success">
                Update Success
              </div>
            <?php endif; ?>
            <h4 class="font-weight-bold text-white">
              Login Info <a class="btn-order-list" href="<?= get_site_url() ?>/my-account/orders/">Order List</a>
            </h4>
            <hr>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="row flex-lg-row-reverse">
                <div class="col-lg-2 col-md-12 col-12 mb-lg-0 mb-md-3 mb-3 text-center">
                  <h6 class="font-weight-bold text-white">
                    Profile Image
                  </h6>
                  <div
                    style="background-image: url(<?php echo $avatar_url ?>)"
                    class="avatar-container-image">
                    <div class="avatar-take-image-button">
                      <i class="fa fa-camera"></i>
                    </div>
                    <input type="file" name="file_avatar" class="hidden"/>
                  </div>
                </div>
                <div class="col-lg-5 col-md-12 col-12 mb-lg-0 mb-3">
                  <div class="form-group">
                    <label class="text-white" for="">
                      Last Name <sup style="color:white;font-size:20px;top:0.3em">*</sup>
                    </label>
                    <input type="text" name="current_user_last_name" class="form-control" value="<?php echo $last_name ?>"
                          required/>
                  </div>
                  <div class="form-group">
                    <label class="text-white" for="">
                      Department (Optional)
                    </label>
                    <input type="text" name="department" class="form-control" value="<?php echo $department ?>"/>
                  </div>
                  <div class="form-group mb-4">
                    <label class="text-white" for="">
                      Company Address <sup style="color:white;font-size:20px;top:0.3em">*</sup>
                    </label>
                    <textarea name="address" class="form-control" cols="10" rows="4"><?php echo $address; ?></textarea>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label class="text-white" for="">
                          City (Optional)
                        </label>
                        <input type="text" name="town" class="form-control" value="<?php echo $town ?>"/>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label class="text-white" for="">
                          Region (Optional)
                        </label>
                        <input type="text" name="region" class="form-control" value="<?php echo $region ?>"/>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label class="text-white" for="">
                          Country (Optional)
                        </label>
                        <input type="text" name="country" class="form-control" value="<?php echo $country ?>"/>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label class="text-white" for="">
                          Post Code (Optional)
                        </label>
                        <input type="number" name="zip" class="form-control" value="<?php echo $zip ?>"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 col-md-12 col-12 mb-lg-0 mb-3">
                  <div class="form-group">
                    <label class="text-white" for="">
                      First Name <sup style="color:white;font-size:20px;top:0.3em">*</sup>
                    </label>
                    <input type="text" name="current_user_first_name" class="form-control"
                          value="<?php echo $first_name; ?>" required/>
                  </div>
                  <div class="form-group">
                    <label class="text-white" for="">
                      Company Name <sup style="color:white;font-size:20px;top:0.3em">*</sup>
                    </label>
                    <input type="text" name="company_name" class="form-control" value="<?php echo $company_name ?>"/>
                  </div>
                  <div class="form-group">
                    <label class="text-white" for="">
                      Email Address <sup style="color:white;font-size:20px;top:0.3em">*</sup>
                    </label>
                    <input type="email" name="current_user_email" readonly class="form-control"
                          value="<?php echo $user->user_email ?>" required/>
                  </div>

                  <div class="form-group">
                    <label class="text-white" for="">
                      Phone Number <sup style="color:white;font-size:20px;top:0.3em">*</sup>
                    </label>
                    <input type="number" name="phone" class="form-control" value="<?php echo $phone ?>"/>
                  </div>
                  <div class="form-group">
                    <label class="text-white" for="">
                      Linkedin Profile (Optional)
                    </label>
                    <input type="text" name="linkedin_profile" class="form-control"
                          value="<?php echo $linkedin_profile ?>"/>
                  </div>
                  <div class="form-group">
                    <label class="text-white" for="">
                      Change Password
                    </label>
                    <input type="email" name="current_user_password" class="form-control" value=""/>
                    <small class="text-white">Only fill if you want to update password</small>
                  </div>
                  <div class="form-group">
                    <input type="submit" name="submit" value="Save" class="btn btn-rounded btn-blue btn-sm text-white">
                    <a href="<?php echo wp_logout_url(); ?>"
                      class="btn btn-sm btn-danger btn-rounded logout-btn text-white">
                      Logout
                    </a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
            </section>

  <?php get_footer(); ?>
