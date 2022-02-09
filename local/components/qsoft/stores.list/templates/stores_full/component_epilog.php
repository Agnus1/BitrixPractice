<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !==true) die();?>
<?php if ($arParams["SHOW_MAP"]):?>
<div class="my-4 space-y-4 max-w-4xl">
    <hr>
    <p class="text-black text-2xl font-bold mb-4"><?=GetMessage("SALONS_ON_MAP")?></p>
    <div class="bg-gray-200">
        <?php
        $placemarks = $this->arResult["MAP_PLACEMARKS"];
        $APPLICATION->IncludeComponent(
            "bitrix:map.yandex.view",
            ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "INIT_MAP_TYPE" => "MAP",
                "MAP_DATA" => $placemarks,
                "MAP_WIDTH" => "600",
                "MAP_HEIGHT" => "500",
                "CONTROLS" => array(
                    0 => "ZOOM",
                    1 => "TYPECONTROL",
                ),
                "OPTIONS" => array(
                    0 => "ENABLE_SCROLL_ZOOM",
                    1 => "ENABLE_DRAGGING",
                ),
                "MAP_ID" => "test",
                "API_KEY" => ""
            ),
            false
        )?>
    </div>
</div>

<?php endif?>