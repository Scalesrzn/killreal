<?php
$menu = array(
"Главная"=>"index.php", 
"Работа №1"=>"index.php?page=lab1",
"Работа №2"=>"index.php?page=lab2",
"Работа №3"=>"index.php?page=lab3",
"Работа №4"=>"index.php?page=lab4",
"Работа №5"=>"index.php?page=lab5",
"Каталог"=>"index.php?page=catalog");
?>	
<?php
getMenu($menu);
?>
        <?php

        $hideReview = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if ($hideReview == 'http://vrednayapolza.ru/' or $hideReview == 'http://vrednayapolza.ru/index.php?'  ){
            echo '<div>
                <form action="#review">
                    <button formaction="#review" class="btn">
                        Отзывы
                    </button>
                </form>
            </div>';}
        ?>
