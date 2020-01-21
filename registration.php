
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
			

			<?php
				$host="localhost"; 
				$user="scalesrzn_phplab"; 
				$pass="WCHx&Z2l";
				$database='scalesrzn_phplab';
				if ($_SERVER['REQUEST_METHOD'] == 'POST')
				$dbh = mysqli_connect($host, $user, $pass, $database); 

				{
					if (!empty($_POST['login_reg']) && !empty($_POST['password_1']) && !empty($_POST['password_2']) && !empty($_POST['email'])) 
					{
						if ($_POST['password_1'] == $_POST['password_2'])
						{
							$firstname = clearData($_POST['FirstN']);
							$surename = clearData($_POST['SureN']);
							$login_reg = clearData($_POST['login_reg']);
							$hash_password = clearData($_POST['password_1']);
							$email_reg = clearData($_POST['email']);
							if (!preg_match("~^[-a-z0-9!#$%&'*+/=?^_`{|}]+(\.[-a-z0-9!#$%&'*+/=?^_`{|}]+)*@([a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$~", $email_reg)) 
							{
								echo '<h3>Введите корректный адрес электронной почты</h3>';
								exit;
							}
							$dbh = mysqli_connect($host, $user, $pass, $database); 
							$query = "INSERT INTO USERS (FIRST,SURE,LOGIN,PASSWORD,EMAIL) VALUES ('$firstname', '$surename', '$login_reg','$hash_password','$email_reg')";
							if (mysqli_query($dbh, $query))
								echo "Зарегистрирован успешно";
							else 
								echo "Сбой при вставке данных: ".  mysqli_error($dbh);
							mysqli_begin_transaction($dbh, MYSQLI_TRANS_START_READ_WRITE);
						}
						else echo 'Пароли не совпадают';
					}
					else echo 'Полностью заполните форму';
				}
				?>

				<h3>Регистрация</h3>
				<table class="data_table">
					<tr>
						<td><form method="POST">
							<table>
								<tr>
									<td>
										<label>Имя:</label>
									</td>
									<td>
										<input type="text" required name="FirstN" style="margin-left:30px">
									</td>
								</tr>
								<tr>
									<td>
										<label>Фамилия:</label>
									</td>
									<td>
										<input type="text" required name="SureN" style="margin-left:30px">
									</td>
								</tr>
								<tr>
									<td>
										<label>Логин:</label>
									</td>
									<td>
										<input type="text" required name="login_reg" style="margin-left:30px">
									</td>
								</tr>	
								<tr>
									<td>
										<label>Пароль:</label>
									</td>
									<td>
										<input type="password" required name="password_1" style="margin-left:30px">
									</td>
								</tr>
								<tr>
									<td>
										<label>Повторите пароль:</label>
									</td>
									<td>
										<input type="password" required name="password_2" style="margin-left:30px">
									</td>
								</tr>	
								
								<tr>
									<td>
										<label>Email:</label>
									</td>
									<td>
										<input type="email" required name="email" style="margin-left:30px">
									</td>
								</tr>
								<tr><td></td>
									<td>
										<input type="submit" style="margin-left:30px;margin-top:30px">
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
				</table>
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