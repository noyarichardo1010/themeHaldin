<?php
const AGILE_DOMAIN = "ekoyunianto";  # Example : define("domain","jim");
//const AGILE_USER_EMAIL = "eko.yunianto@haldin-natural.com";
const AGILE_USER_EMAIL = "indraya.hutagalung@haldin-natural.com";
const AGILE_REST_API_KEY = "3tqib27gv4nh0p6gmko2a685bs";

function curl_wrap($entity, $data, $method, $content_type) {
	if ($content_type == NULL) {
		$content_type = "application/json";
	}

	$agile_url = "https://" . AGILE_DOMAIN . ".agilecrm.com/dev/api/" . $entity;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
	curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, true);
	switch ($method) {
		case "POST":
			$url = $agile_url;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			break;
		case "GET":
			$url = $agile_url;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			break;
		case "PUT":
			$url = $agile_url;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			break;
		case "DELETE":
			$url = $agile_url;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			break;
		default:
			break;
	}
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		"Content-Type:$content_type;", 'Accept:application/json'
	));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERPWD, AGILE_USER_EMAIL . ':' . AGILE_REST_API_KEY);
	curl_setopt($ch, CURLOPT_TIMEOUT, 120);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}


function agile_create_contact( $data ) {
	$address = [
		"address" => $data['address'],
		"city" => $data['town'],
		"state" => $data['region'],
		"country" => $data['country']
	];
	$contact_email = $data['user_email'];
	$contact_json = array(
		"lead_score"=>"0",
		"star_value"=>"0",
		"tags"=>array("User Web registration"),
		"properties"=>array(
			array(
				"name"=>"first_name",
				"value"=> $data['first_name'],
				"type"=>"SYSTEM"
			),
			array(
				"name"=>"last_name",
				"value"=>$data['last_name'],
				"type"=>"SYSTEM"
			),
			array(
				"name"=>"email",
				"value"=>$contact_email,
				"type"=>"SYSTEM"
			),
			array(
				"name"=>"title",
				"value"=> "",
				"type"=>"SYSTEM"
			),
			array(
				"name"=>"address",
				"value"=>json_encode($address),
				"type"=>"SYSTEM"
			),
			array(
				"name"=>"phone",
				"value"=> $data['phone'],
				"type"=>"SYSTEM"
			),
		)
	);

	$contact_json = json_encode($contact_json);
	curl_wrap("contacts", $contact_json, "POST", "application/json");
}

