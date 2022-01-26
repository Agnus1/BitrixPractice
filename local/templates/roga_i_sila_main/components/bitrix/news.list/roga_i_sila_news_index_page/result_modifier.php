<?
// Заменяем указатель #SITE_DIR# на реальную директорию сайта
$arResult['LIST_PAGE_URL'] = str_replace("#SITE_DIR#/", SITE_DIR, $arResult['LIST_PAGE_URL']);
?>