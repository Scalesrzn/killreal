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
<title>Частная зубная поликлиника "Шпак"</title>
</head>

<body>

<div class='main'>
	<?php include "lib.inc.php" ?>
	<div class='header'>
        <?php include 'top.inc.php'?>
	</div>
	<div class="wrapper">
		<div class='lborder'>
                <div class="menu">
                    <? include 'menu.inc.php'?>        
                </div>
		</div>
		
		<div class='center'>
            <div class="toggle">
					<?php
						require 'base_registration.php';
						if (!empty($_GET['page']))
							$page = $_GET['page'];
						if ($page == 'reg')
						{
							include 'registration.php';
							exit;
						}
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
								case 'lab4':
								include 'lab_rab4.php'; break;
								case 'lab5': 
								include 'lab_rab5.php'; break;	
								case 'reg':
								include 'registration.php'; break;		
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
            <div class='about'>
                <div> <img src="../gallery/room.jpg" alt="ШПАК"> </div>
                <span>
                    Мы осуществляем профилактическую, лечебно-диагностическую, ортопедическую и хирургическую помощь взрослому населению и детям  как на бесплатной основе в рамках ОМС, так и оказываем платные стоматологические услуги. Лечебно-профилактическая помощь организована в нашей поликлинике и подразделениях даже в выходные и праздничные дни.
                    Кабинеты Стоматологической поликлиники N°1 и районных стоматологических подразделений оснащены передовой медицинской техникой, для диагностики используются новейшие ортопантомографы и радиовизиографы, что позволяет оперативно получать рентгеновские снимки, выводя их на дисплей у каждого рабочего места врача-стоматолога.  В нашу практику постоянно внедряются новые технологии, используются эффективные средства защиты, стоматологические материалы импортного и отечественного производства. Имеется большой выбор анестетиков, что позволяет оказывать стоматологическую помощь без боли.
                    Мы ждём Вас в нашей поликлинике и стоматологических подразделениях!
                </span>
            </div>
		</div>
		<div class="rborder">
		</div>
	</div>
	

	<div class="footer">
        <? include 'bottom.inc.php'?>
	</div>
</div>




</body>
</html>