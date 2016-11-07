<?php
	class Server {
		public function getUserList() {
			$db    = mysqli_connect('localhost', 'root', '', 'order');
			mysqli_set_charset($db, 'utf8');
			$query = 'SELECT * FROM `user` ORDER BY `surname`, `name`;';
			$result   = mysqli_query($db, $query);
			$response = mysqli_fetch_all($result);
			return json_encode($response);
		}
		public function getProductList() {
			$db    = mysqli_connect('localhost', 'root', '', 'order');
			mysqli_set_charset($db, 'utf8');
			$query = 'SELECT * FROM `product` ORDER BY `name`;';
			$result   = mysqli_query($db, $query);
			$response = mysqli_fetch_all($result);
			return json_encode($response);
		}
	}
	ini_set("soap.wsdl_cache_enabled", "0");
	$url = "http://localhost/SOAP/controller/server.wsdl";
	$server = new SoapServer($url);
	$server->setClass("Server");
	$server->handle();
?>