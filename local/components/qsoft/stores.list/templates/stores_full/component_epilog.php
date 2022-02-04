    <?php if ($arParams["SHOW_MAP"] === "Y"):?>
        <div class="my-4 space-y-4 max-w-4xl">
            <hr>
            <p class="text-black text-2xl font-bold mb-4"><?=GetMessage("SALONS_ON_MAP")?></p>
            <div class="bg-gray-200">
                <?$APPLICATION->IncludeComponent(
                        "bitrix:map.yandex.view", 
                        ".default", 
                        array(
                            "API_KEY" => "",
                            "CONTROLS" => array(
                                0 => "ZOOM",
                                1 => "TYPECONTROL",
                            ),
                            "INIT_MAP_TYPE" => "MAP",
                            "MAP_DATA" => "a:3:{s:10:\"yandex_lat\";d:55.73829999999371;s:10:\"yandex_lon\";d:37.59459999999997;s:12:\"yandex_scale\";i:10;}",
                            "MAP_HEIGHT" => "500",
                            "MAP_ID" => "salons",
                            "MAP_WIDTH" => "600",
                            "OPTIONS" => array(
                                0 => "ENABLE_SCROLL_ZOOM",
                            ),
                            "COMPONENT_TEMPLATE" => ".default"
                        ),
                        false
                    );?>
            </div>
        </div>
    <?php endif?>
</div>
