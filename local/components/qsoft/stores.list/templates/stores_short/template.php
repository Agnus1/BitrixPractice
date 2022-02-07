<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

// начало динамической зоны компонента, установка заглушки при загрузке
$frame = $this->createFrame()->begin(GetMessage("LOADING"));
?>
<?php $this->AddEditAction("main-container", $arParams['ADD_LINK'], $arParams["ADD_LINK_TEXT"]);?>
<div id="<?=$this->GetEditAreaId("main-container");?>" class="flex-1">
    <div>
        <p class="inline-block text-3xl text-black font-bold mb-4"><?=GetMessage('OUR_SALONS')?></p>
        <?php if ($arParams["SHOW_ALL"]):?>
        	<span class="inline-block pl-1"> / <a href="<?=$arParams['LIST_PAGE_URL']?>" class="inline-block pl-1 text-gray-600 <?=$arParams["SHOW_ALL"] ? "hover:text-orange" : "disabled"?>"><b><?=GetMessage("ALL")?></b></a></span>
 		<?php endif?>
    </div>
    <div class="grid gap-6 grid-cols-1 lg:grid-cols-2">
    	<?php foreach ($arResult as $salon):?>
            <?php
                $this->AddEditAction($salon['ID'], $salon['EDIT_LINK'], CIBlock::GetArrayByID($salon["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($salon['ID'], $salon['DELETE_LINK'], CIBlock::GetArrayByID($salon["IBLOCK_ID"], "ELEMENT_DELETE"), ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);
            ?>
	        <div class="w-full flex" id="<?=$this->GetEditAreaId($salon['ID']);?>">
	            <div class="h-48 lg:h-auto w-32 xl:w-48 flex-none text-center rounded-lg overflow-hidden">
	                <a class="block w-full h-full <?=$arParams["SHOW_ALL"] ? "hover:opacity-75" : "disabled"?>" href="<?=$arParams['LIST_PAGE_URL']?>">
	                	<img
	                	src="<?=$salon["IMAGE_SRC"]?>"
	                	class="w-full h-full object-cover">
	                </a>
	            </div>
	            <div class="px-4 flex flex-col justify-between leading-normal">
	                <div class="mb-8">
	                    <div class="text-black font-bold text-xl mb-2">
	                        <a class="<?=$arParams["SHOW_ALL"] ? "hover:text-orange" : "disabled"?>" href="<?=$arParams['LIST_PAGE_URL']?>"><?=$salon["NAME"]?></a>
	                    </div>
	                    <div class="text-base space-y-2">
	                        <p class="text-gray-400"><?=$salon["PROPERTY_ADDRESS_VALUE"]?></p>
	                        <p class="text-black"><?=$salon["PROPERTY_PHONE_VALUE"]?></p>
	                        <p class="text-sm"><?=GetMessage("WORK_HOURS")?>:<br><?=$salon["PROPERTY_WORK_HOURS_VALUE"]?></p>
	                    </div>
	                </div>
	            </div>
        	</div>
        <?php endforeach?>
    </div>
</div>
<?php
// закрытие динамической зоны компонента
$frame->end();
?>