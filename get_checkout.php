<?php

	session_start();

	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;

	require __DIR__.'/conf.php';

	$shopify = shopify\client(SHOPIFY_SHOP, SHOPIFY_APP_API_KEY, SHOPIFY_APP_PASSWORD, true);
	 //print_r($shopify);
	try
	{
		# Making an API request can throw an exception
		$order = $shopify('GET /admin/order.json', array('published_status'=>'published'));
		print_r($order);
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
		echo '<br>';
		print_R($e->getRequest());
		print_R($e->getResponse());
	}

?>