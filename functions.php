<?php
const VERSION = '1.0.2';
date_default_timezone_set('Asia/Bangkok');
add_filter('xmlrpc_enabled', '__return_false');
include "includes/mr-image-resize.php";
include "agile_api/agile_crm_api_helper.php";
include "includes/theme_options.php";
include "social_media_api/facebook_api.php";
include "social_media_api/instagram_api.php";

add_theme_support('post-thumbnails');
add_theme_support('menus');
add_filter('use_default_gallery_style', '__return_falsfe');

//mr image resize
function theme_thumb($url, $width, $height = 0, $align = '')
{
	return mr_image_resize($url, $width, $height, true, $align, false);
}

//queue theme scripts
function theme_scripts()
{
	wp_deregister_script('jquery');
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), VERSION);
	wp_enqueue_style('slickcss', get_template_directory_uri() . '/slick/slick.css', array(), VERSION);
	wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/all.min.css', array(), VERSION);
	wp_enqueue_style('scrollbar', get_template_directory_uri() . '/css/jquery.scrollbar.css', array(), VERSION);
	wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.min.css', array(), VERSION);
	wp_enqueue_style('aos', get_template_directory_uri() . '/css/aos.css', array(), VERSION);
	wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css', array(), VERSION);
	wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-2.2.4.min.js', '', VERSION, true);
	wp_enqueue_script('slickjs', get_template_directory_uri() . '/slick/slick.min.js', array('jquery'), VERSION, true);
	wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), VERSION, true);
	wp_enqueue_script('sweetalert', '//cdn.jsdelivr.net/npm/sweetalert2@11', array('jquery'), VERSION, true);
	wp_enqueue_script('scrollbar', get_template_directory_uri() . '/js/jquery.scrollbar.js', array('jquery'), VERSION, true);
	wp_enqueue_script('aos', get_template_directory_uri() . '/js/aos.js', array('jquery'), VERSION, true);
	wp_enqueue_script('site', get_template_directory_uri() . '/js/site.js', array('jquery', 'slickjs', 'bootstrapjs', 'scrollbar', 'aos'), VERSION, true);
	wp_localize_script('site', 'myAjax', array('ajaxUrl' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'theme_scripts');

// Custom product haldin
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);


remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.

function footer_enqueue_scripts()
{
	remove_action('wp_head', 'wp_print_scripts');
	remove_action('wp_head', 'wp_print_head_scripts', 5);
	remove_action('wp_head', 'wp_enqueue_scripts', 5);
	add_action('wp_footer', 'wp_print_scripts', 5);
	add_action('wp_footer', 'wp_enqueue_scripts', 5);
	add_action('wp_footer', 'wp_print_head_scripts', 5);
}

add_action('after_setup_theme', 'footer_enqueue_scripts');

function unregister_default_wp_widgets()
{
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Nav_Menu_Widget');
}

add_action('widgets_init', 'unregister_default_wp_widgets', 1);

function get_image($url, $width = false, $height = false)
{
	$thumb = '';
	if (function_exists('jetpack_photon_url')) {
		if ($width && $height) {
			$size = [$width, $height];
			$resize = array(
				'resize' => implode(',', $size),
			);
		} else {
			$resize = [];
		}
		$thumb = jetpack_photon_url($url, $resize);
	} else {
		if ($width && $height) {
			$thumb = theme_thumb($url, $width, $height);
		} else {
			$thumb = $url;
		}
	}
	return $thumb;
}


function dd($data)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function get_page_by_slug($slug)
{
	$args = [
		'post_type' => 'page',
		'posts_per_page' => 1,
		'post_name__in' => [$slug]
	];
	$q = get_posts($args);
	if (count($q) > 0) return $q[0];
	return false;
}

function get_page_child_by_parent_id($id)
{
	$args = array(
		'post_type' => 'page',
		'posts_per_page' => -1,
		'post_parent' => $id,
		'order' => 'ASC',
		'orderby' => 'menu_order'
	);

	$query = new WP_Query($args);

	wp_reset_postdata();

	return $query;
}

