<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);

if (!empty($arResult['NAV_RESULT']))
{
    $navParams =  array(
        'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
        'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
        'NavNum' => $arResult['NAV_RESULT']->NavNum
    );
}
else
{
    $navParams = array(
        'NavPageCount' => 1,
        'NavPageNomer' => 1,
        'NavNum' => $this->randString()
    );
}

$showBottomPager = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1)
{
    $showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
}

?>
 <div class="p-4">
    <h1 class="text-black text-3xl font-bold mb-4"><?=GetMessage("CATALOG")?></h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6">
    <?php foreach ($arResult["ITEMS"] as $item):?>
        <?php $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
            <div class="bg-white w-full border border-gray-100 rounded overflow-hidden shadow-lg hover:shadow-2xl pt-4" id="<?=$this->GetEditAreaId($item['ID']);?>">
                <a class="block w-full h-40" href="<?=$item["DETAIL_PAGE_URL"]?>"><img class="w-full h-full hover:opacity-90 object-cover" src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>" alt="Seed"></a>
                <div class="px-6 py-4">
                    <div class="text-black font-bold text-xl mb-2"><a class="hover:text-orange" href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item["NAME"]?></a></div>
                    <p class="text-grey-darker text-base">
                        <span class="inline-block"><?=$arResult["PRICES"][$item["ID"]]?> <?=GetMessage("CURRENCY")?></span><span class="inline-block line-through pl-6 text-gray-400">TO DO</span>
                    </p>
                </div>
            </div>
    <?php endforeach?>
        </div>
        <?php if ($showBottomPager):?>
            <div class="text-center mt-4">
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px text-lg" aria-label="Pagination">
                    <?=$arResult['NAV_STRING']?>
                </nav>
            </div>
        <?php endif?>
</div>
