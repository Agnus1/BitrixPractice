<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


/*************************************************************************
    Processing of received parameters
*************************************************************************/

// удаляем неиспользуемый параметр
unset($arParams["IBLOCK_TYPE"]);

// получаем целочисленное значение ID инфоблока
$arIBlockFilter = intval($arParams["IBLOCK"]);

// обработка ошибок, проверка полей, вводимых вручную пользователем
// (кроме списков и чекбоксов)
if ($arIBlockFilter <= 0) {
    ShowError(GetMessage("WRONG_IBLOCK"));  
    return;
}

if (intval($arParams["AMOUNT_OF_EL"]) <= 0) {
    ShowError(GetMessage("WRONG_AMOUNT_OF_EL"));    
    return;
}

if(!CModule::IncludeModule("iblock")) {
    ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
    return;
}


// установка времени кэширования по умолчанию
if(!isset($arParams["CACHE_TIME"])) {
    $arParams["CACHE_TIME"] = 180;
}

// проверка на наличие актулаьного кэша
if($this->StartResultCache(false, false)) {

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
        "nTopCount" => $arParams['AMOUNT_OF_EL'],
    ];

    //ORDER BY
    $arSort = [
        $arParams["SORT_FIELD"] => $arParams["SORT_ORDER"],
    ];

    //EXECUTE
    $rsIBlockElement = CIBlockElement::GetList($arSort, $arFilter, false, $arLimit, $arSelect);

    // проверка на наличие записей в выборке
    if ($rsIBlockElement->SelectedRowsCount()) {

        // получение элементов из списка и запоминание в arResult, запоминание id картинок
        while ($el = $rsIBlockElement->GetNext()) {
            // получение id картинки (Ключ - id элемента, значение - id картинки)
            if ($el['PREVIEW_PICTURE']) {
                $images[$el["ID"]] = $el["PREVIEW_PICTURE"];
            }
            $arResult[$el["ID"]] = $el;
        }

        // получение картинок и привязка к элементам
        if (!empty($images)) {
            $res = CFile::getList([], ["@ID" => $images]);
            while ($image = $res->GetNext()) {
                $elID = array_search($image["ID"], $images);
                $arResult[$elID]["IMAGE_SRC"] = CFile::GetFileSRC($image);
            }
        }

        // установка ссылки "все" в массив параметров (если ссылка задана в компоненте, то она и устанавливается, 
        // в противном случае - берётся из инфоблока)
        $arParams["LIST_PAGE_URL"] = $arParams["LIST_PAGE_URL"] ?? array_values($arResult)[0]["LIST_PAGE_URL"];
    } else {
        // вывод ошибки без прерывания скрипта, в случае если в выборке нет элементов 
        // (чтобы результат закэшировался и при каждом переходе не делались запросы), 
        // устаноква флага на скрытие ссылок
        ShowError(GetMessage("NO_ELEMENTS"));
        $arParams["SHOW_ALL"] = "N";
    }

    // отображение всех ссылок если флаг установлен на "Y", сокрытие - в противном случае
    $arParams["SHOW_ALL"] = ($arParams["SHOW_ALL"] === "Y");
    $arParams["LIST_PAGE_URL"] = ($arParams["SHOW_ALL"] ? $arParams["LIST_PAGE_URL"] : '#');

    $this->SetResultCacheKeys([]);
    $this->IncludeComponentTemplate();
}
?>
