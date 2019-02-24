<?php
/*
	Есть отсортированный по возрастанию массив из 1000 элементов. 
	Есть число, которое точно есть в этом массиве. Выведите на экран его порядковый номер.
	Функции поиска элемента в массиве не используйте, напишите цикл.
*/

/*
	binarySearch - функция для поиска элемента в массиве
	$arr - массив, в ктором производится поиск
	$elem - значение, которое нужно найти
	Возвращаемое значение - порядковый номер искомого элемнта ($elem) в массиве ($arr)
	В случае отсутствия искомого элемента в массиве возвращается значение -1
*/
function binarySearch($arr, $elem)
{
	$left = 0;
	$right = count($arr) - 1;
	while($left < $right)
	{
		$middle = (int)($left + ($right - $left) / 2);

		if($arr[$middle] < $elem)
		{
			$left = $middle + 1;
		}
		if($arr[$middle] > $elem)
		{
			$right = $middle - 1;
		}
		if($arr[$middle] == $elem)
		{
			return ++$middle;
		}
	}
	return -1;
}


for($i = 0; $i<1000; $i++)
{
	$array[$i] = $i*$i;
}

$search_value = 64;
$result = binarySearch($array, $search_value);

if($result != -1)
{
	echo "Зачение ".$search_value." имеет порядковый номер ". $result;
}
else
{
	echo "Значение не найдено";
}

?>