<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

\Bitrix\Main\Loader::includeModule("catalog");

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
foreach ($component->arResult["ITEMS"] as $item) {
    $ids[$item["ID"]] = $item["ID"];
}

$allProductPrices = \Bitrix\Catalog\PriceTable::getList([
  "select" => ["*"],
  "filter" => [
       "@PRODUCT_ID" => $ids,
  ],
   "order" => ["CATALOG_GROUP_ID" => "ASC"]
]);

while($price = $allProductPrices->fetch()) {
    $component->arResult["PRICES"][$price["PRODUCT_ID"]] = $price["PRICE"];
}
