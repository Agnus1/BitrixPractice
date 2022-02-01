<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


/*************************************************************************
	Processing of received parameters
*************************************************************************/

unset($arParams["IBLOCK_TYPE"]);
$arIBlockFilter = intval($arParams["IBLOCKS"][0]);

// обработка ошибок
if ($arIBlockFilter <= 0) {
	ShowError(GetMessage("WRONG_IBLOCK"));	
	return;
}
if(!CModule::IncludeModule("iblock"))
{
	ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
	return;
}


// установка времени кэширования по умолчанию
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 180;

// проверка на наличие актулаьного кэша
if($this->StartResultCache(false, ($arParams["CACHE_GROUPS"] === "N"? false: $USER->GetGroups())))
{


	// SELECT
	$arSelect = array(
		"ID",
		"IBLOCK_ID",
		"CODE",
		"IBLOCK_SECTION_ID",
		"NAME",
		"PREVIEW_PICTURE",
		"LIST_PAGE_URL",
		"PROPERTY_PHONE",
		"PROPERTY_ADDRESS",
		"PROPERTY_WORK_HOURS",
	);

	// WHERE
	$arFilter = array(
		"IBLOCK_ID" => $arIBlockFilter,
		"ACTIVE_DATE" => "Y",
		"ACTIVE" => "Y",
	);

	// LIMIT
	$arLimit = ["nTopCount" => $arParams['AMOUNT_OF_EL']];

	//ORDER BY
	$arSort = array(
		$arParams["SORT_FIELD"] => $arParams["SORT_ORDER"],
	);

	//EXECUTE
	$rsIBlockElement = CIBlockElement::GetList($arSort, $arFilter, false, $arLimit, $arSelect);

	// получение элементов из списка и запоминание в arResult, запоминание id картинок
	while ($el = $rsIBlockElement->GetNext()) {
		
		// получение id картинки
		if ($el['PREVIEW_PICTURE']) {
			$images[] = $el["PREVIEW_PICTURE"];
		}

		$arResult[] = $el;
	}

	// получение картинок и привязка к элементам
	if (!empty($images)) {
		$res = CFile::getList([], ["@ID" => $images]);
		
		while ($image = $res->GetNext()) {
			for ($i = 0; $i < count($arResult); $i++) {
				if ($arResult[$i]["PREVIEW_PICTURE"] == $image["ID"]) {
					$arResult[$i]["IMAGE_SRC"] = CFile::GetFileSRC($image);
				}
			}
		}
	}

	// установка ссылки "все" в массив параметров (если ссылка задана в компоненте, то она и устанавливается, 
	// в противном случае - берётся из инфоблока)
	$arParams["LIST_PAGE_URL"] = $arParams["LIST_PAGE_URL"] ?? $arResult[0]["LIST_PAGE_URL"];

	$this->SetResultCacheKeys(array());
	$this->IncludeComponentTemplate();
}
?>