function get_child_menu_buttons_by_parent_id($id)
{
	$args = array(
		'post_type' => 'page',
		'posts_per_page' => -1,
		'post_parent' => $id,
		'order' => 'ASC',
		'orderby' => 'menu_order'
	);

	$query = new WP_Query($args);

	if ($query->have_posts()) {
		echo '<div class="col-12 px-0 child-section-button-container my-3">';
		echo '<div class="row">';
		while ($query->have_posts()) {
			$query->the_post();
			?>
      <div class="col-12 mb-1">
        <button
          open-modal
          data-job="get-detail"
          data-type="page"
          data-target="main-modal"
          data-id="<?php echo get_the_ID(); ?>"
          class="btn btn-block btn-sm btn-rounded">
					<?php the_title(); ?>
        </button>
      </div>
			<?php
		}
		echo '</div>';
		echo '</div>';
	}

	wp_reset_postdata();
}

function get_detail()
{
	$page = get_post($_GET['id']);
	$next_link = '';
	$before_link = '';
	$position = 'right';
	$titleColor = isset($_GET['titleColor']) && $_GET['titleColor'] == 'white' ? 'text-white' : 'text-dark';
  $button_meta = get_post_meta($_GET['id'], 'page_button', true)[0] ?? [];
  $button_meta1 = get_post_meta($_GET['id'], 'page_button1', true)[0] ?? [];
	if ($_GET['id'] == 29) {
		$next_link = get_post(31);
	}
	if ($_GET['id'] == 31) {
		$next_link = get_post(29);
		$next_link->post_title = 'Manufacturing';
		$position = 'left';
	}
	if ($_GET['id'] == 42) {
		$next_link = get_post(45);
		$position = 'right';
		$titleColor = 'text-white';
	}
	if ($_GET['id'] == 45) {
		$before_link = get_post(42);
		$next_link = get_post(47);
		$position = 'right';
		$titleColor = 'text-white';
	}
	if ($_GET['id'] == 47) {
		$next_link = get_post(45);
		$position = 'left';
		$titleColor = 'text-white';
	}

	if ($_GET['id'] == 57) {
		$next_link = get_post(59);
		$position = 'right';
		$titleColor = 'text-white';
	}
	if ($_GET['id'] == 59) {
		$before_link = get_post(57);
		$next_link = get_post(61);
		$position = 'right';
		$titleColor = 'text-white';
	}
	if ($_GET['id'] == 61) {
		$next_link = get_post(59);
		$position = 'left';
		$titleColor = 'text-white';
	}

	include('template/modal/normal-modal-page.php');

	die();
}

add_action('wp_ajax_nopriv_get_detail', 'get_detail');
add_action('wp_ajax_get_detail', 'get_detail');

function get_featured_image_by_post_id($id)
{
	$image = '';
	$attachment_id = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'single-post-thumbnail');
	if ($attachment_id) $image = $attachment_id[0];

	echo $image;
}

add_post_type_support('page', 'excerpt');

function get_product_list_by_category_id()
{
	$id = $_GET['id'];
	$titleColor = isset($_GET['titleColor']) && $_GET['titleColor'] == 'white' ? 'text-white' : 'text-dark';

	$term = get_term_by('id', $id, 'product-category');
	if ($term) {
		$args = [
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => 6,
			'tax_query' => array(
				array(
					'taxonomy' => 'product-category',
					'field' => 'term_id',
					'terms' => $id
				)
			)
		];

		$query = new WP_Query($args);

		include('template/modal/product-modal.php');

		wp_reset_postdata();
	}

	die();
}

add_action('wp_ajax_nopriv_get_product_list_by_category_id', 'get_product_list_by_category_id');
add_action('wp_ajax_get_product_list_by_category_id', 'get_product_list_by_category_id');

function cover_with_span($str)
{

	$str_array = explode(' ', $str);
	$new_string = '';
	foreach ($str_array as $item) {
		$new_string .= '<span>' . $item . '</span>';
	}

	return $new_string;
}

function shapeSpace_filter_search($query)
{
	if (!$query->is_admin && $query->is_search) {
		$query->set('post_type', array('post'));
	}
	return $query;
}

add_filter('pre_get_posts', 'shapeSpace_filter_search');

