<?php
const INSTAGRAM_API = 'https://graph.facebook.com/';
function generate_instagram_feed() {
	echo do_shortcode('[fts_instagram instagram_id=17841444954859020]');
	die();
}
add_action('wp_ajax_nopriv_generate_instagram_feed', 'generate_instagram_feed');
add_action('wp_ajax_generate_instagram_feed', 'generate_instagram_feed');

function overwrite_shortcode_insta_shortcode()
{
	function fts_instagram_extend($atts)
	{
		$id = $atts['instagram_id'] ?? false;
		$access_token = get_option( 'fts_facebook_instagram_custom_api_token' ) ? get_option( 'fts_facebook_instagram_custom_api_token' ) : false;
		if (!$access_token || !$id) return false;
		try {
			$response = curl_data(INSTAGRAM_API . $id . '/media?fields=caption,id,media_url,media_type,permalink,thumbnail_url,timestamp,username&limit=1&access_token=' . $access_token);
			if ($response) {
				$response = json_decode($response);
				if (isset($response->data) && count($response->data) > 0) {
					$data_socmed = [
						'type' => 'instagram',
						'message' => $response->data[0]->caption,
						'date' => $response->data[0]->timestamp,
						'image' => $response->data[0]->media_url ?? null
					];
					return generate_socmed_data($data_socmed);
				}
			}
			return false;
		} catch (\Exception $e) {
			return false;
		}

	}

	remove_shortcode('fts_instagram');
	add_shortcode('fts_instagram', 'fts_instagram_extend');
}

add_action('wp_loaded', 'overwrite_shortcode_insta_shortcode');
