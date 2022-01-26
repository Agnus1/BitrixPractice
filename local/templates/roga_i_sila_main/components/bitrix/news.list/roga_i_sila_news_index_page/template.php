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

// "голос за" композитное кэширование 
$this->setFrameMode(true);

?>
<section class="news-block-inverse px-6 py-4">
    <div>
        <p class="inline-block text-3xl text-white font-bold mb-4"><?= GetMessage("TEMPLATE_HEADER") ?></p>
        <span class="inline-block text-gray-200 pl-1"> / <b><?= ($arParams["DISPLAY_BOTTOM_PAGER"]) ? $arResult["NAV_STRING"] : "" ?></b></span>
    </div>
	<div class="grid md:grid-cols-1 lg:grid-cols-3 gap-6">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="w-full flex">
		    <div class="h-48 lg:h-auto w-32 sm:w-60 lg:w-32 xl:w-48 flex-none text-center overflow-hidden">
		        <a 
		        	class="block w-full h-full hover:opacity-75" 
		        	href="<?= (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) ? $arItem["DETAIL_PAGE_URL"] : "#" ?>">
		        		<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"] ?? $this->GetFolder() . '/images/no_photo.png'?>"
		        			width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
		        			height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
		        			title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
		        			alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
		        			class="bg-white bg-opacity-25 w-full h-full object-contain preview_picture">
		        </a>
		    </div>
		    <div class="px-4 flex flex-col justify-between leading-normal">
		        <div class="mb-8">
		        	<?php if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
				            <div class="text-white font-bold text-xl mb-2">
				                <a 
				                class="hover:text-orange"
				                href="<?= (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) ? $arItem["DETAIL_PAGE_URL"] : "#"?>">
				                	<?= $arItem["NAME"]?>
			                	</a>
				            </div>
		        	<?php endif ?>
	    			<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]): ?>
			            <p class="text-gray-300 text-base">
			                <a class="hover:text-orange" href="<?= (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) ? $arItem["DETAIL_PAGE_URL"] : "#"?>"><?= $arItem["PREVIEW_TEXT"] ?></a>
			            </p>
					<?php endif ?>
		        </div>
		        <div>
		            <span class="text-sm text-white italic rounded bg-orange px-2">Парадигма</span>
		            <span class="text-sm text-white italic rounded bg-orange px-2">Архетип</span>
		            <span class="text-sm text-white italic rounded bg-orange px-2">Киа Seed</span>
		        </div>
		        <?php if ($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			        <div class="flex items-center">
			            <p class="text-sm text-gray-400 italic news-date-time"><?= $arItem["DISPLAY_ACTIVE_FROM"]?></p>
			        </div>
		    	<?php endif ?>
		    </div>
		</div>
	<?endforeach;?>
	</div>
</section>
