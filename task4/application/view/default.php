<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Country</title>
    <link href="public/styles/main.css" rel="stylesheet">
    <link href="public/styles/bootstrap.css" rel="stylesheet">
    <script src="public/scripts/jquery.js"></script>
</head>
<body>
	<form  method="post">
		<div class="form-group row">
			<label for="name" class="col-sm-2 col-form-label">Название страны</label>
			<div class="col-sm-3">
				<input type="text" name = "name" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label for="capital" class="col-sm-2 col-form-label">Столица</label>
			<div class="col-sm-3">
				<input type="text" name = "capital" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label for="population" class="col-sm-2 col-form-label">Население</label>
			<div class="col-sm-3">
				<input type="text" name = "population" class="form-control">
			</div>
		</div>

		<div class="form-group row">
			<label for="area" class="col-sm-2 col-form-label">Площадь</label>
			<div class="col-sm-3">
				<input type="text" name = "area" class="form-control">
			</div>
		</div>
		<input type="submit" value="Добавить" class="btn btn-primary">
	</form>
	<?php
	if(empty($country))
	{
		echo "<div class='alert alert-warning'> Список стран пуст </div>";
	}
	else
	{
	?>
		<div class="table-response">
		<table class="table table-striped table-condensed">
			<thead>
				<tr>
					<th>Название страны</th>
					<th>Столица </th>
					<th>Население </th>
					<th>Площадь</th>
				</tr>
			</thead>
			<tbody>
	<?
		foreach ($country as $key => $value) 
		{
			echo "<tr>";
			$id = false;
			foreach($value as $item)
			{
				if($id)
				{
					echo "<td>".htmlspecialchars($item)."</td>";
				}
				$id = true;
			}
			echo "</tr>";
		}
		?>
		</tbody>
		</table>
		</div>
		<? } ?>
</body>
</html>