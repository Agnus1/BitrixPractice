<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock")) {
	return;
}

$arIBlockType = CIBlockParameters::GetIBlockTypes();
$rsIBlock = CIBlock::GetList(["sort" => "asc"], ["TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"]);
$arIBlock[0] = GetMessage("NOT_SELECTED");

while ($arr = $rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
	$fieldsIBlock = array_combine(array_keys($arr), array_keys($arr));
}
$fieldsIBlock["RAND"] = GetMessage("RAND");

$arComponentParameters = [
	"GROUPS" => [],
	"PARAMETERS" => [
		"IBLOCK_TYPE" => [
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		],
		"IBLOCK" => [
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_IBLOCK"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		],
		"SHOW_MAP" => [
			"PARENT" => "BASE",
			"NAME" => GetMessage("SHOW_MAP"),
			"TYPE" => "CHECKBOX",
		],
		"SORT_FIELD" => [
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("SORT_FIELD"),
			"TYPE" => "LIST",
			"VALUES" => $fieldsIBlock,
			"DEFAULT" => "RAND",
		],
		"SORT_ORDER" => [
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("SORT_ORDER"),
			"TYPE" => "LIST",
			"VALUES" => [
				"DESC" => GetMessage("DESC"),
				"ASC" => GetMessage("ASC")
			],
		],
		"SHOW_ALL" => [
			"PARENT" => "URL_TEMPLATES",
			"NAME" => GetMessage("SHOW_ALL"),
			"TYPE" => "CHECKBOX",
			"REFRESH" => "Y",
		],
		"CACHE_TIME"  =>  ["DEFAULT"=>180],
	],
];

// Скрытие поля ввода URL для списка салонов, если не устновлен чекбокс на показ кнопки "Все"
if ($arCurrentValues["SHOW_ALL"] == "Y") {
	$arComponentParameters["PARAMETERS"]["LIST_PAGE_URL"] = CIBlockParameters::GetPathTemplateParam(
		"ALL",
		"LIST_PAGE_URL",
		GetMessage("IBLOCK_ALL_URL"),
		"",
		"URL_TEMPLATES"
	);
}

// Скрытие поля ввода количества элементов, если инфоблок не выбран
if (in_array($arCurrentValues["IBLOCK"], array_keys($arIBlock)) && intval($arCurrentValues["IBLOCK"]) !== 0) {
	$amount = range(1, CIBlockElement::GetList(
		[],
		['IBLOCK_ID' => $arCurrentValues["IBLOCK"]],
		[],
		false,
		[],
	));
	$amount = array_combine(array_values($amount), $amount);
	$amount["UNLIMITED"] = GetMessage("UNLIMITED");

	$arComponentParameters["PARAMETERS"]["AMOUNT_OF_EL"] = [
		"PARENT" => "BASE",
		"NAME" => GetMessage("AMOUNT_OF_EL"),
		"TYPE" => "LIST",
		"VALUES" => $amount,
	];
}

?>
