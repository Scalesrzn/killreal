<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//Параметры подключения

$host="localhost"; 
$user="scalesrzn_phplab"; 
$pass="WCHx&Z2l";
$database='scalesrzn_phplab';
echo 'Таблицы созданы!</br>';
echo 'Структура таблиц:</br>';
$dbh = mysqli_connect($host, $user, $pass, $database);
//Начало транзакции

mysqli_begin_transaction($dbh, MYSQLI_TRANS_START_READ_WRITE);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//Создание таблиц	
mysqli_query($dbh, "drop table if exists UsersLAB");
mysqli_query($dbh, "drop table if exists Purchase");
mysqli_query($dbh, "CREATE TABLE IF NOT EXISTS UsersLAB (id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, name VARCHAR(60) not null, date_born DATE, adress VARCHAR(80) not null, phone SMALLINT)");
mysqli_query($dbh, "CREATE TABLE IF NOT EXISTS Purchase (id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, name VARCHAR(60) not null, cost INTEGER, userid INTEGER REFERENCES UsersLAB  , date_purchase TIMESTAMP)");

mysqli_commit($dbh);
//Вывод информации о таблицах
getTableInfo($host, $user, $pass, $database);
mysqli_begin_transaction($dbh, MYSQLI_TRANS_START_READ_WRITE);
echo '</br>Измененная структура таблиц:</br>';
//Изменение структуры таблицы
$dbh = mysqli_connect($host, $user, $pass, $database);
mysqli_query($dbh, "ALTER TABLE Purchase ADD description VARCHAR(50)");
mysqli_query($dbh, "ALTER TABLE UsersLAB DROP phone");
mysqli_query($dbh, "ALTER TABLE UsersLAB add email VARCHAR(50)");
mysqli_commit($dbh);

//Вывод информации о таблицах
getTableInfo($host, $user, $pass, $database);
//Заполнение таблиц данными
mysqli_query($dbh, "INSERT INTO UsersLAB (name,adress,date_born,email) VALUES ('Бадалов','Рязань','2020.01.01', 'badalov@vtb.ru')");
mysqli_query($dbh, "INSERT INTO UsersLAB (name,adress,date_born,email) VALUES ('Петров','Орел','1992.06.12','petrov@mail.ru')");
mysqli_query($dbh, "INSERT INTO UsersLAB (name,adress,date_born,email) VALUES ('Сидоров','Москва','1998.02.03','sidorov@mail.ru')");

mysqli_query($dbh, "INSERT INTO Purchase (name,cost,userid,date_purchase,description) VALUES ('Наушники','228','1','2019.11.23 15:45:45', 'без проводов')");
mysqli_query($dbh, "INSERT INTO Purchase (name,cost,userid,date_purchase,description) VALUES ('Наручники','123','2','2019.11.25 16:47:52', 'нет ключа')");
mysqli_query($dbh, "INSERT INTO Purchase (name,cost,userid,date_purchase,description) VALUES ('WD-40','777','1','2019.11.26 17:34:25','не смазало')");
mysqli_query($dbh, "INSERT INTO Purchase (name,cost,userid,date_purchase,description) VALUES ('Плеть','666','1','2017.11.06 19:23:56','отличная покупка')");

//Вывод содержимого таблиц
echo "</br>Таблица Purchase:</br><table border='1' width='80%'>
<tr>
<th width='10%'>ID</th>
<th width='30%'>Название товара</th>
<th width='15%''>Цена, руб</th>		
<th width='20%'>Имя покупателя</th>
<th width='20%'>Дата покупки</th>
<th width='20%'>Отзыв</th>
</tr>";
$result = mysqli_query($dbh, "SELECT Purchase.id, Purchase.name, Purchase.cost,UsersLAB.name, Purchase.date_purchase, Purchase.description FROM Purchase,UsersLAB WHERE Purchase.userid = UsersLAB.id ") or die ("Сбой при доступе к БД: " );
while ($row = mysqli_fetch_row($result)) 
{
	echo "<tr>
	<td>$row[0]</td>
	<td>$row[1]</td>
	<td>$row[2]</td>
	<td>$row[3]</td>
	<td>$row[4]</td>
	<td>$row[5]</td></tr>";
}
echo '</table>';
echo "</br>Таблица Users:</br><table border='1' width='80%'>
<tr>
<th width='10%'>ID</th>
<th width='30%'>Имя</th>
<th width='25%''>Адрес</th>
<th width='30%'>Дата рождения</th>
<th width='30%'>email</th>
</tr>";
$result = mysqli_query($dbh, "SELECT * FROM UsersLAB") or die ("Сбой при доступе к БД: " );
while ($row = mysqli_fetch_row($result)) 
{
	echo "<tr>
	<td>$row[0]</td>
	<td>$row[1]</td>
	<td>$row[3]</td>		
	<td>$row[2]</td>
	<td>$row[4]</td>
	</tr>";
}
echo '</table>';

//Вывод результатов первого запроса
echo "</br>Запрос №1:</br>
Вывести информацию о покупках Бадалова, сумма которых более 100</br></br>

<table border='1' width='80%'>
<tr>
<th width='45%'>Название товара</th>
<th width='20%''>Цена, руб</th>
<th width='35%'>Дата покупки</th>
</tr>";
$result = mysqli_query($dbh, "SELECT name,cost,date_purchase FROM Purchase WHERE userid=(select id from UsersLAB WHERE name='Бадалов') AND cost>=100") or die ("Сбой при доступе к БД: " );
while ($row = mysqli_fetch_row($result)) 
{
	echo "<tr>
	<td>$row[0]</td>
	<td>$row[1]</td>
	<td>$row[2]</td></tr>";
}
echo '</table>';

//Вывод результатов второго запроса
echo "</br>Запрос №2:</br>
Вывести информацию о покупках с положительными отзывами</br></br>

<table border='1' width='80%'>
<tr>
<th width='30%'>Товар</th>
<th width='20%'>Имя покупателя</th>
<th width='40%'>Email</th>
</tr>";
$result = mysqli_query($dbh, "SELECT (SELECT name from Purchase WHERE description='Отличная покупка') as 'Товар', name as 'Имя', email FROM UsersLAB WHERE id=(select userid from Purchase WHERE description='Отличная покупка')");
while ($row = mysqli_fetch_row($result)) 
{
	echo "<tr>
	<td>$row[0]</td>
	<td>$row[1]</td>
	<td>$row[2]</td>
	</tr>";
}
echo '</table>';

//Удаление БД
mysqli_query($dbh, "drop table if exists UsersLAB");
mysqli_query($dbh, "drop table if exists Purchase");
echo '</br>Таблицы удалены</br>';
?>