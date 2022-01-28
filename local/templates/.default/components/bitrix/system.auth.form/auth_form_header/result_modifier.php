<?php 
$arResult["LOGOUT_URL"] = $APPLICATION->GetCurPageParam("logout=yes&" . bitrix_sessid_get(), 
	array(
		     "login",
		     "logout",
		     "register",
		     "forgot_password",
		     "change_password"
	)
);
$arResult["AUTHORIZE_URL"] = $arParams["AUTHORIZE_URL"];
$arResult["PERSONAL_URL"] = $arParams["PERSONAL_URL"];
