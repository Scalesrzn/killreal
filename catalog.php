<!-- <?php
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
					<th>Ваше имя</th>
					<th>Врач</th>				
					<th>Дата посещения</th>
					<th>Описание</th>
					<tr>			
						<?php
						if (!empty($_SESSION['catalog'])){
							foreach($_SESSION['catalog'] as $doctor => $massiv) {
								echo "<tr>";						
								echo "<td width='10px'><input type='checkbox' name='delId[]' value=$doctor></td>";
								echo "<td><a href='index.php?page=item&id=$doctor'>".$massiv['name']."</a></td><td>".$massiv['doctor']."</td><td>".$massiv['year']."</td><td>".$massiv['description']."</td>";
								echo "</tr>";
							}
						}
						?>
					</table>
				</form>
			</div>
 -->
 

 <div class='addtable'>
	<form method='GET' action='index.php'>
		<input type='hidden' name='page' value='catalog'>
		<p>Название товара:</br><input type='text' name='doctor' style='margin-left:45px'><? $doctor ?></input></p>
		<p>Бренд:</br><input name='name' style='margin-left:32px'><? $name ?></input></p>
		<input type='submit' value='Поиск' class='btn'>
	</form>
</div>

<button onclick="location.href='index.php?page=add';" class="btn" style="float: left;">Добавить</button>

	<?php
		$doctor = "";
		$where = "";
		$and = "";
		$condition2 = "";
		$sort = "";
		$type = "";
		$order_by = "";
		$host="localhost"; 
		$user="scalesrzn_phplab"; 
		$pass="WCHx&Z2l";
		$database='scalesrzn_phplab';
		$dbh = mysqli_connect($host, $user, $pass, $database);
		if (isset($_POST['delete']) && isset($_POST['cbs']))
		{
			$cbs = $_POST['cbs'];
			$count = count($_POST['cbs']);
			for ($i = 0; $i < $count; $i++) 
			{
				$del = $cbs[$i];
				$result = mysqli_query($dbh, "SELECT * FROM ITEMS WHERE doctor='$del'") or die("Сбой при доступе к БД1: " );
				$row = mysqli_fetch_row($result);
				if (!empty($row[7]))
				{
					unlink($row[7]);
				}
				mysqli_query($dbh, "DELETE FROM ITEMS WHERE doctor='$del'") or die("Сбой при доступе к БД: " );
			}
			header("Refresh");
		}
		if (isset($_GET['sort'])) {
			$sort = clearData($_GET['sort']);
			switch($sort) {
				case '1': $order_by = 'ORDER BY DOCTOR'; break;
				case '2': $order_by = 'ORDER BY NAME'; break;
				case '3': $order_by = 'ORDER BY YEAR'; break;
			}
		}
		
		if (!empty($_GET['doctor']) or !empty($_GET['type'])) {
			$where = "WHERE ";
			if (!empty($_GET['doctor'])) {
				$doctor = clearData($_GET['doctor']);
				if (!preg_match("/.{2,}/", $doctor)) {
					echo '<h3>Строка для поиска должна состоять из 2 или более символов</h3>';
					exit;
				}
				if (!preg_match("/[\D]{1,}/", $doctor)) {
					echo '<h3>Строка для поиска должна состоять только из цифр</h3>';
					exit;
				}
				
				$doctor = preg_split('/[\s]+/', $doctor);
				$doctor = preg_grep('/[\D]{1,}/', $doctor);
				for ($i=0; $i<count($doctor); $i++) {
					$conditions[] = "UPPER (doctor) LIKE UPPER('%".$doctor[$i]."%')";
				}
				$doctor = implode($doctor);
			}
			if (!empty($_GET['name'])) {
				if (!empty($_GET['doctor'])) $and = "AND ";
				$name = clearData($_GET['name']);
				$condition2 = "name LIKE '%".$name."%'";
			}
		}
		else $conditions[]='';
		
		$num = '';
		if (!empty($_GET['n']))
			$n = clearData($_GET['n']);
		if(empty($n) or $n < 0) $n = 1;
		$start = $n * $num - $num;
		$total_items = mysqli_fetch_row(mysqli_query($dbh,"SELECT COUNT(*) FROM ITEMS ". $where . implode(' OR ', $conditions). $and . $condition2));
		if ($total_items[0] == 0) {
			echo '<h3>Ничего не найдено</h3>';
			exit;
		}
		$login = $_SESSION['user_login'];
		if ($login='admin'){
			$query = "SELECT * FROM ITEMS ". $where . implode(' OR ', $conditions). $and . $condition2. " ". $order_by;
		}
		else {
			$query = "SELECT * FROM ITEMS WHERE Login='$login'" . implode(' OR ', $conditions). $and . $condition2. " ". $order_by;
		}
		$result = mysqli_query($dbh, $query);
		echo "<table class='addtable' border='1'><tr>
		<th width='35%'><a href='index.php?page=catalog&sort=1&doctor=$doctor&type=$type'>Название товара</a></th>
		<th width='25%'><a href='index.php?page=catalog&sort=2&doctor=$doctor&type=$type'>Бренд</a></th>
		<th width='20%'><a href='index.php?page=catalog&sort=3&doctor=$doctor&type=$type'>Год модели</a></th>
		<th width='15%'><a href='index.php?page=catalog&sort=4&doctor=$doctor&type=$type'>Описание</a></th>
		<th width='5%'></th></tr>";

		while ($row = mysqli_fetch_row($result)) 
		{
			echo "
			<tr>
				<td>
					<a href='index.php?page=item&id=$row[0]'>
						$row[0]
					</a>
				</td>
				<td>$row[1]</td>
				<td>$row[2]</td>
				<td>$row[3]</td>
				<td>
					<form method='POST'>
					<input type='checkbox' name='cbs[]' value=$row[0] />
				</td>
			</tr>";
		}
		echo "
		<input class='btn' id='delete' type='submit' name='delete' value='Удалить' class='catalog_2'/>
		</form>
		</table>
		<div style='margin-left:40px'>Число записей: <b>$total_items[0]</b></div>";
		getOutputMenu($num,$total_items,$n,'page=catalog&sort='.$sort.'&doctor='.$doctor.'&type='.$type);
	?>
