<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 */

?>
<div class="p-4">
    <h1 class="text-black text-3xl font-bold mb-4"><?=GetMessage("AUTH_PLEASE_AUTH")?></h1>

    <?php
    if(!empty($arParams["~AUTH_RESULT"])):
        $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
        ?>
        <div class="my-4">
            <div class="px-4 py-3 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
                <p><?=nl2br(htmlspecialcharsbx($text))?></p>
            </div>
        </div>
    <?php endif?>

    <?php if($arResult['ERROR_MESSAGE'] <> ''):
    $text = str_replace(array("<br>", "<br />"), "\n", $arResult['ERROR_MESSAGE']);
    ?>
        <div class="my-4">
            <div class="px-4 py-3 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
                <p><?=nl2br(htmlspecialcharsbx($text))?></p>
            </div>
        </div>
    <?endif?>

    <form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="AUTH" />
        <?if ($arResult["BACKURL"] <> ''):
            $arResult["AUTH_URL"] = $arResult["BACKURL"];
        ?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif?>
        <?foreach ($arResult["POST"] as $key => $value):?>
            <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
        <?endforeach?>
        <div class="mt-8 max-w-md">
            <div class="grid grid-cols-1 gap-6">
                <div class="block">
                    <label for="field1" class="text-gray-700 font-bold"><?=GetMessage("AUTH_LOGIN")?></label>
                    <input type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="block">
                    <label for="field2" class="text-gray-700 font-bold"><?=GetMessage("AUTH_PASSWORD")?></label>
                    <input type="password" name="USER_PASSWORD" maxlength="255" autocomplete="off" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="block">
                    <div class="mt-2">
                        <div>
                            <label class="inline-flex items-center cursor-pointer">

                                <input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y"  class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2"><?=GetMessage("AUTH_REMEMBER_ME")?></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <input type="submit" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>"  class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded cursor-pointer">
                    <a class="ml-5 hover:text-orange" href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
                </div>
            </div>
        </div>
    </form>
</div>
<noindex class="ml-6">
        <?=GetMessage("AUTH_FIRST_ONE")?><br/>
        <a class="hover:text-orange ml-6" href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><b><?=GetMessage("AUTH_REGISTER")?></b></a>
</noindex>

<script type="text/javascript">
    <?if ($arResult["LAST_LOGIN"] <> ''):?>
    try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
    <?else:?>
    try{document.form_auth.USER_LOGIN.focus();}catch(e){}
    <?endif?>
</script>
