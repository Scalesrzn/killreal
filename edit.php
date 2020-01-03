<?php
$id = clearData($_GET['id']);	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {		
	if (!empty($_POST['name']) && !empty($_POST['brand']) && !empty($_POST['year']) && !empty($_POST['description'])) {	
		if ($_FILES['uploadfile']['tmp_name']) {				
				$a = loadImage("edit"); 		
				if (empty($a['mess'])) {
					$_SESSION['catalog'][$id] = array("name"=>clearData($_POST['name']),
						"brand"=>clearData($_POST['brand']),
						"year"=>clearData($_POST['year']),
						"description"=>clearData($_POST['description']),
						"image"=>$a['src']);			
					header("Location: index.php?page=catalog");
					exit;
				}
				else { 
					echo $a['mess'];
				}
			}
			else {		
				$src = $_SESSION['catalog'][$id]['image'];
				$_SESSION['catalog'][$id] = array("name"=>clearData($_POST['name']),
					"brand"=>clearData($_POST['brand']),
					"year"=>clearData($_POST['year']),
					"description"=>clearData($_POST['description']),
					"image"=>$src);			
				header("Location: index.php?page=catalog");
				exit;
			}
		}
		else 
			echo '<font size="5" color="DarkRed"><strong>Заполните все поля!</strong></font>';		
	}
	?>
	
	<h2 style="margin: 10px 100px 30px 200px;">Редактирование товара</h2>
	<form method='POST' action='index.php?page=edit&id=<?php echo $id; ?>' ENCTYPE='multipart/form-data'>			
		<table>
			<tr>
				<th>Название товара:</th>
				<td><input type='text' name='name' value='<?=$_SESSION['catalog'][$id]['name']?>' size="35"></td>
			</tr>
			<tr>
				<th>Бренд:</th> 
				<td><input type='text' name='brand' value='<?=$_SESSION['catalog'][$id]['brand']?>' size="35"></td>
			</tr >
			<tr>
				<th>Год модели:</th>
				<td><input type='text' name='year' value='<?=$_SESSION['catalog'][$id]['year']?>' size='4'>&nbsp;год</td>
			</tr>
			<tr>
				<th>Описание:</th>
				<td><textarea name='description' rows='10' cols='50' style="resize:none;" ><?=$_SESSION['catalog'][$id]['description']?></textarea></td>
			</tr>
			<tr>
				<th>Изображение:</th> 
				<td><input type='file' name='uploadfile'></td>
			</tr>
		</table>
		<center><p><input class="btn" type='submit' value='Сохранить'></p></center>
	</form>