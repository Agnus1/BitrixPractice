<?php

AddEventHandler("main", "OnAfterUserLogin", Array("SendUserAuth", "OnAfterUserLoginHandler"));

class SendUserAuth
{
    // создаем обработчик события "OnAfterUserLogin"
    function OnAfterUserLoginHandler(&$fields)
    {
        // если логин успешен то
        if($fields['USER_ID'] > 0)
        {
        	// получение полей для шаблона
	    	$email = CUser::GetEmail();
	    	$login = $fields["LOGIN"];
	    	$date = date('Y.m.d h:i:s', time());
	    	$inf = [
	    		"EMAIL" => $email,
	    		"LOGIN" => $login,
	    		"DATE" => $date,
	    	];

        	CEvent::Send("USER_AUTHORIZED", SITE_ID, $inf);
        }
    }
}