function my_login_redirect($redirect_to, $request, $user)
{
	//is there a user to check?
	global $user;
	if (isset($user->roles) && is_array($user->roles)) {
		//check for admins
		if (in_array('user', $user->roles)) {
			// redirect them to the default place

		    return home_url('/');
		} else {
		    if(isset($_GET['re']) && $_GET['re'] == "checkout"){
			 return $_GET['re'];
			}
			else{
			return $redirect_to;
			}
		}
	} else {
		return $redirect_to;
	}
}

add_filter('login_redirect', 'my_login_redirect', 10, 3);

function upload_file($file)
{
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	$upload_overrides = array('test_form' => false);
	$upload_file = wp_handle_upload($file, $upload_overrides);
	$wp_filetype = wp_check_filetype($file['name'], null);
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_parent' => '',
		'post_title' => preg_replace('/\.[^.]+$/', '', $file['name']),
		'post_content' => '',
		'post_status' => 'inherit'
	);

	$attachment_id = wp_insert_attachment($attachment, $upload_file['file'], '');
	if (!is_wp_error($attachment_id)) {
		$attachment_data = wp_generate_attachment_metadata($attachment_id, $upload_file['file']);
		wp_update_attachment_metadata($attachment_id, $attachment_data);
	}

	return $attachment_id;
}

function curl_data($url, $method = 'GET')
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}

function generate_socmed_data($data)
{

	$icon = '<div class="fb-icon socmed-icon"><i class="fab fa-facebook-f"></i></div>';
	if ($data['type'] == 'instagram') $icon = '<div class="instagram-icon socmed-icon"><i class="fab fa-instagram-square"></i></div>';
	if ($data['type'] == 'linkedin') $icon = '<div class="linkedin-icon socmed-icon"><i class="fab fa-linkedin-in"></i></div>';
	$element = '<div 	data-aos-delay="150"
					data-aos="fade-up"
					class="socmed-item-feed card">';
	$element .= '<div class="card-body">';
	$element .= '<div class="d-flex align-items-center justify-content-end">' . $icon . '</div>';
	$element .= '<div class="date-container">' . date("d-M-Y", strtotime($data['date'])) . '</div>';
	$element .= '<div class="message-container transition hide">' . $data['message'] . '</div>';

	if (strlen($data['message']) > 50) {
		$element .= '<div class="read-more">Read more</div>';
	}
	if (isset($data['image']) && $data['image']) {
		$element .= '<div style="background-image: url(' . $data['image'] . ')" class="standard-thumbnail"></div>';
	}
	$element .= '</div>';
	$element .= '</div>';
	return $element;
}

function send_request_email($data)
{

	$email = $data['request_user_email'];
	$name = $data['request_user_name'];
	$address = $data['request_user_address'];

	$products = [];
  $products_list = [];
	foreach ($data['_prod_cat'] as $key => $value) {
		$term_name = get_term_by('id', $data['_prod_cat'][$key], 'product-category');
		$post_data = get_post($data['_product_id'][$key]);
		$product_code = get_post_meta($data['_product_id'][$key], 'production_code', true);
		$products[] = [
			"category_name" => $term_name->name,
			"product_name" => $post_data->post_title . '(#' . $product_code . ')'
		];

    $products_list[] = [
      "title" => $post_data->post_title,
      "code" => $product_code
    ];
	}

	send_email_to_user($email, $name, $address, $products);
	send_sample_email($products_list);

	return true;
}

function send_request_email_haldin_x($data)
{

	$email = $data['request_user_email'];
	$name = $data['request_user_name'];
	$address = $data['request_user_address'];

	$products = [];
	$products_list = [];
	foreach ($data['_prod_cat'] as $key => $value) {
		$products[] = [
			"category_name" => $data['_prod_cat'][$key],
			"product_name" => $data['_product_id'][$key]
		];

		$products_list[] = [
			"title" => $data['_prod_cat'][$key],
			"code" => $data['_product_id'][$key]
		];
	}

	send_email_to_user($email, $name, $address, $products);
	send_sample_email($products_list);

	return true;
}

function set_email_content_type()
{
	return "text/html";
}

