<?php

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

CBitrixComponent::includeComponentClass('bitrix:advertising.banner');


class HornsAndPowerBanner extends \AdvertisingBanner
{
    public function onPrepareComponentParams($params)
    {
       $params = parent::onPrepareComponentParams($params);

       global $USER;
       if (! $USER->IsAuthorized()) {
           $params['QUANTITY'] = 1;
       }
      
       return $params;
    }
}