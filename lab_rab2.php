<!DOCTYPE html>
<html lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet">
<title>Частная зубная поликлиника "Шпак"</title>
</head>

<body>

<div class='main'>
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
			<div class = 'exprdate'>
				<?php
					$dateget=isset($_GET['date']) ? $_GET['date'] : 6;
					$date = iconv("UTF-8", "windows-1251", $dateget);
					$searchdate = strtotime($dateget) - time() ;
					$sYear = intval($searchdate/60/60/24);
					if ($sYear<365){
						$sYear = 0;
					}
					else{
						$sYear = $sYear/365;
					}
					$sDay = intval($searchdate/60/60/24);
					$sMounth = intval($searchdate/60/60/24/30) ;
					$sHours = intval($searchdate/60/60);
					if (strtotime($dateget)>time()){
						echo 'Сегодня: ' , date("Y-n-j"), '<br><br>';
						echo 'До введенной даты осталось ', intval($sYear), ' Лет ', $sMounth, ' Месяцев ',$sDay, ' Дней ' , $sHours, ' Часов ', '<br><br>';
					}
					else{
						echo "<script>alert ('Введите дату позднее сегодняшнего дня')</script>";
					}
					
					$getString = isset($_GET['customstring']) ? $_GET['customstring'] : 6;
					$getTag = isset($_GET['tagsnodel']) ? $_GET['tagsnodel'] : 6;
					$args = array($getString, $getTag);
					$test   = call_user_func_array('my_strip_tags', $args);

					echo "<span>Введенная дата: $dateget</span><br><br>"; 
					echo "<span>Результат удаления тегов: '$test'</span><br><br>";
						
					function my_strip_tags($html, $allowTags = '') {
						$tags = array();
						
						if ('' != $allowTags) {
							if (preg_match_all('/<(?P<name>[^\\s<>"\']++)[^<>]*+>/', $allowTags, $matches)) {
								$tags = $matches['name'];
							}
						}
						
						if ($tags) {
							$tags = array_map(
								'preg_quote',
								$tags,
								array_fill(0, count($tags), '~')
							);
						
							$tags = '(?i:' . join('|', $tags) . ')';
						
							return preg_replace_callback(
								'~<(?P<all>/?(?P<tag>' . $tags . '?)(?:[^<>"\']++|"[^"]*+"|\'[^\']*+\')*+)>~',
								function ($match) {
									return (isset($match['tag']) && '' != $match['tag'])
										? "<" . str_replace(array("<", ">"), "", $match['all']) . ">"
										: ''
									;
								},
								$html
							);
						}
						else {
							return preg_replace(
								'~</?(?:[^<>"\']++|"[^"]*+"|\'[^\']*+\')*+>~i',
								'',
								$html
							);
						}
					}
					
					
						
				?>

				
				<form name="authForm" method="GET" action="<?=$_SERVER['PHP_SELF']?>">
					<span>Введите дату:</span><input type="date" value="2020-11-30"name="date"><br>
					<span>Введите строку с тегами:</span><input type="text" value="foo<>bar<br>te<br>foo'bar'lol\' foo=bar" name="customstring"><br>
					<span>Введите тег, который не нужно удалять:</span><input type="text" value="<br>" name="tagsnodel">
					<input class='btn' type="submit">
				</form>	
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