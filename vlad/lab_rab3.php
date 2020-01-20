<?php
	session_start();
	setcookie('story',$storyarr);
	$from = 1;
	$to = 10;
	$report = '';
	if (isset($_POST['submit'])) {
		if (isset($_SESSION['count']) <=3)
			$i = $_SESSION['count'] -1;
			$_SESSION['count']++;
			$number = (int) $_POST['number'];
			$_SESSION['story'][$i] = $_POST['number'];
			$try = 3 - $_SESSION['count'];
			if ($_SESSION['story'][0] != ''){
				echo 'Вы уже вводили '. $_SESSION['story'][0].' '.$_SESSION['story'][1].' '.$_SESSION['story'][2]. ' ';
			}
			echo '</br><span> Вы ввели:  '.$_POST['number']. '</span>';
			echo "</br><span> Осталось попыток : $try </span>";
			if ($_SESSION['count'] != 3){
				if ($number == $_SESSION['number']) {
					$report = '<span>Угадал с ' . $_SESSION['count'] . ' попыток</span>';
					$_SESSION['count'] = 0;
					$_SESSION['number'] = mt_rand($from, $to);

				}
				else {
					echo "</br>Не угадал!";
				}
			}
			else{
				$_SESSION['story'][0] = '';
				$_SESSION['story'][1] = '';	
				$_SESSION['story'][2] = '';
				$_SESSION['count'] = 0;
				$_SESSION['number'] = mt_rand($from, $to);	
				echo 'Попытки кончились. Попробуй еще раз!';
			}
		
	} else {
		$_SESSION['story'][0] = '';
		$_SESSION['story'][1] = '';	
		$_SESSION['story'][2] = '';
		$_SESSION['number'] = mt_rand($from, $to);
		$_SESSION['count'] = 0;
		
	}
?>
        <div><?=$report ?></div>
        <form action="<?php $_SERVER['SCRIPT_NAME']?>" method="POST">
            <fieldset>
                <legend>Введите число от <?=$from ?> до <?=$to ?></legend>
                <label><p>
                <input type="text" name="number" /></p></label>
                <p><input class ='btn' type="submit" name="submit"  value="проверить"/></p>
                <p><input class ='btn' type="submit" name="reset" value="начать заново" /></p>
            </fieldset>
        </form>
