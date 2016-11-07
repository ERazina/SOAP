﻿<?php	
	$client   = new SoapClient("http://localhost/SOAP/server.wsdl");
	$arrMet   = $client->__getFunctions();
	echo '<h3>Доступные методы</h3>';
	echo '<pre>';

	print_r($arrMet);
	echo '</pre>';
	echo '<hr/>';
//Получаем все товары, приобретенные пользователем



$getUser = json_decode($client->getUser());

echo '<h3>Список всех приобретенных товаров пользователем:</h3>';
echo "<form method='post'>
	id пользователя: <input type='number' name='id'><br/>
	<input type='submit' value='Получить данные'>
	</form>";
if(isset($_POST)) {
	$getUser = json_decode($client->getUser($_POST));
}
echo '<hr/>';


//Получаем всех пользователей, которые купили товар
//$getUser = json_decode($client->getUser());
/*echo '<h3>Список всех пользователей, которые приобрели товар</h3>';
echo "<form method='post'>
	id товара: <input type='number' name='id'><br/>
	<input type='submit' value='Получить данные'>
	</form>";
if(!empty($_POST)) {
	$getUser = json_decode($client->getUser($_POST));
}
echo '<hr/>';*/

//Получаем общую сумму продаж
echo "<form method='post'>
	id пользователя: <input type='number' name='id'><br/>
	<input type='submit' value='Общая сумма продаж'>
	</form>";
if(!empty($_POST)) {
	$getStat    = json_decode($client->getStat($_POST));
}
echo '<hr/>';


	//Выведем всех пользователей
	$users    = json_decode($client->getUserList());
echo '<h3>Список всех пользователей</h3>';
echo "<form method='post'>
	id пользователя: <input type='number' name='id'><br/>
	<input type='submit' value='Получить данные'>
	</form>";

	//print_r($users);

		foreach ($users as $key => $value) {
			echo '<ul>';
			echo "<li>$value[2] $value[1]</li>";
			echo "</ul>";
		}
	echo '<hr/>';

	//Выведем список всех товаров

	$products = json_decode($client->getProductList());
	echo '<h3>Список всех товаров</h3>';
	foreach ($products as $key => $value) {
	echo '<ul>';
	echo "<li>$value[1]</li>";
	echo "</ul>";
}
echo '<hr/>';

//Выведем статистику по продажам
$getStat    = json_decode($client->getStat(), true);

echo '<h3>Статистика по продажам</h3>';
//echo '<pre>';
//print_r($getStat);

	echo '<ul>';
	echo "<p>Общая сумма заказов:</p>";
	echo "<li>$getStat[sum];</li>";
	echo "<p>Общее число заказов:</p>";
	echo "<li>$getStat[count];</li>";
	echo "<p>Количество покупателей:</p>";
	echo "<li>$getStat[user_count];</li>";
	echo "<p>Общая сумма рекомендованных продаж:</p>";
	echo "<li>$getStat[recommended_sum];</li>";
	echo "<p>Общая сумма типовых продаж:</p>";
	echo "<li>$getStat[typical_sum];</li>";
	echo "</ul>";

echo '<hr/>';


?>