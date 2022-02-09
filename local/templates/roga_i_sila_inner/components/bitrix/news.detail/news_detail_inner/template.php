<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

<div class="col-span-4 sm:col-span-3 lg:col-span-4 p-4">

    <div class="space-y-4">
        <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
             title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>">
        <div>
            <span class="text-sm text-white italic rounded bg-orange px-2">Это</span>
            <span class="text-sm text-white italic rounded bg-orange px-2">Теги</span>
        </div>
        <?=$arResult["DETAIL_TEXT"]?>
    </div>

    <div class="mt-4">
        <a class="inline-flex items-center text-orange hover:opacity-75" href="<?=$arResult["LIST_PAGE_URL"]?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
            </svg>
            <?=GetMessage("TO_NEWS_LIST")?>
        </a>
    </div>
</div>