add_filter('wp_mail_content_type', 'set_email_content_type');

function send_email_to_user($email, $name, $address, $products)
{

	$template = 'Hello <strong>' . $name . '</strong><br>' . PHP_EOL;
	$template .= 'Thank you for requesting these following samples : <br><br>' . PHP_EOL;

	foreach ($products as $product) {
		$template .= '<strong>' . $product["category_name"] . '</strong><br>' . PHP_EOL;
		$template .= '<strong>' . $product['product_name'] . '</strong><br><br>' . PHP_EOL;
	}

	wp_mail($email, 'Request On Process', $template);
}

function send_sample_email($products) {
	$user = wp_get_current_user();
	$name = get_user_meta($user->ID, 'full_name', true);
	$address = get_user_meta($user->ID, 'address', true);
	$company = get_user_meta($user->ID, 'company_name', true);
	$phone = get_user_meta($user->ID, 'phone', true);
  $template = 'Request Date : '. date('Y-m-d H:i:s'). '<br>'. PHP_EOL;
  $template .= 'Requestor : '. $name.'<br>'. PHP_EOL;
  $template .= 'Company : '. $company.'<br>'. PHP_EOL;
  $template .= 'Address : '. $address.'<br>'. PHP_EOL;
  $template .= 'Contact Person : '. $name.'<br>'. PHP_EOL;
  $template .= 'Phone : '. $phone. '<br>'.PHP_EOL;
  $template .= '<br>'. PHP_EOL;
  $template .= 'Product Detail'.'<br>'. PHP_EOL;
  $template .= '<br>'.PHP_EOL;
	foreach ($products as $product) {
		$template .= $product["title"] . '<br>'. PHP_EOL;
		$template .= 'Code :' .$product["code"] . '<br>'. PHP_EOL;
    $template .= '<br>'.PHP_EOL;
	}

  wp_mail('sample.haldin@haldin-natural.com', 'Request Sample', $template);
}

function get_product_by_category_id()
{
	$id = null;
	if (isset($_GET['category_id'])) $id = $_GET['category_id'];
	if (!$id) echo '';
	try {

		$args = [
			"posts_per_page" => -1,
			"post_type" => "product",
			'tax_query' => array(
				array(
					'taxonomy' => 'product-category',
					'field' => 'term_id',
					'terms' => $id,
				)
			)
		];

		$data = [];

		$query = new WP_Query($args);
		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();
				$code = get_post_meta(get_the_ID(), 'production_code', true);
				$data[get_the_ID()] = get_the_title() . ' #' . $code;
			}
		}
		wp_reset_postdata();
		echo json_encode($data);

	} catch (\Exception $e) {
		echo '';
	}

	die();
}

add_action('wp_ajax_nopriv_get_product_by_category_id', 'get_product_by_category_id');
add_action('wp_ajax_get_product_by_category_id', 'get_product_by_category_id');


add_filter('wp_mail_from_name', 'my_mail_from_name');
function my_mail_from_name($name)
{
	return "Haldin";
}

add_filter('wp_mail_from', 'my_mail_from');
function my_mail_from($email)
{
	return "noreply@haldin.com";
}

// Add the custom columns to the book post type:
add_filter('manage_product_posts_columns', 'set_custom_edit_product_columns');
function set_custom_edit_product_columns($columns)
{
	$columns['product_code'] = 'Product Code';
	$columns['category'] = 'Category';
	return $columns;
}

// Add the data to the custom columns for the book post type:
add_action('manage_product_posts_custom_column', 'custom_product_column', 10, 2);
function custom_product_column($column, $post_id)
{
	switch ($column) {
		case 'product_code' :
			echo get_post_meta($post_id, 'production_code', true);;
			break;
		case 'category' :
			echo get_the_terms($post_id, 'product-category')[0]->name;
			break;
	}
}

// Add the custom columns to the book post type:
add_filter('manage_product_innovation_posts_columns', 'set_product_innovation_column');
function set_product_innovation_column($columns)
{
	$columns['category'] = 'Category';
	$columns['type'] = 'Type';
	return $columns;
}

