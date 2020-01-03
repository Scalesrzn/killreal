<?php
	session_start();
	ob_start();
	ini_set('display_errors',1);
	date_default_timezone_set('Europe/Moscow');
	header("Content-Type: text/html; charset=utf-8");
	header("Cache-control: no-store");
	if (isset($_COOKIE['dateVisit']))
		$dateVisit = $_COOKIE['dateVisit'];
	setcookie('dateVisit',date('Y-m-d H:i:s'),time()+0xFFFFFFF);
		//Инициализация переменных
	$page = "";

?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet">
<title>Сайт товарного склада "СкладовщикЪ"</title>
<script src="//code.jivosite.com/widget.js" data-jv-id="U6hkUZJIfZ" async></script>
</head>

<body>

<div class='main'>
	<?php include "lib.inc.php" ?>
	<div class="menu">
	  <?php include "menu.inc.php"?>
  </div>
  
	<div class='header'>
    <?php include "top.inc.php"?>
	</div>
	<div class="wrapper">
		<div class='lborder'>
		</div>
		
		<div class='center'>
			
			<div class="content">
				<div class="toggle">
					<?php
						if (!empty($_GET['page']))
								$page = $_GET['page'];
						require 'auth.php';
						if (empty($page)) {
					?>

					<?php 
						}
						else switch($page)
						{
							case 'lab1': 
							include 'lab_rab1.php'; break;
							case 'lab2': 
							include 'lab_rab2.php'; break;
							case 'lab3': 
							include 'lab_rab3.php'; break;				
							case 'catalog':
							include 'catalog.php'; break;	
							case 'add': 
							include 'add.php'; break;
							case 'item': 
							include 'item.php'; break;	
							case 'edit': 
							include 'edit.php'; break;	
						}		
					?>
				</div>
				<div class="gallery">
					<img class="image" alt="Не найдено" src="../gallery/sklad1.jpg">
					<img class="image" alt="Не найдено" src="../gallery/sklad4.jpg">
				</div>
				
			</div>
			
			<div class="clients">
				<div id="review" class="comm">
					<p>Отзывы довольных клиентов:</p>
				</div>
				
				<div class="userpix">
					<div>
						<p>Алена</p>

							<img class="photo"  alt="Не найдено" src="../gallery/alena.png">

						<p>Лучший склад во всем мире!
						<br>"СкладовщикЪ" - я тебя люблю!</p>
					</div>
					
					<div>
						<p>Дмитрий</p>
						<img class="photo" alt="Не найдено" src="../gallery/dima.png">
						<p>Раньше боялся брать у <br>Складовщика.
						Теперь беру всем <br>друзьям и родственникам.</p>
					</div>
					
					<div>
						<p>Анна</p>
						<img class="photo" alt="Не найдено" src="../gallery/anna.png">
						<p>Wildberries НИЧТО, <br>по сравнению.</p> 
						<p>с этим <br>великолепным складом!</p>
					</div>
				</div>
			</div>
			<div class="info">
					<div>
						<h1 >О Нас.</h1>
						<span class="text">Мы занимаемся выдачей <br>Ваших товаров <br>с нашего склада.</span>
					</div>
					<div class="infogr">
						<img class="icon" alt="Не найдено" src="../gallery/time.png"><span>Более 150 лет на рынке!</span>
						<img class="icon" alt="Не найдено" src="../gallery/people.png"><span>Более 1 000 000 довольных клиентов</span>
						<img class="icon" alt="Не найдено" src="../gallery/sklad.png"><span>Более 50 000 складов по всему МИРУ!</span>
					</div>
			</div>
		</div>
		
		<div class="rborder">
		</div>
	</div>
	
	
	<div class="footer">
    <?php include "bottom.inc.php"?>
	</div>
</div>


</body>
</html>