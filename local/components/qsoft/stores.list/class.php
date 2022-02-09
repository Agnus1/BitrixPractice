<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\SystemException;

class StoresList extends CBitrixComponent
{
    public function onPrepareComponentParams(array $arParams) : array
    {
        unset($arParams["IBLOCK_TYPE"]);
        $arParams["SHOW_ALL"] = ($arParams["SHOW_ALL"] === "Y");

        if (!isset($arParams["CACHE_TIME"])) {
            $arParams["CACHE_TIME"] = 1800;
        }

        return $arParams;
    }

    public function executeComponent() : void
    {

        if ($this->StartResultCache(false, false)) {
            try {
                $this->checkInputErrors();
                $rsIBlockElement = $this->getSalonsList();
                $this->arResult = $this->getArResult($rsIBlockElement);
                $this->setLinks($this->arResult[0]["LIST_PAGE_URL"]);
            } catch(SystemException $e) {
                ShowError($e->getMessage());
                $this->hideLinks();
            }
            $this->IncludeComponentTemplate();
        }
    }

    protected function getArResult(CIBlockResult $rsIBlockElement) : array
    {
        while ($salon = $rsIBlockElement->GetNext()) {
            $arResult[$salon["ID"]] = $salon;
        }

        foreach ($arResult as $salonId => $salon) {
            if ($salon['PREVIEW_PICTURE']) {
                $images[$salonId] = $salon["PREVIEW_PICTURE"];
            }
        }

        if (!empty($images)) {
            $imagesRes = CFile::getList([], ["@ID" => $images]);
            while ($image = $imagesRes->GetNext()) {
                $imagesSRC[$image["ID"]] = CFile::GetFileSRC($image);
            }
            foreach ($images as $salonId => $imageId) {
                $arResult[$salonId]["IMAGE_SRC"] = $imagesSRC[$imageId]; 
            }
        }

        return array_values($arResult);
    }

    protected function getSalonsList() : CIBlockResult
    {
        // SELECT
        $arSelect = [
            "ID",
            "IBLOCK_ID",
            "CODE",
            "IBLOCK_SECTION_ID",
            "NAME",
            "PREVIEW_PICTURE",
            "LIST_PAGE_URL",
            "PROPERTY_PHONE",
            "PROPERTY_ADDRESS",
            "PROPERTY_WORK_HOURS",
        ];

        // WHERE
        $arFilter = [
            "IBLOCK_ID" => $arIBlockFilter,
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
        ];

        // LIMIT
        $arLimit = [
            "nTopCount" => $this->arParams['AMOUNT_OF_EL'],
        ];

        //ORDER BY
        $arSort = [
            $this->arParams["SORT_FIELD"] => $this->arParams["SORT_ORDER"],
        ];

        //EXECUTE
        $result = CIBlockElement::GetList($arSort, $arFilter, false, $arLimit, $arSelect);

        if (!$result->SelectedRowsCount()) {
            throw new SystemException(GetMessage("NO_ELEMENTS"));
        } 

        return $result;
    }

    protected function checkInputErrors() : void
    {
        if (intval($this->arParams["IBLOCK"]) <= 0) {
            throw new SystemException(GetMessage("WRONG_IBLOCK"));
        }

        if (intval($this->arParams["AMOUNT_OF_EL"]) <= 0) {
            throw new SystemException(GetMessage("WRONG_AMOUNT_OF_EL"));
        }

        if (!CModule::IncludeModule("iblock")) {
            throw new SystemException(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        }
    }

    protected function setLinks(String $listPageUrl) : void
    {
        $link = empty($this->arParams["LIST_PAGE_URL"]) ? $listPageUrl : $this->arParams["LIST_PAGE_URL"];
        $link = $this->arParams["SHOW_ALL"] ? $link : "#";
        $this->arParams["LIST_PAGE_URL"] = $link;
    }

    protected function hideLinks() : void
    {
        $this->arParams["SHOW_ALL"] = false;
        $this->arParams["LIST_PAGE_URL"] = "#";
    }
}