// Add the data to the custom columns for the book post type:
add_action('manage_product_innovation_posts_custom_column', 'product_innovation_column', 10, 2);
function product_innovation_column($column, $post_id)
{
	switch ($column) {
		case 'category' :
			echo get_the_terms($post_id, 'innovation_category')[0]->name;
			break;
		case 'type' :
			echo get_the_terms($post_id, 'innovation_type')[0]->name;
			break;
	}
}

add_action('pre_get_posts', function ($query) {
	if (is_admin()) {
		return;
	}

  if(isset($query->query['product-category'])) {
		$query->set('posts_per_page', -1);
  }
});
//
// add_action('wp_logout', 'ps_redirect_after_logout');
// function ps_redirect_after_logout()
// {
// 	wp_redirect(get_site_url() .'/login');
// 	exit();
// }

function send_email_contact_us($data) {
	$template = 'New Contact Us Form Request : <br><br>' . PHP_EOL;
  $template .= 'First name :'. $data['first_name'] . '<br>'. PHP_EOL;
  $template .= 'Last name :'. $data['last_name'] . '<br>'. PHP_EOL;
  $template .= 'Email :'. $data['email'] . '<br>'. PHP_EOL;
  $template .= 'Descriptions :'. $data['description'] . '<br>'. PHP_EOL;
	wp_mail('sales@haldin-natural.com', 'Contact Us', $template);
}

add_filter( 'woocommerce_before_cart_table', 'check_cart_count_alert' );
function check_cart_count_alert() {
    $item_count = WC()->cart->get_cart_contents_count();

    if($item_count > 5){
        ?>
        <div class="alert alert-danger"><?php _e("You can only request 5 items at once. Please remove some products from cart.", "woocommerce"); ?></div>
        <?php
    }
}

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' );
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Request Sample', 'woocommerce' );
}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Request Sample', 'woocommerce' );
}

function woocommerce_button_proceed_to_checkout() {
        $checkout_url = WC()->cart->get_checkout_url();
        $item_count = WC()->cart->get_cart_contents_count();

        if($item_count <= 5){
        ?>
        <a href="<?php echo $checkout_url; ?>" class="checkout-button button alt wc-forward"><?php _e("Request", "woocommerce"); ?></a>
        <?php
        }
        else{
        ?>
        <a href="#" class="button wc-forward"><?php _e("You can only request 5 items at once. Please remove some products from cart.", "woocommerce"); ?></a>
        <?php
        }
}

add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' );

function woo_custom_order_button_text() {
    return __( 'Proceed to Payment', 'woocommerce' );
}

// Cart Ajax count update
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );

function iconic_cart_count_fragments( $fragments ) {

    $fragments['span.header-cart-count'] = '<span class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';

    return $fragments;

}

add_action( 'wp_footer', 'ajax_button_text_js_script' );
function ajax_button_text_js_script() {
    $text = __('Added to Cart', 'woocommerce');
    ?>
    <script>
        jQuery(function($) {
            var text = '<?php echo $text; ?>',      $this;

            $(document.body).on('click', '.ajax_add_to_cart', function(event){
                $this = $(this); // Get button jQuery Object and set it in a variable
            });

            $(document.body).on('added_to_cart', function(event,b,data){
                var buttonText = '<span class="add_to_cart_text product-is-added">'+text+'</span><i class="cart-icon pe-7s-cart"></i>';

                // Change inner button html (with text) and Change "data-tip" attribute value
                $this.html(buttonText).attr('data-tip',text);
				$this.attr('href', 'javascript:void(0)');
				$this.attr('class', 'cart_added');

				var cart_count = $('.header-cart-count').html();
				if(cart_count == "5"){
					location.reload();
				}
            });

			$('.woocommerce-checkout').on("submit", function(e){
				// e.preventDefault();
				// if(confirm('Apakah data yang diinput sudah benar?')){
				// 	e.stopImmediatePropagation();
				// }
				// else{
				// 	e.stopImmediatePropagation();
				// }

			});
        });
    </script>
	<?php
}

add_filter( 'woocommerce_currency_symbol', 'change_currency_symbol', 10, 2 );

