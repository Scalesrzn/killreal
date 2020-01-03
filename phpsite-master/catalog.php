<?php
	if (isset($_POST['add'])) header("Location: index.php?page=add");
	?>
	<div style="width:800px">
		<h2 style="margin: 0px 100px 30px 400px;">Каталог</h2>	
		<form action="index.php?page=catalog" method="POST">
			<div> 
                <input  class="btn" type="submit" name="add" value="Добавить">
                <input  class="btn" type="submit" name="del" value="Удалить">
			</div>	
			<?php	  
			if	(isset($_POST['del'])) {	
				if (!empty($_POST['delId'])) {			    
					foreach($_POST['delId'] as $val) {
						@unlink($_SESSION['catalog'][$val]['image'].'.jpg');   
						unset($_SESSION['catalog'][$val]);
					}
				}
				else echo "<font size='5' color='DarkRed'><strong>Выберите записи для удаления!</strong></font>";
			}
			?>		
			<br>
			<table class="addtable" style="width: 100%; height: 100%" text-align="center" border="1" >
				<tr>
					<th></th>
					<th>Товар</th>
					<th>Бренд</th>				
					<th>Год модели</th>
					<th>Описание</th>
					<tr>			
						<?php
						if (!empty($_SESSION['catalog'])){
							foreach($_SESSION['catalog'] as $brand => $massiv) {
								echo "<tr>";						
								echo "<td width='10px'><input type='checkbox' name='delId[]' value=$brand></td>";
								echo "<td><a href='index.php?page=item&id=$brand'>".$massiv['name']."</a></td><td>".$massiv['brand']."</td><td>".$massiv['year']."</td><td>".$massiv['description']."</td>";
								echo "</tr>";
							}
						}
						?>
					</table>
				</form>
			</div>

