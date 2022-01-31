<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php if (!empty($arResult)): ?>
<aside class="hidden sm:block col-span-1 border-r p-4">
    <nav>
        <ul class="text-sm">
            <li>
                <p class="text-xl text-black font-bold mb-4"><?=GetMessage('ROGA_I_SILA_LEFT_MENU_TITLE')?></p>
                <ul class="space-y-2">
            		<?php foreach($arResult as $arItem):?>
                    <li><a class="<?= $arItem['SELECTED'] ? ($arItem['PARAMS']['isGreen'] ? 'text-green cursor-default' : 'text-orange cursor-default') : 'hover:text-orange'?>" 
                    	href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                	<?php endforeach ?>
                </ul>
            </li>
        </ul>
    </nav>
</aside>
<?php endif?>