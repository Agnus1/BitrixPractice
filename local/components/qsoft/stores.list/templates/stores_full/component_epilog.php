<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !==true) die();?>
<?php if ($arParams["SHOW_MAP"]):?>
    <div class="center-block">
        <?php
            $placemarks = $this->arResult["MAP_PLACEMARKS"];
            $APPLICATION->IncludeComponent(
                "bitrix:map.yandex.view",
                ".default",
                array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "INIT_MAP_TYPE" => "MAP",
                    "MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.73829999999371;s:10:\"yandex_lon\";d:37.59459999999997;s:12:\"yandex_scale\";i:10;s:10:\"PLACEMARKS\";" . $placemarks . "}",
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
<?php endif?>