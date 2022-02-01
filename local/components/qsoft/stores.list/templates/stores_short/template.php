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
$frame = $this->createFrame()->begin('');
?>
<div class="flex-1">
    <div>
        <p class="inline-block text-3xl text-black font-bold mb-4"><?=GetMessage('OUR_SALONS')?></p>
        <span class="inline-block pl-1"> / <a href="<?=$arResult['LIST_PAGE_URL']?>" class="inline-block pl-1 text-gray-600 hover:text-orange"><b><?=GetMessage("ALL")?></b></a></span>
    </div>
    
    <div class="grid gap-6 grid-cols-1 lg:grid-cols-2">
    	<?foreach ($arResult["ELEMENTS"] as $salon):?>
	        <div class="w-full flex">
	            <div class="h-48 lg:h-auto w-32 xl:w-48 flex-none text-center rounded-lg overflow-hidden">
	                <a class="block w-full h-full hover:opacity-75" href="<?=$arResult['LIST_PAGE_URL']?>"><img
	                	src="<?=$salon["PICTURE"]["SRC"]?>" 
	                	class="w-full h-full object-cover"></a>
	            </div>
	            <div class="px-4 flex flex-col justify-between leading-normal">
	                <div class="mb-8">
	                    <div class="text-black font-bold text-xl mb-2">
	                        <a class="hover:text-orange" href="<?=$arResult['LIST_PAGE_URL']?>"><?=$salon["NAME"]?></a>
	                    </div>
	                    <div class="text-base space-y-2">
	                        <p class="text-gray-400"><?=$salon["ADDRESS"]["VALUE"]?></p>
	                        <p class="text-black"><?=$salon["PHONE"]["VALUE"]?></p>
	                        <p class="text-sm"><?=GetMessage("WORK_HOURS")?>:<br><?=$salon["WORK_HOURS"]["VALUE"]?></p>
	                    </div>
	                </div>
	            </div>
        	</div>
        <?endforeach?>
    </div>
</div>
<?
$frame->end();
?>