<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul id="horizontal-multilevel-menu">

<?if (!empty($arResult)):?>
<nav class="order-1">
    <ul class="block lg:flex">
        <?$previousLevel = 0?>
            <?foreach($arResult as $arItem):?>

                <?if ($previousLevel > $arItem["DEPTH_LEVEL"]):?>
                    </ul></li>
                <?endif?>

                <?if ($arItem["IS_PARENT"]):?>
      

                    <li class="group">
                        <a 
                            class="inline-block p-4 text-<?=($arItem["SELECTED"]) ? 'orange' : 'black'?> font-bold border-l border-r border-transparent group-hover:text-orange group-hover:bg-gray-100 group-hover:border-l group-hover:border-r group-hover:border-gray-200 group-hover:shadow"
                            href="<?=$arItem["LINK"]?>">
                                <?=$arItem["TEXT"]?>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="inline-block h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>
                        <ul class="dropdown-navigation-submenu absolute hidden group-hover:block bg-white shadow-lg">
                <?elseif ($arItem["DEPTH_LEVEL"] > 1):?>
                    <li><a 
                        class="block py-2 px-4 text-<?=($arItem["SELECTED"]) ? 'orange' : 'black'?> hover:text-orange hover:bg-gray-100"
                        href="<?=$arItem["LINK"]?>">
                            <?=$arItem["TEXT"]?>
                    </a></li>
                <?else:?>
                     <li class="group"><a class="inline-block p-4 text-<?=($arItem["SELECTED"]) ? 'orange' : 'black'?> font-bold hover:text-orange" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                <?endif?>
            <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
        <?endforeach?>

        <?if ($previousLevel > 1)?>
            </ul></li>
        <?endif?>
    </ul>
</nav>
<?endif?>