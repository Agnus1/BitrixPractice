<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\SystemException;

class StoresList extends CBitrixComponent
{
    private $resultCacheKeys = [];

    /**
     * @param array $arParams
     * @return array
     */
    public function onPrepareComponentParams(array $arParams) : array
    {
        $arParams["SHOW_ALL"] = ($arParams["SHOW_ALL"] === "Y");
        $arParams["SHOW_MAP"] = ($arParams["SHOW_MAP"] === "Y");

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
        try {
            $this->checkModuleErrors();
            $this->setHermitageAddButton();
            if ($this->StartResultCache(false, false)) {
                    $this->checkInputErrors();
                    $this->getArResult($this->getSalonsList());
                    $this->setHermitageElementEditButtons();
                    $this->setLinks();
                    $this->setMapSerializedPlacemarks();
                    $this->SetResultCacheKeys($this->resultCacheKeys);
                    $this->IncludeComponentTemplate();
            }
        } catch (SystemException $e) {
            ShowError($e->getMessage());
            return;
        }

    }

    /**
     * @param CIBlockResult $rsIBlockElement
     * @return void
     */
    protected function getArResult(CIBlockResult $rsIBlockElement)
    {
        while ($salon = $rsIBlockElement->GetNext()) {
            $this->arResult["ELEMENTS"][$salon["ID"]] = $salon;
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
                $this->arResult["ELEMENTS"][$salonId]["IMAGE_SRC"] = $imagesSRC[$imageId];
            }
        }
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
            "NAME",
            "PREVIEW_PICTURE",
            "PROPERTY_PHONE",
            "PROPERTY_ADDRESS",
            "PROPERTY_WORK_HOURS",
        ];

        if ($this->arParams["SHOW_ALL"]) {
            $arSelect[] = "LIST_PAGE_URL";
        }

        if ($this->arParams["SHOW_MAP"]) {
            $arSelect[] = "PROPERTY_MAP";
        }

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
        } else {
            $arLimit = false;
        }

        //ORDER BY
        $arSort = [
            $this->arParams["SORT_FIELD"] => $this->arParams["SORT_ORDER"],
        ];

        //EXECUTE
        $result = CIBlockElement::GetList($arSort, $arFilter, false, $arLimit, $arSelect);

        if (!$result->SelectedRowsCount()) {
            ShowError(GetMessage("NO_ELEMENTS"));
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
    }

    /**
     * @return void
     */
    protected function checkModuleErrors() : void
    {
        if (!CModule::IncludeModule("iblock")) {
            throw new SystemException(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        }
    }

    /**
     * @return voidQ
     */
    protected function setMapSerializedPlacemarks() : void
    {
        foreach ($this->arResult["ELEMENTS"] as $salon) {
            list($lat, $lon) = explode(',', $salon["PROPERTY_MAP_VALUE"]);
            $res[] = [
                "LON" => $lon,
                "LAT" => $lat,
                "TEXT" => $salon["NAME"],
            ];
        }

        $this->arResult["MAP_PLACEMARKS"] = serialize($res);
        $this->resultCacheKeys[] = "MAP_PLACEMARKS";
    }

    /**
     * @param String|null $listPageUrl
     * @return void
     */
    protected function setLinks() : void
    {
        if ($this->arParams["SHOW_ALL"] && $this->arResult["ELEMENTS"][0]["LIST_PAGE_URL"]) {
            $this->arParams["LIST_PAGE_URL"] = empty($this->arParams["LIST_PAGE_URL"]) ? $this->arResult["ELEMENTS"][0]["LIST_PAGE_URL"] : $this->arParams["LIST_PAGE_URL"];
        };
    }

    /**
     * @return void
     */
    protected function setHermitageElementEditButtons() : void
    {
        if (!empty($this->arResult["ELEMENTS"])) {
            foreach ($this->arResult["ELEMENTS"] as &$salon) {
                $arButtons = CIBlock::GetPanelButtons(
                    $salon["IBLOCK_ID"],
                    $salon["ID"],
                    0,
                    ["SECTION_BUTTONS" => false, "SESSID" => false]
                );

                $salon["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
                $salon["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
                $salon["EDIT_LINK_TEXT"] = $arButtons["edit"]["edit_element"]["TEXT"];
                $salon["DELETE_LINK_TEXT"] = $arButtons["edit"]["delete_element"]["TEXT"];
            }
        }
    }

    /**
     * @return void
     */
    protected  function  setHermitageAddButton() : void
    {
        $arButtons = CIBlock::GetPanelButtons(
            $this->arParams["IBLOCK"],
            0,
            0,
            ["SECTION_BUTTONS" => false, "SESSID" => false]
        );
        $this->arParams["ADD_LINK"] = $arButtons["edit"]["add_element"]["ACTION_URL"];
        $this->arParams["ADD_LINK_TEXT"] = $arButtons["edit"]["add_element"]["TEXT"];

    }
}