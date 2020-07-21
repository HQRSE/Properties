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

foreach ($content as $line) { // читаем построчно
$properties[] = explode ('@', $line); // разбиваем строку и записываем в массив
}

/* Let's GO! *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** */

$all_lines = count($properties);
$end = $all_lines;
$step = 5;
/* *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** */
$i = 0;
$j = 0;
$properties_perem = array (
'code',
'manufacturer_value',
'kalibr_value',
'material_priklada_value',
'material_tsevya_value',
'material_stvola_value',
'color_value',
'weight_value',
'emkost_magazina_value',
'tip_magazina_value',
'kolichestvo_stvolov_value',
'raspolojenie_stvolov_value',
'printsip_deystviya_value',
'dlina_stvola_value',
'obshaya_dlina_value',
'komplektatsiya_value',
'nabor_iz_smennykh_chokov_value',
'chok_value',
'poluchok_value',
'tsilindr_value',
'slaby_poluchok_value',
'sredny_chok_value',
'keys_value',
'kluch_value',
'maslo_value',
'vstavki_priklad_value',
'antabki_value',
'garantiya_value'
);

$end_c = count($properties[$counter]);
$end_p = count($properties_perem);

$zaliv = [];

while ($i < $end_c && $j < $end_p) {

//$glad = array ($properties_perem[$j] => $properties[$counter][$i]);
//echo "j: ".$j." ".$properties_perem[$j]." - i: ".$i." ".$properties[$counter][$i]."<br>";

$zaliv[] = [$properties_perem[$j] => $properties[$counter][$i]];

$i++;
$j++;

}
print_r($zaliv);
//print_r($glad);
//echo $properties;
/* *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** */
while ($counter < $end) {
echo "current array: ".$counter."<br>";
echo "current property code: ".$properties[$counter][0]."<br>";

/* Характеристики гладкоствольное оружие */
$code = 							$properties[$counter][0];  // Код товара
$manufacturer_value = 				$properties[$counter][1];  // Производитель
$kalibr_value = 					$properties[$counter][2];  // Калибр 
$material_priklada_value = 			$properties[$counter][3];  // Материал приклада (ложи) 
$material_tsevya_value = 			$properties[$counter][4];  // Материал цевья
$material_stvola_value = 			$properties[$counter][5];  // Материал ствола
$color_value = 						$properties[$counter][6];  // Цвет 
$weight_value = 					$properties[$counter][7];  // Вес, гр
$emkost_magazina_value = 			$properties[$counter][8];  // Емкость магазина
$tip_magazina_value = 				$properties[$counter][9];  // Тип магазина
$kolichestvo_stvolov_value = 		$properties[$counter][10]; // Количество стволов
$raspolojenie_stvolov_value = 		$properties[$counter][11]; // Расположение стволов
$printsip_deystviya_value = 		$properties[$counter][12]; // Принцип действия
$dlina_stvola_value = 				$properties[$counter][13]; // Длина ствола, мм
$obshaya_dlina_value = 				$properties[$counter][14]; // Общая длина, мм
$komplektatsiya_value = 			$properties[$counter][15]; // Комплектация
$nabor_iz_smennykh_chokov_value = 	$properties[$counter][16]; // Набор из сменных чоков 
$chok_value = 						$properties[$counter][17]; // Чок 
$poluchok_value = 					$properties[$counter][18]; // Получок
$tsilindr_value = 					$properties[$counter][19]; // Цилиндр
$slaby_poluchok_value = 			$properties[$counter][20]; // Слабый получок
$sredny_chok_value = 				$properties[$counter][21]; // Средний чок
$keys_value = 						$properties[$counter][22]; // Кейс
$kluch_value = 						$properties[$counter][23]; // Ключ
$maslo_value = 						$properties[$counter][24]; // Масло оружейное
$vstavki_priklad_value = 			$properties[$counter][25]; // Вставки в приклад (для регулировки наклона приклада)
$antabki_value = 					$properties[$counter][26]; // Антабки
$garantiya_value = 					$properties[$counter][27]; // Гарантия

//echo $code."<--- <br>";

/* Получаем ID товара, зная его код */
	//$results = $DB->Query("SELECT IBLOCK_ELEMENT_ID FROM b_iblock_element_property WHERE VALUE='$code' AND DESCRIPTION='Код'");

	while ($row = $results->Fetch()) {

		$res = CIBlockElement::GetList(array(), array('IBLOCK_ID' => $iblock, 'ACTIVE'=>'Y', 'ID' => $row['IBLOCK_ELEMENT_ID'], 'SITE_ID' => "s1"));
		if ($item = $res->Fetch()) {
		//echo "ID ==> ".$row['IBLOCK_ELEMENT_ID']."<br>"; // Здесь работает
		$p_id = $item['ID'];
		echo "p_id: ".$p_id."<br>";

		/* Символьные коды характеристик гладкоствольное оружие */
		$manufacturer_code = "REAL_MANUFACTURER";
		$kalibr_code = "KALIBR_2";
		$material_priklada_code = "MATERIAL_PRIKLADA";
		$material_tsevya_code = "MATERIAL_TSEVYA";
		$material_stvola_code = "MATERIAL_STVOLA";
		$color_code = "REAL_COLOR";
		$weight_code = "VES";
		$emkost_magazina_code = "EMKOST_MAGAZINA";
		$printsip_deystviya_code ="PRINTSIP_DEYSTVIYA";
		$dlina_stvola_code = "DLINA_STVOLA";
		$obshaya_dlina_code = "DLINA_OBSHCHAYA";
		$tip_magazina_code = "REAL_TIP_MAGAZINA";
		$kolichestvo_stvolov_code = "REAL_KOLICHESTVO_STVOLOV";
		$raspolojenie_stvolov_code = "REAL_RASPOLOJENIE_STVOLOV";
		$komplektatsiya_code = "KOMPLEKTATSIYA";
		$nabor_iz_smennykh_chokov_code = "REAL_NABOR_CHOKOV";
		$chok_code = "REAL_CHOK";
		$poluchok_code = "REAL_POLUCHOK";
		$tsilindr_code = "REAL_TSILINDR";
		$slaby_poluchok_code = "REAL_SLABY_POLUCHOK";
		$sredny_chok_code = "REAL_SREDNY_CHOK";
		$keys_code = "REAL_KEYS";
		$kluch_code = "REAL_KLUCH";
		$maslo_code = "REAL_MASLO";
		$vstavki_priklad_code = "REAL_VSTAVKI_PRIKLAD";
		$antabki_code = "REAL_ANTABKI";
		$garantiya_code = "REAL_GARANTIYA";

		/* Значения списка свойства Калибр (икс и хэ) */
		$property_enums_kalibr = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$kalibr_code));
		while ($enum_fields_kalibr = $property_enums_kalibr->GetNext()) {
			if (strtolower($enum_fields_kalibr["VALUE"]) === strtolower($kalibr_value)) {
				$kalibr_id_value = $enum_fields_kalibr["ID"];
				//echo $enum_fields_kalibr["ID"]." - ".$enum_fields_kalibr["VALUE"]."<br>"; // Если печатать, то с этого момента и до конца начинает колотить эту запись
			}
		}

		/* Значения списка свойства Материал приклада (ложи) */
		$property_enums_material_priklada = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$material_priklada_code));
		while ($enum_fields_material_priklada = $property_enums_material_priklada->GetNext()) {
			if (strtolower($enum_fields_material_priklada["VALUE"]) === strtolower($material_priklada_value)) {
				$material_priklada_id_value = $enum_fields_material_priklada["ID"];
			}
		}

		/* Значения списка свойства Количество стволов */
		$property_enums_kolichestvo_stvolov = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$kolichestvo_stvolov_code));
		while ($enum_fields_kolichestvo_stvolov = $property_enums_kolichestvo_stvolov->GetNext()) {
			if ($enum_fields_kolichestvo_stvolov["VALUE"] === $kolichestvo_stvolov_value) {
				$kolichestvo_stvolov_id_value = $enum_fields_kolichestvo_stvolov["ID"];
			}
		}

		/* Значения списка свойства Расположение стволов */
		$property_enums_raspolojenie_stvolov = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$raspolojenie_stvolov_code));
		while ($enum_fields_raspolojenie_stvolov = $property_enums_raspolojenie_stvolov->GetNext()) {
			if (strtolower($enum_fields_raspolojenie_stvolov["VALUE"]) === strtolower($raspolojenie_stvolov_value)) {
				$raspolojenie_stvolov_id_value = $enum_fields_raspolojenie_stvolov["ID"];
			}
		}

		/* Значения списка свойства Набор из сменных чоков */
		$property_enums_nabor_iz_smennykh_chokov = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$nabor_iz_smennykh_chokov_code));
		while ($enum_fields_kolichestvo_stvolov = $property_enums_nabor_iz_smennykh_chokov->GetNext()) {
			if (strtolower($enum_fields_nabor_iz_smennykh_chokov["VALUE"]) === strtolower($nabor_iz_smennykh_chokov_value)) {
				$nabor_iz_smennykh_chokov_id_value = $enum_fields_nabor_iz_smennykh_chokov["ID"];
			}
		}

		/* Значения списка свойства Чок */
		$property_enums_chok = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$chok_code));
		while ($enum_fields_chok = $property_enums_chok->GetNext()) {
			if (strtolower($enum_fields_chok["VALUE"]) === strtolower($chok_value)) {
				$chok_id_value = $enum_fields_chok["ID"];
			}
		}

		/* Значения списка свойства Полчок */
		$property_enums_poluchok = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$poluchok_code));
		while ($enum_fields_poluchok = $property_enums_poluchok->GetNext()) {
			if (strtolower($enum_fields_poluchok["VALUE"]) === strtolower($poluchok_value)) {
				$poluchok_id_value = $enum_fields_poluchok["ID"];
			}
		}

		/* Значения списка свойства Цилиндр */
		$property_enums_tsilindr = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$tsilindr_code));
		while ($enum_fields_tsilindr = $property_enums_tsilindr->GetNext()) {
			if (strtolower($enum_fields_tsilindr["VALUE"]) === strtolower($tsilindr_value)) {
				$tsilindr_id_value = $enum_fields_tsilindr["ID"];
			}
		}

		/* Значения списка свойства Слабый получок */
		$property_enums_slaby_poluchok = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$slaby_poluchok_code));
		while ($enum_fields_slaby_poluchok = $property_enums_slaby_poluchok->GetNext()) {
			if (strtolower($enum_fields_slaby_poluchok["VALUE"]) === strtolower($slaby_poluchok_value)) {
				$slaby_poluchok_id_value = $enum_fields_slaby_poluchok["ID"];
			}
		}

		/* Значения списка свойства Средний получок */
		$property_enums_sredny_chok = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$sredny_chok_code));
		while ($enum_fields_sredny_chok = $property_enums_sredny_chok->GetNext()) {
			if (strtolower($enum_fields_sredny_chok["VALUE"]) === strtolower($sredny_chok_value)) {
				$sredny_chok_id_value = $enum_fields_sredny_chok["ID"];
			}
		}

		/* Значения списка свойства Кейс */
		$property_enums_keys = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$keys_code));
		while ($enum_fields_keys = $property_enums_keys->GetNext()) {
			if (strtolower($enum_fields_keys["VALUE"]) === strtolower($keys_value)) {
				$keys_id_value = $enum_fields_keys["ID"];
			}
		}

		/* Значения списка свойства Ключ */
		$property_enums_kluch = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$kluch_code));
		while ($enum_fields_kluch = $property_enums_kluch->GetNext()) {
			if (strtolower($enum_fields_kluch["VALUE"]) === strtolower($kluch_value)) {
				$kluch_id_value = $enum_fields_kluch["ID"];
			}
		}

		/* Значения списка свойства Масло оружейное */
		$property_enums_maslo = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$maslo_code));
		while ($enum_fields_maslo = $property_enums_maslo->GetNext()) {
			if (strtolower($enum_fields_maslo["VALUE"]) === strtolower($maslo_value)) {
				$maslo_id_value = $enum_fields_maslo["ID"];
			}
		}

		/* Значения списка свойства Вставки в приклад */
		$property_enums_vstavki_priklad = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$vstavki_priklad_code));
		while ($enum_fields_vstavki_priklad = $property_enums_vstavki_priklad->GetNext()) {
			if (strtolower($enum_fields_vstavki_priklad["VALUE"]) === strtolower($vstavki_priklad_value)) {
				$vstavki_priklad_id_value = $enum_fields_vstavki_priklad["ID"];
			}
		}

		/* Значения списка свойства Антабки */
		$property_enums_antabki = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$antabki_code));
		while ($enum_fields_antabki = $property_enums_antabki->GetNext()) {
			if (strtolower($enum_fields_antabki["VALUE"]) === strtolower($antabki_value)) {
				$antabki_id_value = $enum_fields_antabki["ID"];
			}
		}

		/* Значения списка свойства Гарантия */
		$property_enums_garantiya = CIBlockPropertyEnum::GetList(Array("ID"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$garantiya_code));
		while ($enum_fields_garantiya = $property_enums_garantiya->GetNext()) {
			if (strtolower($enum_fields_garantiya["VALUE"]) === strtolower($garantiya_value)) {
				$garantiya_id_value = $enum_fields_garantiya["ID"];
			}
		}

		// Новые значения свойств элемента
			/*CIBlockElement::SetPropertyValuesEx($p_id, false, array(
		$manufacturer_code => 				$manufacturer_value, 
		$kalibr_code => 					$kalibr_id_value,
		$material_priklada_code => 			$material_priklada_id_value,
		$material_tsevya_code => 			$material_tsevya_value, 
		$material_stvola_code => 			$material_stvola_value,
		$color_code => 						$color_value,
		$weight_code => 					$weight_value,
		$emkost_magazina_code => 			$emkost_magazina_value,
		$printsip_deystviya_code => 		$printsip_deystviya_value,
		$dlina_stvola_code => 				$dlina_stvola_value,
		$obshaya_dlina_code => 				$obshaya_dlina_value,
		$tip_magazina_code => 				$tip_magazina_value,
		$kolichestvo_stvolov_code => 		$kolichestvo_stvolov_id_value,
		$komplektatsiya_code => 			$komplektatsiya_value,
		$raspolojenie_stvolov_code => 		$raspolojenie_stvolov_id_value,
		$nabor_iz_smennykh_chokov_code => 	$nabor_iz_smennykh_chokov_id_value,
		$chok_code => 						$chok_id_value,
		$poluchok_code => 					$poluchok_id_value,
		$tsilindr_code => 					$tsilindr_id_value,
		$slaby_poluchok_code => 			$slaby_poluchok_id_value,
		$sredny_chok_code => 				$sredny_chok_id_value,
		$keys_code => 						$keys_id_value,
		$kluch_code => 						$kluch_id_value,
		$maslo_code => 						$maslo_id_value,
		$vstavki_priklad_code => 			$vstavki_priklad_id_value,
		$antabki_code => 					$antabki_id_value,
		$garantiya_code => 					$garantiya_id_value
));*/
		}
	}

	$break = $counter % $step;

	/*if ($break == 0) {
	$counter++;
		header("refresh: 2; url=/12dev/properties/index.php?counter=$counter"); // default: $counter = 0;
		break;
} */

	$counter++;


	}

/*
echo "<pre>";
print_r($properties);
echo "</pre>";
*/

?>

</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
