<?php	
	$client   = new SoapClient("http://localhost/SOAP/controller/server.wsdl");
	$arrMet   = $client->__getFunctions();
	echo '<h3>Доступные методы</h3>';
	echo '<pre>';
	print_r($arrMet);
	echo '</pre>';
	echo '<hr/>';
	echo '<hr/>';
	
	$users    = json_decode($client->getUserList());
	echo '<h3>Пользователи</h3>';
	echo '<pre>';
	print_r($users);
	echo '</pre>';
	echo '<hr/>';
	
	$products    = json_decode($client->getProductList());
	echo '<h3>Товары</h3>';
	echo '<pre>';
	print_r($products);
	echo '</pre>';
	echo '<hr/>';
?>