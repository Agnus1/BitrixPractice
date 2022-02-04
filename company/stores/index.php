<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><?$APPLICATION->IncludeComponent(
	"qsoft:stores.list", 
	"stores_full", 
	array(
		"AMOUNT_OF_EL" => "5",
		"CACHE_TIME" => "180",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "stores_full",
		"IBLOCK" => "6",
		"IBLOCK_TYPE" => "salons",
		"LIST_PAGE_URL" => "",
		"SHOW_ALL" => "Y",
		"SHOW_MAP" => "Y",
		"SORT_FIELD" => "NAME",
		"SORT_ORDER" => "ASC"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>