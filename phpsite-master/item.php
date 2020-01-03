<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$id = clearData($_GET['id']);
}
?>

<br/>
<a href='index.php?page=catalog'><button class='btn'>Назад</button></a>
<a href='index.php?page=edit&id=<? echo $id; ?>'><button class='btn'>Редактировать</button></a>
<br/><br/>
<table border="1" style="text-align:left;" align="center" >
	<tr>
		<th width="15%" bgcolor="#FA8072">Товар</th>
		<td  ><?= $_SESSION['catalog'][$id]['name'] ?></td>
		<td rowspan="4"><img src='<?php if (empty($_SESSION['catalog'][$id]['image'])) echo "images/catalog/no-image.jpg"; else echo $_SESSION['catalog'][$id]['image'].'.jpg';?> '></td>
	</tr>
	<tr>
		<th bgcolor="#FA8072">Бренд</th>
		<td  width="45%"><?= $_SESSION['catalog'][$id]['brand']?></td>
	</tr>
	<tr>
		<th bgcolor="#FA8072">Год модели</th>
		<td><?= $_SESSION['catalog'][$id]['year'] ?> год</td>
	</tr>
	<tr height="150">
		<th width="15%" bgcolor="#FA8072">Описание</th>
		<td valign="top"><?= $_SESSION['catalog'][$id]['description'] ?></td>
	</tr>
</table>
<br/>
