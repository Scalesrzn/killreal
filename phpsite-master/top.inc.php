<img src="../gallery/logo3.jpg" alt="СкладовщикЪ">
<?php
	if (!empty($_SESSION['user_login']))
		echo "<div class='welcomemsg'>Добро пожаловать, <b>{$_SESSION['user_login']}!</b> <a class='button' href='index.php?logout=true'>  (Выйти)</a></div>";
?>