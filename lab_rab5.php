<form class='addtable' method="post">
			<b>Вопрос №1.</b><br/>
	Создать подкаталог PASCAL в каталоге D:\PROG (md d:\pgor\pascal, D:\PROG\PASCAL)<br/><br/>
  	Ответ: <input name="answer1" type="text" size="100" maxlength="255"><br/><br/>
			<b>Вопрос №2.</b><br/>
	Выяснить метку тома с именем E: (vol e:, LABEL E:) <br/><br/>
  	Ответ: <input name="answer2" type="text" size="100" maxlength="255"><br/><br/>
			<b>Вопрос №3.</b><br/>
	Вывести на монитор содержимое файла prg1.pas, находящегося в текущем каталоге, по частям размером в один экран (More < prg1.pas, TYPE prg1.pas |more) <br/><br/>
  	Ответ: <input name="answer3" type="text" size="100" maxlength="255"><br/><br/>
			<b>Вопрос №4.</b><br/>
	Сделать видимыми все файлы с расширением SYS текущего и подчиненных ему каталогов и установите у них разряд "Архивный" 
	(Attrib +a -h *.sys /s, attrib -h +a *.sys /s) <br/><br/>
  	Ответ: <input name="answer4" type="text" size="100" maxlength="255"><br/><br/>
			<b>Вопрос №5.</b><br/>
	Установить текущей датой 12 декабря 2010 г (date 12-12-2010, date 12/12/2010, date 12.12.2010)<br/><br/>
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
if (preg_match(' /^(md|mkdir)[\s]+d:\\\\?prog\\\\pascal$/i', $answer[0]))
	{
	$correct++;
	}
if (preg_match(' /^(vol[\s]+e:|label[\s]+e:)$/i', $answer[1]))
	{
	$correct++;
	}
if (preg_match('/^((More[\s]?<[\s]prg1.pas)|(TYPE[\s]prg1.pas[\s]\|*more))$/i', $answer[2]))
	{
	$correct++;
	}
if (preg_match("/^attrib[\s]\+a[\s]-h[\s]\*\.sys[\s]\/s$/i", $answer[3]))
	{
	$correct++;
	}
if (preg_match('/^date[\s]12(\.|\-|\/)12(\.|\-|\/)2010$/i', $answer[4]))
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
