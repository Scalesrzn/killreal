<div  >
	<form method='GET' action='index.php'>
		<input type='hidden' name='page' value='catalog'>
		<p>Доктор:</br><input type='text' name='doctor' style='margin-left:45px'><? $doctor ?></input></p>
		<p>Ваше имя:</br><input name='name' style='margin-left:32px'><? $name ?></input></p>
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
		$user="scalesrzn_killre"; 
		$pass="kvXzsg4&";
		$database='scalesrzn_killre';
		$login = $_SESSION['user_login'];
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
		echo "<table   border='1'><tr>
		<th width='35%'><a href='index.php?page=catalog&sort=1&doctor=$doctor&type=$type'>Врач</a></th>
		<th width='25%'><a href='index.php?page=catalog&sort=2&doctor=$doctor&type=$type'>Имя пациента</a></th>
		<th width='20%'><a href='index.php?page=catalog&sort=3&doctor=$doctor&type=$type'>Дата посещения</a></th>
		<th width='15%'><a href='index.php?page=catalog&sort=4&doctor=$doctor&type=$type'>Описание недуга</a></th>
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
