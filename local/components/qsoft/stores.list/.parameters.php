<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array(
	"-" => GetMessage("IBLOCK_ANY"),
);
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));

while ($arr = $rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
	$fieldsIBlock = array_combine(array_keys($arr), array_keys($arr));
}
$fieldsIBlock["RAND"] = GetMessage("RAND"); 


$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCKS" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_IBLOCK"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"AMOUNT_OF_EL" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("AMOUNT_OF_EL"),
			"TYPE" => "STRING",
			"DEFAULT" => '2',
		),
		"SORT_FIELD" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("SORT_FIELD"),
			"TYPE" => "LIST",
			"VALUES" => $fieldsIBlock,
			"DEFAULT" => "RAND",
			"REFRESH" => "Y",
		),
		"SORT_ORDER" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("SORT_ORDER"),
			"TYPE" => "LIST",
			"VALUES" => [
				"DESC" => GetMessage("DESC"),
				"ASC" => GetMessage("ASC")
			],
			"DEFAULT" => "DESC",
		),
		"LIST_PAGE_URL" => CIBlockParameters::GetPathTemplateParam(
			"ALL",
			"ALL_URL",
			GetMessage("IBLOCK_ALL_URL"),
			"",
			"URL_TEMPLATES"
		),
		"CACHE_TIME"  =>  array("DEFAULT"=>180),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("CP_BPR_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
	),
);
?>
