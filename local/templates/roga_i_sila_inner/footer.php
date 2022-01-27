<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
    </div>
</div>
  </main>
    <footer class="container mx-auto">
        <section class="block sm:flex bg-white px-4 sm:px-8 py-4">
            <div class="flex-1">
                <div>
                    <p class="inline-block text-3xl text-black font-bold mb-4">Наши салоны</p>
                    <span class="inline-block pl-1"> / <a href="salons.html" class="inline-block pl-1 text-gray-600 hover:text-orange"><b>Все</b></a></span>
                </div>
                
                <div class="grid gap-6 grid-cols-1 lg:grid-cols-2">
                    <div class="w-full flex">
                        <div class="h-48 lg:h-auto w-32 xl:w-48 flex-none text-center rounded-lg overflow-hidden">
                            <a class="block w-full h-full hover:opacity-75" href="salons.html"><img src="<?=DEFAULT_ASSETS_PATH?>/pictures/test_salon_1.jpg" class="w-full h-full object-cover" alt=""></a>
                        </div>
                        <div class="px-4 flex flex-col justify-between leading-normal">
                            <div class="mb-8">
                                <div class="text-black font-bold text-xl mb-2">
                                    <a class="hover:text-orange" href="salons.html">Салон на братиславской</a>
                                </div>
                                <div class="text-base space-y-2">
                                    <p class="text-gray-400">Москва, ул. Братиславская, дом 23</p>
                                    <p class="text-black">+7 495 987 65 43</p>
                                    <p class="text-sm">Часы работы:<br> c 9.00 до 21.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex">
                        <div class="h-48 lg:h-auto w-32 xl:w-48 flex-none text-center rounded-lg overflow-hidden">
                            <a class="block w-full h-full hover:opacity-75" href="salons.html"><img src="<?=DEFAULT_ASSETS_PATH?>/pictures/test_salon_2.jpg" class="w-full h-full object-cover" alt=""></a>
                        </div>
                        <div class="px-4 flex flex-col justify-between leading-normal">
                            <div class="mb-8">
                                <div class="text-black font-bold text-xl mb-2">
                                    <a class="hover:text-orange" href="salons.html">Салон на братиславской</a>
                                </div>
                                <div class="text-base space-y-2">
                                    <p class="text-gray-400">Москва, ул. Братиславская, дом 23</p>
                                    <p class="text-black">+7 495 987 65 43</p>
                                    <p class="text-sm">Часы работы:<br> c 9.00 до 21.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
);?>
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