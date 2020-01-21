

<?php
	$host="localhost"; 
	$user="scalesrzn_killre"; 
	$pass="kvXzsg4&";
	$database='scalesrzn_killre';
	$login = $_SESSION['user_login'];
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!empty($_POST['DOCTOR']) && !empty($_POST['namepac']) && !empty($_POST['year']) && !empty($_POST['description']))
	{
		$DOCTOR = clearData($_POST['DOCTOR']);
		if (!preg_match("/^[a-zA-Zа-яёА-ЯЁ][\w\s:-]{2,50}$/iu", $DOCTOR)) {
			echo '<h3>Введите корректное название записи</h3>';
			exit;
		}
		$DOCTOR = clearData($_POST['DOCTOR']);
		$dbh = mysqli_connect($host, $user, $pass, $database);
		$result = mysqli_query($dbh,"SELECT COUNT(*) FROM ITEMS WHERE DOCTOR='$DOCTOR'");
		$total_items = mysqli_fetch_row($result);
		if ($total_items[0] < 1)
		{
			
			$namepac = clearData($_POST['namepac']);
			$year = clearData($_POST['year']);
			$description = clearData($_POST['description']);
			$description = preg_replace("~(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}".
				"(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\.)+(?:com|net|".
				"org|mil|edu|arpa|gov|biz|info|aero|inc|name|[a-z]{2})|(?!0)(?:(?".
				"!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(?:/[a-z0-9.,_@%&".
				"?+=\~/-]*)?(?:#[^ '\"&<>]*)?~i",'',$description);
			if (!empty($_FILES['uploadfile']['name']))
			{
				$tmp_path = 'tmp/';
				$result = imageCheck();
				$file_path = 'Images/';
				if ($result == 1)
				{
					$name = resize($_FILES['uploadfile']);
					$uploadfile = $file_path . $name;
					if (@copy($tmp_path . $name, $file_path . $DOCTOR . '.jpg'))
						unlink($tmp_path . $name);
				}
				else
				{
					echo $result;
					exit;
				}
			}
			$uploadlink = $file_path . $DOCTOR . '.jpg';
			$query = "INSERT INTO ITEMS (DOCTOR,NAME,year,DESCRIPTION,uploadlink, Login) VALUES ('$DOCTOR','$namepac','$year','$description','$uploadlink', '$login')";
			mysqli_query($dbh, $query) or die ("Сбой при доступе к БД: ");
			header("Location: index.php?page=catalog");
		}
		else echo 'Такой товар уже существует';
	}
	else echo 'Полностью заполните форму';
}
?>


<h2 style="margin: 10px 100px 30px 200px;">Добавить запись</h2>
<form class="addtable" method='POST' action='index.php?page=add' ENCTYPE='multipart/form-data'>			
	<table>
		<tr>
			<th>Доктор:</th>
			<td><input type='text' name='DOCTOR' style="width:150%"></td>
		</tr>
		<tr>
			<th>Пациент:</th> 
			<td><input type='text' name='namepac' style="width:150%"></td>
		</tr>			 			
		<tr>
			<th>Дата посещения:</th>
			<td><input type='text' name='year' size='4'>&nbsp;год</td>
		</tr>
		<tr>
			<th>Описание:</th>
			<td><textarea name='description' rows='10' style="resize:none; width:150%"></textarea></td>
		</tr>
		<tr>
			<th>Изображение:</th> 
			<td><input type='file' name='uploadfile' accept='.jpg'></td>
		</tr>
	</table>
	<center><p><input class="btn" type='submit' value='Добавить' name='add' style="margin: 5px 0px 100px 100px"></p></center>
</form>