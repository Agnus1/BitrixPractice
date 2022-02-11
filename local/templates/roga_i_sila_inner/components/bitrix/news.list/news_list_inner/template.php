<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="space-y-4">
    <?php foreach($arResult["ITEMS"] as $arItem) :?>
    <?php
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
        <div class="w-full flex" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="h-48 lg:h-auto w-32 sm:w-60 lg:w-32 xl:w-48 flex-none text-center overflow-hidden">
                <a class="block w-full h-full hover:opacity-75" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"] ?? NO_IMAGE_PATH?>"
                                                                                                             alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                                                                                             title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                                                                                                              class="bg-white bg-opacity-25 w-full h-full object-contain"></a>
        </div>
            <div class="px-4 leading-normal">
                <div class="mb-8 space-y-2">
                    <div class="text-black font-bold text-xl">
                        <a class="hover:text-orange" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                    </div>
                    <p class="text-gray-600 text-base">
                        <a class="hover:text-orange" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["PREVIEW_TEXT"]?></a>
                    </p>
                    <div>
                        <span class="text-sm text-white italic rounded bg-orange px-2">Это</span>
                        <span class="text-sm text-white italic rounded bg-orange px-2">Теги</span>
                    </div>
                    <div class="flex items-center">
                        <p class="text-sm text-gray-400 italic"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach?>
    <div>
        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px text-lg" aria-label="Pagination">
            <!--PAGINATION-->
            <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
                <?=$arResult["NAV_STRING"]?>
            <?endif;?>
        </nav>
    </div>
</div>
