<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
    </div>
</div>
  </main>
    <footer class="container mx-auto">
        <section class="block sm:flex bg-white px-4 sm:px-8 py-4">
            <?$APPLICATION->IncludeComponent(
	"qsoft:stores.list", 
	"stores_short", 
	array(
		"ALL_URL" => "/company/stores/",
		"AMOUNT_OF_EL" => "2",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "180",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"IBLOCKS" => "6",
		"IBLOCK_TYPE" => "salons",
		"PARENT_SECTION" => "",
		"SORT_FIELD" => "ID",
		"SORT_ORDER" => "DESC",
		"COMPONENT_TEMPLATE" => "stores_short",
		"LIST_PAGE_URL" => ""
	),
	false
);?>
            <?$APPLICATION->IncludeComponent(
            	"bitrix:menu", 
            	"roga_i_sila_bot_menu", 
            	array(
            		"ALLOW_MULTI_SELECT" => "N",
            		"CHILD_MENU_TYPE" => "left",
            		"DELAY" => "N",
            		"MAX_LEVEL" => "1",
            		"MENU_CACHE_GET_VARS" => array(
            		),
            		"MENU_CACHE_TIME" => "3600",
            		"MENU_CACHE_TYPE" => "A",
            		"MENU_CACHE_USE_GROUPS" => "Y",
            		"ROOT_MENU_TYPE" => "bottom",
            		"USE_EXT" => "N",
            		"COMPONENT_TEMPLATE" => "roga_i_sila_bot_menu"
            	),
            	false
            )?>
        </section>


        <div class="space-y-4 sm:space-y-0 sm:flex sm:justify-between items-center py-6 px-2 sm:px-0">
            <div class="copy pr-8">© 2021 Рога &amp; Сила. Продажа автомобилей.</div>
            <div class="text-right">
                <a href="https://www.qsoft.ru" target="_blank" class="inline-block">Сделано в <img class="ml-2 inline-block" src="<?=DEFAULT_ASSETS_PATH?>/images/qsoft.png" width="59" height="11" alt=""/></a>
            </div>
        </div>
    </footer>
</div>

</body>
</html>