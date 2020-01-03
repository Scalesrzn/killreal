<?php
function getMenu($menu, $vertical=true) {
	$style = "";
	foreach ($menu as $link=>$href)
	{
		echo "<div><a class='button' style='margin: 0 0 0 0' href=\"$href\"><button formaction='index.php' class='btn'>",$link,'</button> </a></div>';

	}
}

function SimvolInString($Stroka,$Simvol) {
	return substr_count($Stroka,$Simvol);
}

function My_Count($MyParam) {
	// $MyParam = new aClass;
	$MyParam = array(1, 2, 3, 7, 8, 9, 10);

	$m_count = 0;

	if (isset($MyParam) == false) 
		$m_count = 0;
	else
		if (is_array($MyParam) or is_object($MyParam)) {//делаем расчет
			if(is_null($MyParam)) 
				$m_count = 0;
			else {
				foreach ($MyParam as &$value) {
					$m_count = $m_count + 1;
				}
			}
		}
		else $m_count = 1;
   		return $m_count; //$m_count; 
   	}

   	class aClass {
   		var $protected_property = 'protected_value';
   		var $private_property = 'private_value';
   		var $public_property = 'public_value';
   	}

   	function clearData($data) {
   		return trim(strip_tags($data));
   	}

function loadImage($p) {    // функция принимает параметр, который получает значение либо add(новое изображение) либо edit(замена изображения)
	$a = array("mess"=>"","src"=>""); // возвращаемый массив из двух элементов $a['mess'] - сообщение об ошибке если есть и $a['src'] - путь к изображению 
	if ($_FILES['uploadfile']['type'] != 'image/jpeg') 
		$a['mess']= '<font color="red" align="center" >Не верный тип изображения!</font>';
	else {
		if ($_FILES['uploadfile']['size'] > 100000) 
			$a['mess'] = '<font color="red" align="center" >Размер изображения слишком большой! (макс.=100кб.)</font>';
		else {
			$Image = imagecreatefromjpeg($_FILES['uploadfile']['tmp_name']); // создаем изображение
			$Size = getimagesize($_FILES['uploadfile']['tmp_name']); // получаем размер изображения
			$Tmp = imagecreatetruecolor(300, 300);
			imagecopyresampled($Tmp, $Image, 0, 0, 0, 0, 300, 300, $Size[0], $Size[1]); // изменяем размер на 300 на 300 $Size[0] и $Size[1] текущие размеры выбранного изображения             
			if ($p=="add")
				$Download = 'images/catalog/'.count($_SESSION['catalog']);
			else 
				$Download = $_SESSION['catalog'][$_GET['id']]['image'];
			if (empty($Download)) $Download = 'images/catalog/'.$_GET['id'];
						imagejpeg($Tmp, $Download.'.jpg'); // сохраняем изображение на сервере в каталоге $Download 
						imagedestroy($Image);
						imagedestroy($Tmp);
						$a['src']=$Download;
					}   
				}
				return $a;
			}
			?>