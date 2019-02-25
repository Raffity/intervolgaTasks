<?php 

class Db 
{
	private static $pdo;

	function __construct()
	{
		// Подключение к БД 
		$config = require 'application/config/db.php';
		try
		{
			$this->pdo = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'', $config['user'], $config['password']);
		}
		catch(PDOException $e)
		{
			echo "Подключение не удалось:". $e->getMessage();
			die;
		}
	}

	/*
		Проверка корректности введенных значений 
		Возвращает bool
	*/
	private function verification(array $params)
	{
		if(empty($params['name']) || empty($params['capital']) 
			|| empty($params['area']) || empty($params['area']))
		{
			$_POST['message'] = "Заполните все поля.";
			return false;
		}
		if(!is_numeric($params['population']) || !is_numeric($params['area']) ||
			$params['population'] < 1 || $params['area'] < 1)
		{
			$_POST['message'] = "Число жителей и площадь страны должны быть целыми числами.";
			return false;
		}
		$country = $this->getAllCountry();
		foreach ($country as $key => $value) 
		{
			if($value['name'] == $params['name'])
			{
				$_POST['message'] = "Страна с таким названием уже есть";
				return false;
			}
		}
		return true;
	}

	/*
		Возвращает массив всех стран
	*/
	public function getAllCountry()
	{
		$stmt = $this->pdo->prepare('SELECT * FROM country');
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/*
		Вывод ошибки
	*/
	public function error()
	{
		echo "<script> alert(\"".$_POST['message']. "\"); </script>";
	}

	/*
		Метод добавления страны в БД
		Возвращает bool
	*/
	public function addCountry($post)
	{
		$params = [
			'name' => $post['name'],
			'capital' => $post['capital'],
			'population' => $post['population'],
			'area' => $post['area'],
		];

		if(!$this->verification($params))
		{
			return false;
		}

		$stmt = $this->pdo->prepare("INSERT INTO country(name, capital, population, area)
				VALUES (:name, :capital, :population, :area)");
		if (!empty($params)) 
		{
			foreach ($params as $key => $val) 
			{
				if (is_int($val)) 
				{
					$type = PDO::PARAM_INT;
				} 
				else 
				{
					$type = PDO::PARAM_STR;
				}
				$stmt->bindValue(':'.$key, $val, $type);
			}
		}
		$stmt->execute();
		$_POST['message'] =  "Запись добавлена";
		return true;
	}
}

?>