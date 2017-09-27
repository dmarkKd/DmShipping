<?php

	session_start();

	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;

	require __DIR__.'/conf.php';



	$shopify = 'https://logicats-demo.myshopify.com/admin/themes/1458896922/assets.json';

	print_r($shopify);
	try
	{
		# Making an API request can throw an exception
		$shop = $shopify('GET /admin/shop.json');
	
	}
	catch (shopify\ApiException $e)
	{
		# HTTP status code was >= 400 or response contained the key 'errors'
		echo $e;
		print_R($e->getRequest());
		print_R($e->getResponse());
	}
	catch (shopify\CurlException $e)
	{
		# cURL error
		echo $e;
		print_R($e->getRequest());
		print_R($e->getResponse());
	}
?>