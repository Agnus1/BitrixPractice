<?php

AddEventHandler("main", "OnAfterUserAuthorize", Array("SendUserAuth", "OnAfterUserAuthorizeHandler"));


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

}