<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	session_start();

	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;

	require __DIR__.'/conf.php';



	// $shopify = 'https://logicats-demo.myshopify.com/admin/themes/1458896922/assets.json';

	$url = file_get_contents("https://logicats-demo.myshopify.com/admin/themes/1458896922/assets.json");

	echo "<script> top.location.href='$url'</script>";


	

?>