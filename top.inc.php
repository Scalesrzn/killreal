
    <div class='img'> <img src="../gallery/label.png" alt="ШПАК"> </div>
    <div> <span>Частная зубная поликлиника "Шпак"</span> </div>
    <?php
	    if (!empty($_SESSION['user_login']))
		    echo "<div class='welcomemsg'>Добро пожаловать, <b>{$_SESSION['user_login']}!</b> <a class='button' href='index.php?logout=true'>  (Выйти)</a></div>";
    ?>