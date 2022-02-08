<?php 

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !==true) die();
/** @var array $arParams */
/** @var array $arResult["ELEMENTS"] */
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
<?php $this->AddEditAction("main-container", $arParams['ADD_LINK'], $arParams["ADD_LINK_TEXT"]);?>
<div id="<?=$this->GetEditAreaId("main-container");?>" class="col-span-4 sm:col-span-3 lg:col-span-4 p-4">

    <div class="space-y-4 max-w-4xl">
    <?php
        $i = 0;
        foreach ($arResult["ELEMENTS"] as $salon):
    ?>
            <?php
                $i++;
                $this->AddEditAction($salon['ID'], $salon['EDIT_LINK'], CIBlock::GetArrayByID($salon["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($salon['ID'], $salon['DELETE_LINK'], CIBlock::GetArrayByID($salon["IBLOCK_ID"], "ELEMENT_DELETE"), ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);
            ?>
            <?php if ($i % 2 == 1):?>
                <div id="<?=$this->GetEditAreaId($salon['ID']);?>" class="w-full flex p-4">
                    <div class="h-48 lg:h-auto w-32 xl:w-48 flex-none text-center rounded-lg overflow-hidden">
                        <img src="<?=$salon["IMAGE_SRC"]?>" class="w-full h-full object-cover" alt="">
                    </div>
                    <div class="px-4 flex flex-col justify-between leading-normal">
                        <div class="mb-8">
                            <div class="text-black font-bold text-xl mb-2"><?=$salon["NAME"]?></div>
                            <div class="text-base space-y-2">
                                <p class="text-gray-400"><?=$salon["PROPERTY_ADDRESS_VALUE"]?></p>
                                <p class="text-black"><?=$salon["PROPERTY_PHONE_VALUE"]?></p>
                                <p class="text-sm"><?=GetMessage("WORK_HOURS")?>:<br><?=$salon["PROPERTY_WORK_HOURS_VALUE"]?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else:?>
                <div id="<?=$this->GetEditAreaId($salon['ID']);?>" class="w-full flex justify-end bg-gray-100 p-4">
                    <div class="px-4 flex flex-col justify-between leading-normal text-right">
                        <div class="mb-8">
                            <div class="text-black font-bold text-xl mb-2"><?=$salon["NAME"]?></div>
                            <div class="text-base space-y-2">
                                <p class="text-gray-400"><?=$salon["PROPERTY_ADDRESS_VALUE"]?></p>
                                <p class="text-black"><?=$salon["PROPERTY_PHONE_VALUE"]?></p>
                                <p class="text-sm"><?=GetMessage("WORK_HOURS")?>:<br><?=$salon["PROPERTY_WORK_HOURS_VALUE"]?></p>
                            </div>
                        </div>
                    </div>
                    <div class="h-48 lg:h-auto w-32 xl:w-48 flex-none text-center rounded-lg overflow-hidden">
                        <img src="<?=$salon["IMAGE_SRC"]?>" class="w-full h-full object-cover" alt="">
                    </div>
                </div>
            <?php endif?>            
        <?php endforeach?>
    </div>
    <?php if ($arParams["SHOW_MAP"]):?>
        <div class="my-4 space-y-4 max-w-4xl">
            <hr>
            <p class="text-black text-2xl font-bold mb-4"><?=GetMessage("SALONS_ON_MAP")?></p>
            <div class="bg-gray-200">
            </div>
        </div>
    <?php endif?>
</div>
<?php
// закрытие динамической зоны компонента
$frame->end();
?>