	<div class='addtable'>
	<form method='GET' action='index.php'>
		<input type='hidden' name='page' value='catalog'>
		<p>Название товара:</br><input type='text' name='nametovar' style='margin-left:45px'><? $nametovar ?></input></p>
		<p>Бренд:</br><input name='brand' style='margin-left:32px'><? $brand ?></input></p>
		<input type='submit' value='Поиск' class='btn'>
	</form>
</div>

<button onclick="location.href='index.php?page=add';" class="btn" style="float: left;">Добавить</button>

	<?php
		$nametovar = "";
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
				$result = mysqli_query($dbh, "SELECT * FROM ITEMS WHERE nametovar='$del'") or die("Сбой при доступе к БД1: " );
				$row = mysqli_fetch_row($result);
				if (!empty($row[7]))
				{
					unlink($row[7]);
				}
				mysqli_query($dbh, "DELETE FROM ITEMS WHERE nametovar='$del'") or die("Сбой при доступе к БД: " );
			}
			header("Refresh");
		}
		if (isset($_GET['sort'])) {
			$sort = clearData($_GET['sort']);
			switch($sort) {
				case '1': $order_by = 'ORDER BY NAMETOVAR'; break;
				case '2': $order_by = 'ORDER BY BRAND'; break;
				case '3': $order_by = 'ORDER BY YEAR'; break;
			}
		}
		
		if (!empty($_GET['nametovar']) or !empty($_GET['type'])) {
			$where = "WHERE ";
			if (!empty($_GET['nametovar'])) {
				$nametovar = clearData($_GET['nametovar']);
				if (!preg_match("/.{2,}/", $nametovar)) {
					echo '<h3>Строка для поиска должна состоять из 2 или более символов</h3>';
					exit;
				}
				if (!preg_match("/[\D]{1,}/", $nametovar)) {
					echo '<h3>Строка для поиска должна состоять только из цифр</h3>';
					exit;
				}
				
				$nametovar = preg_split('/[\s]+/', $nametovar);
				$nametovar = preg_grep('/[\D]{1,}/', $nametovar);
				for ($i=0; $i<count($nametovar); $i++) {
					$conditions[] = "UPPER (nametovar) LIKE UPPER('%".$nametovar[$i]."%')";
				}
				$nametovar = implode($nametovar);
			}
			if (!empty($_GET['brand'])) {
				if (!empty($_GET['nametovar'])) $and = "AND ";
				$brand = clearData($_GET['brand']);
				$condition2 = "brand LIKE '%".$brand."%'";
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
		<th width='35%'><a href='index.php?page=catalog&sort=1&nametovar=$nametovar&type=$type'>Название товара</a></th>
		<th width='25%'><a href='index.php?page=catalog&sort=2&nametovar=$nametovar&type=$type'>Бренд</a></th>
		<th width='20%'><a href='index.php?page=catalog&sort=3&nametovar=$nametovar&type=$type'>Год модели</a></th>
		<th width='15%'><a href='index.php?page=catalog&sort=4&nametovar=$nametovar&type=$type'>Описание</a></th>
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
		getOutputMenu($num,$total_items,$n,'page=catalog&sort='.$sort.'&nametovar='.$nametovar.'&type='.$type);
	?>
