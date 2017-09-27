<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://logicats-demo.myshopify.com/admin/orders.json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "authorization: Basic YTdjMzEwMmZlOWM4YmVkNTlkNzA3YmNiNWFlOGU0YTU6YmRlNWE1MDE5ZGM1NjYwMTk1NmIxNDczMmM1NmY3NmU=",
    "cache-control: no-cache",
    "postman-token: 170762fd-e479-1022-caaa-291ec01d257f"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;