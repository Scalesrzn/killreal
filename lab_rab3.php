


<?php
    session_start();

        $range=htmlspecialchars ($_POST['range']);
        $timeyear=htmlspecialchars ($_POST['timeyear']);
        $stars=htmlspecialchars ($_POST['stars']);
        $agecustomer=htmlspecialchars ($_POST['agecustomer']) * 0.02;
        $count = 2000*$range*$timeyear*$stars*$agecustomer;
        if (isset($_POST['submit'])) {
            echo "<span style='color:red'>Стоимость проживания в гостиничном номере 1 день будет стоить: $count</span>";
        }



    
?>
<form name="tourform" method="POST" action="<?php $_SERVER['SCRIPT_NAME']?>">
    <span> Выберите параметры для гостиницы</span><br>
    <span> Удаленность от центра:</span>
    <select name="range"> 
        <option value="1.1">Далеко</option> 
        <option value="1.5">Средне</option>
        <option value="2">Близко</option>
    </select><br>
    <span> Время года:</span>
    <select name="timeyear"> 
        <option value="1.1">Зима</option> 
        <option value="2">Лето</option>
        <option value="1.5">Осень</option>
        <option value="1.5">Весна</option>
    </select><br>
    <span>Количество звезд:</span>
    <select name="stars"> 
        <option value="1.1">1</option> 
        <option value="1.2">2</option>
        <option value="1.5">3</option>
        <option value="2">4</option>
        <option value="3">5</option>
    </select><br>
    <span>Возраст:</span><input type="text" required name="agecustomer"><br>
    <input class='btn' name="submit" type="submit">
</form>	
