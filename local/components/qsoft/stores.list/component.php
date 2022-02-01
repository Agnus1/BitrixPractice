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

// установка времени кэширования по умолчанию
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 180;



// фильтрация инфоблока
$arIBlockFilter = intval($arParams["IBLOCKS"][0]);
if(isset($arIBlockFilter))
{
	if(!CModule::IncludeModule("iblock"))
	{
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	// получение списка ифноблоков по типу
	$rsIBlocks = CIBlock::GetList(array("sort" => "asc"), array(
		"type" => $arParams["IBLOCK_TYPE"],
		"LID" => SITE_ID,
		"ACTIVE" => "Y",
		'ID' => $arIBlockFilter,
	));

	if($arIBlock = $rsIBlocks->Fetch()) {
		$arIBlockFilter = $arIBlock["ID"];
	}
}

unset($arParams["IBLOCK_TYPE"]);

// проверка на наличие актулаьного кэша
if(!empty($arIBlockFilter) && $this->StartResultCache(false, ($arParams["CACHE_GROUPS"] === "N"? false: $USER->GetGroups())))
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}

	// SELECT
	$arSelect = array(
		"ID",
		"IBLOCK_ID",
		"CODE",
		"IBLOCK_SECTION_ID",
		"NAME",
		"PREVIEW_PICTURE",
		"LIST_PAGE_URL",
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
	$rsIBlockElement->SetUrlTemplates("", "", $arParams["ALL_URL"]);

	// получение элементов из списка и запоминание в arResult
	for ($i = 0; $i < $arParams['AMOUNT_OF_EL']; $i++) {
		$el = $rsIBlockElement->GetNextElement();

		$arResult["ELEMENTS"][$i] = array_merge($el->GetProperties(), $el->GetFields());
		$arResult["ELEMENTS"][$i]["PICTURE"] = CFile::GetFileArray($arResult["ELEMENTS"][$i]["PREVIEW_PICTURE"]);

		if(!is_array($arResult["ELEMENTS"][$i]["PICTURE"])) {
			$arResult["ELEMENTS"][$i]["PICTURE"] = CFile::GetFileArray($arResult["ELEMENTS"][$i]["DETAIL_PICTURE"]);
		}

		if ($arResult["ELEMENTS"][$i]["PICTURE"])
		{
			$arResult["ELEMENTS"][$i]["PICTURE"]["ALT"] = $arResult["ELEMENTS"][$i]["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"];
			if ($arResult["ELEMENTS"][$i]["PICTURE"]["ALT"] == "") {
				$arResult["ELEMENTS"][$i]["PICTURE"]["ALT"] = $arResult["ELEMENTS"][$i]["NAME"];
			}

			$arResult["ELEMENTS"][$i]["PICTURE"]["TITLE"] = $arResult["ELEMENTS"][$i]["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"];
			if ($arResult["ELEMENTS"][$i]["PICTURE"]["TITLE"] == "") {
				$arResult["ELEMENTS"][$i]["PICTURE"]["TITLE"] = $arResult["ELEMENTS"][$i]["NAME"];
			}
		}
	}

	if (in_array(false, $arResult, true)) {
		$this->AbortResultCache();
	} else {
		$arResult["LIST_PAGE_URL"] = empty($arParams["LIST_PAGE_URL"]) ? $arResult["ELEMENTS"][0]["LIST_PAGE_URL"] : $arParams["LIST_PAGE_URL"];
		$this->SetResultCacheKeys(array());
		$this->IncludeComponentTemplate();
	}

}
?>