function change_currency_symbol( $symbols, $currency ) {
	if ( 'IDR' === $currency ) {
		return 'IDR ';
	}

    return $symbols;
}

// Thank you page
add_filter( 'the_title', 'woo_title_order_received', 10, 2 );

function woo_title_order_received( $title, $id ) {
	if ( function_exists( 'is_order_received_page' ) &&
	     is_order_received_page() && get_the_ID() === $id ) {
		$title = "Thank you!";
	}
	return $title;
}

add_action( 'woocommerce_add_to_cart_validation', 'restrict_cart_items' );

 function restrict_cart_items ($cart_item_data) {

 $item_count = WC()->cart->get_cart_contents_count();

 if($item_count >= 5){
    return false;
 }
   return $cart_item_data;
}

add_action('wp_logout','auto_redirect_after_logout');

function auto_redirect_after_logout(){
  wp_safe_redirect( home_url() );
  exit;
}

function register_paid_order_status() {
	register_post_status( 'wc-paid', array(
		'label'                     => 'Paid',
		'public'                    => true,
		'show_in_admin_status_list' => true,
		'show_in_admin_all_list'    => true,
		'exclude_from_search'       => false,
		'label_count'               => _n_noop( 'Paid <span class="count">(%s)</span>', 'Paid <span class="count">(%s)</span>' )
	) );
}
// Error Shipped
// add_action( 'init', 'register_shipped_order_status' );
// function add_shipped_to_order_statuses( $order_statuses ) {
// 	$new_order_statuses = array();
// 	foreach ( $order_statuses as $key => $status ) {
// 		$new_order_statuses[ $key ] = $status;
// 		if ( 'wc-processing' === $key ) {
// 			$new_order_statuses['wc-shipped'] = 'Shipped';
// 		}
// 	}
// 	return $new_order_statuses;
// }
// add_filter( 'wc_order_statuses', 'add_shipped_to_order_statuses' );

add_filter( 'wc_order_statuses', 'wc_renaming_order_status' );
function wc_renaming_order_status( $order_statuses ) {
    foreach ( $order_statuses as $key => $status ) {
        if ( 'wc-processing' === $key )
            $order_statuses['wc-processing'] = _x( 'Paid', 'Order status', 'woocommerce' );
    }
    return $order_statuses;
}

// add_filter('woocommerce_email_recipient_customer_processing_order', 'email_recipient_custom_notification', 10, 2);
// function email_recipient_custom_notification( $recipient, $order ) {

//     if ( ! is_a( $order, 'WC_Order' ) ) return $recipient;

//     // Set HERE your replacement recipient email(s)… (If multiple, separate them by a coma)
//     $recipient .= ', ferdinandphoee@gmail.com';
//     return $recipient;
// }

add_filter( 'woocommerce_email_headers', 'bbloomer_order_processing_email_add_bcc', 9999, 3 );

function bbloomer_order_processing_email_add_bcc( $headers, $email_id, $order ) {
    if ( 'customer_processing_order' == $email_id ) {
        $headers .= "Bcc: Ferdinand Phoe <ferdinandphoee@gmail.com>\r\n"; // delete if not needed
    }
    return $headers;
}

// Billing Fields.
// add_filter( 'woocommerce_billing_fields', 'custom_woocommerce_billing_fields' );
// function custom_woocommerce_billing_fields( $fields ) {
//     $fields['billing_address_2']['label_class'] = '';
//     $fields['billing_address_2']['label'] = 'Subdistrict';

//     return $fields;
// }

// // Shipping Fields.
// add_filter( 'woocommerce_shipping_fields', 'custom_woocommerce_shipping_fields' );
// function custom_woocommerce_shipping_fields( $fields ) {
//     $fields['shipping_address_2']['label_class'] = '';
//     $fields['shipping_address_2']['label'] = 'Subdistrict';

//     return $fields;
// }

// // Subdistrict ordering
// add_filter( 'woocommerce_checkout_fields', 'fdp_address_2_order' );

// function fdp_address_2_order( $checkout_fields ) {
// 	$checkout_fields[ 'billing' ][ 'billing_address_2' ][ 'priority' ] = 1;
// 	$checkout_fields[ 'shipping' ][ 'shipping_address_2' ][ 'priority' ] = 1;
// 	return $checkout_fields;
// }

