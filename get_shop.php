
<?php

	session_start();

	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;

	require __DIR__.'/conf.php';

	$shopify = shopify\client(SHOPIFY_SHOP, SHOPIFY_APP_API_KEY, SHOPIFY_APP_SHARED_SECRET, true);
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

<!-- https://b7578934bf19aa4c0f763b16b3964a58:5702c4b245785628d22a3822a2995970@nh1234.myshopify.com/admin/shop.json -->