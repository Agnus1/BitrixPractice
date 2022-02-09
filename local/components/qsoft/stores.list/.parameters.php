<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = [
	"-" => GetMessage("IBLOCK_ANY"),
];
$rsIBlock = CIBlock::GetList(["sort" => "asc"], ["TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"]);

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
		"AMOUNT_OF_EL" => [
			"PARENT" => "BASE",
			"NAME" => GetMessage("AMOUNT_OF_EL"),
			"TYPE" => "STRING",
		],
		"SORT_FIELD" => [
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("SORT_FIELD"),
			"TYPE" => "LIST",
			"VALUES" => $fieldsIBlock,
			"DEFAULT" => "RAND",
			"REFRESH" => "Y",
		],
		"SORT_ORDER" => [
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("SORT_ORDER"),
			"TYPE" => "LIST",
			"VALUES" => [
				"DESC" => GetMessage("DESC"),
				"ASC" => GetMessage("ASC")
			],
			"DEFAULT" => "DESC",
		],
		"SHOW_ALL" => [
			"PARENT" => "URL_TEMPLATES",
			"NAME" => GetMessage("SHOW_ALL"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		],
		"LIST_PAGE_URL" => CIBlockParameters::GetPathTemplateParam(
			"ALL",
			"ALL_URL",
			GetMessage("IBLOCK_ALL_URL"),
			"",
			"URL_TEMPLATES"
		),
		"CACHE_TIME"  =>  ["DEFAULT"=>180],
	],
];
?>
