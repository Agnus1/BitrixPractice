<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arTemplateParameters = array(
    "AUTHORIZE_URL" => array(
		"NAME" => GetMessage("AUTHORIZE_URL_TEXT"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
    ),
    "PERSONAL_URL" => array(
		"NAME" => GetMessage("PERSONAL_URL_TEXT"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
    ),
);
?>
