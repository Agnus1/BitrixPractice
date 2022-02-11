<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");
?>

<noindex>
    <div class="p-4">
        <h1 class="text-black text-3xl font-bold mb-4"><?=GetMessage("AUTH_REGISTER")?></h1>

        <?php if(!empty($arParams["~AUTH_RESULT"])):
            $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
            ?>
            <div class="px-4 py-3 leading-normal text-<?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "green-700 bg-green-100":"red-700 bg-red-100")?> rounded-lg"><?=nl2br(htmlspecialcharsbx($text))?></div>
        <?php endif?>

        <form method="post" action="<?=$arResult["AUTH_URL"]?><?=DeleteParam("backurl")?>" name="bform" enctype="multipart/form-data">
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="REGISTRATION" />


            <div class="mt-8 max-w-md">
                <div class="grid grid-cols-1 gap-6">
                    <div class="block">
                        <label for="field1" class="text-gray-700 font-bold"><?=GetMessage("AUTH_NAME")?></label>
                        <input id="field1" type="text" name="USER_NAME" maxlength="255" value="<?=$arResult["USER_NAME"]?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="block">
                        <label for="field2" class="text-gray-700 font-bold"><?=GetMessage("AUTH_LAST_NAME")?></label>
                        <input id="field2" type="text" name="USER_LAST_NAME" maxlength="255" value="<?=$arResult["USER_LAST_NAME"]?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="block">
                        <label for="field2" class="text-gray-700 font-bold"><span class="bx-authform-starrequired">*</span><?=GetMessage("AUTH_LOGIN_MIN")?></label>
                        <input id="field2" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["USER_LOGIN"]?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="block">
                        <label for="field2" class="text-gray-700 font-bold"><span class="bx-authform-starrequired">*</span><?=GetMessage("AUTH_PASSWORD_REQ")?></label>
                        <input id="field2" type="password" name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" autocomplete="off" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="block">
                        <label for="field2" class="text-gray-700 font-bold"><span class="bx-authform-starrequired">*</span><?=GetMessage("AUTH_CONFIRM")?></label>
                        <input id="field2" type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" autocomplete="off" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="block">
                        <label for="field3" class="text-gray-700 font-bold"><span class="bx-authform-starrequired">*</span><?=GetMessage("AUTH_EMAIL")?></label>
                        <input id="field3" type="text" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="john@example.com">
                    </div>

                    <div class="block">
                            <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />

                            <div class="block">
                                <label for="field3" class="text-gray-700 font-bold"><span class="bx-authform-starrequired">*</span><?=GetMessage("CAPTCHA_REGF_PROMT")?></label>

                                <div><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></div>
                                <div>
                                    <input type="text" name="captcha_word" maxlength="50" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" autocomplete="off"/>
                                </div>
                            </div>
                    </div>
                    <div class="block">
                        <input type="submit" class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded cursor-pointer" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>" />
                    </div>
                </div>
            </div>
            <div class="mt-5 block">
                <label for="field3" class="text-gray-700 font-bold"><?=$arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]?><br></label>
                <label for="field3" class="text-gray-700 font-bold"><span class="bx-authform-starrequired">*</span><?=GetMessage("AUTH_REQ")?></label>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        document.bform.USER_NAME.focus();
    </script>
</noindex>