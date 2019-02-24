<?php

//Автозагрузка классов
spl_autoload_register(function ($class) {
	$path = $_SERVER['DOCUMENT_ROOT'].'/task4/application/classes/' . $class . '.php';
    include_once $path;
});

$db = new Db();

//Получаем массив всех стран, которые на данный момент есть в БД
$country = $db->getAllCountry();

if(!empty($_POST))
{
	/*
		Если смогли добавить введенные данные, то редирект на эту же страницу 
		Иначе Выводим ошибку
	*/
	if($db->addCountry($_POST))
	{
		header("Location: ". $_SERVER["HTTP_REFERER"]);
	}
	else
	{
		$db->error();
	}
}

//Подключаем шаблон
require_once $_SERVER['DOCUMENT_ROOT'].'/task4/application/view/default.php';
?>