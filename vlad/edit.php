<?php
$host="localhost"; 
$user="scalesrzn_phplab"; 
$pass="WCHx&Z2l";
$database='scalesrzn_phplab';
$file_path = 'Images/';
if ($_SERVER['REQUEST_METHOD'] == 'GET')   $id = clearData($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST')  $id = clearData($_POST['id']);

$dbh = mysqli_connect($host, $user, $pass, $database);
$result = mysqli_query($dbh, "SELECT * FROM ITEMS WHERE nametovar='$id'");
$row = mysqli_fetch_row($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!empty($_POST['brand']) && !empty($_POST['year']) && !empty($_POST['description']))
	{
		$nametovar = clearData($_POST['nametovar']);
		$total_items = mysqli_fetch_row(mysqli_query($dbh,"SELECT COUNT(*) FROM ITEMS WHERE nametovar='$nametovar'"));
		$brand = clearData($_POST['brand']);
		$year = clearData($_POST['year']);
		$description = clearData($_POST['description']);
		$description = preg_replace("~(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}".
				"(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\.)+(?:com|net|".
				"org|mil|edu|arpa|gov|biz|info|aero|inc|name|[a-z]{2})|(?!0)(?:(?".
				"!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(?:/[a-z0-9.,_@%&".
				"?+=\~/-]*)?(?:#[^ '\"&<>]*)?~i",'',$description);
		if (($nametovar <> $row[0]) or (!empty($_FILES['uploadfile']['name'])))
		{
			if ($nametovar <> $row[0])
			{
				rename($row[7], $file_path . $nametovar . '.jpg');
			}
			if (!empty($_FILES['uploadfile']['name']))
			{
				$tmp_path = 'tmp/';
				$result = imageCheck();
				if ($result == 1)
				{
					$name = resize($_FILES['uploadfile']);
					$uploadfile = $file_path . $name;
					if (@copy($tmp_path . $name, $file_path . $nametovar . '.jpg'))
						unlink($tmp_path . $name);
				}
				else
				{
					echo $result;
					exit;
				}
			}
			$uploadlink = $file_path . $nametovar . '.jpg';
			
			$query = "UPDATE ITEMS SET nametovar='$nametovar',brand='$brand',year='$year',DESCRIPTION='$description',uploadlink='$uploadlink' WHERE nametovar='$id'";
		}
		else
		{
			
			$query = "UPDATE ITEMS SET nametovar='$nametovar',brand='$brand',year='$year',DESCRIPTION='$description' WHERE nametovar='$id'";
		}
		mysqli_query($dbh, $query) or die ("Сбой при доступе к БД: " );
		header("Location: index.php?page=catalog");
	}
	else echo 'Полностью заполните форму';	
}

?>
	
	<h2 style="margin: 10px 100px 30px 200px;">Редактирование товара</h2>
	<form method='POST' action='index.php?page=edit&id=<?php echo $id; ?>' ENCTYPE='multipart/form-data'>			
		<input type='text' hidden name='id' value='<?=$row[0]?>'>	
		<table>
			<tr>
				<th>Название товара:</th>
				<td><input type='text' name='nametovar' value='<?=$row[0]?>' size="35"></td>
			</tr>
			<tr>
				<th>Бренд:</th> 
				<td><input type='text' name='brand' value='<?=$row[2]?>' size="35"></td>
			</tr >
			<tr>
				<th>Год модели:</th>
				<td><input type='text' name='year' value='<?=$row[3]?>' size='4'>&nbsp;год</td>
			</tr>
			<tr>
				<th>Описание:</th>
				<td><textarea name='description' rows='10' cols='50' style="resize:none;" ><?=$row[4]?></textarea></td>
			</tr>
			<tr>
				<th>Изображение:</th> 
				<td><input type='file' name='uploadfile'></td>
			</tr>
		</table>
		<center><p><input class="btn" type='submit' value='Сохранить'></p></center>
	</form>