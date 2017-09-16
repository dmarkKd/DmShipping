<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	session_start();
	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;
	require __DIR__.'/conf.php';
	require __DIR__.'/func.php';
	
	//$shopify = shopify\client($_SESSION['shop'], SHOPIFY_APP_API_KEY, $_SESSION['oauth_token']);
	$shopify = shopify\client('logicats-demo.myshopify.com', SHOPIFY_APP_API_KEY, '84d6afd04f4486aca0f9d44dc884aed1');
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

	 $arrayName = array('data' => 'value', 'data1' => 'value1' );

	
	   ?>
	 <!DOCTYPE html>
		<html>
		<body>
			<?php header('Content-Type: application/liquid'); ?>
		<form action="/action_page.php">
		  <fieldset>
		    <legend>Personal information:</legend>
		    First name:<br>
		    <?php foreach ($arrayName as  $value) {
			 	 echo '<h1>'.$value. '</h1>';
			 	# code...
			 } ?>
		    <input type="text" name="firstname" value="Mickey">
		    <br>
		    Last name:<br>
		    <input type="text" name="lastname" value="Mouse">
		    <br><br>
		    <input type="submit" value="Submit">
		  </fieldset>
		</form>

		</body>
		</html>