add_filter( 'woocommerce_default_address_fields', 'mrks_woocommerce_default_address_fields' );

function mrks_woocommerce_default_address_fields( $fields ) {

    // default priorities:
    // 'first_name' - 10
    // 'last_name' - 20
    // 'company' - 30
    // 'country' - 40
    // 'address_1' - 50
    // 'address_2' - 60
    // 'city' - 70
    // 'state' - 80
    // 'postcode' - 90

  // e.g. move 'company' above 'first_name':
  // just assign priority less than 10
  $fields['address_2']['label'] = 'Sub District';
  $fields['address_2']['label_class'] = '';
  $fields['address_2']['priority'] = 43;

  return $fields;
}

function so_27023433_disable_checkout_script(){
    wp_dequeue_script( 'wc-checkout-js' );
}
add_action( 'wp_enqueue_scripts', 'so_27023433_disable_checkout_script' );




// Variation Products
function spvs_change_loop_add_to_cart() {
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	
	add_action( 'woocommerce_after_shop_loop_item', 'spvs_template_loop_add_to_cart', 10 );
}

add_action( 'init', 'spvs_change_loop_add_to_cart', 10 );

function spvs_template_loop_add_to_cart() {
	global $product;

	if ( ! $product->is_type( 'variable' ) ) {
		woocommerce_template_loop_add_to_cart();
		return;
	}

	remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
	add_action( 'woocommerce_single_variation', 'spvs_func_option_valgt' );
	add_action( 'woocommerce_single_variation', 'spvs_loop_variation_add_to_cart_button', 20 );

	woocommerce_template_single_add_to_cart();
}

function spvs_loop_variation_add_to_cart_button() {
    global $product;
    $id = $product->get_id();
    $sku = $product->get_sku();
    ?>

		<div class="woocommerce-variation-add-to-cart variations_button">
			<a id="button_cart_trial" class="disabled button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="" data-product_sku="<?php echo $sku ?>" rel="nofollow"><i class="fa fa-shopping-cart"></i></a>
			<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
			<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
			<input type="hidden" name="variation_id" class="variation_id" value="0" />
		</div>
    <?php
}

function spvs_func_option_valgt() {
    global $product;

	echo $in_cart;

    if ( $product->is_type('variable') ) {
        $variations_data =[];
        foreach($product->get_available_variations() as $variation ) {
		   $variations_data[$variation['variation_id']] = $variation;
        }
		// print_r($variations_data);
        ?>
       
        <script>
        
        jQuery(function($) {
            var jsonData = <?php echo json_encode($variations_data); ?>,
                inputVID = 'input.variation_id';

            $('input').change( function(){
                    var vid      = $(this).val(),
                        vprice   = ''; 
						vprodcutimage = '';
                    $.each( jsonData, function( index, data ) {
                        if( index == vid  ) {
                            vprice = data.display_price; 
							vprodcutimage = data.image.url;
							hrefDef = '?add-to-cart=';
                            getButton = $('input[value='+vid+']').closest('li.product').find('#button_cart_trial');
							$('input[value='+vid+']').parents('li').find("img.attachment-woocommerce_thumbnail").attr("src", vprodcutimage);
							$('input[value='+vid+']').parents('li').find("img.attachment-woocommerce_thumbnail").attr("srcset", vprodcutimage);
							getButton.removeClass('disabled').attr("data-product_id", vid);
							getButton.attr("href",hrefDef+vid);
                        }
                    });

                    
                //}
            });
        });
		 </script>
        <?php
    }
}



// sort product by latest
add_action( 'pre_get_posts', 'haldin_product_default_sort_latest' );
function haldin_product_default_sort_latest( $query ) {

    // hanya frontend
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    // hanya halaman produk WooCommerce
    if ( is_shop() || is_product_category() || is_product_tag() ) {

        $query->set( 'orderby', 'date' );
        $query->set( 'order', 'DESC' );

    }
}



// add_action('wp_enqueue_scripts', function () {
//     wp_enqueue_script('jquery');
// });
