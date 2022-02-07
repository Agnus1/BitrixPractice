<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\SystemException;

class StoresList extends CBitrixComponent
{
    /**
     * @param array $arParams
     * @return array
     */
    public function onPrepareComponentParams(array $arParams) : array
    {
        $arParams["SHOW_ALL"] = ($arParams["SHOW_ALL"] === "Y");
        $arParams["SHOW_MAP"] = ($arParams["SHOW_MAP"] == "Y");

        unset($arParams["IBLOCK_TYPE"]);
        if (!$arParams["SHOW_ALL"]) {
            unset($arParams["LIST_PAGE_URL"]);
        }
        if (!isset($arParams["CACHE_TIME"])) {
            $arParams["CACHE_TIME"] = 1800;
        }
        return $arParams;
    }

    /**
     * @return void
     */
    public function executeComponent() : void
    {
        if ($this->StartResultCache(false, false)) {
            try {
                $this->checkInputErrors();
                $rsIBlockElement = $this->getSalonsList();
                $this->arResult = $this->getArResult($rsIBlockElement);
                $this->setLinks($this->arResult[0]["LIST_PAGE_URL"]);
            } catch(SystemException $e) {
                $this->hideLinks();
                ShowError($e->getMessage());
            }

            $this->IncludeComponentTemplate();
        }
    }

    /**
     * @param CIBlockResult $rsIBlockElement
     * @return array
     */
    protected function getArResult(CIBlockResult $rsIBlockElement) : array
    {
        while ($salon = $rsIBlockElement->GetNext()) {
            $arResult[$salon["ID"]] = $salon;
            if ($salon['PREVIEW_PICTURE']) {
                $images[$salon["ID"]] = $salon["PREVIEW_PICTURE"];
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

    /**
     * @return CIBlockResult
     */
    protected function getSalonsList() : CIBlockResult
    {
        // SELECT
        $arSelect = [
            "ID",
            "IBLOCK_ID",
            "IBLOCK_SECTION_ID",
            "NAME",
            "PREVIEW_PICTURE",
            "PROPERTY_PHONE",
            "PROPERTY_ADDRESS",
            "PROPERTY_WORK_HOURS",
            $this->arParams["SHOW_ALL"] ? "LIST_PAGE_URL" : "",
            $this->arParams["SHOW_MAP"] ? "PROPERTY_MAP" : "",
        ];

        // WHERE
        $arFilter = [
            "IBLOCK_ID" => intval($this->arParams["IBLOCK"]),
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y",
        ];

        // LIMIT
        if ($this->arParams['AMOUNT_OF_EL'] !== "UNLIMITED") {
            $arLimit = [
                "nTopCount" => $this->arParams['AMOUNT_OF_EL'],
            ];
        }

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

    /**
     * @return void
     */
    protected function checkInputErrors() : void
    {
        if (intval($this->arParams["IBLOCK"]) <= 0) {
            throw new SystemException(GetMessage("WRONG_IBLOCK"));
        }

        if (!CModule::IncludeModule("iblock")) {
            throw new SystemException(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        }
    }

    /**
     * @return String Serialized string with map coordinates
     */
    protected function getMapSerializedPlacemarks() : String
    {
        foreach ($this->arResult as $salon) {
            list($lat, $lon) = explode(',', $salon["PROPERTY_MAP_VALUE"]);
            $res[] = [
                "LON" => $lon,
                "LAT" => $lat,
                "TEXT" => $salon["NAME"],
            ];
        }

        return  serialize($res);
    }

    /**
     * @param String|null $listPageUrl
     * @return void
     */
    protected function setLinks(?String $listPageUrl) : void
    {
        if ($this->arParams["SHOW_ALL"]){
            $this->arParams["LIST_PAGE_URL"] = empty($this->arParams["LIST_PAGE_URL"]) ? $listPageUrl : $this->arParams["LIST_PAGE_URL"];
        }
    }

    /**
     * @return void
     */
    protected function hideLinks() : void
    {
        $this->arParams["SHOW_MAP"] = false;
        $this->arParams["SHOW_ALL"] = false;
        $this->arParams["LIST_PAGE_URL"] = "#";
    }
}