<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id']))
{
	$id = clearData($_GET['id']);
	$dbh = mysqli_connect($host, $user, $pass, $database);
	$query = "SELECT * FROM ITEMS WHERE nametovar='$id'";
	$result = mysqli_query($dbh, $query) or die("Сбой при доступе к БД: " );
	$row = mysqli_fetch_row($result);
}
?>

<br/>
<a href='index.php?page=catalog'><button class='btn'>Назад</button></a>
<a href='index.php?page=edit&id=<?=$row[0]?>'><button class='btn'>Редактировать</button></a>
<br/><br/>
<table border="1" style="text-align:left;" align="center" >
	<tr>
		<th width="15%" bgcolor="#FA8072">Товар</th>
		<td  ><?= $row[0] ?></td>
		<td rowspan="4"><img src='<?= $row[4] ?> '></td>
	</tr>
	<tr>
		<th bgcolor="#FA8072">Бренд</th>
		<td  width="45%"><?= $row[1] ?></td>
	</tr>
	<tr>
		<th bgcolor="#FA8072">Год модели</th>
		<td><?= $row[2] ?> год</td>
	</tr>
	<tr height="150">
		<th width="15%" bgcolor="#FA8072">Описание</th>
		<td valign="top"><?= $row[3] ?></td>
	</tr>
</table>
<br/>
