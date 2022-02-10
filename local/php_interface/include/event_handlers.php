<?php

AddEventHandler("main", "OnAfterUserAuthorize", Array("SendUserAuth", "OnAfterUserAuthorizeHandler"));
AddEventHandler("main", "OnAfterUserRegister", Array("SendUserAuth", "OnAfterUserRegisterHandler"));


class SendUserAuth
{
    // создаем обработчик события "OnAfterUserAuthorizeHandler"
    public static function OnAfterUserAuthorizeHandler(&$fields)
    {

        // получение полей для шаблона
        $email = $fields["user_fields"]["EMAIL"];
        $login = $fields["user_fields"]["LOGIN"];
        $date = date('Y.m.d H:i:s', time());

        $inf = [
            "EMAIL" => $email,
            "LOGIN" => $login,
            "DATE" => $date,
        ];

        CEvent::Send("USER_AUTHORIZED", SITE_ID, $inf);
    }

    // создаем обработчик события "OnAfterUserRegister"
    public static function OnAfterUserRegisterHandler(&$arFields)
    {
        if($arFields["USER_ID"] > 0) {
            $inf = [
                "EMAIL" => $arFields["EMAIL"],
                "LOGIN" => $arFields["LOGIN"],
                "NAME" => $arFields["NAME"],
                "LAST_NAME" => $arFields["LAST_NAME"],
            ];
            CEvent::Send("NEW_USER", SITE_ID, $inf);
        }
    }
}