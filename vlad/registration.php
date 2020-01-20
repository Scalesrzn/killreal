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
								//mysqli_trans();
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