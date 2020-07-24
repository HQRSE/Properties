<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Properties");
?>

<main class="catalog-page category-catalog-page" id="start">

<?

$counter = 0; // $_GET['counter']; // start counter = 0 // counter item
$section = $_GET['section']; // section code

$fileName = 'https://ohotaktiv.ru/12dev/properties/gtxt.txt'; //gladkostvolnoe.csv';
$iblock = 10;
$content = file ($fileName);

foreach ($content as $line) { // Читаем построчно
$properties[] = explode ('@', $line); // Разбиваем строку и записываем в массив
}

if ($section = 'nozhi') { //Если это Ножи
	//Перебираем значения списков (CIBlockPropertyEnum::GetList)
	//Устанавливаем новые значения элементу (CIBlockElement::SetPropertyValuesEx)
	include 'prop_nozhi.php'; // Подключаем символьные коды характеристик Ножей из файла (keys_code = REAL_KEYS)
	//print_r($prop_category);
	//echo "<br>";

	//Если это Костюмы
	//Подключаем символьные коды характеристик Костюмов из файла (keys_code = REAL_KEYS)
	//Перебираем значения списков (CIBlockPropertyEnum::GetList)
	//Устанавливаем новые значения элементу (CIBlockElement::SetPropertyValuesEx)
	/* *** */
	} else {
	echo "ne nozhi<br>";
}

/* Let's GO! *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** */

$all_lines = count($properties);
$end = $all_lines;
$step = 5;

while ($counter < $end) { // Перебор массивов Properties[]
	echo "current array: ".$counter."<br>";
	echo "current property code: ".$properties[$counter][0]."<br>";

	/* *** */
	$end_c = count($properties[$counter]);
	$zaliv = [];
	$i = 0;
	while ($i < $end_c) { // Перебор порядкового массива из Properties[]
		$zaliv[] = $properties[$counter][$i]; // Формируем конечный массив характеристик
	$i++;
	}

	unset($zaliv[0]); // Убираем Код
	unset($zaliv[1]); // Убираем Производитель

	/* Значения, которые есть всегда */
	$code = 				$properties[$counter][0]; // Код
	$real_manufacturer = 	$properties[$counter][1]; // Производитель

	$manufacturer_code = "REAL_MANUFACTURER";
	/* *** *** *** *** *** *** *** */

	/* Получаем ID товара, зная его код */
	$results = $DB->Query("SELECT IBLOCK_ELEMENT_ID FROM b_iblock_element_property WHERE VALUE='$code' AND DESCRIPTION='Код'");

	while ($row = $results->Fetch()) {
		$res = CIBlockElement::GetList(array(), array('IBLOCK_ID' => $iblock, 'ACTIVE'=>'Y', 'ID' => $row['IBLOCK_ELEMENT_ID'], 'SITE_ID' => "s1"));
		if ($item = $res->Fetch()) {
			$p_id = $item['ID']; // Product ID
			echo "current id: ".$p_id."<br>";
			/* *** */
			//echo "section: ".$section."<br>";
			/* *** */
	foreach ($zaliv as $key=>$value) { // Пара: ключ - значение из zaliv[]
		echo $key." - ".$value."<br>";
			foreach ($prop_category as $prop_code) {
				/* Значения свойства типа список */
				$property_enums = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$prop_code));
				while ($enum_fields = $property_enums->GetNext()) {
					//echo "enum_fields value: ".$enum_fields["VALUE"]."<br>";
					if (strtolower($enum_fields["VALUE"]) === strtolower($value)) {
						$id_value = $enum_fields["ID"];
						//echo "id value: ".$id_value."<br>";
						CIBlockElement::SetPropertyValuesEx($p_id, false, array(
							$prop_code => $id_value 
						));
					}
				}
			}
	}
	//print_r($zaliv); // Ключи и их значения
			/* *** */
		}
	}

	/* *** */
	$counter++;
	echo "current_counter: ".$counter."<br>";
}


//print_r($properties); // Полный массив из файла

?>

</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
