<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$frame = $this->createFrame()->begin("");
?>
    <section class="bg-white">
        <div <?=count($arResult["BANNERS_PROPERTIES"]) > 1 ? "data-slick-carousel" : ""?>>
            <?php for ($i = 0; $i < count($arResult["BANNERS_PROPERTIES"]); $i++):?>
                <?php  
                    preg_match("/src=\".*\.(jpg|png|jpeg)\"/i", $arResult["BANNERS"][$i], $src);
                ?>
                <div class="relative banner">
                    <div class="w-full h-full bg-black"><img class="w-full h-full object-cover object-center opacity-70" <?=$src[0]?> alt="" title=""></div>
                    <div class="absolute top-0 left-0 w-full px-10 py-4 sm:px-20 sm:py-8 lg:px-40 lg:py-10">
                        <h1 class="text-gray-100 text-lg sm:text-2xl md:text-4xl xl:text-6xl leading-relaxed sm:leading-relaxed md:leading-relaxed xl:leading-relaxed font-bold uppercase"><?=$arResult["BANNERS_PROPERTIES"][$i]["NAME"]?></h1>
                        <h2 class="text-gray-200 italic text-xs sm:text-lg md:text-xl xl:text-3xl leading-relaxed sm:leading-relaxed md:leading-relaxed xl:leading-relaxed font-bold"><?=$arResult["BANNERS_PROPERTIES"][$i]["COMMENTS"]?><a href="<?=$arResult["BANNERS_PROPERTIES"][$i]["URL"]?>" class="text-orange hover:opacity-75"> <?=GetMessage("DETAIL")?></a></h2>
                    </div>
                </div>
            <?php endfor?>
        </div>
    </section>
<?php
$frame->end();