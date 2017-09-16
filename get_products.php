<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	session_start();
	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;
	require __DIR__.'/conf.php';
	
	// $shopify = shopify\client($_SESSION['shop'], SHOPIFY_APP_API_KEY, $_SESSION['oauth_token']);
	$shopify = shopify\client('logicats-demo.myshopify.com', SHOPIFY_APP_API_KEY, '84d6afd04f4486aca0f9d44dc884aed1');
	try
	{
		# Making an API request can throw an exception
		$products = $shopify('GET /admin/products.json', array('published_status'=>'published'));

	


		$obj = json_decode($products);
		print_r($obj);
	}
	catch (shopify\ApiException $e)
	{
		# HTTP status code was >= 400 or response contained the key 'errors'
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}
	catch (shopify\CurlException $e)
	{
		# cURL error
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}
?>