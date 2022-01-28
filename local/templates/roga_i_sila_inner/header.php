<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$asset = Bitrix\Main\Page\Asset::getInstance();
$asset->addCss(DEFAULT_ASSETS_PATH . "/css/base.css");
$asset->addCss(DEFAULT_ASSETS_PATH . "/css/form.min.css");
$asset->addCss(DEFAULT_ASSETS_PATH . "/css/tailwind.css");

$asset->addCss(DEFAULT_ASSETS_PATH . "/js/vendor/slick.css");
$asset->addJs(DEFAULT_ASSETS_PATH . "/js/vendor/jquery-3.6.0.js");
$asset->addJs(DEFAULT_ASSETS_PATH . "/js/vendor/slick.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/assets/js/script.js");

?>
<!doctype html>
<html class="antialiased" lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?$APPLICATION->ShowHead()?>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <link href="<?=DEFAULT_ASSETS_PATH?>/favicon.ico" rel="shortcut icon" type="image/x-icon">
</head>
<body class="bg-white text-gray-600 font-sans leading-normal text-base tracking-normal flex min-h-screen flex-col">
    <?$APPLICATION->ShowPanel()?>
<div class="wrapper flex flex-1 flex-col">
    <header class="bg-white">
        <div class="border-b">
            <div class="container mx-auto block sm:flex sm:justify-between sm:items-center py-4 px-4 sm:px-0 space-y-4 sm:space-y-0">
                <div class="flex justify-center">
                    <span class="inline-block sm:inline">
                        <img src="<?=DEFAULT_ASSETS_PATH?>/images/logo.png" width="222" height="30" alt="">
                    </span>
                </div>
                <div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:system.auth.form", 
                        "auth_form_header", 
                        array(
                            "FORGOT_PASSWORD_URL" => "",
                            "PROFILE_URL" => "/personal/",
                            "REGISTER_URL" => "/auth/",
                            "SHOW_ERRORS" => "N",
                            "COMPONENT_TEMPLATE" => "auth_form_header",
                            "AUTHORIZE_URL" => "/login/",
                            "PERSONAL_URL" => "/personal/profile/"
                        ),
                        false
                    );?>
                </div>
            </div>
        </div>
        <div class="border-b">
            <div class="container mx-auto block lg:flex justify-between items-center px-2 sm:px-0">
                <form name="search_form" class="bg-gray-100 rounded-full flex items-center px-3 text-sm order-2 my-4 lg:my-0">
                    <label for="search-input" class="hidden"></label>
                    <input id="search-input" type="text" placeholder="Поиск по сайту" class="bg-gray-100 rounded-full py-1 px-1 focus:outline-none placeholder-opacity-50 flex-1 border-none focus:shadow-none focus:ring-0">
                    <button type="submit" class="group focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-black group-hover:text-orange h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>

                <nav class="order-1">
                    <ul class="block lg:flex">
                        <li class="group">
                            <a class="inline-block p-4 text-black font-bold border-l border-r border-transparent group-hover:text-orange group-hover:bg-gray-100 group-hover:border-l group-hover:border-r group-hover:border-gray-200 group-hover:shadow" href="catalog.html">
                                Легковые
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </a>

                            <ul class="dropdown-navigation-submenu absolute hidden group-hover:block bg-white shadow-lg">
                                <li><a class="block py-2 px-4 text-black hover:text-orange hover:bg-gray-100" href="catalog.html">Седаны</a></li>
                                <li><a class="block py-2 px-4 text-black hover:text-orange hover:bg-gray-100" href="catalog.html">Хетчбеки</a></li>
                                <li><a class="block py-2 px-4 text-black hover:text-orange hover:bg-gray-100" href="catalog.html">Универсалы</a></li>
                                <li><a class="block py-2 px-4 text-black hover:text-orange hover:bg-gray-100" href="catalog.html">Купе</a></li>
                                <li><a class="block py-2 px-4 text-black hover:text-orange hover:bg-gray-100" href="catalog.html">Родстеры</a></li>
                            </ul>
                        </li>
                        <li class="group">
                            <a class="inline-block p-4 text-black font-bold border-l border-r border-transparent group-hover:text-orange group-hover:bg-gray-100 group-hover:border-l group-hover:border-r group-hover:border-gray-200 group-hover:shadow" href="catalog.html">
                                Внедорожники
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </a>
                            <ul class="dropdown-navigation-submenu absolute hidden group-hover:block bg-white shadow-lg">
                                <li><a class="block py-2 px-4 text-black hover:text-orange hover:bg-gray-100" href="catalog.html">Рамные</a></li>
                                <li><a class="block py-2 px-4 text-black hover:text-orange hover:bg-gray-100" href="catalog.html">Пикапы</a></li>
                                <li><a class="block py-2 px-4 text-black hover:text-orange hover:bg-gray-100" href="catalog.html">Кроссоверы</a></li>
                            </ul>
                        </li>
                        <li class="group"><a class="inline-block p-4 text-black font-bold hover:text-orange" href="catalog.html">Раритетные</a></li>
                        <li class="group"><a class="inline-block p-4 text-black font-bold hover:text-orange" href="catalog.html">Распродажа</a></li>
                        <li class="group"><a class="inline-block p-4 text-black font-bold hover:text-orange" href="catalog.html">Новинки</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <nav class="container mx-auto bg-gray-100 py-1 px-4 text-sm flex items-center space-x-2">
        <a class="hover:text-orange" href="index.html">Главная</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-3 w-3 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
        </svg>
        <span>Легковые</span>
    </nav>
    <main class="flex-1 container mx-auto bg-white">
        <div class="flex-1 grid grid-cols-4 lg:grid-cols-5 border-b">
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "roga_i_sila_left_menu",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "bottom",
                    "USE_EXT" => "N"
                )
            );?>
            <div class="col-span-4 sm:col-span-3 lg:col-span-4 p-4">
            <h1 class="text-black text-3xl font-bold mb-4"><?=$APPLICATION->AddBufferContent([$APPLICATION, 'GetTitle'])?></h1>