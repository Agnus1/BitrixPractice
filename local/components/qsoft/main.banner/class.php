<?php

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

CBitrixComponent::includeComponentClass('bitrix:advertising.banner');


class HornsAndPowerBanner extends \AdvertisingBanner
{
    protected function loadBanners()
    {
        global $USER;
        if (!$USER->IsAuthorized()) {
            $this->arParams['QUANTITY'] = 1;
        }
        parent::loadBanners();
        $this->arResult["TEST"] = $this->templateProps;
    }
}