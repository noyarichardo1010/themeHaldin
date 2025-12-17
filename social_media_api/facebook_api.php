<?php
const FACEBOOK_API_URL = 'https://graph.facebook.com/';
function overwrite_shortcode_fb_shortcode()
{

	function fts_facebook_extend($atts)
	{
		$access_token = get_option( 'fts_facebook_custom_api_token' )?? false;
		$id = $atts['id'] ?? false;
		if (!$access_token || !$id) return false;
		try {
			$response = curl_data(FACEBOOK_API_URL . $id . '/posts?fields=id,created_time,message,full_picture&limit=1&access_token=' . $access_token);
			$content = '';
			if ($response) {
				$response = json_decode($response);
				if (isset($response->data) && count($response->data) > 0) {
					$data_socmed = [
						'type' => 'facebook',
						'message' => $response->data[0]->message,
						'date' => $response->data[0]->created_time,
						'image' => $response->data[0]->full_picture ?? null
					];
					$content = generate_socmed_data($data_socmed);
				}
			}
			return $content;

		} catch (\Exception $e) {
			return false;
		}

	}

	remove_shortcode('fts_facebook');
	add_shortcode('fts_facebook', 'fts_facebook_extend');
}

add_action('wp_loaded', 'overwrite_shortcode_fb_shortcode');

function generate_fb_feed_page() {
	echo do_shortcode('[fts_facebook id=393431514059580]');
	die();
}

add_action('wp_ajax_nopriv_generate_fb_feed_page', 'generate_fb_feed_page');
add_action('wp_ajax_generate_fb_feed_page', 'generate_fb_feed_page');

