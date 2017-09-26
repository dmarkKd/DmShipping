<?php

$_db = 'stores.json';

require_once( __DIR__ . '/inc/func.php' );

define('STORE_URL', 'https://nh1234.myshopify.com');
define('STORE_API_KEY', 'a7c3102fe9c8bed59d707bcb5ae8e4a5');
define('STORE_API_PASS', 'bde5a5019dc56601956b14732c56f76e');
define('STORE_API_SECRET', '61880ee65060befe116a1f1fc38a60d4');


$authCode = base64_encode( STORE_API_KEY . ':' . STORE_API_PASS );

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => STORE_URL. "/admin/products.json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "authorization: Basic ".$authCode,
    "cache-control: no-cache",
    "postman-token: 6c75449b-82d4-434f-185b-952dde5e150e"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}