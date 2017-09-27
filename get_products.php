<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	session_start();
	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;
	require __DIR__.'/conf.php';
	require __DIR__.'/func.php';

	
	print_r($_SESSION['oauth_token']); 
   
	
	$shopify = shopify\client($_GET['shop'], SHOPIFY_APP_API_KEY, $oauth_token);
	try
	{
		# Making an API request can throw an exception
		$products = $shopify('GET /admin/products.json', array('published_status'=>'published'));
		pr($products);
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