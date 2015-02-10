<?php
define("AGILE_DOMAIN", "your_agile_domain");
define("AGILE_USER_EMAIL", "your_agile_user_email");
define("AGILE_REST_API_KEY", "your_agile_api_key");

function curl_wrap($entity, $data, $method){
$agile_url = "https://".AGILE_DOMAIN.".agilecrm.com/dev/api/";

$ch = curl_init();
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, true);

switch($method)
{
  case "POST":
    curl_setopt($ch, CURLOPT_URL, $agile_url.$entity);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    break;
  case "GET":
    curl_setopt($ch, CURLOPT_URL, $agile_url.$entity);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    break;
  case "PUT":
    curl_setopt($ch, CURLOPT_URL, $agile_url.$entity);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    break;
  case "DELETE":
    curl_setopt($ch, CURLOPT_URL, $agile_url.$entity);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    break;
  default:
    break;
}

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type : application/json; charset : UTF-8;'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, AGILE_USER_EMAIL.':'.AGILE_REST_API_KEY);
curl_setopt($ch, CURLOPT_TIMEOUT, 120);

$output = curl_exec($ch);
curl_close($ch);
return $output;
}
?>
