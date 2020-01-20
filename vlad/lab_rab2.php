<div class='array'>
	<?php 
		result();
		function result(){	
			for ($row = 0; $row < 5; $row++){
				for($col =0; $col <5; $col++){
					$arrayOne[$row][$col] = rand(0,10);

				}
			}
			for ($row = 0; $row < 5; $row++){
				for($col =0; $col <5; $col++){
					$arrayTwo[$row][$col] = rand(0,10);

				}
			}
			echo "<div class='arrayone'>";
			echo "<span>Матрица первая:</span>";
			echo "<table border='1'>";
			for ($row = 0; $row < 5; $row++) {
				echo "<tr>";

				foreach($arrayOne[$row] as $key => $value) {
					echo "<td>".$value;
				}
				echo "</tr>";
			}
			echo "</table>";
			echo "</div>";

			echo "<div class='arraytwo'>";
			echo "<span>Матрица вторая:</span>";
			echo "<table border='1'>";
			for ($row = 0; $row < 5; $row++) {
				echo "<tr>";
				foreach($arrayTwo[$row] as $key => $value) {
					echo "<td>".$value;
				}
				echo "</tr>";
			}
			echo "</table>";
			echo "</div>";
			for ($row = 0; $row < 5; $row++){
				for($col =0; $col <5; $col++){
					$arrayTree[$row][$col] = $arrayOne[$row][$col] * $arrayTwo[$row][$col];

				}
			}
			echo "<div class='result'>";
			echo "<span>Результативная матрица:</span>";
			echo "<table border='1'>";
			for ($row = 0; $row < 5; $row++) {
				echo "<tr>";
				foreach($arrayTree[$row] as $key => $value) {
					echo "<td>".$value;
				}
				echo "</tr>";
			}
			echo "</table>";
			echo "</div>";
	}?>	
	<div class="strlen">
		
		<?php
			$wordget=isset($_GET['word']) ? $_GET['word'] : 6;
			$word = iconv("UTF-8", "windows-1251", $wordget);
			if ($word!=null){
				$tmp = '';    $i = 0;
				while (isset($word[$i])){
					$tmp .= $word[$i];
					$i++;
				}
			
				echo "<div><span>Количество символов во введенном слове: $i</span></br>"; 
				echo "<span>Введенное слово: $wordget</span></div>"; 
			}
		?>
		<form name="authForm" method="GET" action="<?=$_SERVER['PHP_SELF']?>">
			<span>Введите слово:</span><input type="text" name="word">
			<input class='btn' type="submit">
		</form>
	</div>
</div>