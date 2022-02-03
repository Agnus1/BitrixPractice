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

// начало динамической зоны компонента, установка заглушки при загрузке
$frame = $this->createFrame()->begin(GetMessage("LOADING"));
?>
<div class="flex-1">
    <div>
        <p class="inline-block text-3xl text-black font-bold mb-4"><?=GetMessage('OUR_SALONS')?></p>
        <?if ($arParams["SHOW_ALL"]):?>
        	<span class="inline-block pl-1"> / <a href="<?=$arParams['LIST_PAGE_URL']?>" class="inline-block pl-1 text-gray-600 <?=$arParams["SHOW_ALL"] ? "hover:text-orange" : "disabled"?>"><b><?=GetMessage("ALL")?></b></a></span>
 		<?endif?>   
    </div>
    
    <div class="grid gap-6 grid-cols-1 lg:grid-cols-2">
    	<?foreach ($arResult as $salon):?>
	        <div class="w-full flex">
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
        <?endforeach?>
    </div>
</div>
<?
// закрытие динамической зоны компонента
$frame->end();
?>