<?php
	class Server {
		//Получаем список всех пользователей
		public function getUserList() {
			$db    = mysqli_connect('localhost', 'root', '', 'order');
			mysqli_set_charset($db, 'utf8');
			$query = 'SELECT * FROM `user` ORDER BY `surname`, `name`;';
			$result   = mysqli_query($db, $query);
			$response = mysqli_fetch_all($result);
			return json_encode($response);
		}

		//получаем всех пользователей, которые купили товар
		public function getUser(){
			$db = mysqli_query('localhost', 'root', '', 'order');
			mysqli_set_charset($db, 'utf8');
			$query = 'SELECT `product`.`name`, `user`.`name` from `order`
					left join `product` on (`product`.`id` = `order`.`product_id`)
					left join `user` on (`user`.`id` = `order`.`user_id`)
					WHERE `product`.`id` = '.$id.'
					;';
			$responce = mysqli_query($db, $query);
			return json_encode($responce);
		}
		//Получаем список всех товаров
		public function getProductList(){
			$db = mysqli_connect('localhost', 'root', '', 'order');
			mysqli_set_charset($db, 'utf8');
			$query = 'SELECT * FROM `product` ORDER BY `name`;';
			$result = mysqli_query($db, $query);
			$response = mysqli_fetch_all($result);
			return json_encode($response);
		}
		//Получаем статистику по продажам
		public function getStat() {
			$db = mysqli_connect('localhost', 'root', '', 'order');
			mysqli_set_charset($db, 'utf8');
			$query = 'SELECT
						SUM(`typical` + `recommended`) AS `sum`,
						count(`id`) AS `count`,
						count(DISTINCT `user_id`) AS `user_count`,
						SUM(`recommended`) AS `recommended_sum`,
						SUM(`typical`) AS `typical_sum`
						FROM `order`
				;';
			$result = mysqli_query($db, $query);
			$response = mysqli_fetch_assoc($result);
			return json_encode($response);
		}



	}
	ini_set("soap.wsdl_cache_enabled", "0");
	$url = "http://localhost/SOAP/server.wsdl";
	$server = new SoapServer($url);
	$server->setClass("server");
	$server->handle();
?>