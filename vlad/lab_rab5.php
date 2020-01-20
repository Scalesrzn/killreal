<form class='addtable' method="post">
			<b>Вопрос №1.</b><br/>
	Удалить подкаталог ТЕХТ, который находится в каталоге D:\DATA, если текущим является диск D:<br/><br/>
  	Ответ: <input name="answer1" type="text" size="100" maxlength="255"><br/><br/>
			<b>Вопрос №2.</b><br/>
	Назначить каталогу D:\TEST виртуальный диск с именем F: <br/><br/>
  	Ответ: <input name="answer2" type="text" size="100" maxlength="255"><br/><br/>
			<b>Вопрос №3.</b><br/>
	Вывести на монитор структуру каталогов диска в дисководе а:, исходя из корневого каталога, и список имен файлов, содержащихся в каталогах. Структура должна отображаться на экране дисплея постранично <br/><br/>
  	Ответ: <input name="answer3" type="text" size="100" maxlength="255"><br/><br/>
			<b>Вопрос №4.</b><br/>
	Вывести в файл VOL.TXT метку тома для диска C: <br/><br/>
  	Ответ: <input name="answer4" type="text" size="100" maxlength="255"><br/><br/>
			<b>Вопрос №5.</b><br/>
	Скопировать в корневой каталог диска в дисководе В: все файлы каталога D:\PROGRAMM и, возможно, файлы имеющихся там подкаталогов, у которых установлен бит "архивный", без сброса после копирования этого бита в исходное состояние<br/><br/>
  	Ответ: <input name="answer5" type="text" size="100" maxlength="255"><br/><br/>
  	<input type="submit" class='btn' value="Ответить" style="margin:10px">
</form><br/>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$correct = 0;
	for ($i=1;$i<=5;$i++)
	{
		$answer[] = trim($_POST["answer".$i]);	
	}
if (preg_match(' /^(rd|rmdir)[\s]+\\\\?data\\\\text$/i', $answer[0]))
	{
	$correct++;
	}
if (preg_match(' /^subst[\s]+f:[\s]+d:\\\\text$/i', $answer[1]))
	{
	$correct++;
	}
if (preg_match('/^tree[\s]+a:(\\\\)?[\s]+\/f[\s]*\|[\s]*more$/i', $answer[2]))
	{
$correct++;
	}
if (preg_match('/^vol[\s]+c:[\s]*>vol\.txt$/i', $answer[3]))
	{
$correct++;
	}
if (preg_match('/^xcopy\s+d:\\\\programm(\\\\\*)?[\s]+b:[\s]+\/s\/a$/i', $answer[4]))
	{
		$correct++;
	}
	switch($correct)
	{
		case '5': $estimation = 5; break;
		case '4': $estimation = 4; break;
		case '3': $estimation = 3; break;
		default: $estimation = 2;
	}	
	echo "<table border='1'><tr>
	<th>Правильных ответов </th>
	<td>$correct</td></tr>
	<tr><th>Оценка </th>
	<td>$estimation</td>
	</tr></table><br/>";
}	
?>
