<?php 

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

$APPLICATION->SetTitle(GetMessage("OUR_SALONS"));

// начало динамической зоны компонента, установка заглушки при загрузке
$frame = $this->createFrame()->begin(GetMessage("LOADING"));
?>
<div class="col-span-4 sm:col-span-3 lg:col-span-4 p-4">

    <div class="space-y-4 max-w-4xl">
    	<?php for ($i = 0; $i < count($arResult); $i++):?>
            <?php if ($i % 2 == 0):?>
                <div class="w-full flex p-4">
                    <div class="h-48 lg:h-auto w-32 xl:w-48 flex-none text-center rounded-lg overflow-hidden">
                        <img src="<?=$arResult[$i]["IMAGE_SRC"]?>" class="w-full h-full object-cover" alt="">
                    </div>
                    <div class="px-4 flex flex-col justify-between leading-normal">
                        <div class="mb-8">
                            <div class="text-black font-bold text-xl mb-2"><?=$arResult[$i]["NAME"]?></div>
                            <div class="text-base space-y-2">
                                <p class="text-gray-400"><?=$arResult[$i]["PROPERTY_ADDRESS_VALUE"]?></p>
                                <p class="text-black"><?=$arResult[$i]["PROPERTY_PHONE_VALUE"]?></p>
                                <p class="text-sm"><?=GetMessage("WORK_HOURS")?>:<br><?=$arResult[$i]["PROPERTY_WORK_HOURS_VALUE"]?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else:?>
                <div class="w-full flex justify-end bg-gray-100 p-4">
                    <div class="px-4 flex flex-col justify-between leading-normal text-right">
                        <div class="mb-8">
                            <div class="text-black font-bold text-xl mb-2"><?=$arResult[$i]["NAME"]?></div>
                            <div class="text-base space-y-2">
                                <p class="text-gray-400"><?=$arResult[$i]["PROPERTY_ADDRESS_VALUE"]?></p>
                                <p class="text-black"><?=$arResult[$i]["PROPERTY_PHONE_VALUE"]?></p>
                                <p class="text-sm"><?=GetMessage("WORK_HOURS")?>:<br><?=$arResult[$i]["PROPERTY_WORK_HOURS_VALUE"]?></p>
                            </div>
                        </div>
                    </div>
                    <div class="h-48 lg:h-auto w-32 xl:w-48 flex-none text-center rounded-lg overflow-hidden">
                        <img src="<?=$arResult[$i]["IMAGE_SRC"]?>" class="w-full h-full object-cover" alt="">
                    </div>
                </div>
            <?php endif?>            
        <?php endfor?>
    </div>

<?php
// закрытие динамической зоны компонента
$frame->end();
?>