<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	// keys will effectively prefix all session keys with the specified string.
	$client = new Predis\Client($single_server, array('prefix' => 'sessions:'));

	// Set `gc_maxlifetime` to specify a time-to-live of 5 seconds for session keys.
	$handler = new Predis\Session\Handler($client, array('gc_maxlifetime' => 5));

	// Register the session handler.
	$handler->register();

	// We just set a fixed session ID only for the sake of our example.
	session_id('example_session_id');
	session_start();

	if (isset($_SESSION['foo'])) {
	    echo "Session has `foo` set to {$_SESSION['foo']}", PHP_EOL;
	} else {
	    $_SESSION['foo'] = $value = mt_rand();
	    echo "Empty session, `foo` has been set with $value", PHP_EOL;
	}
	//session_start();
	print_r($_SESSION); die();
	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;

	require __DIR__.'/conf.php';

	# Guard: http://docs.shopify.com/api/authentication/oauth#verification
	// shopify\is_valid_request($_GET, SHOPIFY_APP_SHARED_SECRET) or die('Invalid Request! Request or redirect did not come from Shopify');


	# Step 2: http://docs.shopify.com/api/authentication/oauth#asking-for-permission
	if (!isset($_GET['code']))
	{
		$permission_url = shopify\authorization_url($_GET['shop'], SHOPIFY_APP_API_KEY, array('read_content', 'write_content', 'read_themes', 'write_themes', 'read_products', 'write_products', 'read_customers', 'write_customers', 'read_orders', 'write_orders', 'read_script_tags', 'write_script_tags', 'read_fulfillments', 'write_fulfillments', 'read_shipping', 'write_shipping'),REDIRECT_URL);

		die("<script> top.location.href='$permission_url'</script>");
	}


	# Step 3: http://docs.shopify.com/api/authentication/oauth#confirming-installation
	try
	{
		# shopify\access_token can throw an exception
		$oauth_token = shopify\access_token($_GET['shop'], SHOPIFY_APP_API_KEY, SHOPIFY_APP_SHARED_SECRET, $_GET['code']);

		$_SESSION['oauth_token'] = $oauth_token;
		$_SESSION['shop'] = $_GET['shop'];

		// echo 'App Successfully Installed!';
		$redirect_url = 'https://'.$_GET['shop'].'/admin/apps';
	
		echo "<script> top.location.href='$redirect_url'</script>";
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